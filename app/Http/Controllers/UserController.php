<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        //CONEXION BBDD CON FACADES, ojo importar la clase DB de facades
        // RAW SQL QUERYS (consultas en crudo a lo bestia)
        // $personas = DB::select('select * from persona where sexo = ?', ['H']);
        // dd($personas);
        // // para mostras la info desde el controlador:
        // foreach($personas as $users){
        //     echo $users->nombre. '</br>';
        // }

        // DB::insert('insert into persona (id, nombre, apellido1, ciudad, direccion, fecha_nacimiento, sexo, tipo) values (?,?,?,?,?,?,?,?)',[26,'Dayle','Fernandez','Berlín','C/hola','1988-10-29', 'H', 'alumno']);

        // $affected = DB::update('update persona set nombre = "Dayle2" where id = ?', ['25']);
        // $deleted = DB::delete('delete from persona where nombre="Dayle2"');
        //DB::statement('drop table persona');

        //Transacciones (el ejemplo no está adaptado a la BBDD actual)
        // DB::transaction(function () {
        //     DB::table('users')-update(['votes => 1']);
        //     DB::table('posts')->delete();
        // });

        // DB::beginTransaction();
        // DB::rollBack();
        // DB::commit();

        // FLUENT!!!!
        // concatenar funciones que llevan las consultas
        // esto devuelve un array de objetos
    //     $personas = DB::table('persona')->get();
    //     // foreach($personas as $user){
    //     //     echo $user->nombre.'</br>';
    //     // }
    //     // devuelve una columna concreta con pluck
    //     $apellido2 = DB::table('persona')->pluck('apellido2');
    //     $apellido1 = DB::table('persona')->pluck('apellido1', 'nombre');

    //     // foreach($apellido1 as $nombre => $apellido1){
    //     //     echo $nombre, '-', $apellido1.'</br>';
    //     // }
    //     // contar filas
    //     $users = DB::table('persona')->count();
    //     echo "hay $users usuarios";

    //     // CONSULTAS DE AGREGADOS
    //     $fecha = DB::table('persona')->max('fecha_nacimiento');
    //     echo "la ultima fecha: $fecha";

        // DEPURAR CONSULTAS
        DB::listen(function($sql){
            var_dump($sql->sql);
            var_dump($sql->bindings);
        });
    //     $personas = DB::table('persona')->distinct()->get();
    //    // var_dump($personas);
    //     $cuantosTIpos = DB::table('persona')
    //                     ->distinct()
    //                     ->select('tipo')
    //                     ->get()
    //                     ->count();
                    
    //     echo $cuantosTIpos;
    //     $tipoApellido = DB::table('persona')->select('tipo', 'apellido2');
    //     $salida = $tipoApellido->addSelect('nombre')->get();

    //     // CONDICIONES
    //     // si no encadeno el metodo select(), entonces sera un 'select' * from ....
    //     $personas = DB::table('persona')->where('sexo', '=', 'H')->get();
    //     $personas = DB::table('persona')->where('sexo', 'H')->get();

    //     //FIND
    //     $user = DB::table('persona')->find(3);
    //     echo $user->nombre, ' ', $user->apellido1;
    //     // FIRST
    //     $personas = DB::table('persona')->where('sexo', 'H')->first();
    //     echo $user->nombre;
    //     // LIKE
        
    //    $personas = DB::table('persona')->where('nombre', 'like', 'S%')->get();
    //    //like con array  
    //    $personas = DB::table('persona')->where([
    //         ['nombre', 'like', 'S%'],
    //         ['sexo', '=', 'M'], 

    //         ])->get();
            
    //         $personas = DB::table('persona')->where([
    //             ['nombre', 'like', 'C%'],
    //             ['sexo', '=', 'M'], 
    
    //             ])->get();
        
        
        // $personas = DB::table('persona')
        //     ->where('tipo','alumno')
        //     ->orWhere(function($query) {
        //         $query->where('apellido1', 'like', 'H%')
        //             ->where('tipo', 'profesor');
        //     })->get();
        //     // whereBetween
        //     $personas = DB::table('persona')
        //         ->whereBetween('id', [1,10])
        //         ->get();

        //     //whereIn // whereNotIn // orWhereIn / orWhereNotIn
        //     $personas = DB::table('persona')
        //         ->whereIn('id', [1,2,3])
        //         ->get();

        //     // whereNull // whereNotNull / orWhereNull // orWhereNotNull

        //     $personas = DB::table('persona')
        //         ->whereNull('telefono')
        //         ->get();
        //     $personas = DB::table('persona')
        //         ->whereNull('telefono')
        //         ->get();

        //     //wheredate
        //     $personas = DB::table('persona')
        //         ->whereDate('fecha_nacimiento', '>=', '1992-08-08')
        //         ->get();
            // comprobar columnas entre si
            $personas = DB::table('persona')
                ->whereColumn('apellido1', 'apellido2')
                ->get();

            // varias condiciones sobre varias columnas
             $personas = DB::table('persona')
                ->whereColumn([
                    ['apellido1', '=', 'apellido2'],
                    ['apellido1', '>', 'apellido2'],
                ])->get();   

            // SUBCONSULTAS

            $personas = DB::table('persona')
                    ->whereExists(function($query){
                        $query->select(DB::raw(1))
                        ->from('alumno_se_matricula_asignatura')
                        ->whereRaw('persona.id = alumno_se_matricula_asignatura.id_alumno');
                    }) ->get();

            //dd($personas);

            // $users = DB::table('users')
            // ->where(function ($query) {
            //     $query->select('type')
            //         ->from('membership')
            //         ->whereColumn('user_id', 'users.id')
            //         ->orderByDesc('start_date')
            //         ->limit(1);
            // }, 'Pro')->get();

            $personas = DB::table('persona')->orderBy('id')->chunk(5,function ($users){
                foreach($users as $user){
                    echo $user->nombre.'<br/>';
                }
                return false;
            });

            // DEVUELVE TRUE SI LA CONSULTA TIENE ALGUN RESULTADO
            echo DB::table('persona')->where('tipo','alumno')->exists();

            // DEVUELVE TRUE SI LA CONSULTA NO OBTIENE ALGUN RESULTADO
            echo DB::table('persona')
                ->where('nombre', 'alfonsito')
                ->doesntExist();


            $personas = DB::table('persona')
                ->orderBy('apellido1', 'desc')
                ->orderBy('apellido2', 'asc')
                ->get();

            // busca por defecto segun la columna created_at
            $personas = DB::table('persona')
                ->latest('fecha_nacimiento')
                ->first();


            // orden aleatorio

            $personas = DB::table('persona')
                ->inRandomOrder('fecha_nacimiento')
                ->first();

               
                
            $personas = DB::table('persona')->select('sexo')
                ->groupBy('sexo')
                ->having('sexo', 'H')
                ->get();    
            //skip equivale a offset y take equivale a limit
            //select * from `persona` limit 5 offset 10
            $personas = DB::table('persona')->skip(10)->take(5)->get();




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
        // el más sencillo para acceder a ese campo
        // dd($request->email)
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
            'nombre_producto' => 'required',
            'descripcion' => 'max:200',
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
