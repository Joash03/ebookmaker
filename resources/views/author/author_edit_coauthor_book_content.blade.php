@extends('author.author_dashboard')
@section('author')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="/js/tinymce/tinymce.min.js"></script>

<div class="page-content">

  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="mb-3 mb-md-0">Edit {{ $getcorecord->title }} Content</h4>
    </div>
  </div>
   
  <div class="row">
    <!-- Edit coauthorbook content form -->
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <form class="forms-sample" method="POST" action="{{ url('author/edit/coauthor/book/content/' .$getcorecord->id) }}" enctype="multipart/form-data">
            @csrf
            <!-- Content input -->
            <div class="mb-3">
              <textarea class="form-control" id="content" name="content">{{ $getcorecord->content }}</textarea>
            </div><br>
            <!-- Status input -->
            <div class="mb-3">
              <label class="form-label">Ebook Status</label>
              <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id="status" name="status" value="incomplete" checked="{{ $getcorecord->status === 'incomplete' ? 'checked' : '' }}">
                <label class="form-check-label" for="status">Incomplete</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="status" name="status" value="complete" {{ $getcorecord->status === 'complete' ? 'checked' : '' }}> 
                <label class="form-check-label" for="status">Completed</label>
              </div>
            </div>
            <div class="mb-3">
              <button type="submit" class="btn btn-primary me-2">Save Progress</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="mb-3 mb-md-0">Make Comments on Progress</h4>
    </div>
  </div>

  <div class="row">
    <!-- Add comment form -->
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <!-- Comment Form -->
          <div class="p-3 border-bottom tx-16">
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="coauthorbook_id" value="{{ $getcorecord->id }}">
                <div class="mb-2">
                    <textarea type="text" class="form-control" data-bs-toggle="collapse" href="#collapseExample"
                        id="exampleInputUsername1" autocomplete="off" placeholder="Leave Comment" rows="1"
                        onclick="this.select(rows=6)" name="content" required></textarea>
                </div>
                <div class="collapse" id="collapseExample">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="collapse"
                        href="#collapseExample" id="cancelButton"
                        onclick="document.getElementById('exampleInputUsername1').rows = 1;">Cancel</button>
                </div>
            </form> 
          </div>
          <!-- Comment List -->
          @foreach ($comments as $comment)
              <div class="card-body">
                  <!-- Comment Content -->
                  <div class="justify-content-between p-3">
                      <!-- Comment Header -->
                      <div class="d-flex align-items-center justify-content-between flex-wrap px-3 py-2 border-bottom">
                          <!-- Author Info -->
                          <div class="d-flex align-items-center">
                              <div class="me-2">
                                  <img class="wd-50 rounded-circle" src="{{ (!empty($comment->author->photo)) ? url('upload/author_images/'.$comment->author->photo) : url('upload/no_image.jpg') }}" alt="profile">
                              </div>
                              <h5>{{ $comment->author->name }}</h5>
                          </div>
                          <div class="tx-14 mt-2 mt-sm-0">{{ $comment->updated_at }}</div>
                      </div>
                      <!-- Comment Body -->
                      <div class="p-3 border-bottom">
                          <p class="card-text tx-15">{{ $comment->content }}</p>
                          <div class="p-2">
                              <!-- Reply Button -->
                              @if ($comment->author_id !== Auth::id())
                                  <span>
                                      <button type="button" class="btn btn-primary btn-icon reply-button" data-comment-id="{{ $comment->id }}"
                                          data-bs-toggle="collapse" href="#collapseReply{{ $comment->id }}" id="replyButton{{ $comment->id }}">
                                          <i data-feather="feather"></i>
                                      </button>
                                  </span>
                              @endif
                              <!-- Edit and Delete Buttons -->
                              @if ($comment->author_id === Auth::id())
                                  <span>
                                      <button type="button" class="btn btn-primary btn-icon" data-bs-toggle="collapse" href="#collapseExample2" id="exampleInputUsername2">
                                          <i data-feather="edit"></i>
                                      </button>
                                  </span>
                                  <!-- Delete Comment Form -->
                                  <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger btn-icon">
                                          <i data-feather="trash-2"></i>
                                      </button>
                                  </form>
                                  <!-- Edit Comment Form -->
                                  <div class="collapse" id="collapseExample2">
                                      <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="d-inline">
                                          @csrf
                                          @method('PUT')
                                          <textarea class="form-control" name="content">{{ $comment->content }}</textarea>
                                          <button type="submit" class="btn btn-primary btn-sm mt-2">Update</button>
                                      </form>
                                  </div>
                              @endif
                          </div>
                          <!-- Reply Form -->
                          <div class="collapse" id="collapseReply{{ $comment->id }}">
                              <form action="{{ route('replies.store', $comment->id) }}" method="POST">
                                  @csrf
                                  <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                  <div class="mb-3">
                                      <textarea class="form-control" name="content" rows="2" placeholder="Reply to this comment"></textarea>
                                  </div>
                                  <button type="submit" class="btn btn-primary">Reply</button>
                              </form>
                          </div>
                      </div>
                  </div>
                  <!-- Replies -->
                  @foreach ($comment->replies as $reply)
                      <!-- Reply Content -->
                      <div class="justify-content-between bg-lighter p-3">
                          <!-- Reply Header -->
                          <div class="d-flex align-items-center justify-content-between flex-wrap px-3 py-2 border-bottom">
                              <!-- Author Info -->
                              <div class="d-flex align-items-center">
                                  <div class="me-2">
                                      <img class="wd-50 rounded-circle" src="{{ (!empty($reply->author->photo)) ? url('upload/author_images/'.$reply->author->photo) : url('upload/no_image.jpg') }}" alt="profile">
                                  </div>
                                  <h5>{{ $reply->author->name }}</h5>
                              </div>
                              <div class="tx-14 mt-2 mt-sm-0">{{ $reply->updated_at }}</div>
                          </div>
                          <div class="p-3 border-bottom">
                              <p class="card-text tx-15">{{ $reply->content }}</p>
                              <div class="p-2">
                                  <!-- Edit and Delete Buttons -->
                                  @if ($reply->author_id === Auth::id())
                                      <span>
                                          <button type="button" class="btn btn-primary btn-icon" data-bs-toggle="collapse" href="#collapseExample{{ $reply->id }}" id="exampleInputUsername{{ $reply->id }}">
                                              <i data-feather="edit"></i>
                                          </button>
                                      </span>
                                      <!-- Delete Reply Form -->
                                      <form action="{{ route('replies.destroy', $reply->id) }}" method="POST" class="d-inline">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-danger btn-icon">
                                              <i data-feather="trash-2"></i>
                                          </button>
                                      </form>
                                      <!-- Edit Reply Form -->
                                      <div class="collapse" id="collapseExample{{ $reply->id }}">
                                          <form action="{{ route('replies.update', $reply->id) }}" method="POST" class="d-inline">
                                              @csrf
                                              @method('PUT')
                                              <textarea class="form-control" name="content">{{ $reply->content }}</textarea>
                                              <button type="submit" class="btn btn-primary btn-sm mt-2">Update</button>
                                          </form>
                                      </div>
                                  @endif
                              </div>
                          </div>
                      </div>
                  @endforeach
              </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>


</div>


@endsection

