<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsermanagerRequest;
use App\Models\User;
use App\Models\Requisition;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;

class UserManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.usermanager.index')->withData(User::paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.usermanager.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsermanagerRequest $request)
    {
        $data = $request->validated();
        unset($data['password']);

        if (!empty(request()->password)) {
            $data +=['password'=>Hash::make(request()->password)];
        }else{
            // Else needed otherwiese I have to unset
            $data +=['password' => bcrypt(mt_rand())];
        }



        // Create an user using data.
        $user = User::create($data);
        // Send user notifications uncomment to enable or set options in settings
        // $token = Password::getRepository()->create($user);
        // $user->sendPasswordResetNotification($token);

        return redirect()->route('admin.usermanager.show',$user->id)->with('success','New users email send Successfully');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $usermanager)
    {
        return view('admin.usermanager.show')->withData($usermanager);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usermanager)
    {
        return view('admin.usermanager.edit')->withData($usermanager);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UsermanagerRequest $request,User $usermanager)
    {
        $data = $request->validated();

        unset($data['password']);
        if (!empty(request()->password)) {
            $data +=['password'=>Hash::make(request()->password)];
        }

        $usermanager->update($data);

        return redirect()->route('admin.usermanager.index')->with('success','User Updated,');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usermanager)
    {
        if (Auth::id() == $usermanager->id) {
            return redirect()->back()->with('error','Can not delete self');
        }

        $usermanager->delete();
        return redirect()->route('admin.usermanager.index')->with('success','Successfully deleted.');
    }
    /**
     * Reset the password for specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(User $usermanager)
    {
        $token = Password::getRepository()->create($usermanager);
        $usermanager->sendPasswordResetNotification($token);
        return redirect()->route('admin.usermanager.index')
        ->with('success','Users Password reset email send Successfull.');

    }


}
