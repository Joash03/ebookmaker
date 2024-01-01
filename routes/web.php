<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ChatDestroyController;
use App\Http\Controllers\ChatGptDestroyController;
use App\Http\Controllers\ChatGptIndexController;
use App\Http\Controllers\ChatGptStoreController;
use Illuminate\Foundation\Application;
use Inertia\Inertia;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//Group Admin Middleware
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    
    
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
   

    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/store', [AdminController::class, 'AdminStorePassword'])->name('admin.password.store');


    Route::get('/admin/manage/authors', [AdminController::class, 'AdminManageAuthors'])->name('admin.manage.authors'); 
    Route::get('/author/delete/author/{id}', [AdminController::class, 'DeleteAuthor'])->name('author.author.delete');


    Route::get('/admin/completed/personal/books', [AdminController::class, 'ViewCompletedPersonalBooks'])->name('admin.completed.personal.books');
    Route::get('/admin/completed/coauthor/books', [AdminController::class, 'ViewCompletedCoauthorBooks'])->name('admin.completed.coauthor.books');
    
}); 
//End Group Admin Middleware


//User Auth Middleware
Route::get('user/login', [UserController::class, 'Login'])->name('user.login');
Route::get('user/register', [UserController::class, 'Register'])->name('user.register');

Route::get('user/forget/password', [UserController::class, 'ForgetPassword'])->name('user.forget.password');
Route::post('user/forget/password/email', [UserController::class, 'SendResetLinkEmail'])->name('user.password.email');

Route::get('/reset/password/{token}', [UserController::class, 'ShowResetForm'])->name('reset.password');
Route::post('/user/password/update', [UserController::class, 'ResetPassword'])->name('new.password.update');
//End User Auth Middleware


//Group Author Middleware
Route::middleware(['auth', 'role:author'])->group(function () {
    Route::get('/author/dashboard', [AuthorController::class, 'AuthorDashboard'])->name('author.dashboard');
    Route::get('/author/logout', [AuthorController::class, 'AuthorLogout'])->name('author.logout');
    
    Route::get('/author/profile', [AuthorController::class, 'AuthorProfile'])->name('author.profile');
    Route::post('/author/profile/store', [AuthorController::class, 'AuthorProfileStore'])->name('author.profile.store');
   
    Route::get('/author/change/password', [AuthorController::class, 'AuthorChangePassword'])->name('author.change.password');
    Route::post('/author/password/store', [AuthorController::class, 'AuthorStorePassword'])->name('author.password.store');



    //Ebooks Middleware

    //Personal Ebooks Middleware
    Route::get('/author/personal/books', [BookController::class, 'AuthorBooksInprogress'])->name('author.personal.books');
    Route::post('/author/add/book', [BookController::class, 'AddBook'])->name('author.add.book');
    Route::get('/author/edit/book/{id}', [BookController::class, 'EditBooks'])->name('author.edit.book');
    Route::get('/author/delete/book/{id}', [BookController::class, 'DeleteBook'])->name('author.book.delete');
    Route::post('/author/edit/book/{id}', [BookController::class, 'UpdateBookDetails'])->name('author.bookdetails.store');
    Route::get('/author/edit/book/content/{id}', [BookController::class, 'EditBooksContent'])->name('author.edit.bookcontent');
    Route::post('/author/edit/book/content/{id}', [BookController::class, 'UpdateBookContent'])->name('author.bookcontent.store');
    Route::get('/author/completed/personal/books', [BookController::class, 'CompletedPersonalBooks'])->name('author.completed.personal.books');
    Route::get('/personal/books/{id}/download', [BookController::class, 'DownloadPersonalBooks'])->name('personal.books.download');
    //End Personal Ebooks Middleware


    //Co-author Ebooks Middleware
    Route::get('/author/coauthor/book', [BookController::class, 'AuthorCoauthorBook'])->name('author.coauthor.books');
    Route::post('/author/add/coauthor/book', [BookController::class, 'AddCoauthorBook'])->name('author.add.coauthor.book');
    Route::get('/author/edit/coauthor/book/{id}', [BookController::class, 'EditCoauthorBooks'])->name('author.edit.coauthor.book');
    Route::get('/author/delete/coauthor/book/{id}', [BookController::class, 'DeleteCoauthorBook'])->name('author.book.coauthor.delete');
    Route::post('/author/edit/coauthor/book/{id}', [BookController::class, 'UpdateCoauthorBookDetails'])->name('author.coauthor.bookdetails.store');
    
    Route::get('/author/edit/coauthor/book/content/{id}', [BookController::class, 'EditCoauthorBooksContent'])->name('author.edit.coauthor.bookcontent');
    Route::post('/author/edit/coauthor/book/content/{id}', [BookController::class, 'UpdateCoauthorBookContent'])->name('author.coauthor.bookcontent.store');
    
    Route::post('/comments', [BookController::class, 'storeComment'])->name('comments.store');
    Route::put('/comments/{id}', [BookController::class, 'updateComment'])->name('comments.update');
    Route::delete('/comments/{id}', [BookController::class, 'deleteComment'])->name('comments.destroy');
    
    Route::post('comments/{id}/reply', [BookController::class, 'storeReply'])->name('replies.store');
    Route::put('replies/{id}', [BookController::class, 'updateReply'])->name('replies.update');
    Route::delete('replies/{id}', [BookController::class, 'destroyReply'])->name('replies.destroy');


    Route::get('/author/completed/coauthor/books', [BookController::class, 'CompletedCoauthorBooks'])->name('author.completed.coauthor.books');
    Route::get('/coauthor/books/{id}/download', [BookController::class, 'DownloadCoauthorBooks'])->name('coauthor.books.download');
  
    Route::get('/author/coauthor/add/authors/{id}', [BookController::class, 'CoauthorAuthor'])->name('author.coauthor');
    Route::post('/coauthorbooks/{coauthorbookId}/add-author', [BookController::class, 'AddCoauthor'])->name('coauthorbook.addAuthor');
    Route::delete('/coauthorbook/{coauthorbookId}/author/{authorId}', [BookController::class, 'RemoveCoauthor'])->name('coauthor.remove');

    Route::get('/author/coauthor/book/author', [BookController::class, 'AuthorCoauthorBookByAuthor'])->name('author.coauthor.books.byauthor');

    //End Co-author Ebooks Middleware

    //End Ebooks Middleware



    //AI Support Middleware
    Route::get('/chat/{id?}', ChatGptIndexController::class)->name('chat.show');
    Route::post('/chat/{id?}', ChatGptStoreController::class)->name('chat.store');
    Route::delete('/chat/{chat}', ChatGptDestroyController::class)->name('chat.destroy');
    //End AI Support Middleware
}); 
//End Group Author Middleware