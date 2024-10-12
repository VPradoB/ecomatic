<?php

namespace App\Http\Controllers\Api;

use App\Machine;
use App\Sale;
use App\Tank;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        return Sale::all()->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(Request $request)
    {
        $data = $request->only(
            'product_id',
            'machine_id',
            'price',
            'quantity'
        );

        $validator = Validator::make($data, [
            'product_id' => 'required|integer',
            'tank_id'=> 'required|integer',
            'machine_id'=> 'required|integer',
            'price' => 'required|integer',
            'quantity' =>'required|integer'
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        $data['total_amount']= $data['price']*$data['quantity'];

        $data['code'] = Machine::where('id',$data['machine_id'])->first()->sale->count();

        return Sale::create($data)->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return string
     */
    public function show(Sale $sale)
    {
        return $sale->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        return json_encode($sale->delete());
    }

    public function view()
    {
        $sales = Sale::all();
        return view('sale.index',compact('sales'));
    }

    public function indexByDateRange(Request $request)
    {
        $dateRange = explode("-",$request->get('dateRange'));
        $sales = Sale::whereDateRange(substr($dateRange[0],0,-1),substr($dateRange[1],1));


        if($request->exists('pdf')){
            $view = View::make('document.pdf.sales',compact('sales','machine'))->render();
            $pdf = PDF::loadHTML($view);
            return $pdf->stream('document.pdf');
        }else{
            $sales->transform(function($item,$key){
                return [
                    'Codigo de venta'   => 'M'.dechex($item->machine->id).'-'.$item->code,
                    'Producto' => $item->product->name,
                    'Maquina'  => $item->machine->mac.", ".$item->machine->name." (".$item->machine->ubication.")",
                    'Precio'   => $item->price,
                    'Cantidad' => $item->quantity,
                    'Total de venta' => $item->total_amount,
                    'Fecha'     =>$item->created_at
                ];
            });
            Excel::create(Carbon::now().'_sales_report', function($excel) use ($sales) {
                $excel->setTitle(Carbon::now().'_sales_report');

                $excel->sheet('New sheet', function($sheet) use ($sales) {
                    $sheet->fromArray($sales);

                });
            })->download('xls');
        }

    }
}
