<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller,App\RingGroup,Auth;

class RingGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ringgroups.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ringgroups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateRingGroupRequest $request)
    {
        $RingGroup = RingGroup::create([
            'customer' => Auth::user()->customer,
            'rg_name' => $request->input('rg_name'),
            'rg_type' => $request->input('rg_type'),
            'rg_time' => $request->input('rg_time'),
            'rg_members' => json_encode($request->input('ring_users')),
            'rg_dest_type' => $request->input('destination_type')
        ]);

        switch($request->input('destination_type')){
            case 'hangup':
                $RingGroup->rg_dest = '';
            break;
            case 'forward':
                $RingGroup->rg_dest = $request->input('forward');
            break;
            case 'extension':
                $RingGroup->rg_dest = $request->input('extension');
            break;
            case 'ivr':
                $RingGroup->rg_dest = $request->input('ivr');
            break;
            case 'ringgroup':
                $RingGroup->rg_dest = $request->input('ringgroup');
            break;
            case 'schedule':
                $RingGroup->rg_dest = $request->input('schedule');
            break;
            case 'confbridge':
                $RingGroup->rg_dest = $request->input('confbridge');
            break;
            case 'voicemail':
                $RingGroup->rg_dest = $request->input('voicemail');
            break;
            case 'queue':
                $RingGroup->rg_dest = $request->input('queue');
            break;
            case 'busy':
                $RingGroup->rg_dest = '';
            break;
            default:
                $RingGroup->rg_dest = '';
            break;
        }

        $RingGroup->save();

        $RingGroup->buildDialPlan();

        return redirect('/ringgroups');
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
        $RingGroup = RingGroup::find($id);

        return view('ringgroups.edit')->with('RingGroup',$RingGroup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateRingGroupRequest $request, $id)
    {
        $RingGroup = RingGroup::find($id);

        if($request->input('delete') == 'on'){
            if($RingGroup->isInUse()){
                \Session::flash('error_message',"Cannot delete a ring group that is in use");
                return redirect()->back();
            }
            $this->destroy($RingGroup);
            return redirect('/ringgroups');
        }

        $RingGroup->rg_name = $request->input('rg_name');
        $RingGroup->rg_type = $request->input('rg_type');
        $RingGroup->rg_time = $request->input('rg_time');
        $RingGroup->rg_members = json_encode($request->input('ring_users'));
        $RingGroup->rg_dest_type = $request->input('destination_type');

        switch($request->input('destination_type')){
            case 'hangup':
                $RingGroup->rg_dest = '';
            break;
            case 'forward':
                $RingGroup->rg_dest = $request->input('forward');
            break;
            case 'extension':
                $RingGroup->rg_dest = $request->input('extension');
            break;
            case 'ivr':
                $RingGroup->rg_dest = $request->input('ivr');
            break;
            case 'ringgroup':
                $RingGroup->rg_dest = $request->input('ringgroup');
            break;
            case 'schedule':
                $RingGroup->rg_dest = $request->input('schedule');
            break;
            case 'confbridge':
                $RingGroup->rg_dest = $request->input('confbridge');
            break;
            case 'voicemail':
                $RingGroup->rg_dest = $request->input('voicemail');
            break;
            case 'queue':
                $RingGroup->rg_dest = $request->input('queue');
            break;
            case 'busy':
                $RingGroup->rg_dest = '';
            break;
            default:
                $RingGroup->rg_dest = '';
            break;
        }

        $RingGroup->save();

        $RingGroup->buildDialPlan();

        return redirect('/ringgroups');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function destroy(RingGroup $RingGroup)
    {
        $RingGroup->delete();
    }
}
