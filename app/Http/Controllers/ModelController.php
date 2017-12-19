<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mod;
use App\Package;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subheader = "Model Manager";
        $models = Mod::get();
        return view('model.index',compact('models','subheader'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subheader = "Model Manager";
        $packages = Package::get();
        return view('model.create',compact('packages','subheader'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = Mod::create([
            'name' => $request->modelName,
            'package_id' => $request->package,
            'description' => $request->description
        ]);
        return redirect('/model');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Mod $model)
    {
        $subheader = "Model Manager";
        $model->error;
        return view('model.detail',compact('model','subheader'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subheader = "Model Manager";
        $model = Mod::find($id);
        $packages = Package::get();
        return view('model.edit',compact('model','packages','subheader'));
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
        $model = Mod::find($id);
        $model->name = $request->modelName;
        $model->package_id = $request->package;
        $model->description = $request->description;
        $model->save();
        return redirect('/model');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mod $model)
    {
        $model->delete();
        return redirect('/model');
    }
}
