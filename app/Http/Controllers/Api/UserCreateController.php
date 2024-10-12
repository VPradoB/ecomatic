<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Product;
use App\User;
use App\Publicity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;


class UserCreateController extends Controller
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
        return User::all()->toJson();
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
            'email',
            'password',
            'type'
            );
        $validator = Validator::make($data, [
            'name'      => 'required|string',
            'email' => 'required|string',
            'password'    => 'required|string',
            'type' => 'required|string'
        ],$this->message());
        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }
        return User::create($data)->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return string
     */
    public function show(User $user)
    {
        return $user->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return string
     */
    public function update(Request $request,User $user)
    {
        $data = $request->only(
            'name',
            'email',
            'password',
            'type'
            );
        $validator = Validator::make($data, [
            'name'      => 'required|string',
            'email' => 'required|string',
            'password'    => 'required|string',
            'type' => 'required|string'
        ],$this->message());
        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }
        if($user->update(array_filter($data))== true) return $user->toJson();
        return response()->json($validator->errors(),400);
    }

    /**
     * Remove a company
     *
     * @param Company $company
     * @return \Illuminate\Http\Response|string
     */
    public function destroy(User $user)
    {
        
        try {
            return json_encode($user->delete());
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function view()
    {
        $users = User::all();
        return view('user.index',compact('users'));
    }

    private function message()
    {
        return [
            'name.string'           => 'El nombre del usuario debe ser un texto',
            'name.max'              => 'El nombre del usuario ha excedido el tamaño maximo (100 caracteres)',
            'name.required'         => 'Se requiere un nombre para el usuario',
            'email.string'          => 'El correo del usuario debe ser un texto',
            'email.max'             => 'El correo del usuario ha excedido el tamaño maximo (100 caracteres)',
            'email.required'        => 'Se requiere un correo para el usuario',
            'password.required'     => 'Es necesario una contraseña',
        ];
    }
}