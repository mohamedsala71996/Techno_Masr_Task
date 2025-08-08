<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <!-- Sidebar Toggle -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>
        
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ms-auto">
            <!-- User Menu -->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle me-1"></i>
                    <span class="d-none d-md-inline">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="dropdown-item">
                        <form action="{{ route('admin.logout') }}" method="POST" class="w-100">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 text-decoration-none w-100 text-start">
                                <i class="bi bi-box-arrow-right me-2"></i> تسجيل الخروج
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>