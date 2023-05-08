<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    protected $casts = [
        'images' => 'json',
    ];

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
        // $request->user()->fill($request->safe()->only(['name', 'email']));

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $path = null;
        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('img', 'public');
            $request->user()->main_image = $path;
        }

        $image_paths = [];
        if ($request->hasFile('sub_images')) {
            $image_paths = $request->file('sub_images');
            $sub_paths = [];
            foreach ($image_paths as $path) {
                $sub_path = $path->store('img', 'public');
                $sub_paths[] = $sub_path;
            }

            $request->user()->sub_image = implode(',', $sub_paths);
        }

        // $sub_path = null;
        // if ($request->user()->sub_image) {
        //     if ($request->hasFile('sub_image')) {
        //         $sub_paths = [];
        //         $sub_images[] = $request->file('sub_image');
        //         foreach ($sub_images as $sub_image) {
        //             $sub_paths[] = $sub_image->store('img', 'public');
        //         }
        //         $total_path = $request->user()->sub_image . ',' . implode(',', $sub_paths);
        //         $request->user()->sub_image = $total_path;
        //     }
        // } else {
        //     if ($request->hasFile('sub_image')) {
        //         $sub_paths = [];
        //         foreach ($request->file('sub_image') as $sub_image) {
        //             $sub_paths[] = $sub_image->store('img', 'public');
        //         }
        //         $request->user()->sub_image = implode(',', $sub_paths);
        //     }
        // }


        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
