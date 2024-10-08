<nav class="sidebar vertical-scroll ps-container ps-theme-default ">
    <div class="logo d-flex justify-content-between">
        <a href="index-2.html"><img src="/admin/img/logo.png" alt /></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li class="">
            <a class="" href="/" aria-expanded="false">
                <div class="icon_menu">
                    <img src="/admin/img/menu-icon/dashboard.svg" alt />
                </div>
                <span>home</span>
            </a>
        </li>
        <li class="">
            <a class="" href="{{ route('employees.index') }}" aria-expanded="false">
                <div class="icon_menu">
                    <img src="/admin/img/menu-icon/2.svg" alt />
                </div>
                <span>Employees</span>
            </a>
        </li>
        <li class="">
            <a class="" href="{{ route('products.index') }}" aria-expanded="false">
                <div class="icon_menu">
                    <img src="/admin/img/menu-icon/3.svg" alt />
                </div>
                <span>Products</span>
            </a>
        </li>
        <li class="">
            <a class="" href="{{ route('users.index') }}" aria-expanded="false">
                <div class="icon_menu">
                    <img src="/admin/img/menu-icon/4.svg" alt />
                </div>
                <span>Users</span>
            </a>
        </li>
    </ul>
</nav>
