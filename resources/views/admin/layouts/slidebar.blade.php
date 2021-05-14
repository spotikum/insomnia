<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Prognet<sup>2</sup></div>
    </a>

    <hr class="sidebar-divider my-0">
        <li class="nav-item{{ request()->is('admin') ? ' active' : ''}}">
            <a class="nav-link" href="{{ url('admin') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
    <hr class="sidebar-divider">
        <li class="nav-item{{ request()->is('product') ? ' active' : ''}}">
            <a class="nav-link" href="{{ url('product') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Products</span></a>
        </li>
        <li class="nav-item{{ request()->is('category') ? ' active' : ''}}">
            <a class="nav-link" href="{{ url('category') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Category</span></a>
        </li>
        <li class="nav-item{{ request()->is('couriers') ? ' active' : ''}}">
            <a class="nav-link" href="{{ url('couriers') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Courier</span></a>
        </li>
        <li class="nav-item{{ request()->is('discount') ? ' active' : ''}}">
            <a class="nav-link" href="{{ url('discount') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Discount</span></a>
        </li>
    <hr class="sidebar-divider">
</ul>
<!-- End of Sidebar -->