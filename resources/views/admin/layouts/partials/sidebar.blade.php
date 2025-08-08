      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
          <div class="sidebar-brand">
              <a href="{{ route('admin.dashboard') }}" class="brand-link d-flex align-items-center">
                  <i class="bi bi-house-door nav-icon fs-4 me-2 text-white"></i>
                  <span class="brand-text fw-light text-white">لوحة التحكم</span>
              </a>
          </div>
          <div class="sidebar-wrapper">
              <nav class="mt-2">
                  <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                      data-accordion="false">

                      <li class="nav-item mb-1">
                          <a href="{{ route('admin.dashboard') }}"
                              class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                              <i class="bi bi-house-door nav-icon"></i>
                              <span class="ms-2">الرئيسية</span>
                          </a>
                      </li>

                      @can('view admins')
                          <li class="nav-item mb-1">
                              <a href="{{ route('admin.admins.index') }}"
                                  class="nav-link {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}">
                                  <i class="bi bi-person-badge nav-icon"></i>
                                  <span class="ms-2">المشرفين</span>
                              </a>
                          </li>
                      @endcan
                      @can('view users')
                          <li class="nav-item mb-1">
                              <a href="{{ route('admin.users.index') }}"
                                  class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                  <i class="bi bi-people nav-icon"></i>
                                  <span class="ms-2">المستخدمين</span>
                              </a>
                          </li>
                      @endcan
                      @can('view categories')
                          <li class="nav-item mb-1">
                              <a href="{{ route('admin.categories.index') }}"
                                  class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                                  <i class="bi bi-layers nav-icon"></i>
                                  <span class="ms-2">الأقسام</span>
                              </a>
                          </li>
                      @endcan
                      @can('view posts')
                          <li class="nav-item mb-1">
                              <a href="{{ route('admin.posts.index') }}"
                                  class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                                  <i class="bi bi-file-earmark-text nav-icon"></i>
                                  <span class="ms-2">المقالات</span>
                              </a>
                          </li>
                      @endcan
                      @can('view roles')
                          <li class="nav-item mb-1">
                              <a href="{{ route('admin.roles.index') }}"
                                  class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                                  <i class="bi bi-shield-lock nav-icon"></i>
                                  <span class="ms-2">الأدوار والصلاحيات</span>
                              </a>
                          </li>
                      @endcan

                  </ul>
                  <!--end::Sidebar Menu-->
              </nav>
          </div>
          <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->
