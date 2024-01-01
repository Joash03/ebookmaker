@extends('admin.admin_dashboard')
@section('admin')


<div class="page-content">

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
          <h4 class="mb-3 mb-md-0">Manage Authors</h4>
        </div>
    </div>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body"><div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th class="pt-0">S/N</th>
                  <th class="pt-0">Photo</th>
                  <th style="white-space: pre-line;"class="pt-0">Name</th>
                  <th style="white-space: pre-line; " class="pt-0">Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($authorData as $value)
                <tr>
                  <td>
                    <img class="wd-80 rounded" src="{{ (!empty($value->photo)) ? 
                      url('upload/author_images/'.$value->photo) : url('upload/no_image.jpg') }}" 
                    alt="profile">
                  </td>
                  <td style="white-space: pre-line;">{{ $value->name }}</td>
                  <td>
                    <button type="button" class="{{ ($value->status === 'active') ? 'btn btn-primary btn-success' 
                    : 'btn btn-primary btn-danger' }}"> {{ $value->status }}</button>                  
                  </td>
                  <td>
                    <div class="btn-group">
                       <!-- Button trigger modal --> 
                      <button type="button" class="btn btn-primary btn-icon" data-bs-toggle="modal" data-bs-target="#viewUserModal{{ $value->id }}">
                        <i data-feather="eye"></i>
                      </button>
                      <!-- Modal -->
                      <div class="modal fade" id="viewUserModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="viewUserModal{{ $value->id }}Label" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title h4" id="myLargeModalLabel">{{ $value->name }} Details</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                            </div>
                            <div class="modal-body d-flex flex-column align-items-center border-bottom px-5 py-3 ">
                              <img style="height: 120px; width: 120px;" src="{{ (!empty($value->photo)) ? 
                                url('upload/author_images/'.$value->photo) : url('upload/no_image.jpg') }}" alt="photo">
                              <div class="mt-3">
                                <label class="tx-15 fw-bolder mb-0 text-uppercase">Name: </label>
                                <a class="text-muted">{{ $value->name }}</a>
                              </div>
                              <div class="mt-3">
                                <label class="tx-15 fw-bolder mb-0 text-uppercase">Username:</label>
                                <a class="text-muted">{{ $value->username }}</a>
                              </div>
                              <div class="mt-3">
                                <label class="tx-15 fw-bolder mb-0 text-uppercase">Email:</label>
                                <a class="text-muted">{{ $value->email }}</a>
                              </div>
                              <div class="mt-3">
                                <label class="tx-15 fw-bolder mb-0 text-uppercase">Phone:</label>
                                <a class="text-muted">{{ $value->phone }}</a>
                              </div>
                              <div class="mt-3">
                                <label class="tx-15 fw-bolder mb-0 text-uppercase">Address:</label>
                                <a class="text-muted">{{ $value->address }}</a>
                              </div>
                              <div class="mt-3 d-flex social-links">
                                <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                  <i data-feather="facebook"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                  <i data-feather="twitter"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                  <i data-feather="instagram"></i>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="btn-group">
                      <button type="button" class="btn btn-danger btn-icon" href="{{ url('author/delete/author/' .$value->id) }}" 
                        onclick="confirmation(event)">
                        <i data-feather="trash-2"></i>
                      </button>
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