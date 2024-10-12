<?php

namespace App\Http\Controllers\Api;

use App\Configuration;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigurationController extends Controller
{
    /**
     * ConfigurationController constructor.
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
        return Configuration::all()->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(Request $request)
    {
        $data = $request->only('code','value','description');
        $validator = Validator::make($request->all(), [
            'code' =>'unique:configurations,code|required|string|max:5',
            'value' =>'required|integer',
            'description' =>'required|string|max:250',
        ], $this->message());
        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        return Configuration::create($request->all())->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param Configuration $configuration
     * @return string
     */
    public function show(Configuration $configuration)
    {
        return $configuration->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Configuration $configuration
     * @return string
     */
    public function update(Request $request, Configuration $configuration)
    {
        $request = $request->only(['code','value','description']);
        if($request['code'] == $configuration->code) $request['code'] = '';
        $validator = Validator::make($request, [
            'code' =>'unique:configurations,code|string|max:5',
            'value' =>'integer',
            'description' =>'string|max:250',
        ], $this->message());
        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        if($configuration->update(array_filter($request)) == true) return $configuration->toJson();
        return 'false';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Configuration $configuration
     * @return string
     */
    public function destroy(Configuration $configuration)
    {
        try {
            $result = $configuration->delete();
            return json_encode($result);
        }
        catch (\Exception $e) {
            return response($e->getMessage(),'422');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        $configurations = Configuration::all();
        return view('configuration.index',compact('configurations'));
    }

    private function message()
    {
        return [
            'code.unique' =>'El codigo de la configuración debe ser unico',
            'code.required' =>'Se requiere un codigo',
            'code.max' =>'El codigo excede debe ser de 5 caracteres o menos',
            'value.integer' =>'El valor debe ser entero',
            'value.required' =>'Se requiere un valor',
            'description.string' =>'La descripción excede tamaño maximo (240 caracteres)',
            'description.required' =>'Se requiere una descripción',
        ];
    }
}
