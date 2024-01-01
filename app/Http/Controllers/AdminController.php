<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Coauthorbook;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        $userCount = User::where('role', 'author')->count();
        $completedPeBookData = Book::where('status', 'complete')->count();
        $completedCoBookData = Coauthorbook::where('status', 'complete')->count();

        return view('admin.index', ['userCount' => $userCount, 'completedPeBookData' => $completedPeBookData, 'completedCoBookData' => $completedCoBookData]);
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile_view', compact('profileData'));
    }

    public function AdminProfileStore(Request $request)
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
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data->photo = $filename;
        }

        $data->save();
        Alert::success('Admin Profile Updated Successfully');

        return redirect()->back();
    }

    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password', compact('profileData'));
    }

    public function AdminStorePassword(Request $request)
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
        Alert::success('Admin Password Updated Successfully');

        return redirect()->back();
    }

    public function AdminManageAuthors()
    {
        $authorTableData['authorData'] = User::where('role', 'author')->get();
        return view('admin.admin_manage_users', $authorTableData);
    }

    public function DeleteAuthor($id, Request $request)
    {
        $deleteAuthor = User::find($id);

        $deleteAuthor->books()->delete();
        
        if (!empty($deleteAuthor->photo) && file_exists('upload/author_images/' . $deleteAuthor->photo)) {
            unlink('upload/author_images/' . $deleteAuthor->photo);
        }
        $deleteAuthor->delete();
        return redirect('admin/manage/authors');
    }

    public function ViewCompletedCoauthorBooks(){
        $completedCoBookData['getcorecord'] = Coauthorbook::where('status', 'complete')->get();

        // Fetch the author for each co-author book
        foreach ($completedCoBookData['getcorecord'] as $coauthorbook) {
            $coauthorbook->author = User::find($coauthorbook->author_id);
        }
        return view('admin.admin_view_coauthor_books', $completedCoBookData);
    }

    public function ViewCompletedPersonalBooks(){
        $completedPeBookData['getrecord'] = Book::where('status', 'complete')->get();

        // Fetch the author for each personal book
        foreach ($completedPeBookData['getrecord'] as $book) {
            $book->author = User::find($book->author_id);
        }
        return view('admin.admin_view_personal_books', $completedPeBookData);
    }

}
