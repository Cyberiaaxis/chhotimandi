<div class="d-flex flex-column pt-0">
    <div class="d-flex justify-content-end" id="sidebarToggleContainer">
        <span class="fs-5 sidebar-icon" style="cursor: pointer;" onclick="toggleSidebar()">
            <i class="fas fa-times"></i>
        </span>
    </div>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard.index') }}" class="nav-link {{ set_active('admin.dashboard.index') }}">
                <span class="icon"><i class="fas fa-tachometer-alt"></i></span>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.sliders.index') }}" class="nav-link {{ set_active('admin.sliders.index') }}">
                <span class="icon"><i class="fas fa-tachometer-alt"></i></span>
                <span class="text">Slider Management</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('orders.index') }}" class="nav-link {{ set_active('orders.index') }}">
                <span class="icon"><i class="fas fa-tachometer-alt"></i></span>
                <span class="text">Orders Management</span>
            </a>
        </li>

        <li class="nav-item dropdown">
            <a href="#" class="nav-link" id="productsDropdown" role="button" data-bs-toggle="collapse"
                data-bs-target="#productSubmenu" aria-expanded="false">
                <span class="icon"><i class="fas fa-th-large"></i></span>
                <span class="text">Catalog</span>
                <span class="text"> <i class="fa fa-chevron-down"></i> </span>
            </a>
            <div class="collapse {{ set_active(['admin.products.*', 'admin.categories.*'], 'show') }} product-menu" id="productSubmenu">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.products.index') }}"
                            class="nav-link {{ set_active('admin.products.index') }}" id="addProductDropdown">
                            <i class="fas fa-clipboard-list me-2"></i>
                            <span class="text"> Products </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.categories.index') }}"
                            class="nav-link {{ set_active('admin.categories.index') }}" id="removeProductDropdown">
                            <i class="fas fa-tags me-2"></i>
                            <span class="text">Categories</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- Add Privileges dropdown -->
        <li class="nav-item dropdown">
            <a href="#" class="nav-link" id="rolePermissionDropdown" role="button" data-bs-toggle="collapse"
                data-bs-target="#rolePermissionSubmenu" aria-expanded="false">
                <span class="icon"><i class="fas fa-user-shield"></i></span>
                <span class="text">Privileges</span>
                <span class="text"> <i class="fa fa-chevron-down"></i> </span>
            </a>
            <div class="collapse {{ set_active(['admin.permissions.*', 'admin.roles.*'], 'show') }}" id="rolePermissionSubmenu">

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.permissions.index') }}"
                            class="nav-link {{ set_active('admin.permissions.index') }}" id="permissionsLink">
                            <i class="fas fa-key me-2"></i>
                            <span class="text">Permissions</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.roles.index') }}"
                            class="nav-link {{ set_active('admin.roles.index') }}" id="rolesLink">
                            <i class="fas fa-user-tag me-2"></i>
                            <span class="text">Roles</span>
                        </a>
                    </li>

                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.assignRole.index') }}"
                class="nav-link {{ set_active('admin.assignRole.index') }}" id="permissionsLink">
                <i class="fas fa-key me-2"></i>
                <span class="text">Assign Role</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.tickets.index') }}" class="nav-link {{ set_active('admin.tickets.index') }}">
                <span class="icon"><i class="fas fa-users"></i></span>
                <span class="text">Tickets</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.discounts.index') }}" class="nav-link {{ set_active('admin.tickets.index') }}">
                <span class="icon"><i class="fas fa-users"></i></span>
                <span class="text">Offer & Discounts</span>
            </a>
        </li>
    </ul>
</div>