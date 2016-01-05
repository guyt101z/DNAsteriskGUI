<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller,App\Queue,App\CQ,Auth,App\QueueMember,App\User;

class QueueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('queue.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('queue.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateQueueRequest $request)
    {
        $CQ = CQ::create([
            'customer' => Auth::user()->customer,
            'q_name' => $request->input('queue_name'),
            'q_members' => json_encode($request->input('queue_members'))
        ]);

        $Queue = Queue::create([
            'name' => Auth::user()->customer.'_'.$CQ->id,
            'musiconhold' => 'default',
            'strategy' => $request->input('queue_strategy'),
            'timeout' => $request->input('queue_timeout'),
            'retry' => $request->input('queue_retry'),
            'cq' => $CQ->id
        ]);

        foreach($request->input('queue_members') as $u){
            QueueMember::create([
                'membername' => 'SIP/'.User::find($u)->SIPPeer->name,
                'interface' => 'SIP/'.User::find($u)->SIPPeer->name,
                'queue_name' => Auth::user()->customer.'_'.$CQ->id,
                'penalty' => 0
            ]);
        }

        \Session::flash('success_message',"Queue created");
        return redirect('/queue');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Queue = CQ::find($id);

        return view('queue.edit')->with('Queue',$Queue);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\CreateQueueRequest $request, $id)
    {
        $CQ = CQ::find($id);
        $Queue = $CQ->Queue;

        if($request->input('delete') == 'on'){
            if($Queue->isInUse()){
                \Session::flash('error_message',"Cannot delete a queue that is in use");
                return redirect()->back();
            }
            $Queue->Members()->delete();
            $Queue->delete();
            $CQ->delete();
            \Session::flash('success_message',"Queue deleted");
            return redirect('/queue');
        }

        $CQ->q_name = $request->input('queue_name');
        $CQ->q_members = json_encode($request->input('queue_members'));
        $CQ->save();

        $Queue->strategy = $request->input('queue_strategy');
        $Queue->timeout = $request->input('queue_timeout');
        $Queue->retry = $request->input('queue_retry');
        $Queue->save();

        $Queue->Members()->delete();

        foreach($request->input('queue_members') as $u){
            QueueMember::create([
                'membername' => 'SIP/'.User::find($u)->SIPPeer->name,
                'interface' => 'SIP/'.User::find($u)->SIPPeer->name,
                'queue_name' => Auth::user()->customer.'_'.$CQ->id,
                'penalty' => 0
            ]);
        }

        \Session::flash('success_message',"Queue updated");
        return redirect('/queue');

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
