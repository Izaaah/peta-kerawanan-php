<div class="superadmin-sidebar">
    <div class="sidebar-header">
        <h3 class="text-lg font-semibold">Menu Utama</h3>
    </div>

    <nav class="sidebar-nav">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('superadmin.dashboard') }}" class="sidebar-link {{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}">
                    <span class="icon">🏠</span>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('superadmin.peta') }}" class="sidebar-link {{ request()->routeIs('superadmin.peta') ? 'active' : '' }}">
                    <span class="icon">🗺️</span>
                    <span>Peta Kerawanan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('superadmin.user-management') }}" class="sidebar-link {{ request()->routeIs('superadmin.user-management.*') ? 'active' : '' }}">
                    <span class="icon">👥</span>
                    <span>User Management</span>
                </a>
            </li>
            <li>
                <a href="{{ route('superadmin.data-input') }}" class="sidebar-link {{ request()->routeIs('superadmin.data-input.*') ? 'active' : '' }}">
                    <span class="icon">📝</span>
                    <span>Input Data</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
