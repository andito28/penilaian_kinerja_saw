<nav class="sidebar vertical-scroll  ps-container ps-theme-default ps-active-y">
    <div class="logo d-flex justify-content-between mb-2 pb-0">
        <a href="{{ route('dashboard.index') }}">
            <h4>PENILAIAN KINERJA</h4>
            {{-- <img src="{{ asset('pages/img/logo.png') }}" alt=""> --}}
        </a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li class="mm-active">
            <a href="{{ route('dashboard.index') }}">
                <div class="icon_menu">
                    <img src="{{ asset('pages/img/menu-icon/dashboard.svg') }}" alt="">
                </div>
                <span>Dashboard</span>
            </a>
        </li>
        @if (Auth::user()->role == 'admin')
            <li class="">
                <a href="{{ route('laskar.index') }}">
                    <div class="icon_menu">
                        <img src="{{ asset('pages/img/menu-icon/4.svg') }}" alt="">
                    </div>
                    <span>Laskar Pelangi</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('kriteria.index') }}" aria-expanded="false">
                    <div class="icon_menu">
                        <img src="{{ asset('pages/') }}/img/menu-icon/5.svg" alt="">
                    </div>
                    <span>Kriteria</span>
                </a>
            </li>
        @endif
        @if (Auth::user()->role == 'kepala_bidang')
            <li class="">
                <a href="{{ route('penilaian.index') }}" aria-expanded="false">
                    <div class="icon_menu">
                        <img src="{{ asset('pages') }}/img/menu-icon/6.svg" alt="">
                    </div>
                    <span>penilaian</span>
                </a>
            </li>
        @endif
        <li class="">
            <a href="{{ route('penilaian.hasil') }}" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('pages') }}/img/menu-icon/2.svg" alt="">
                </div>
                <span>Hasil Penilaian</span>
            </a>
        </li>
        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'kepala_bidang')
            <li class="">
                <a href="{{ route('penilaian.rekap') }}" aria-expanded="false">
                    <div class="icon_menu">
                        <img src="{{ asset('pages') }}/img/menu-icon/7.svg" alt="">
                    </div>
                    <span>Rekap Penilaian</span>
                </a>
            </li>
        @endif
    </ul>
</nav>
