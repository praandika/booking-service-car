<ul class="nav">
    <li class="nav-item {{ Route::is('member') || Route::is('admin.dashboard') ? 'active' : '' }}">
        <a href="{{ (Auth::user()->access == 'customer') ? route('member') : route('admin.dashboard') }}"
            class="nav-link"><i class="typcn typcn-chart-area-outline"></i>
            Dashboard</a>
    </li>
    @if(Auth::user()->access == 'admin')
    <li class="nav-item {{ Route::is('admin.booking-list') ? 'active' : '' }}">
        <a href="{{ route('admin.booking-list') }}" class="nav-link"><i class="typcn typcn-th-list"></i>
            Tertunda</a>
    </li>
    <li class="nav-item {{ Route::is('admin.work-order') ? 'active' : '' }}">
        <a href="{{ route('admin.work-order') }}" class="nav-link"><i class="typcn typcn-spanner"></i>
            Dikerjakan</a>
    </li>
    <li class="nav-item {{ Route::is('admin.work-finished') ? 'active' : '' }}">
        <a href="{{ route('admin.work-finished') }}" class="nav-link"><i class="typcn typcn-tick"></i>
            Selesai</a>
    </li>
    <li class="nav-item {{ Route::is('admin.employee') ? 'active' : '' }}">
        <a href="{{ route('admin.employee') }}" class="nav-link"><i class="typcn typcn-user"></i>
            Teknisi</a>
    </li>
    @endif
    @if(Auth::user()->access == 'customer')
    <li class="nav-item {{ Route::is('member.booking-list') ? 'active' : '' }}">
        <a href="{{ route('member.booking-list') }}" class="nav-link"><i class="typcn typcn-bookmark"></i>
            Data Booking</a>
    </li>
    <li class="nav-item {{ Route::is('member.history') ? 'active' : '' }}">
        <a href="{{ route('member.history') }}" class="nav-link"><i class="typcn typcn-time"></i>
            Riwayat</a>
    </li>
    @endif
</ul>
