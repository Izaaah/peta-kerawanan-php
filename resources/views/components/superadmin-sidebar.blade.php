<div class="superadmin-sidebar">
    <div class="sidebar-header">
        <h3 class="text-lg font-semibold">Menu Utama</h3>
    </div>

    <nav class="sidebar-nav">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('super-admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('super-admin.dashboard') ? 'active' : '' }}">
                    <span class="icon">🏠</span>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('super-admin.chart-jaringan') }}" class="sidebar-link {{ request()->routeIs('super-admin.chart-jaringan') ? 'active' : '' }}">
                    <span class="icon">📊</span>
                    <span>Chart Jaringan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('peta-penyalahgunaan.domisili') }}" class="sidebar-link {{ request()->routeIs('peta-penyalahgunaan.domisili') ? 'active' : '' }}">
                    <span class="icon">🗺️</span>
                    <span>Peta Kerawanan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('super-admin.user-management.index') }}" class="sidebar-link {{ request()->routeIs('super-admin.user-management.*') ? 'active' : '' }}">
                    <span class="icon">👥</span>
                    <span>User Management</span>
                </a>
            </li>
            <li>
                <a href="#" class="sidebar-link">
                    <span class="icon">📝</span>
                    <span>Input Data</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
