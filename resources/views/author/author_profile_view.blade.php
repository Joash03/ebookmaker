@extends('author.author_dashboard')
@section('author')
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

			<div class="page-content"> 
        <div class="row profile-body">
          <!-- left wrapper start -->
          <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
            <div class="card rounded">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <div>
                    <img class="wd-100 rounded-circle" src="{{ (!empty($profileData->photo)) ? 
                    url('upload/author_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" 
                    alt="profile">
                    <span class="h4 ms-3 text-dark">{{ $profileData->username }}</span>
                  </div>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
                  <p class="text-muted">{{ $profileData->name }}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Unique ID:</label>
                  <p class="text-muted">{{ $profileData->uuid }}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                  <p class="text-muted">{{ $profileData->email }}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
                  <p class="text-muted">{{ $profileData->phone }}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
                  <p class="text-muted">{{ $profileData->address }}</p>
                </div>
                <div class="mt-3 d-flex social-links">
                  <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                    <i data-feather="github"></i>
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
          <!-- left wrapper end -->
          <!-- middle wrapper start -->
          <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="card">
                  <div class="card-body">
    
                    <h6 class="card-title">Update Author Profile</h6>
    
                    <form method="post" action="{{ route('author.profile.store') }}" class="forms-sample" enctype="multipart/form-data">
                      @csrf
                      <div class="mb-3">
                        <label for="exampleInputUsername1" class="form-label">Username</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" 
                        autocomplete="off" name="username" value="{{ $profileData->username }}">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input type="text" class="form-control"  id="exampleInputEmail1" 
                        name="name" value="{{ $profileData->name }}">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control"  id="exampleInputEmail1" 
                        name="email" value="{{ $profileData->email }}">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Phone</label>
                        <input type="phone" class="form-control"  id="exampleInputEmail1" 
                        name="phone" value="{{ $profileData->phone }}">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Address</label>
                        <input type="text" class="form-control"  id="exampleInputEmail1" 
                        name="address" value="{{ $profileData->address }}">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Photo</label>
                        <input class="form-control" type="file" id="image" name="photo">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label"> </label>
                        <img id="showImage" class="wd-80 rounded-circle" src="{{ (!empty($profileData->photo)) ? 
                          url('upload/author_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" 
                          alt="profile">
                      </div>
                      <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- middle wrapper end --> 
        </div>

			</div>

      <script type="text/javascript">
        $(document).ready(function(){
          $('#image').change(function(e){
          var reader = new FileReader();
          reader.onload = function(e){
            $('#showImage').attr('src',e.target.result);
          }
          reader.readAsDataURL(e.target.files['0']);
          });
        });
        
        function confirmation(e) {
          e.preventDefault();
          var urlToRedirect = e.currentTarget.getAttribute('href');
          console.log(urlToRedirect);
          Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
           if (result.isConfirmed) {
          window.location.href=urlToRedirect;
          Swal.fire(
          'Deleted!',
          'Successfully deleted.',
          'success'
          )
          } 
        })
        }
      </script>
@endsection