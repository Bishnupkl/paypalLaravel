
<div class="page-sidebar-wrapper">

    <div class="page-sidebar navbar-collapse collapse">

        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item {{Request::is('/') || Request::is('dashboard') ? 'active' : ''}}">
                <a href="/dashboard" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="{{Request::is('/') || Request::is('dashboard') ? 'selected' : ''}}"></span>
                    <span class="{{Request::is('/') || Request::is('dashboard') ? 'arrow open' : ''}}"></span>
                </a>
            </li>
            @if(Auth::user()->is_admin)
                <li class="nav-item {{Request::is('paypal') || Request::is('employee/*') ? 'active' : ''}}">
                    <a href="{{route('paypal')}}" class="nav-link nav-toggle">
                        <i class="fa fa-building"></i>
                        <span class="title">Paypal</span>
                        <span class="{{Request::is('paypal') || Request::is('paypal/*') ? 'selected' : ''}}"></span>
                        <span class="{{Request::is('paypal') || Request::is('paypal/*') ? 'arrow open' : ''}}"></span>
                    </a>
                </li>
                
               @endif
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
