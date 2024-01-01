<nav class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
        Ebook<span>Maker</span>
      </a>
      <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="sidebar-body">
      <ul class="nav">
        <li class="nav-item">
          <a href="{{ route('author.dashboard') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item nav-category">Personal Ebooks</li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('author.personal.books') }}">
            <i class="link-icon" data-feather="book"></i>
            <span class="link-title">Ebooks In-progress</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('author.completed.personal.books') }}" class="nav-link">
            <i class="link-icon" data-feather="inbox"></i>
            <span class="link-title">Completed Ebooks</span>
          </a>
        </li>
        <li class="nav-item nav-category"><h6>Co-Author Ebooks</h6></li>
        <li class="nav-item">
          <a href="" class="nav-link" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
            <i class="link-icon" data-feather="key"></i>
            <span class="link-title">Unique ID</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-toggle="collapse" href="#collaborations" role="button" aria-expanded="false" aria-controls="emails">
            <i class="link-icon" data-feather="users"></i>
            <span class="link-title">Ebooks In Progress</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down link-arrow">
              <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
          </a>
          <div class="collapse" id="collaborations" style="">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{ route('author.coauthor.books') }}" class="nav-link">As Team Creator</a>
              </li>
              <li class="nav-item">
                <a href="{{ route('author.coauthor.books.byauthor') }}" class="nav-link">As Team Member</a>
            </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a href="{{ route('author.completed.coauthor.books') }}" class="nav-link">
            <i class="link-icon" data-feather="archive"></i>
            <span class="link-title">Completed Ebooks</span>
          </a>
        </li>
        <li class="nav-item nav-category">Support</li>
        <li class="nav-item">
          <a href="{{ route('chat.show') }}" class="nav-link">
            <i class="link-icon" data-feather="star"></i>
            <span class="link-title">AI Support</span>
          </a>
        </li>
      </ul>
    </div>
</nav>

@php
$id = Auth::user()->id;
$uniqueKey = App\Models\User::find($id);
@endphp
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-20" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Unique ID</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <h1>{{ $uniqueKey->uuid }}</h1>
      </div>
    </div>
  </div>
</div>
