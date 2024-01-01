<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Coauthorbook;
use RealRashid\SweetAlert\Facades\Alert;

class AuthorController extends Controller
{
    public function AuthorDashboard(Request $request)
    {
        $authorId = Auth::user()->id;

        // Count completed personal books by the author
        $completedPeBookData = Book::where('author_id', $authorId)
            ->where('status', 'complete')
            ->count();

        // Count completed co-author books by the author
        $completedCoBookData = Coauthorbook::where('author_id', $authorId)
            ->where('status', 'complete')
            ->count();

        return view('author.index', [
            'completedPeBookData' => $completedPeBookData,
            'completedCoBookData' => $completedCoBookData
        ]);
    }
    
    public function AuthorLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function AuthorProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('author.author_profile_view', compact('profileData'));
    }

    public function AuthorProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/author_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/author_images'), $filename);
            $data->photo = $filename;
        }

        $data->save();
        Alert::success('Author Profile Updated Successfully');

        return redirect()->back();
    }

    public function AuthorChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('author.author_change_password', compact('profileData'));
    }
    
    public function AuthorStorePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!password_verify($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'The old password is incorrect.']);
        }

        $user->password = bcrypt($request->new_password);
        $user->save();
        Alert::success('Author Password Updated Successfully');

        return redirect()->back();
    }

    public function AuthorAiSupport()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('author.aisupport', compact('profileData'));
    }
}
