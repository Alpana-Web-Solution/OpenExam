<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Requisition;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;

class UserManagerController extends Controller
{

    // Validation function to eliminate repetitive code
    private function validateUser()
    {
        return request()->validate([
        "email"=>"required",
        "name" => "required",
        "username" => "required|min:6|alpha_dash",
        'password' => "required|string|min:8|confirmed",
        "mobile" => "required|digits:10",        
        
        ]);
    }

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
    public function store(Request $request)
    {
        // Get validated data and add password and last donated field
        $data = $this->validateUser();
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

        return back()->with('success','New users email send Successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $data = User::where('id',$user)->firstOrFail();
        return view('admin.usermanager.show')->withData($data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        // dd($user);
        $user = User::where('id',$user)->firstOrFail();
        return view('admin.usermanager.edit')->withData($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$user)
    {
        // dd($request->all());
        $data = $this->validateUser();
        unset($data['password']);
        if (!empty(request()->password)) {
            $data +=['password'=>Hash::make(request()->password)];
        }
       
        $user = User::where('id',$user)->firstOrFail();

        $user->update($data);

        return redirect()->route('admin.usermanager.index')->with('info','User Updated,');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        if (Auth::id() == $user) {
            return redirect()->back()->with('error','Can not delete self');
        }

        $data = User::where('id',$user)->first();
        $data->delete();
        return redirect()->back()->with('success','Successfully deleted.');
    }
    /**
     * Reset the password for specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function resetPassword($user)
    {
        $data = User::where('id',$user)->firstOrFail();
        $token = Password::getRepository()->create($data);
        $data->sendPasswordResetNotification($token);
        return redirect()->back()->with('success','Users Password reset email send Successfull.');

    }


}
