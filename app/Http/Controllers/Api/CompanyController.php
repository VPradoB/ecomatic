<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Product;
use App\Publicity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;


class CompanyController extends Controller
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
            'phone_number',
            'direction'
            );
        $validator = Validator::make($data, [
            'name'      => 'required|string',
            'direction' => 'required|string',
            'phone_number'    => 'required|string'
        ],$this->message());
        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }
        return Company::create($data)->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return string
     */
    public function show(Company $company)
    {
        return $company->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return string
     */
    public function update(Request $request,Company $company)
    {
        $data = $request->only(
            'name',
            'phone_number',
            'direction'
        );
        $validator = Validator::make($data, [
            'name'            => 'string|max:100',
            'direction'       => 'string|max:100',
            'phone_number'    => 'string|max:100'
        ],$this->message());
        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }
        if($company->update(array_filter($data))== true) return $company->toJson();
        return response()->json($validator->errors(),400);
    }

    /**
     * Remove a company
     *
     * @param Company $company
     * @return \Illuminate\Http\Response|string
     */
    public function destroy(Company $company)
    {
        foreach ($company->publicties as $publicty) $publicty->delete();
        try {
            return json_encode($company->delete());
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function view()
    {
        $companies = Company::all();
        return view('company.index',compact('companies'));
    }

    private function message()
    {
        return [
            'name.string'               => 'El nombre de la compañia debe ser un texto',
            'name.max'                  => 'El nombre de la compañia ha excedido el tamaño maximo (100 caracteres)',
            'name.required'             => 'Se requiere un nombre para la compañia',
            'direction.string'          => 'La direción de la compañia debe ser un texto',
            'direction.max'             => 'La dirección de la compañia ha excedido el tamaño maximo (100 caracteres)',
            'direction.required'        => 'Se requiere una dirección para la compañia',
            'phone_number.string'       => 'El número de teléfono de la compañia debe ser un texto',
            'phone_number.max'          => 'El número de teléfono de la compañia ha excedido el tamaño maximo (100 caracteres)',
            'phone_number.required'     => 'El número de teléfono de la compañia',
        ];
    }
}
