<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::orderBy('id','ASC')->paginate(8); //Para traer los datos pero ordenados, en este caso por ID, y creo una paginacion para mostrar usuarios
        return view('Admin/User/index')->with('usuarios', $user); //Paso la variable para usarla en la vista primer parametro el nombre que va a adoptar el segundo es el valor que quiero pasar, esto es lo mismo que pasar ('Admin/User/index', ['usuarios' =>$user]);
        
        /*
        $user = User::all();
        dd($user);
        */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('Admin/User/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if($request->validate([
        // 'name'  => 'required|min:5|max:255',
        // 'email' => 'required|email|unique:users',
        // 'password'  => 'required',
        // 'type' => 'required'
        // ])){
        // $user = new User($request->all());
        // $user->password = bcrypt($request->clave);
        // $user->save();
        // return redirect()->action('UsersController@index');
        // }else{
        // return $request->validate([
        // 'name'  => 'required|min:5|max:255',
        // 'email' => 'required|email|unique:users',
        // 'password'  => 'required',
        // 'type' => 'required'
        // ]);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*$user = User::find($id);
        dd($user->name);*/
        dd($id);
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
        $user = User::findOrFail($id);
        $req = new User($request->all());

        if(is_null($req['type'])){
            $user->type = $user->type;
        }else{
            $user->type = $request->type;
        }

        if(is_null($req['status'])){
            $user->status = $user->status;
        }else{
            $user->status = $request->status;
        }

        if(is_null($req['space'])){
            $user->space = $user->space;
        }else{
            $user->space = $request->space;
        }

        $user->save();
        return redirect()->action('UsersController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->action('UsersController@index');
    }

}