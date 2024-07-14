<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Wisata Fadhil</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">WF</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item  ">
                <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-house"></i><span>Dashboard</span></a>

            </li>

            <li class="nav-item ">
                <a href="{{ route('users.index') }}" class="nav-link "><i class="fas fa-user"></i>
                    <span>Users</span></a>
            </li>

            <li class="nav-item ">
                <a href="{{ route('categories.index') }}" class="nav-link "><i class="fas fa-list"></i>
                    <span>Categories</span></a>
            </li>

            <li class="nav-item ">
                <a href="{{ route('products.index') }}" class="nav-link "><i class="fas fa-ticket"></i>
                    <span>Products</span></a>
            </li>

            <li class="nav-item ">
                <a href="{{ route('orders.index') }}" class="nav-link "><i class="fas fa-dollar-sign"></i>
                    <span>Orders</span></a>
            </li>
    </aside>
</div>
