<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // para venir a esta ruta, no hace falta poner /usuarios/index
    public function index()
    {
        return "inicio";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //hace el volcado y muere "dump&die". esto muestra la información de la petición
        //dd($request);
        //dd($request->all());
        //dd(\Request::all());
        //($request->input('name','empty'));
        //if($request ->has('email')){return "la petición viene con el campo email";}
        //if($request -> hasAny('email', 'password')){return "la peticioen viene con el campo email o password";}
        //if ($request->filled('email')){return "el campo email está relleno";}
        //if($request ->missing('correo')){return "la peticion viene sin el campo correo";}
        //dd($request ->only('email','password'));
        //dd($request ->except('email'));
        //echo $request ->url(),'</br>';
        //echo $request ->path(),'</br>';
        // echo $request ->fullUrl(),'</br>';
        // if ($request ->isMethod('post')){
        //     echo "es un POST";
        // }
        // dd($request -> ajax());
        // REGLAS DE VALIDACION
        // $validatedData = $request->validate([
        //     'name' => 'required|max:255',
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);

                // //pasar reglas como parámetro

        $rules =[
            'name' => 'required|max:255',
            'email' => 'required|email',
        ];
        $messages = [
            'required'=>'El campo :attribute es obligatorio.'
            ,'email.required'=>'Dirección de correo inválida u obligatoria'
        ];

        $validatedData = $request->validate($rules, $messages);

        //VALIDACION USANDO FACADES - VALIDATOR
        // $validator = Validator::make($request->all(),$rules);
        // if($validator->fails()){
        //     return redirect('usuarios/create')
        //     ->withErrors($validator)
        //     ->withInput();
        // }
            //otra forma
        // $validator = Validator::make($request->all(),$rules)
        // ->validate();
        // VALIDATE WITH BAG
        //$validatedData = $request->validateWithBag($rules, $messages);

       
        // $validatedData = $request->validate($rules);[
        //     'nombre' => ['required', 'max:255'],
        //     'correo' => ['required', 'email'],
        // ];

        // //declarar varias reglas con arrays
        // $validatedData = $requiest ->validate([
        //     'nombre' => ['required', 'max:255'],
        //     'correo' => ['required', 'email'],
        // ]);

        return "OK!";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
