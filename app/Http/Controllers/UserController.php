<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Peer,App\User,App\VoicemailBox,Validator,Hash,Auth,App\UserSettings;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->Customer->default_callerid){
            about(404);
        }
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\UserRequest $request)
    {
        
        $newUser = User::create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'fullname' => $request->input('fullname'),
            'customer' => Auth::user()->customer,
            'email' => $request->input('email'),
            'permlevel' => $request->input('permlevel'),
            'vmenabled' => $request->input('enable_voicemail')
        ]);

        UserSettings::create(['user' => $newUser->id]);

        $newPeer = Peer::create([
            'name' => Auth::user()->customer.'_'.$newUser->id,
            'callerid' => Auth::user()->Customer->default_callerid,
            'defaultuser' => Auth::user()->customer.'_'.$newUser->id,
            'secret' => Peer::genSecret(),
            'mailbox' => $newUser->id.'@'.Auth::user()->customer,
            'portaluid' => $newUser->id
        ]);

        $newUser->peer = $newPeer->id;
        $newUser->save();

        $blfText = file_get_contents(env('EXTENSIONS_CONF_FILE_PATH'));
        $blfText = str_replace("[BLF]\n","[BLF]\nexten => ".$newPeer->getHint().",hint,SIP/".$newPeer->name."\n",$blfText);
        file_put_contents(env('EXTENSIONS_CONF_FILE_PATH'), $blfText);

        $newMailbox = VoicemailBox::create([
            'customer_id' => $newUser->id,
            'context' => $newUser->customer,
            'mailbox' => $newUser->id,
            'password' => $request->input('vmpassword'),
            'fullname' => $newUser->fullname,
            'email' => $newUser->email,
            'sip_buddy_id' => $newPeer->id,
            'attach' => $request->input('enable_email'),
            'delete' => $request->input('enable_email')
        ]);

        $newPeer->vmrow = $newMailbox->uniqueid;
        $newPeer->save();

        return redirect('/user');

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
        $User = User::find($id);

        return view('user.edit')->with('User',$User);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateUserRequest $request, $id)
    {

        $User = User::find($id);

        $User->fullname = $request->input('fullname');
        $User->email = $request->input('email');
        $User->permlevel = $request->input('permlevel');
        $User->vmenabled = $request->input('enable_voicemail');

        $User->save();

        $User->SIPPeer->VoicemailBox->attach = $request->input('enable_email');
        $User->SIPPeer->VoicemailBox->delete = $request->input('enable_email');
        $User->SIPPeer->VoicemailBox->email = $request->input('email');
        $User->SIPPeer->VoicemailBox->fullname = $request->input('fullname');
        $User->SIPPeer->VoicemailBox->password = $request->input('vmpassword');

        $User->SIPPeer->VoicemailBox->save();

        $User->UserSettings->follow_enabled = $request->input('enable_followme');
        $User->UserSettings->follow_number = $request->input('follow_number');
        $User->UserSettings->follow_time_1 = $request->input('follow_time_1');
        $User->UserSettings->follow_time_2 = $request->input('follow_time_2');
        $User->UserSettings->forward_enabled = $request->input('enable_forward');
        $User->UserSettings->forward_number = $request->input('foroward_to');

        $User->UserSettings->save();

        return redirect('/user');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
