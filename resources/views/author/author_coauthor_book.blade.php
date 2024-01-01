@extends('author.author_dashboard')
@section('author')


<div class="page-content">

	<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
		<div>
		  <h4 class="mb-3 mb-md-0">Co-Author EBooks In Progress</h4>
		</div>
	</div>
  
	<div class="row">
	  <div class="col-md-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New Ebook</button>
				<br><br>
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title h4" id="myLargeModalLabel">Create New Ebook</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
					  </div>
					  <div class="modal-body">
						<form class="forms-sample" method="POST" action="{{ route('author.add.coauthor.book') }}" enctype="multipart/form-data">
						  @csrf
						  <div class="mb-3">
							<label for="exampleInputUsername1" class="form-label">Title</label>
							<input type="text" class="form-control" name="title" id="title" required autocomplete="off" placeholder="Title">
							<x-input-error :messages="$errors->get('title')" class="text-danger" />
						  </div>
						  <div class="mb-3">
							<label for="exampleFormControlTextarea1" class="form-label">Description</label>
							<textarea class="form-control" id="description"name="description" rows="5" required style="white-space: pre-wrap;"></textarea>
							<x-input-error :messages="$errors->get('description')" class="text-danger" />
						  </div>
						  <div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Ebook Cover</label>
							<input class="form-control" type="file" id="image" name="cover">
						  </div>
						  <div class="mb-3">
							<label for="exampleInputEmail1" class="form-label"> </label>
							<img id="showImage" class="wd-80 rounded" src="{{ url('upload/no_image.jpg') }}" 
							  alt="cover">
						  </div>
						  <button type="submit" class="btn btn-primary me-2">Create Ebook</button>
						</form>
					  </div>
					</div>
				  </div>
				</div>
	
	
		<div class="table-responsive">
			<table id="dataTableExample" class="table">
				  <thead>
					<tr> 
					  <th class="pt-0">S/N</th>
					  <th class="pt-0">Cover</th>
					  <th style="white-space: pre-line; max-width: 200px;"class="pt-0">Title</th>
					  <th style="white-space: pre-line; max-width: 400px;" class="pt-0">Description</th>
					  <th class="pt-0"></th>
					</tr>
				  </thead>
				  <tbody>
					@foreach ($getcorecord as $value)
					<tr>
					  <td>
						<img class="wd-80 rounded" src="{{ (!empty($value->cover)) ? 
						url('upload/coathor_ebook_cover/'.$value->cover) : url('upload/no_image.jpg') }}" 
						  alt="profile">
					  </td>
					  <td style="white-space: pre-line; max-width: 200px;">{{ $value->title }}</td>
					  <td style="white-space: pre-line; max-width: 400px;">{{ $value->description }}</td>
					  <td>
						<div class="btn-group">
							<a href="{{ url('author/coauthor/add/authors/' .$value->id) }}"class="btn btn-primary btn-sm" role="button">Authors</a>
						</div>
						<div class="btn-group">
							<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button>
							
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
								<a class="dropdown-item d-flex align-items-center" href="{{ url('author/edit/coauthor/book/' .$value->id) }}">
								  <i data-feather="edit" class="icon-sm me-2"></i> 
								  <span class="">Edit Details</span>
								</a>
								<a class="dropdown-item d-flex align-items-center" href="{{ url('author/edit/coauthor/book/content/' .$value->id) }}">
								  <i data-feather="edit" class="icon-sm me-2"></i> 
								  <span class="">Edit Content</span>
								</a>
								<a class="dropdown-item d-flex align-items-center" href="{{ url('author/delete/coauthor/book/' .$value->id) }}" 
								  onclick="confirmation(event)">
								  <i data-feather="trash" class="icon-sm me-2"></i> 
								  <span class="">Delete</span>
								</a>
							  </div>
						</div>
					  </td>
					</tr>
					@endforeach
				  </tbody>
				</table>
			  </div>
			</div>
		</div>
	  </div>
	</div>
  
  </div>
  

@endsection