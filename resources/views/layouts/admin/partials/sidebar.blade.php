<div class="menu menu-column menu-title-gray-800 
menu-state-title-primary menu-state-icon-primary 
menu-state-bullet-primary menu-arrow-gray-500" id="kt_aside_menu" data-kt-menu="true">

    <div class="menu-item">
        <div class="menu-content pb-2">
            <span class="menu-section text-muted text-uppercase fs-8 ls-1">
                Dashboard
            </span>
        </div>
    </div>

    <div class="menu-item">
        <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <span class="menu-icon">
                <i class="bi bi-grid-fill fs-3"></i>
            </span>
            <span class="menu-title">Dashboard</span>
        </a>
    </div>


    <div class="menu-item">
        <div class="menu-content pt-8 pb-2">
            <span class="menu-section text-muted text-uppercase fs-8 ls-1">
                Data Master
            </span>
        </div>
    </div>

    @php
        $masterActive = request()->routeIs('patients.*')
            || request()->routeIs('medicines.*')
            || request()->routeIs('medicine-categories.*');
    @endphp

    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ $masterActive ? 'show' : '' }}">

        <span class="menu-link">
            <span class="menu-icon">
                <i class="bi bi-database-fill fs-3"></i>
            </span>
            <span class="menu-title">Data Master</span>
            <span class="menu-arrow"></span>
        </span>

        <div class="menu-sub menu-sub-accordion menu-active-bg">

            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('patients.*') ? 'active' : '' }}"
                    href="{{ route('patients.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">
                        <i class="bi bi-person-fill me-2"></i>
                        Pasien
                    </span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('medicines.*') ? 'active' : '' }}"
                    href="{{ route('medicines.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">
                        <i class="bi bi-capsule me-2"></i>
                        Obat
                    </span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('medicine-categories.*') ? 'active' : '' }}"
                    href="{{ route('medicine-categories.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">
                        <i class="bi bi-tags me-2"></i>
                        Kategori Obat
                    </span>
                </a>
            </div>

        </div>
    </div>


    <div class="menu-item">
        <div class="menu-content pt-8 pb-2">
            <span class="menu-section text-muted text-uppercase fs-8 ls-1">
                Transaksi
            </span>
        </div>
    </div>

    @php
        $visitActive = request()->routeIs('visits.*');
    @endphp

    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ $visitActive ? 'show' : '' }}">

        <span class="menu-link">
            <span class="menu-icon">
                <i class="bi bi-clipboard-pulse fs-3"></i>
            </span>
            <span class="menu-title">Kunjungan Pasien</span>
            <span class="menu-arrow"></span>
        </span>

        <div class="menu-sub menu-sub-accordion menu-active-bg">

            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('visits.*') ? 'active' : '' }}"
                    href="{{ route('visits.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">
                        <i class="bi bi-file-medical me-2"></i>
                        Data Kunjungan
                    </span>
                </a>
            </div>

        </div>
    </div>


    <div class="menu-item">
        <div class="menu-content pt-8 pb-2">
            <span class="menu-section text-muted text-uppercase fs-8 ls-1">
                Laporan
            </span>
        </div>
    </div>

    <div class="menu-item">
        <a class="menu-link {{ request()->routeIs('reports.*') ? 'active' : '' }}" href="{{ route('reports.index') }}">
            <span class="menu-icon">
                <i class="bi bi-bar-chart-fill fs-3"></i>
            </span>
            <span class="menu-title">Laporan Pendapatan</span>
        </a>
    </div>


    <div class="menu-item">
        <div class="menu-content pt-8 pb-2">
            <span class="menu-section text-muted text-uppercase fs-8 ls-1">
                Administrasi
            </span>
        </div>
    </div>

    <div class="menu-item">
        <a class="menu-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
            <span class="menu-icon">
                <i class="bi bi-people-fill fs-3"></i>
            </span>
            <span class="menu-title">Manajemen Pengguna</span>
        </a>
    </div>

</div>