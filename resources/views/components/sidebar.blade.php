<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('home') }}" class="app-brand-link">
            <img src="{{ asset('logo-black.png') }}" alt="{{ config('app.name') }}" width="35">
            <span class="app-brand-text demo text-black fw-bolder ms-2">{{ config('app.name') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Home -->
        <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="{{ __('menu.home') }}">{{ __('menu.home') }}</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{ __('menu.header.main_menu') }}</span>
          </li>
          <li class="menu-item">
            <a href="app-email.html" class="menu-link">
              <i class="menu-icon tf-icons bx bx-envelope"></i>
              <div class="text-truncate" data-i18n="Email">User</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ route('jabatan.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-chat"></i>
              <div class="text-truncate" data-i18n="Chat">Jabatan</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ route('bagian.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-calendar"></i>
              <div class="text-truncate" data-i18n="Calendar">Bagian</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ route('jenis.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-grid"></i>
              <div class="text-truncate" data-i18n="Kanban">Jenis Surat</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ route('ruang.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-grid"></i>
              <div class="text-truncate" data-i18n="Kanban">Ruang Penyimpanan</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ route('relasi.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-grid"></i>
              <div class="text-truncate" data-i18n="Kanban">Perusahaan/Relasi</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ route('suratmasuk.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-grid"></i>
              <div class="text-truncate" data-i18n="Kanban">Surat Masuk</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ route('suratkeluar.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-grid"></i>
              <div class="text-truncate" data-i18n="Kanban">Surat Keluar</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ route('disposisi.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-grid"></i>
              <div class="text-truncate" data-i18n="Kanban">Disposisi SM</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ route('approve.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-grid"></i>
              <div class="text-truncate" data-i18n="Kanban">Persetujuan</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="app-kanban.html" class="menu-link">
              <i class="menu-icon tf-icons bx bx-grid"></i>
              <div class="text-truncate" data-i18n="Kanban">Arsip</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="app-kanban.html" class="menu-link">
              <i class="menu-icon tf-icons bx bx-grid"></i>
              <div class="text-truncate" data-i18n="Kanban">Laporan</div>
            </a>
          </li>
    </ul>
</aside>
