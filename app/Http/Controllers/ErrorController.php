<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Error;
use App\Component;
use App\Mod;

class ErrorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $subheader = "Error Code";
        $model = Mod::find($id);
        $components = Component::where('mod_id',$id)->get();
        return view('model.error.create',compact('model','components','subheader'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        Error::create([
            'mod_id' => $id,
            'component_id' => $request->component,
            'err_code'=> $request->errorCode,
            'description' => $request->description
        ]);
        return redirect('/model/'.$id.'/show');
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
    public function edit(Error $error)
    {
        $subheader = "Error Code";
        $models = Mod::get();
        return view('model.error.edit',compact('error','models','subheader'));
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
        $error = Error::find($id);
       
        $error->err_code = $request->errorCode;
        $error->mod_id = $request->model;
        $error->description = $request->description;
        $error->component_id = $request->component;
        $error->save();
        return redirect('/model/'.$error->mod->id.'/show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $r)
    {
        return  Error::destroy($r->error);
    }
}
