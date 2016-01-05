<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\DID,App\Extension,Auth;

class DIDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('did.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    	$DID = DID::findOrFail($id);

        return view('did.did')->with('DID',$DID);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $DID = DID::findOrFail($id);

        return view('did.edit')->with('DID',$DID);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ChangeDIDRequest $request, $id)
    {
        
        $DID = DID::find($id);

        $Route = Extension::where('customer',Auth::user()->customer)
            ->where('priority',1)
            ->where('exten', $DID->did_did)
            ->where('context', Auth::user()->Customer->incoming_context)
            ->first();

        $DID->dest_type = $request->input('destination_type');
        switch($request->input('destination_type')){
            case 'hangup':
                $DID->dest_target = '';
                $Route->app = 'Hangup';
                $Route->appdata = '';
            break;
            case 'forward':
                $DID->dest_target = $request->input('forward');
                $Route->app = 'Dial';
                $Route->appdata = '${TRUNK1}/'.$request->input('forward').',60';
            break;
            case 'extension':
                $DID->dest_target = $request->input('extension');
                $Route->app = 'Goto';
                $Route->appdata = Auth::user()->Customer->internal_context.','.$request->input('extension').',1';
            break;
            case 'ivr':
                $DID->dest_target = $request->input('ivr');
            break;
            case 'ringgroup':
                $DID->dest_target = $request->input('ringgroup');
            break;
            case 'schedule':
                $DID->dest_target = $request->input('schedule');
            break;
            case 'confbridge':
                $DID->dest_target = $request->input('confbridge');
            break;
            case 'voicemail':
                $DID->dest_target = $request->input('voicemail');
            break;
            case 'queue':
                $DID->dest_target = $request->input('queue');
            break;
            case 'busy':
                $DID->dest_target = '';
                $Route->app = 'Busy';
                $Route->appdata = '';
            break;
            default:
                $DID->dest_target = '';
                $Route->app = 'Hangup';
                $Route->appdata = '';
            break;
        }

        $DID->save();
        $Route->save();

        return redirect('/did');

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
