<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Machine;
use Illuminate\Support\Facades\Storage;
use Validator;
use File;
use App\Publicity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicityController extends Controller
{
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
        return Publicity::all()->toJson();
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
            'name',
            'description',
            'company_id'
        );
        $validator = Validator::make($request->all(), [
            'description'   => 'string|required',
            'name'          => 'string|required',
            'company_id'    => 'integer|required|exists:companies,id',
            'logo'           => 'file|required|image',
            'vid'           => 'file|required|mimes:mp4,ogg,webm'
        ],$this->messages());
        if($validator->fails()) {
            return response($validator->errors(),400);
        }

        //obtenemos el campo file definido en el formulario
        $vid = $request->file('vid');
        $logo = $request->file('logo');

        //obtenemos el nombre del archivo
        if(Storage::exists($data['vid'] = $vid->getClientOriginalName())) return response()->json((['vid' =>["nombre de video existente"]]),400);
        if(Storage::exists($data['logo'] = $logo->getClientOriginalName())) return response()->json((['logo' =>["nombre de video existente"]]),400);
        //indicamos que queremos guardar un nuevo archivo en el disco local
        Storage::disk('local')->put($data['vid'],   File::get($vid));
        Storage::disk('local')->put($data['logo'],  File::get($logo));
        return Publicity::create($data)->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param Publicity $publicity
     * @return string
     */
    public function show(Publicity $publicity)
    {
        return $publicity->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Publicity $publicity
     * @return Publicity
     */
    public function update(Request $request, Publicity $publicity)
    {
        $vid = $logo = null;
        $validator = Validator::make($request->all(), [
            'description'   => 'string',
            'name'          => 'string',
            'company_id'    => 'integer',
            'logo'           => 'file|image',
            'vid'           => 'file|mimes:mp4,ogg,webm'
        ], $this->messages());
        $data = $request->only(
            'name',
            'description',
            'company_id'
        );

        if($validator->fails()) return response()->json($validator->errors(),400);
        //obtenemos el campo file definido en el formulario¿
        if($request->file('vid') != null){
            if(!$request->file('vid')->isValid()) return response()->json(["error" => "error con el video."], 400);

            $vid = $request->file('vid');
            $data['vid'] = $vid->getClientOriginalName();
            if(Storage::exists($data['vid'] )) return response()->json(('nombre de video existente'),400);
            //indicamos que queremos guardar un nuevo archivo en el disco local

        }
        if($request->file('logo') != null){
            if(! $request->file('logo')->isValid())             return response()->json(["error" => "error con el logo."], 400);

            $logo= $request->file('logo');
            $data['logo'] = $logo->getClientOriginalName();
            if(Storage::exists($data['logo'])) return response()->json(('nombre de logo existente'),400);
            //indicamos que queremos guardar un nuevo archivo en el disco local
        }

        if($vid){
            Storage::delete($publicity->vid);
            Storage::disk('local')->put($data['vid'],   File::get($vid));
        }
        if($logo){
            Storage::delete($publicity->logo);
            Storage::disk('local')->put($data['logo'],   File::get($logo));
        }
        if($publicity->update((array_filter($data)))) return $publicity;
        return response()->json('error al actualizar, recargue la página y vuelva a intentar',400);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Publicity $publicity
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Publicity $publicity)
    {
        return  json_encode($publicity->delete());
    }

    public function view()
    {
        $publicities = Publicity::all();
        $companies = Company::all();
        $machines = Machine::all();
        return view('publicity.index',compact('publicities','companies','machines'));
    }

    public function attachMachine(Publicity $publicity, Request $request)
    {
        if($publicity->machines()->where('machine_id',$request->get('machine_id'))->first() != null) return 'false';
        $publicity->machines()->attach($request->get('machine_id'));
        return Machine::where('id',$request->get(('machine_id')))->first()->toJson();
    }

    public function detachMachine(Publicity $publicity, Request $request)
    {
        $publicity->machines()->detach($request->get('machine_id'));
        return 'true';
    }

    public function getMachines(Publicity $publicity)
    {
        return $publicity->machines()->get()->toJson();
    }

    /**
     * return message for validator fails()
     * @return array
     */
    private function messages()
    {
        return [
            'description.string'        => 'La descripción debe ser un texto',
            'description.required'      => 'La descripción es requerida',
            'name.string'               => 'el nombre debe ser un texto',
            'name.required'             => 'El nombre se requiere',
            'company_id.integer'        => 'Esa compañia no existe, recargue la página',
            'company_id.required'       => 'Se requiere una compañia',
            'logo.file'                 => 'El logo debe ser una imagen',
            'logo.required'             => 'El logo es necesario',
            'logo.image'                => 'El logo debe ser una imagen',
            'vid.file'                  => 'El video debe ser de tipo mp4, ogg o webm',
            'vid.mimes'                 => 'El video debe ser de tipo mp4, ogg o webm',
            'vid.required'              => 'El video es necesario'
        ];
    }

    public function getResources(Request $request, $archivo)
    {
        $public_path = public_path();
        $url = $public_path.'/storage/img/'.$archivo;
        //verificamos si el archivo existe y lo retornamos
        if (Storage::exists($archivo))
        {
            return response()->download($url);
        }
        //si no se encuentra lanzamos un error 404.
        return response()->json(["error" => "archivo no encontrado."], 404);
    }
}
