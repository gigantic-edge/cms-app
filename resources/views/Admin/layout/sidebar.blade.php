<style>
    body {
        overflow-x: hidden;
    }

    .sidebar {
        height: 100vh;
        background: #343a40;
        color: #fff;
    }

    .sidebar .nav-link {
        color: #adb5bd;
        transition: 0.3s;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
        background-color: #495057;
        color: #fff;
    }

    .sidebar .nav-link i {
        margin-right: 10px;
    }
</style>

<nav class="col-md-3 col-lg-2 d-md-block sidebar p-3">
    <h4 class="text-white mb-4">CMS Dashboard</h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ Request::is('Administrator/dashboard') ? 'active' : '' }}" href="{{ url('/Administrator/dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('Administrator/blogs') ? 'active' : '' }}" href="{{ url('/Administrator/blogs') }}">
                <i class="bi bi-folder2-open"></i> Blogs
            </a>
        </li>
        <li class="nav-item mt-4">
            <a onclick="return confirm('Are you sure to logout from our system?')" class="nav-link text-danger" href="{{ url('/Administrator/logout') }}">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </li>
    </ul>
</nav>