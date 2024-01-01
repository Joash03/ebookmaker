@extends('author.author_dashboard')
@section('author')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">

  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
	<div>
	  <h4 class="mb-3 mb-md-0">Edit {{ $getrecord->title  }} Content</h4>
	</div>
   </div>
  
   <div class="row">
    <!-- Edit coauthorbook content form -->
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <form class="forms-sample" method="POST" action="{{ url('author/edit/book/content/' .$getrecord->id) }}" enctype="multipart/form-data">
            @csrf
            <!-- Content input -->
            <div class="mb-3">
              <textarea class="form-control" id="content" name="content">{{ $getrecord->content }}</textarea>
            </div><br>
            <!-- Status input -->
            <div class="mb-3">
              <label class="form-label">Ebook Status</label>
              <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id="status" name="status" value="incomplete" checked="{{ $getrecord->status === 'incomplete' ? 'checked' : '' }}">
                <label class="form-check-label" for="status">Incomplete</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="status" name="status" value="complete" {{ $getrecord->status === 'complete' ? 'checked' : '' }}> 
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


</div>

@endsection

