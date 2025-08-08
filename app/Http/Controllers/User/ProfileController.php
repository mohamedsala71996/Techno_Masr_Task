<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Traits\ImageHandler;

class ProfileController extends Controller
{
    use ImageHandler;

    public function edit()
    {
        $user = Auth::user();
        return view('user.profile.index', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $user->update($request->validated());
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $this->updateMorphImage($user, $path, 'profile_image');
        }
        return redirect()->route('user.profile')->with('success', 'تم تحديث البيانات بنجاح.');
    }
}
