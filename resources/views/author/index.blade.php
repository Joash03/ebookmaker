@extends('author.author_dashboard')
@section('author')
<div class="page-content">

  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-xl-12 stretch-card">
      <div class="row flex-grow-1">
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Personal Ebooks Completed</h6>
                <div class="dropdown mb-2">
                  <button class="btn p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5">
                  <h2 class="mb-2">{{ $completedPeBookData }}</h2>
                  <div class="d-flex align-items-baseline">
                    <p class="text-success">
                      <span>+3.3%</span>
                      <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p>
                  </div>
                </div>
                <div class="col-6 col-md-12 col-xl-7">
                  <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Co-author Ebooks Completed</h6>
                <div class="dropdown mb-2">
                  <button class="btn p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5">
                  <h2 class="mb-2">{{ $completedCoBookData }}</h2>
                  <div class="d-flex align-items-baseline">
                    <p class="text-success">
                      <span>-2.8%</span>
                      <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                    </p>
                  </div>
                </div>
                <div class="col-6 col-md-12 col-xl-7">
                  <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Co-author Ebooks Completed</h6>
                <div class="dropdown mb-2">
                  <button class="btn p-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5">
                  {{-- <h2 class="mb-2">{{ $completedCoBookData }}</h2>
                  <div class="d-flex align-items-baseline">
                    <p class="text-success">
                      <span>+2.8%</span>
                      <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p>
                  </div>
                </div>
                <div class="col-6 col-md-12 col-xl-7">
                  <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                </div>
              </div>
            </div>
          </div>
        </div> --}}
      </div>
    </div>
  </div> <!-- row -->
    
@endsection