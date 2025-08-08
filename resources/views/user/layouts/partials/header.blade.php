<style>
    .user-navbar {
        background: linear-gradient(90deg, #2575fc 0%, #8c5bc0 100%);
        box-shadow: 0 4px 32px rgba(80,112,185,0.09), 0 1.5px 4px rgba(80,112,185,0.08);
        border-radius: 0 0 16px 16px;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }
    .user-navbar .navbar-brand {
        color: #fff !important;
        font-weight: bold;
        font-size: 1.3rem;
        letter-spacing: 1px;
    }
    .user-navbar .nav-link, .user-navbar .dropdown-toggle {
        color: #f3f1f5 !important;
        font-weight: 500;
        font-size: 1.05rem;
        transition: color 0.2s;
    }
    .user-navbar .nav-link:hover, .user-navbar .dropdown-toggle:hover {
        color: #ffffff !important;
    }
    .user-navbar .dropdown-menu {
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(80,112,185,0.08);
        border: none;
        min-width: 170px;
        text-align: right;
    }
    .user-navbar .dropdown-item {
        font-size: 1rem;
        font-weight: 500;
        color: #444;
        transition: background 0.2s, color 0.2s;
        text-align: right;
        direction: rtl;
    }
    .user-navbar .dropdown-item:hover {
        background: #f3f1f5;
        color: #2575fc;
    }
    .user-navbar .navbar-toggler {
        border: none;
    }
    .user-navbar .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(140,91,192,0.7)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }
</style>
<nav class="navbar navbar-expand-lg user-navbar mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('user.home') }}">
            <i class="fas fa-code me-2"></i>TechBlog
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#userNavbar" aria-controls="userNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="userNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.home') }}">
                        <i class="fas fa-home me-1 p-1"></i>الرئيسية
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                        تسجيل الدخول
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                        تسجيل جديد
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.posts.create') }}">
                            <i class="fas fa-plus me-1 "></i>إضافة منشور
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user me-1 p-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('user.profile') }}">
                                    <i class="fas fa-user-edit me-1 "></i>حسابي
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit">
                                        <i class="fas fa-sign-out-alt me-1"></i>تسجيل الخروج
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
