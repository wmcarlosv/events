<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UsersController extends Controller
{
    private $view = "admin.users.";
    private $router = "users.index";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        $title = "Usuarios";

        return view($this->view."index",['title' => $title,'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Nuevo Usuario';
        $action = 'create';

        return view($this->view."save",['title' => $title,'action' => $action]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required'
        ]);

        $object = new User();
        $object->name = $request->input('name');
        $object->email = $request->input('email');
        $object->role = $request->input('role');
        $object->password = bcrypt('123456');

        if($object->save()){
            flash()->overlay('Registro insertado con Exito!!','Alerta');
        }else{
            flash()->overlay('Error al tratar de insertar el Registro!!','Error');
        }

        return redirect()->route($this->router);
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
        $title = 'Editar Usuario';
        $action = 'update';
        $data = User::findorfail($id);

        return view($this->view."save",['title' => $title,'action' => $action, 'data' => $data]);
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
         $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'role' => 'required'
        ]);

        $object = User::findorfail($id);
        $object->name = $request->input('name');
        $object->email = $request->input('email');
        $object->role = $request->input('role');

        if($object->save()){
            flash()->overlay('Registro Actualizado con Exito!!','Alerta');
        }else{
            flash()->overlay('Error al tratar de Actualizar el Registro!!','Error');
        }

        return redirect()->route($this->router);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $object = User::findorfail($id);

        if($object->delete()){
            flash()->overlay('Registro elimninado con Exito!!','Alerta');
        }else{
            flash()->overlay('Error al tratar de  elimninar con Exito!!','Error');
        }

        return redirect()->route($this->router);
    }

    public function profile(){
        $data = Auth::user();
        $title = "Perfil";
        return view($this->view."profile",['title' => $title,'data' => $data]);
    }

    public function edit_profile(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);

        $object = User::findorfail(Auth::user()->id);
        $object->name = $request->input('name');
        $object->email = $request->input('email');

        if($object->save()){
            flash()->overlay('Registro Actualizado con Exito!!','Alerta');
        }else{
            flash()->overlay('Error al tratar de  Actualizado!!','Error');
        }

        return redirect()->route('home');
    }

    public function change_password(Request $request){

        $request->validate([
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $object = User::findorfail(Auth::user()->id);
        $object->password = bcrypt($request->input('password'));

        if($object->save()){
            flash()->overlay('Registro Actualizado con Exito!!','Alerta');
        }else{
            flash()->overlay('Error al tratar de  Actualizado!!','Error');
        }

        return redirect()->route('home');
    }
}
