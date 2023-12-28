<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="/" class="app-brand-link">
      <span class="app-brand-text demo menu-text fw-bold text-uppercase">{{ auth()->user()->role }}</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item {{ request()->is('/') ? 'open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-smart-home"></i>
        <div data-i18n="Dashboards">Dashboards</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->is('/') ? 'active' : '' }}">
          <a href="/" class="menu-link">
            <div data-i18n="Analitik">Analitik</div>
          </a>
        </li>
      </ul>
    </li>

    @if (auth()->user()->role == 'owner')
        
    <!-- MASTER -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">MASTER</span>
    </li>
    <li class="menu-item {{ request()->is('master/renter', 'master/renter/*') ? 'open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-users"></i>
        <div data-i18n="Pengguna">Pengguna</div>
        <div class="badge bg-label-primary rounded-pill ms-auto" id="label-total-brand-influencer-new-count"></div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->is('master/renter', 'master/renter/*') ? 'active' : '' }} menu-item-brand">
          <a href="{{ route('master.renter') }}" class="menu-link">
            <div data-i18n="Penyewa">Penyewa</div>
            <div class="badge bg-label-primary rounded-pill ms-auto" id="label-brand-new-count"></div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item {{ request()->is('master/gor', 'master/gor/*', 'master/field', 'master/field/*') ? 'open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-checkup-list"></i>
        <div data-i18n="Properti">Properti</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->is('master/gor', 'master/gor/*') ? 'active' : '' }}">
          <a href="{{ route('master.gor') }}" class="menu-link">
            <div data-i18n="Gor">Gor</div>
          </a>
        </li>
        <li class="menu-item {{ request()->is('master/field', 'master/field/*') ? 'active' : '' }}">
          <a href="{{ route('master.field') }}" class="menu-link">
            <div data-i18n="Lapangan">Lapangan</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item {{ request()->is('master/category', 'master/category/*') ? 'active' : '' }} menu-item-product">
      <a href="{{ route('master.category') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-package"></i>
        <div data-i18n="Kategori">Kategori</div>
        <div class="badge bg-label-primary rounded-pill ms-auto" id="label-total-product-new-count"></div>
      </a>
    </li>

    <!-- AKTIVITAS -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">LAPORAN</span>
    </li>
    <li class="menu-item {{ request()->is('reporting/sales', 'reporting/sales/*') ? 'active' : '' }}">
      <a href="{{ route('reporting.sales') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-transfer-in"></i>
        <div data-i18n="Penyewaan">Penyewaan</div>
      </a>
    </li>

    <!-- LAPORAN -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">SPESIAL</span>
    </li>
    <li class="menu-item">
      <a href="app-email.html" class="menu-link">
        <i class="menu-icon tf-icons ti ti-wallet"></i>
        <div data-i18n="Langganan">Langganan</div>
      </a>
    </li>

    @endif
    
  </ul>
</aside>