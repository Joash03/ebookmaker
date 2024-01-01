@extends('author.author_dashboard')
@section('author')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">

  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
      <div>
        <h4 class="mb-3 mb-md-0">Manage {{ $coauthorbook->title }} Authors</h4>
      </div>
  </div>

  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New Authors</button>
			<br><br>
			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title h4" id="myLargeModalLabel">Add Authors to {{ $coauthorbook->title  }}</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
				  </div>
				  <div class="modal-body">
						<form class="forms-sample" action="{{ route('coauthorbook.addAuthor', ['coauthorbookId' => $coauthorbookId]) }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="mb-3">
								<label for="exampleInputUsername1" class="form-label">Author Unique Key</label>
							<input type="text" class="form-control" name="author_uuid" id="author_uuid" required autocomplete="off">
							<x-input-error :messages="$errors->get('author_uuid')" class="text-danger" />
							</div>
							<div class="mb-3">
								<button type="submit" class="btn btn-primary me-2">Add Author</button>
							</div>
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
						  <th class="pt-0">Photo</th>
						  <th style="white-space: pre-line; max-width: 200px;"class="pt-0">Author Name</th>
						  <th class="pt-0"></th>
						</tr>
					  </thead>
					  <tbody>
						@foreach($coauthorbook->authors as $author)
						<tr>
						  <td>
							<img class="wd-80 rounded" src="{{ (!empty($value->photo)) ? 
								url('upload/author_images/'.$author->photo) : url('upload/no_image.jpg') }}" 
							  alt="profile">
						  </td>
						  <td style="white-space: pre-line; max-width: 200px;">{{ $author->name }}</td>
						  <td>
							<div class="btn-group">
								<form action="{{ route('coauthor.remove', ['coauthorbookId' => $coauthorbook->id, 'authorId' => $author->id]) }}" method="POST">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-primary btn-sm" role="button">Remove</button>
								</form>
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
  </div>

</div>

@endsection