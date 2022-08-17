<ul class="nav">
    <li class="nav-item {{ Route::is('member') || Route::is('dashboard') ? 'active' : '' }}">
        <a href="{{ (Auth::user()->access == 'customer') ? route('member') : route('dashboard') }}" class="nav-link"><i class="typcn typcn-chart-area-outline"></i>
            Dashboard</a>
    </li>
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
