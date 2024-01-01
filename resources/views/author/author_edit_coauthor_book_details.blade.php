@extends('author.author_dashboard')
@section('author')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">

  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
      <div>
        <h4 class="mb-3 mb-md-0">Edit {{ $getcorecord->title  }} Details</h4>
      </div>
  </div>

  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
			<form class="forms-sample" method="POST" action="{{ url('author/edit/coauthor/book/' .$getcorecord->id) }}" enctype="multipart/form-data">
				@csrf
				<div class="mb-3">
				  <input type="text" class="form-control" name="title" id="title" required autocomplete="off" value="{{ $getcorecord->title }}">
				  <x-input-error :messages="$errors->get('title')" class="text-danger" />
				</div>
				<div class="mb-3">
				  <textarea class="form-control" id="description" name="description" rows="5" required>{{ $getcorecord->description }}</textarea>
				  <x-input-error :messages="$errors->get('description')" class="text-danger" />
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Ebook Cover</label>
							<input class="form-control" type="file" id="image" name="cover">
						  </div>
					</div>
					<div class="col-sm-6">
						<div class="mb-3">
							<img id="showImage" class="wd-80 rounded" src="{{ (!empty($getcorecord->cover)) ? 
								url('upload/coathor_ebook_cover/'.$getcorecord->cover) : url('upload/no_image.jpg') }}"  alt="cover">
						  </div>
					</div>
				</div>
				<div class="mb-3">
					<button type="submit" class="btn btn-primary me-2">Update Ebook Details</button>
				</div>
			</form>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection