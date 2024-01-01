@extends('admin.admin_dashboard')
@section('admin')


<div class="page-content">

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
          <h4 class="mb-3 mb-md-0">Personal EBooks</h4>
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
                  <th style="white-space: pre-line; max-width: 400px;" class="pt-0">Authors</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($getrecord as $value)
                <tr>
                  <td>
                    <img class="wd-80 rounded" src="{{ (!empty($value->cover)) ? 
                    url('upload/ebook_cover/'.$value->cover) : url('upload/no_image.jpg') }}" 
                      alt="profile">
                  </td>
                  <td style="white-space: pre-line; max-width: 200px;">{{ $value->title }}</td>
                  <td style="white-space: pre-line; max-width: 400px;">{{ $value->description }}</td>
                  <td style="white-space: pre-line; max-width: 400px;" class="pt-0">{{ $value->author->name }}</td>
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