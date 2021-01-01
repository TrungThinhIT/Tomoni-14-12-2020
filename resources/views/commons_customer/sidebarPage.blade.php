<div class="sidebar sidebar-style-2">
    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-info" class="">
                <li class="nav-item active">
                    <a >
                        <i class="fas fa-home"></i>
                        <p>Introduction</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <span class="letter-icon">B: </span>
                        <p>Tool</p>
                    </a>
                    <ul class="dropdown-menu departments" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{route('customer.bill.index')}}">Bill</a></li>
                        <li><a class="dropdown-item" href="{{route('customer.payment.index')}}">Payment</a></li>
                        <li><a class="dropdown-item" href="{{route('customer.debt.index')}}">Debt</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <span class="letter-icon">Hi: </span>
                        <p>{{Auth::user()->fname}}</p>
                    </a>
                    <ul class="dropdown-menu departments" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{route('warehouses.imported')}}">Hàng Nhập </a></li>
                        <li><a class="dropdown-item" href="{{route('warehouses.exported')}}">Hàng xuất</a></li>
                        <li><a class="dropdown-item" href="{{route('auth.logout')}}">Đăng xuất</a></li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
