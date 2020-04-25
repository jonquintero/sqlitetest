<div class="sidebar">
    <nav class="sidebar-nav ps ps--active-y">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ url('/home') }}" class="nav-link">
                    <i class="nav-icon fa fa-tachometer">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @canany(['user_management_access', 'user_access','permission_access','role_access'])
            <li class="nav-item nav-dropdown">
                <a class="nav-link  nav-dropdown-toggle">
                    <i class="fa fa-users nav-icon">

                    </i>
                    {{ trans('global.userManagement.title') }}
                </a>
                <ul class="nav-dropdown-items">

                    <li class="nav-item">
                        <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                            <i class="fa fa-briefcase nav-icon">

                            </i>
                            {{ trans('global.role.title') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                            <i class="fa fa-user nav-icon">

                            </i>
                            {{ trans('global.user.title') }}
                        </a>
                    </li>
                </ul>
            </li>
             @endcanany

            @can('post_access')
            <li class="nav-item">
                <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->is('admin/posts','admin/posts/*') ? 'active' : '' }}" >
                   <i class="nav-icon fa fa-file-text"></i>
                     Posts
                </a>
            </li>
            @endcan

            @can('comment_access')
            <li class="nav-item">
                <a href="{{ route('admin.comments.index') }}" class="nav-link {{ request()->is('admin/comments','admin/comments/*') ? 'active' : '' }}" >
                   <i class="nav-icon fa fa-comments"></i>
                     Comments
                </a>
            </li>
            @endcan


            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fa fa-sign-out">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 869px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 415px;"></div>
        </div>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
