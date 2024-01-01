@extends('author.author_dashboard')
@section('author')


<div class="page-content">

  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
      <div>
        <h4 class="mb-3 mb-md-0">Co-Author EBooks</h4>
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
                      <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('author/edit/coauthor/book/content/' .$value->id) }}">
                          <i data-feather="edit" class="icon-sm me-2"></i> 
                          <span class="">Edit Content</span>
                        </a>
                        <a class="dropdown-item d-flex align-items-center"  href="{{ route('coauthor.books.download', ['id' => $value->id]) }}">
                          <i data-feather="download" class="icon-sm me-2"></i> 
                          <span class="">Download</span>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('author/delete/coauthor/book/'.$value->id) }}" 
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