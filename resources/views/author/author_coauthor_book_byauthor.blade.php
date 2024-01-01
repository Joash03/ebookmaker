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
							@foreach ($coauthorbooks as $value)
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
									<a href="{{ url('author/edit/coauthor/book/content/' .$value->id) }}" class="btn btn-primary btn-sm" role="button">Edit Content</a>
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