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
                <li class="nav-item dropdown"  style="color:#44a5f1" >
                    <a class="nav-link dropdown-toggle" href="../components/alerts.php" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <span class="letter-icon">S</span>
                        <p>Supplier</p>
                    </a>
                    <ul  class="dropdown-menu  departments"  style="color:#44a5f1" aria-labelledby="navbarDropdownMenuLink">
                        <li style="color:#44a5f1"><a class="dropdown-item" href="{{route('supplier.invoice')}}">Hoá đơn supplier</a></li>
                        <li style="color:#44a5f1"><a class="dropdown-item" href="{{route('supplier.payments')}}">Tiền thanh toán supplier</a></li>
                        <li style="color:#44a5f1"><a class="dropdown-item" href="{{route('supplier.management')}}">Quản lý supplier</a></li>
                        <li style="color:#44a5f1"><a class="dropdown-item" href="{{route('supplier.payback')}}">Supplier trả lại tiền</a></li>
                        <li style="color:#44a5f1"><a class="dropdown-item" href="{{route('supplier.debt')}}">Công nợ  NCCC</a></li>
                    </ul>
                </li>
                <!-- <select type="text" id="validationDefault01" placeholder="Nhập số hoá đơn"  required style="" >
                    <option>Type</option>
                    <option>Ketchup</option>
                    <option>Relish</option>
                </select> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="../components/componentOrder.php" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <span class="letter-icon">O</span>
                        <p>Order</p>
                    </a>
                    <ul class="dropdown-menu departments" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="../components/hoaDon.php">Hoá đơn</a></li>
                        <li><a class="dropdown-item" href="../components/soCai.php">Sổ cái</a></li>
                        <li><a class="dropdown-item" href="../components/webOrder.php">Web order</a></li>
                        <li><a class="dropdown-item" href="../components/tienKhachThanhToan.php">Tiền khách thanh toán</a></li>
                        <li><a class="dropdown-item" href="../components/congNoKhachHang.php">Công nợ khách hàng</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="../components/componentWarehouse.php" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <span class="letter-icon">W</span>
                        <p>Warehouses</p>
                    </a>
                    <ul class="dropdown-menu departments" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="../components/hangNhap.php">Hàng Nhập </a></li>
                        <li><a class="dropdown-item" href="../components/hangXuat.php">Hàng xuất</a></li>
                        <li><a class="dropdown-item" href="../components/hangTonKho.php">Tồn kho</a></li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
