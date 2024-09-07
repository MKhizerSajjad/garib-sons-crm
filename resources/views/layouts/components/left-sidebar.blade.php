<div class="vertical-menu">
    @php
        $userType = auth()->user()->user_type ?? null;
    @endphp

    {{-- <div class="d-flex"> --}}
        {{-- <!-- LOGO -->
        <div class="navbar-brand-box">
            <a href="index.html" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{ asset('images/logo.png') }}" alt="" height="22">
                </span>
                <span class="logo-lg">\
                    <img src="{{ asset('images/logo.png') }}" alt="" height="17">
                </span>
            </a>

            <a href="index.html" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{ asset('images/logo.png') }}" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('images/logo.png') }}" alt="" height="19">
                </span>
            </a>
        </div> --}}

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('home') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('university.index') }}" class="waves-effect">
                        <i class="bx bx-buildings"></i>
                        <span key="t-universties">Universties</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('course.index') }}" class="waves-effect">
                        <i class="bx bx-book"></i>
                        <span key="t-courses">Courses</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('agent.index') }}" class="waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span key="t-courses">Agents</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-book-open"></i>
                        <span key="t-avail-course">University Courses</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('university-courses.index') }}" key="t-universities">Universities</a></li>
                        <li><a href="{{ route('university-courses.list') }}" key="t-courses">Courses</a></li>
                        {{-- <li><a href="{{ route('intake-course.index') }}" key="t-product-detail">Courses</a></li> --}}
                    </ul>
                </li>

                {{-- @if (in_array(auth()->user()->user_type , [1, 2, 3]))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-store"></i>
                            <span key="t-ecommerce">Shop</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('item.index') }}" key="t-products">Items</a></li>
                            <li><a href="{{ route('product.index') }}" key="t-product-detail">Products</a></li>
                            <li><a href="{{ route('service.index') }}" key="t-orders">Services</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-user-circle"></i>
                            <span key="t-users">Employees</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (in_array(auth()->user()->user_type , [1, 2]))
                                <li><a href="{{ route('employee.index') }}" key="t-products">Employees</a></li>
                            @endif|
                            @if (in_array(auth()->user()->user_type , [1]))
                                <li><a href="{{ route('manager.index') }}" key="t-products">Manager</a></li>
                            @endif
                            @if (in_array(auth()->user()->user_type , [1, 2]))
                                <li><a href="{{ route('technician.index') }}" key="t-products">Technician</a></li>
                            @endif
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-cog"></i>
                            <span key="t-settings">Settings</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('setting.index') }}" key="t-products">General</a></li>
                            <li><a href="{{ route('priority.index') }}" key="t-products">Priority</a></li>
                            <li><a href="{{ route('service-location.index') }}" key="t-orders">Service Location</a></li>
                        </ul>
                    </li>
                @endif --}}

                {{-- @if (in_array(auth()->user()->user_type , [1, 2]))
                    <li>
                        <a href="{{ route('customer.index') }}" class="waves-effect">
                            <i class="bx bx-user-circle"></i>
                            <span key="t-authentication">Customers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('case.index') }}" class="waves-effect">
                            <i class="bx bx-receipt"></i>
                            <span key="t-authentication">Cases</span>
                        </a>
                    </li>
                @endif --}}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
