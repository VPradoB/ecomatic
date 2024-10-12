<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Validator;
use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller

{
    /**
     * ProductsController constructor.
     * auth:api all except(create,edit,show)
     * auth only(create,edit,show)
     */
    public function __construct()
    {
        $this->middleware('api')->except('view');
        $this->middleware('auth')->only('view');
    }


    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        return Product::all()->toJson();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(Request $request)
    {
        $data = $request->only('name','price','vel');
        $validator =Validator::make($request->all(),[
            'name' =>'required|string|max:100',
            'price'=>'required|integer|min:0',
            'logo' => 'file|required|image',
            'vel'  => 'required'
            ],$this->message());
        if($validator->fails()) return response()->json($validator->errors(),400);

        $logo = $request->file('logo');
        if(Storage::exists($data['logo'] = $logo->getClientOriginalName())) return response()->json((['logo' =>["nombre de video existente"]]),400);
        Storage::disk('local')->put($data['logo'],  File::get($logo));
        return Product::create($data)->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return string
     */
    public function show(Product $product)
    {

        return $product->toJson();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Product $product
     * @return bool
     */
    public function update(Request $request,Product $product)
    {
        $data = $request->only(['name','price','vel']);
        $validator =Validator::make($data,[
            'name'=>'string|max:100',
            'price'=>'integer|min:0',
            'vel'=>'min:0',
            'logo'=> 'file|image'
        ],$this->message());
        if($validator->fails()) return response()->json($validator->errors(),400);

        if($request->file('logo') != null){
            if(! $request->file('logo')->isValid())             return response()->json(["error" => "error con el logo."], 400);

            $logo= $request->file('logo');
            $data['logo'] = $logo->getClientOriginalName();
            if(Storage::exists($data['logo'])) return response()->json(('nombre de logo existente'),400);
            //indicamos que queremos guardar un nuevo archivo en el disco local
            Storage::delete($product->logo);
            Storage::disk('local')->put($data['logo'],   File::get($logo));
        }

        if($product->update(array_filter($data)))   return $product->toJson();
        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return bool
     */
    public function destroy(Product $product)
    {
        /** @var Product $product */
        try {
            if($product->delete()) return response()->json(('success'),200);
           return response()->json(('error'),500);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    private function message()
    {
        return [
            'name.required'   => 'El nombre de producto es necesario',
            'name.string'     => 'El nombre debe ser un texto',
            'name.max'        => 'Nombre debe tener maximo 100 caracteres',
            'price.required'  => 'Se necesita un precio para el producto',
            'price.min'       => 'El precio no puede ser negativo',
            'price.integer'   => 'El precio debe ser un número entero',
            'logo.file'                 => 'El logo debe ser una imagen',
            'logo.required'             => 'El logo es necesario',
            'logo.image'                => 'El logo debe ser una imagen'
        ];
    }

    public function getProductsSales(Request $request)
    {

        $return = 0;
        $result = Product::getSales($request->get('month'));
        foreach($result['data'] as $item){
            if($item == 0) $return++;
        }
        if($return == count($result['data'])) return response()->json('No se han vendido productos en este rango de fechas',501);
        return json_encode(Product::getSales($request->get('month')));
    }

    public function salesByDateRange(Request $request)
    {
        /** @var Product $product */
        $product = Product::find($request->get('product_id'));
        $dateRange = explode("-",$request->get('dateRange'));
        $sales = $product->salesByDateRange(substr($dateRange[0],0,-1),substr($dateRange[1],1));

        if($request->exists('pdf')){
            $view = View::make('document.pdf.productsales',compact('sales','product'))->render();
            $pdf = PDF::loadHTML($view);
            return $pdf->stream('document.pdf');
        }else{
            $sales->transform(function($item,$key){
                return [
                    'Codigo de Venta' => 'M'.dechex($item->machine->id).'-'.$item->code,
                    'Producto' => $item->product->name,
                    'Maquina'  => $item->machine->mac.", ".$item->machine->name." (".$item->machine->ubication.")",
                    'Precio'   => $item->price,
                    'Cantidad' => $item->quantity,
                    'Total de venta' => $item->total_amount,
                    'Fecha'     =>$item->created_at
                ];
            });
            Excel::create(Carbon::now().'_product__'.$product->name, function($excel) use ($product,$sales) {
                $excel->setTitle(Carbon::now().'_product__'.$product->name);

                $excel->sheet('New sheet', function($sheet) use ($sales) {
                    $sheet->fromArray($sales);

                });
            })->download('xls');

        }
    }
}
