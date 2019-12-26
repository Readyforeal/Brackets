<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\User;
use App\Profile;

class ProfilesController extends Controller
{
    public function index($user)
    {
        $user = User::findOrFail($user);
        $posts = $user->posts;

        return view('profiles.profile', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function store($data)
    {
        auth()->user()->profile()->create($data);
    }

    public function update(User $user)
    {

        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'profile_image' => '',
            'name' => '',
            'gender' => '',
            'dob' => '',
            'about' => '',
            'job_employer' => '',
            'job_title' => '',
            'institution' => '',
            'graduation_year' => '',
            'interests' => '',
            'location' => '',
        ]);

        
        if(request('profile_image')){
            $imagePath = request('profile_image')->store('profile', 'public');
            
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();
        }
        
        if(request('profile_image')){
            auth()->user()->profile->update(array_merge(
                $data, 
                ['profile_image' => $imagePath]
            ));
        }else{
            auth()->user()->profile->update($data);
        }

        return redirect('/profile/' . auth()->user()->id);
    }
}
