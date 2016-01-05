<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller,Auth,App\ConferenceBridge,App\UsedExtension,App\Extension;

class ConferenceBridgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('conf.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('conf.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\ConferenceBridgeRequest $request)
    {
        $Bridge = ConferenceBridge::create([
            'customer' => Auth::user()->customer,
            'conf_name' => $request->input('conf_name'),
            'conf_auth' => $request->input('conf_auth')
        ]);

        if($request->input('conf_extension')){
            AsteriskController::genRoute(Auth::user()->Customer->internal_context,$request->input('conf_extension'),'confbridge',$Bridge->id);
            /*Extension::firstOrCreate([
                'context' => Auth::user()->Customer->internal_context,
                'exten' => $request->conf_extension,
                'priority' => '1',
                'app' => 'Answer',
                'appdata' => '',
                'customer' => Auth::user()->customer
            ]);
            $priority=2;
            if($request->input('conf_auth')){
                Extension::firstOrCreate([
                    'context' => Auth::user()->Customer->internal_context,
                    'exten' => $request->conf_extension,
                    'priority' => $priority,
                    'app' => 'Authenticate',
                    'appdata' => $request->input('conf_auth'),
                'customer' => Auth::user()->customer
                ]);
                $priority++;
            }
            Extension::firstOrCreate([
                'context' => Auth::user()->Customer->internal_context,
                'exten' => $request->conf_extension,
                'priority' => $priority,
                'app' => 'ConfBridge',
                'appdata' => Auth::user()->customer.'_'.$request->input('conf_name'),
                'customer' => Auth::user()->customer
            ]);*/

            UsedExtension::create([
                'customer' => Auth::user()->customer,
                'extension' => $request->input('conf_extension')
            ]);
        }

        return redirect('/conf');
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
        $Conf = ConferenceBridge::find($id);

        return view('conf.edit')->with('Conf',$Conf);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateConferenceBridgeRequest $request, $id)
    {
        $Conf = ConferenceBridge::find($id);

        if($request->input('delete') == 'on'){
            
            $Conf->delete();
            return redirect('/conf');
        }

        $Conf->conf_name = $request->input('conf_name');
        $Conf->conf_auth = $request->input('conf_auth');

        $Conf->save();

        $Conf->rebuildConference();

        return redirect('/conf');
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
