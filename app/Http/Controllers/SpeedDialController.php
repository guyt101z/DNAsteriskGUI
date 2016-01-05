<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller,Auth,App\SpeedDial,App\UsedExtension,App\Extension,App\User;

class SpeedDialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('speeddial.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('speeddial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateSpeedDialRequest $request)
    {
        $SpeedDial = SpeedDial::create([
            'customer' => Auth::user()->customer,
            'sd_exten' => $request->input('sd_extension'),
            'sd_dest_type' => $request->input('destination_type')
        ]);

        UsedExtension::create([
            'customer' => Auth::user()->customer,
            'extension' => $request->input('sd_extension')
        ]);

        switch($request->input('destination_type')){
            case 'hangup':
                $SpeedDial->sd_dest = '';
            break;
            case 'forward':
                $SpeedDial->sd_dest = $request->input('forward');
            break;
            case 'extension':
                $SpeedDial->sd_dest = $request->input('extension');
            break;
            case 'ivr':
                $SpeedDial->sd_dest = $request->input('ivr');
            break;
            case 'ringgroup':
                $SpeedDial->sd_dest = $request->input('ringgroup');
            break;
            case 'schedule':
                $SpeedDial->sd_dest = $request->input('schedule');
            break;
            case 'confbridge':
                $SpeedDial->sd_dest = $request->input('confbridge');
            break;
            case 'voicemail':
                $SpeedDial->sd_dest = $request->input('voicemail');
            break;
            case 'queue':
                $SpeedDial->sd_dest = $request->input('queue');
            break;
            case 'busy':
                $SpeedDial->sd_dest = '';
            break;
            default:
                $SpeedDial->sd_dest = '';
            break;
        }

        $SpeedDial->save();

        AsteriskController::genRoute(Auth::user()->Customer->internal_context,$SpeedDial->sd_exten,$SpeedDial->sd_dest_type,$SpeedDial->sd_dest);

        //$SpeedDial->buildDialPlan();

        \Session::flash('success_message',"Speed Dial created");
        return redirect('/speeddials');
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
        $SpeedDial = SpeedDial::find($id);

        return view('speeddial.edit')->with('SpeedDial',$SpeedDial);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateSpeedDialRequest $request, $id)
    {
        $SpeedDial = SpeedDial::find($id);
        if($request->input('delete') == 'on'){
            if($SpeedDial->isInUse()){
                \Session::flash('error_message',"Cannot delete a speed dial that is in use");
                return redirect()->back();
            }
            UsedExtension::where('customer',Auth::user()->customer)->where('extension',$SpeedDial->sd_exten)->delete();
            $SpeedDial->delete();
            \Session::flash('success_message',"Speed Dial deleted");
            return redirect('/queue');
        }

        $SpeedDial->sd_exten = $request->input('sd_extension');
        $SpeedDial->sd_dest_type = $request->input('destination_type');
        $SpeedDial->save();

        \Session::flash('success_message',"Speed Dial updated");
        return redirect('/speeddials');
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
