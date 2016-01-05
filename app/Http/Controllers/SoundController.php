<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller,App\Sound,Auth;

class SoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sounds.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sounds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateSoundFileRequest $request)
    {
        $Sound = Sound::create([
            'customer' => Auth::user()->customer,
            'recording_name' => $request->input('filename'),
            'recording_file' => ''.$request->input('filename').'.wav'
        ]);

        $routeText = file_get_contents(env('EXTENSIONS_CONF_FILE_PATH'));
        $routeText = str_replace(";place recording routes here\n",";place recording routes here\n".$Sound->route."\n",$routeText);
        file_put_contents(env('EXTENSIONS_CONF_FILE_PATH'), $routeText);

        \Session::flash('success_message',"Sound file created");
        return redirect('/sounds');
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
        $Sound = Sound::find($id);

        return view('sounds.edit')->with('Sound',$Sound);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\CreateSoundFileRequest $request, $id)
    {
        $Sound = Sound::find($id);

        if($request->input('delete') == 'on'){
            if($Sound->isInUse()){
                \Session::flash('error_message',"Cannot delete a file that is in use");
                return redirect()->back();
            }
            $routeText = file_get_contents(env('EXTENSIONS_CONF_FILE_PATH'));
            $routeText = str_replace($Sound->route."\n","",$routeText);
            file_put_contents(env('EXTENSIONS_CONF_FILE_PATH'), $routeText);
            $Sound->delete();
            \Session::flash('success_message',"Sound file deleted");
            return redirect('/sounds');
        }

        $Sound->recording_name = $request->input('filename');
        $Sound->save();

        \Session::flash('success_message',"Sound file updated");
        return redirect('/sounds');
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
