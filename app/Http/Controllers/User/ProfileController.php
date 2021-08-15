<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PasswordUpdateRequest;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('user.profile')->withData(Auth::user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Upload Image
        // $imageUpload = new ImageUploadService(auth()->user());

        $data = $request->validate([
            'name'=>'required',
            'mobile' =>'required|digits:10',
            'other_contact'=>"nullable|different:contact|digits:10",
            // 'file' => 'image|mimes:jpg,jpeg,gif,png|max:500',
            'address'=>'nullable|string'
        ]);

        // if (!empty($request->file('file'))) {
        //     $data += ['avatar'=>$imageUpload->avatarUpload()];
        // }

        // Update current user's data
        auth()->user()->update($data);

        // // Update profile data for this user.
        // $updateProfile = Profile::updateOrCreate(
        //     ['user_id'=>auth()->user()->id], //please find the user
        //     ['user_id'=>auth()->user()->id,'address'=>request()->address], //or creatre the user
        // )->get();

        return back()->with('success','Thank you. Your data is updated.');
    }

    function passwordform()
    {
        return view('user.profile.password');

    }

    public function password(PasswordUpdateRequest $request)
    {
        // $request->validated($request);
        $user = Auth::user();

        // if (!Hash::check($request->current_password, $user->password)) {
        //     return back()->with('error', 'Current password does not match!');
        // }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password successfully changed!');

    }

}
