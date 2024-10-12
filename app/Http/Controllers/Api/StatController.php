<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Machine;
use App\Stat;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Validator;
use Carbon\Carbon;

class StatController extends Controller
{
    public function __construct()
    {
        $this->middleware('api')->except(['view','report']);
        $this->middleware('auth')->only(['view','report']);
    }

    public function all(Request $request)
    {
        $stats = Stat::all();
        return $stats;
    }

    public function addStat(Request $request)
    {
        $input = $request->only(
            'machine_id',
            'date',
            'hour',
            'transactions',
            'product_count'
        );

        $validator = Validator::make($input, [
            'machine_id' => 'required|integer|exists:machines,machine_id',
            'date' => 'required|string|regex:/^\d{2}\/\d{2}\/\d{2}$/',
            'hour' => 'required|integer',
            'transactions' => 'required|integer',
            'product_count' => 'required|array',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        $stat = Stat::where('machine_id',$input['machine_id'])->
            where('date',$input['date'])->
            where('hour',$input['hour'])->first();

        if(is_null($stat)){
            $stat = Stat::create($input);
            return $stat;
        }
        else{
            $stat->transactions = $input['transactions'];
            $stat->product_count = $input['product_count'];
            $stat->save();
            return $stat;
        }
    }

    public function getByMachineId(Request $request,$machine_id)
    {
        $input = $request->only(
            'date'
        );

        $input['machine_id'] = $machine_id;

        $validator = null;

        $date = null;

        if(is_null($input['date'])){
            $validator = Validator::make($input, [
                'machine_id' => 'required|integer|exists:machines,machine_id'
            ]);
            $date = Carbon::now()->format('d/m/y');
        }
        else{
            $validator = Validator::make($input, [
                'machine_id' => 'required|integer|exists:machines,machine_id',
                'date' => 'required|string|regex:/^\d{2}\/\d{2}\/\d{2}$/'
            ]);
            $date = $input['date'];
        }

        if($validator->fails()) {
            //throw new ValidationHttpException($validator->errors()->all());
            return response()->json($validator->errors(),400);
        }


        $stats = Stat::where('machine_id',$machine_id)->where('date',$date)->get();

        return $stats;

    }

    public function index()
    {
        return Stat::all();
    }

    public function view()
    {
        $stadistics = Stat::all();
        return view('stat.log',compact('stadistics'));
    }

    public function report()
    {
        $machines= Machine::all();
        $products = Product::all();
        return view('stat.report',compact('machines','products'));
    }

    public function indexAlertByDateRange(Request $request)
    {
        $dateRange = explode("-",$request->get('dateRange'));
        $stats = Stat::whereDateRange(substr($dateRange[0],0,-1),substr($dateRange[1],1));


        if($request->exists('pdf')){
            $view = View::make('document.pdf.alert',compact('stats'))->render();
            $pdf = PDF::loadHTML($view);
            return $pdf->   stream('document.pdf');
        }else{
            $stats->transform(function($item,$key){
                return [
                    'Producto' => $item->product->name,
                    'Maquina'  => $item->machine->mac.", ".$item->machine->name." (".$item->machine->ubication.")",
                    'Fecha'     =>$item->created_at,
                    'tipo de evento' => $item->event_types->name
                ];
            });
            Excel::create(Carbon::now().'_alert_report', function($excel) use ($stats) {
                $excel->setTitle(Carbon::now().'_alert_report');

                $excel->sheet('New sheet', function($sheet) use ($stats) {
                    $sheet->fromArray($stats);

                });
            })->download('xls');
        }

    }

}
