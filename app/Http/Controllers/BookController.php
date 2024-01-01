<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Coauthorbook;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;
use Dompdf\Options;
use Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    // Personal Ebooks
    public function AuthorBooksInprogress()
    {
        $authorId = Auth::id();
        $bookData['getrecord'] = Book::where('author_id', $authorId)->where('status', 'incomplete')->get();
        return view('author.author_personal_books', $bookData);
    }

    public function AddBook(Request $request)
    {
        $authorId = Auth::id();

        // Check if the maximum number of books in progress is reached
        $bookLimit = 3;
        $bookCount = Book::where('author_id', $authorId)->where('status', 'incomplete')->count();

        if ($bookCount >= $bookLimit) {
            Alert::error('ErrorAlert', 'You have reached the maximum number of allowed Ebooks. Please complete the Ebooks in progress.');
            return redirect()->back();
        }

        $insertData = new Book;
        $insertData->title = trim($request->title);
        $insertData->description = trim($request->description);
        $insertData->author_id = $authorId;

        if ($request->file('cover')) {
            $file = $request->file('cover');
            @unlink(\public_path('upload/ebook_cover/' . $insertData->cover));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(\public_path('upload/ebook_cover'), $filename);
            $insertData['cover'] = $filename;
        }

        $insertData->save();
        Alert::success('Ebook Created Successfully');
        return redirect()->back();
    }

    public function EditBooks($id, Request $request)
    {
        $authorId = Auth::id();
        $data['getrecord'] = Book::where('author_id', $authorId)->find($id);
        return view('author.author_edit_personal_book_details', $data);
    }

    public function DeleteBook($id, Request $request)
    {
        $authorId = Auth::id();
        $deleteBook = Book::where('author_id', $authorId)->find($id);

        if (!empty($deleteBook->cover) && file_exists('upload/ebook_cover/' . $deleteBook->cover)) {
            unlink('upload/ebook_cover/' . $deleteBook->cover);
        }

        $deleteBook->delete();
        return redirect()->back();
    }

    public function UpdateBookDetails($id, Request $request)
    {
        $authorId = Auth::id();
        $updatedetails = Book::where('author_id', $authorId)->find($id);
        $updatedetails->title = trim($request->title);
        $updatedetails->description = trim($request->description);

        if ($request->file('cover')) {
            $file = $request->file('cover');
            @unlink(\public_path('upload/ebook_cover/' . $updatedetails->cover));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(\public_path('upload/ebook_cover'), $filename);
            $updatedetails['cover'] = $filename;
        }

        $updatedetails->save();
        Alert::success('Ebook Details Updated Successfully');
        return redirect('author/personal/books');
    }

    public function EditBooksContent($id, Request $request)
    {
        $authorId = Auth::id();
        $contentdata['getrecord'] = Book::where('author_id', $authorId)->find($id);
        return view('author.author_edit_personal_book_content', $contentdata);
    }

    public function UpdateBookContent($id, Request $request)
    {
        $authorId = Auth::id();

        // Check if the maximum number of books in progress is reached
        $bookLimit = 3;
        $bookCount = Book::where('author_id', $authorId)->where('status', 'incomplete')->count();
        $currentBookStatus = Book::where('id', $id)->value('status');

        if ($bookCount >= $bookLimit && $currentBookStatus == 'complete' && $request->input('status') == 'incomplete') {
            Alert::error('ErrorAlert', 'You have reached the maximum number of allowed Ebooks. Please complete the Ebooks in progress.');
            return redirect()->back();
        }

        $updateContent = Book::where('author_id', $authorId)->find($id);
        $updateContent->content = trim($request->content);
        $updateContent->status = trim($request->status);

        $updateContent->save();
        Alert::success('Ebook Content Saved Successfully');
        return redirect()->back();
    }

    public function CompletedPersonalBooks()
    {
        $authorId = Auth::id();
        $completedBookData['getrecord'] = Book::where('author_id', $authorId)->where('status', 'complete')->get();
        return view('author.author_completed_personal_books', $completedBookData);
    }

    public function DownloadPersonalBooks($id, Request $request)
    {
        $authorId = Auth::id();
        $book = Book::where('author_id', $authorId)->findOrFail($id);

        $dompdf = new Dompdf();
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf->setOptions($options);

        $dompdf->loadHtml($book->content);
        $dompdf->render();

        $filename = Str::slug($book->title) . '-' . time() . '.pdf';

        $dompdf->stream($filename);
        return response()->download(public_path($filename));
    }

    // Co-author Ebook

    //Coauthorbook Authors
    public function CoauthorAuthor($id, Request $request)
    {
        $coauthorbookId = $id;
        $coauthorbook = Coauthorbook::findOrFail($coauthorbookId);

        // Store the coauthorbookId in the session
        session(['coauthorbookId' => $coauthorbookId]);

        return view('author.author_edit_coauthor_add_author', compact('coauthorbookId', 'coauthorbook'));
    }

    public function AddCoauthor(Request $request, $coauthorbookId)
    {
        // Retrieve the coauthorbook based on the ID
        $coauthorbook = Coauthorbook::findOrFail($coauthorbookId);

        // Retrieve the author based on the UUID
        $authorUuid = $request->input('author_uuid');
        $author = User::where('uuid', $authorUuid)->first();

        // Check if the author exists
        if (!$author) {
            Alert::error('ErrorAlert', 'Invalid author Unique ID.');
            return redirect()->back();
        }

        // Check if the author is the same as the author who created the coauthorbook
        if ($author->id === $coauthorbook->author_id) {
            Alert::warning('WarningAlert', 'You cannot add yourself as a coauthor to your own eBook.');
            return redirect()->back();
        }

        // Check if the author is already added to the coauthorbook
        if ($coauthorbook->authors->contains($author->id)) {
            Alert::warning('WarningAlert', 'This author has already been added to the eBook.');
            return redirect()->back();
        }

        // Check if the maximum number of authors has been reached for the specific coauthorbook
        if ($coauthorbook->authors()->wherePivot('coauthorbooks_author', $coauthorbook->author_id)->count() >= 5) {
            Alert::error('ErrorAlert', 'You have reached the maximum number of authors you can add to this eBook.');
            return redirect()->back();
        }

        // Attach the author to the coauthorbook
        $coauthorbook->authors()->attach($author->id, ['coauthorbooks_author' => $coauthorbook->author_id]);

        Alert::success('Author added successfully.');

        return redirect()->back();
    }

    public function RemoveCoauthor($coauthorbookId, $authorId)
    {
        // Retrieve the coauthorbook based on the ID
        $coauthorbook = Coauthorbook::findOrFail($coauthorbookId);

        // Detach the author from the coauthorbook
        $coauthorbook->authors()->detach($authorId);
        Alert::success('Author removed Successfully');
        return redirect()->back();
    }

    public function AuthorCoauthorBookByAuthor(Request $request)
    {
        // Get the ID of the currently logged-in user (author)
        $authorId = Auth::id();

        // Retrieve the coauthorbooks for the logged-in author
        $coauthorbooks = Coauthorbook::whereHas('authors', function ($query) use ($authorId) {
            $query->where('users.id', $authorId);
        })->get();

        return view('author.author_coauthor_book_byauthor', compact('coauthorbooks'));
    }

    //End Coauthorbook Authors
    
    public function AuthorCoauthorBook()
    {
        $authorId = Auth::id();
        $bookData['getcorecord'] = Coauthorbook::where('author_id', $authorId)->where('status', 'incomplete')->get();
        return view('author.author_coauthor_book', $bookData);
    }

    public function EditCoauthorBooks($id, Request $request)
    {
        $authorId = Auth::id();
        $data['getcorecord'] = Coauthorbook::where('author_id', $authorId)->find($id);
        return view('author.author_edit_coauthor_book_details', $data);
    }

    public function AddCoauthorBook(Request $request)
    {
        $authorId = Auth::id();

        $bookLimit = 3;
        $bookCount = Coauthorbook::where('author_id', $authorId)->where('status', 'incomplete')->count();

        if ($bookCount >= $bookLimit) {
            Alert::error('ErrorAlert', 'You have reached the maximum number of allowed Ebooks. Please complete the Ebooks in progress.');
            return redirect()->back();
        }

        $insertData = new Coauthorbook;
        $insertData->author_id = $authorId;
        $insertData->title = trim($request->title);
        $insertData->description = trim($request->description);

        if ($request->file('cover')) {
            $file = $request->file('cover');
            @unlink(\public_path('upload/coathor_ebook_cover/' . $insertData->cover));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(\public_path('upload/coathor_ebook_cover'), $filename);
            $insertData->cover = $filename;
        }

        $insertData->save();
        Alert::success('Ebook Created Successfully');
        return redirect()->back();
    }

    public function DeleteCoauthorBook($id, Request $request)
    {
        $authorId = Auth::id();
        $deleteBook = Coauthorbook::where('author_id', $authorId)->find($id);

        if (!empty($deleteBook->cover) && file_exists('upload/coathor_ebook_cover/' . $deleteBook->cover)) {
            unlink('upload/coathor_ebook_cover/' . $deleteBook->cover);
        }

        $deleteBook->delete();
        return redirect()->back();
    }

    public function UpdateCoauthorBookDetails($id, Request $request)
    {
        $authorId = Auth::id();
        $updatedetails = Coauthorbook::where('author_id', $authorId)->find($id);
        $updatedetails->title = trim($request->title);
        $updatedetails->description = trim($request->description);

        if ($request->file('cover')) {
            $file = $request->file('cover');
            @unlink(\public_path('upload/coathor_ebook_cover/' . $updatedetails->cover));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(\public_path('upload/coathor_ebook_cover'), $filename);
            $updatedetails->cover = $filename;
        }

        $updatedetails->save();
        Alert::success('Ebook Details Updated Successfully');
        return redirect('author/coauthor/book');
    }

    public function EditCoauthorBooksContent($id)
    {
        $authorId = Auth::id();
        $coauthorbook = Coauthorbook::findOrFail($id);

        // Check if the current user is either the creator or an added author of the coauthorbook
        if (!$coauthorbook->authors->contains($authorId) && $coauthorbook->author_id !== $authorId) {            
            Alert::error('ErrorAlert', 'You do not have permission to edit this Ebook.');
            return redirect()->back();
        }

        $comments = $coauthorbook->comments()->with('author')->get();

        return view('author.author_edit_coauthor_book_content', [
            'getcorecord' => $coauthorbook,
            'comments' => $comments,
        ]);
    }

    public function UpdateCoauthorBookContent($id, Request $request)
    {
        $authorId = Auth::id();

        $bookLimit = 3;
        $bookCount = Coauthorbook::where('author_id', $authorId)->where('status', 'incomplete')->count();
        $currentBookStatus = Coauthorbook::where('id', $id)->value('status');

        if ($bookCount >= $bookLimit && $currentBookStatus == 'complete' && $request->input('status') == 'incomplete') {         
            Alert::error('ErrorAlert', 'You have reached the maximum number of allowed Ebooks. Please complete the Ebooks in progress.');
            return redirect()->back();
        }

        $updateContent = Coauthorbook::where('id', $id)
            ->where(function ($query) use ($authorId) {
                $query->where('author_id', $authorId)
                    ->orWhereHas('coauthors', function ($query) use ($authorId) {
                        $query->where('author_id', $authorId);
                    });
            })
            ->first();

        if (!$updateContent) {
            Alert::error('ErrorAlert', 'You do not have permission to edit this Ebook content.');
            return redirect()->back();
        }

        $updateContent->content = trim($request->input('content'));
        $updateContent->status = trim($request->input('status'));

        $updateContent->save();

        return redirect()->back()->with('success', 'Ebook Content Saved Successfully');
    }

    //Comments
    public function storeComment(Request $request)
    {
        $authorId = Auth::id();

        $coauthorbookId = $request->input('coauthorbook_id');
        $coauthorbook = Coauthorbook::find($coauthorbookId);

        if (!$coauthorbook) {
            return redirect()->back()->with('error', 'Coauthorbook not found.');
        }

        // Check if the current user is either the creator or an added author of the coauthorbook
        if (!$coauthorbook->authors->contains($authorId) && $coauthorbook->author_id !== $authorId) {
            return redirect()->back()->with('error', 'You do not have permission to add a comment to this Ebook.');
        }

        $content = $request->input('content');

        $comment = new Comment();
        $comment->content = $content;
        $comment->coauthorbook_id = $coauthorbookId;
        $comment->author_id = $authorId;
        $comment->save();

        Alert::success('Comment added Successfully.');

        return redirect()->back();
    }

    public function updateComment($id, Request $request)
    {
        $authorId = Auth::id();

        $comment = Comment::find($id);

        if (!$comment) {
            return redirect()->back()->with('error', 'Comment not found.');
        }

        // Check if the current user is the creator of the comment
        if ($comment->author_id !== $authorId) {
            return redirect()->back()->with('error', 'You do not have permission to edit this comment.');
        }

        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->back()->with('success', 'Comment updated successfully.');
    }

    public function deleteComment($id)
    {
        $authorId = Auth::id();

        $comment = Comment::find($id);

        if (!$comment) {
            return redirect()->back()->with('error', 'Comment not found.');
        }

        // Check if the current user is the creator of the comment
        if ($comment->author_id !== $authorId) {
            return redirect()->back()->with('error', 'You do not have permission to delete this comment.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
    //End Comments
    
    // Reply
    public function storeReply(Request $request)
    {
        logger('Content: ' . $request->input('content'));
        logger('Comment ID: ' . $request->input('comment_id'));

        $authorId = Auth::id();
        $commentId = $request->input('comment_id');
        $content = $request->input('content'); // Add this line

        $comment = Comment::find($commentId);

        if (!$comment) {
            return redirect()->back()->with('error', 'Comment not found.');
        }

        // Check if the current user is the author of the comment
        if ($comment->author_id === $authorId) {
            return redirect()->back()->with('error', 'You cannot reply to your own comment.');
        }

        $comment = Comment::with('replies')->find($commentId);

        $reply = new Reply();
        $reply->content = $content;
        $reply->comment_id = $commentId;
        $reply->author_id = $authorId;
        $reply->save();

        return redirect()->back()->with('success', 'Reply added successfully.');
    }
    
    public function updateReply(Request $request, $id)
    {
        $reply = Reply::find($id);

        if (!$reply) {
            return redirect()->back()->with('error', 'Reply not found.');
        }

        // Check if the current user is the author of the reply
        if ($reply->author_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to update this reply.');
        }

        $reply->content = $request->input('content');
        $reply->save();

        return redirect()->back()->with('success', 'Reply updated successfully.');
    }

    public function destroyReply($id)
    {
        $reply = Reply::find($id);

        if (!$reply) {
            return redirect()->back()->with('error', 'Reply not found.');
        }

        // Check if the current user is the author of the reply
        if ($reply->author_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this reply.');
        }

        $reply->delete();

        return redirect()->back()->with('success', 'Reply deleted successfully.');
    }
    //End Reply

    public function CompletedCoauthorBooks()
    {
        $authorId = Auth::id();
        $completedBookData['getcorecord'] = Coauthorbook::where('author_id', $authorId)->where('status', 'complete')->get();
        return view('author.author_completed_coauthor_books', $completedBookData);
    }

    public function DownloadCoauthorBooks($id, Request $request)
    {
        $authorId = Auth::id();
        $book = Coauthorbook::where('author_id', $authorId)->findOrFail($id);

        $dompdf = new Dompdf();
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf->setOptions($options);

        $dompdf->loadHtml($book->content);
        $dompdf->render();

        $filename = Str::slug($book->title) . '-' . time() . '.pdf';

        $dompdf->stream($filename);
        return response()->download(public_path($filename));
    }
}
 