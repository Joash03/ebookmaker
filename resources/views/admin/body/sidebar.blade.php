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
          <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.manage.authors') }}" class="nav-link">
            <i class="link-icon" data-feather="users"></i>
            <span class="link-title">Manage Author</span>
          </a>
        </li>
        <li class="nav-item nav-category">Completed Ebooks</li>
        <li class="nav-item">
          <a href="{{ route('admin.completed.personal.books') }}" class="nav-link">
            <i class="link-icon" data-feather="book"></i>
            <span class="link-title">Personal Ebooks</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.completed.coauthor.books') }}" class="nav-link">
            <i class="link-icon" data-feather="inbox"></i>
            <span class="link-title">Coauthor Ebooks</span>
          </a>
        </li>
      </ul>
    </div>
</nav>