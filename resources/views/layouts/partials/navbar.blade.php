<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <div class="dropdown m-1">
            <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown">
                Sign Out
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('signout') }}">Sign out</a>
            </div>
        </div>


    </ul>
</nav>
