<?php

namespace App\Http\Controllers\Api;

use App\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Machine;
use App\Stat;
use App\Tank;
use Validator;
use Carbon\Carbon;

class TankController extends Controller
{
    public function all(Request $request)
    {
        $tanks = Tank::all();
        return $tanks;
    }

    public function addTankValues(Request $request)
    {
        $input = $request->only(
            'machine_id',
            'product_values'
        );

        $validator = Validator::make($input, [
            'machine_id' => 'required|integer|exists:machines,machine_id',
            'product_values' => 'required|array',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        $tankData = Tank::where('machine_id',$input['machine_id'])->first();

        if(is_null($tankData)){
            $tankData = Tank::create($input);
            return $tankData;
        }
        else{
            $tankData->product_values = $input['product_values'];
            $tankData->save();
            return $tankData;
        }
    }

    public function getByMachineId(Request $request,$machine_id)
    {
        $input = ['machine_id'=>$machine_id];

        $validator = Validator::make($input, [
            'machine_id' => 'required|integer|exists:machines,machine_id'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        $tankData = Tank::where('machine_id',$machine_id)->first();

        if(is_null($tankData))
            return response()->json(['key'=>'NO_DATA','message'=>'no data for machine_id='.$machine_id],400);

        return $tankData;

    }

    public function alertByThreshold(Request $request)
    {
        $input = $request->only(
            'machine_id'
        );

        $validator = Validator::make($input, [
            'machine_id' => 'required|integer|exists:machines,machine_id'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        return response()->json(["key"=>'ALERT_SENT','message'=>'the alert has been sent.']);
    }

    public function alertByExhausted(Request $request)
    {
        $input = $request->only(
            'machine_id'
        );

        $validator = Validator::make($input, [
            'machine_id' => 'required|integer|exists:machines,machine_id'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        return response()->json(["key"=>'ALERT_SENT','message'=>'the alert  has been sent.']);
    }

    public function show(Tank $tank)
    {
        return $tank->toJson();
    }

    public function store(Request $request)
    {
        $data = $request->only(
            'machine_id',
            'product_values',
            'min_product_values',
            'status',
            'product_id'
        );

        $validator = Validator::make($data, [
            'machine_id'                => 'required|integer|exists:machines,id',
            'product_values'            => 'required|integer|min:0',
            'min_product_values'        => 'required|integer|min:0',
            'status'                    => 'required|boolean',
            'product_id'                => 'required|integer|exists:products,id',
        ],$this->messages());

        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        $data['alert']= 1;
        return Tank::create($data);
    }

    /**
     * @param Tank $tank
     * @param Request $request
     * @return Tank|\Illuminate\Http\JsonResponse
     */
    public function update(Tank $tank, Request $request)
    {
        $data = $request->only(
            'machine_id',
            'product_values',
            'min_product_values',
            'status',
            'product_id'
        );

        $data= array_filter($data);

        if($request->get('status') == '0') $data['status'] = $request->get('status');

        if($tank->update($data) == true) return $tank;

    }

    public function reporte(Tank $tank, Request $request)
    {
        $data = $request->only('product_values');

        $data= array_filter($data);

        if(array_key_exists('product_values',$data))
        {
            if($data['product_values'] < 0){
                Sale::create([
                    'product_id'        => $tank->product_id,
                    'machine_id'        => $tank->machine_id,
                    'price'             => $tank->product->price,
                    'quantity'          => -1*$data['product_values'],
                    'total_amount'      => (-1*$data['product_values'])*$tank->product->price,
                    'code'              => $tank->machine->sales->count()
                ]);
                Stat::create([
                    'product_id'        => $tank->product_id,
                    'machine_id'        => $tank->machine_id,
                    'product_count'     => -$data['product_values'],
                    'event_types_id'    => 1,
                    'date'              => $tank->created_at->format('Y-m-d'),
                    'hour'              => $tank->created_at->format('H')
                ]);
            }
            if($data['product_values'] > 0)
            {
                Stat::create([
                    'product_id'        => $tank->product_id,
                    'machine_id'        => $tank->machine_id,
                    'product_count'     => $data['product_values'],
                    'event_types_id'    => 2,
                    'date'              => $tank->created_at->format('Y-m-d'),
                    'hour'              => $tank->created_at->format('H')
                ]);
            }

        return $tank;
        }
        return response()->json(400) ;
    }

    public function destroy(Tank $tank)
    {
        return  json_encode($tank->delete());
    }

    public function updateForTable(Tank $tank, Request $request)
    {
        $data = $request->only(
            'machine_id',
            'product_values',
            'min_product_values',
            'status',
            'product_id'
        );
        $validator = Validator::make($data, [
            'machine_id'                => 'integer|exists:machines,id',
            'product_values'            => 'min:0',
            'min_product_values'        => 'min:0',
            'status'                    => 'boolean',
            'product_id'                => 'integer|exists:products,id',
        ],$this->messages());

        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }
        $tank =$this->update($tank, $request);
        $output ='';
        $output .='{"id":'.$tank->id.
            ',"machine_id":'.$tank->machine_id.
            ',"product_name":"'.$tank->product->name.
            '","product_values":'.$tank->product_values.
            ',"min_product_values":'.$tank->min_product_values.
            ',"status":'.$tank->status.
            ',"product_id":'.$tank->product_id.
            '}';
        return $output;
    }

    public function storeForTable(Request $request)
    {

        $data = $request->only(
            'machine_id',
            'product_values',
            'min_product_values',
            'status',
            'product_id'
        );

        $validator = Validator::make($data, [
            'machine_id'                => 'required|integer|exists:machines,id',
            'product_values'            => 'required|numeric|min:0',
            'min_product_values'        => 'required|numeric|min:0',
            'status'                    => 'required|boolean',
            'product_id'                => 'required|integer|exists:products,id',
        ],$this->messages());
        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        $tank = $this->store($request);

        $output ='';
        $output .='{"id":'              .$tank->id.
            ',"machine_id":'            .$tank->machine_id.
            ',"product_name":"'         .$tank->product->name.
            '","product_values":'       .$tank->product_values.
            ',"min_product_values":'    .$tank->min_product_values.
            ',"status":'                .$tank->status.
            ',"product_id":'            .$tank->product_id.
            '}';
        return $output;

    }

    public function toggleAlert(Tank $tank)
    {
        return $tank->toggleAlert()->toJson();
    }

    private function messages()
    {
        return [
            'machine_id.integer'            => 'Error en la selección de maquina',
            'machine_id.required'           => 'Seleccione una maquina',
            'machine_id.exists'             => 'Ups! alguien debio borrar la maquina, porfavor recargue la página',
            'product_values.required'       => 'El nivel de productos no puede ser nulo',
            'product_values.integer'        => 'El nivel de productos debe ser un número',
            'product_values.min'            => 'La cantidad de productos no puede ser negativa',
            'min_product_values.integer'    => 'La cantidad minima de productos debe ser un entero',
            'min_product_values.required'   => 'La cantidad minima de productos no puede ser nula',
            'min_product_values.min'        => 'La cantidad minima de productos no puede ser negativa',
            'status.boolean'                => 'Error en el campo Estatus, recargue la página',
            'status.required'               => 'Seleccione un estatus',
            'product_id.exists'             => 'Ups! alguien debio borrar el producto, porfavor recargue la página',
            'product_id.integer'            => 'El producto seleccionado no existe, recargue la pagina y pruebe de nuevo',
            'product_id.required'           => 'El producto no puede ser nulo',
        ];
    }
}
