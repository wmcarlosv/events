<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Event;
use Auth;

class EventsController extends Controller
{
    private $view = "admin.events.";
    private $router = "events.index";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Event::all();
        $title = "Events";

        return view($this->view."index",['title' => $title,'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'New Event';
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
            'title' => 'required',
            'description' => 'required',
            'event_date' => 'required'
        ]);

        $object = new Event();
        $object->user_id = auth::user()->id;
        $object->title = $request->input('title');
        $object->description = $request->input('description');
        $object->event_date = date('Y-m-d',strtotime($request->input('event_date')));

        if($request->hasFile('cover')){
            $object->cover = $request->cover->store('events/covers');
        }else{
            $object->cover = NULL;
        }

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
        $title = 'Edit Event';
        $action = 'update';
        $data = Event::findorfail($id);

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
            'title' => 'required',
            'description' => 'required',
            'event_date' => 'required'
        ]);

        $object = Event::findorfail($id);
        $object->user_id = auth::user()->id;
        $object->title = $request->input('title');
        $object->description = $request->input('description');
        $object->event_date = date('Y-m-d',strtotime($request->input('event_date')));

        if($request->hasFile('cover')){
            Storage::delete($object->cover);
            $object->cover = $request->cover->store('events/covers');
        }

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
        $object = Event::findorfail($id);
        if($object->status == 'open'){
            $object->status = 'close';
        }else{
            $object->status = 'open'; 
        }

        if($object->update()){
            flash()->overlay('Registro Actualizado con Exito!!','Alerta');
        }else{
            flash()->overlay('Error al tratar de  actualizar con Exito!!','Error');
        }

        return redirect()->route($this->router);
    }
}
