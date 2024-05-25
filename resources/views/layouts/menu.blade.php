<div class="mainnav__categoriy py-3">
  <ul class="mainnav__menu nav flex-column">
    <h6 class="mainnav__caption mt-0 px-3 fw-bold">Navigation</h6>
    @auth

      <li class="nav-item has-sub">
        <a href="{{ url('dashboard') }}" class=" nav-link collapsed {{ Request::is('dashboard') ? 'active' : '' }}"><i class="demo-pli-home fs-5 me-2"></i>
          <span class="nav-label ms-1">Dashboard</span>
        </a>
      </li>

      <li class="nav-item has-sub">
        <a href="#" class="mininav-toggle nav-link active-sub {{ Request::is('pembelian', 'penjualan', 'lifo') ? 'active' : '' }}">
          <i class="fa fa-chart-line fs-5 me-2"></i>
          <span class="nav-label ms-1">Transaksi</span>
        </a>
        <ul class="mininav-content nav collapse">
          <li class="nav-item">
            <a href="{{ url('pembelian') }}" class="nav-link {{ Request::is('pembelian') ? 'active' : '' }}">Pembelian</a>
          </li>
          <li class="nav-item">
            <a href="{{ url('penjualan') }}" class="nav-link {{ Request::is('penjualan') ? 'active' : '' }}">Penjualan</a>
          </li>
        </ul>
      </li>

      {{-- <li class="nav-item has-sub">
        <a href="#" class="mininav-toggle nav-link collapsed {{ Request::is('laporan') ? 'active' : '' }}
              "><i class="demo-pli-split-vertical-2 fs-5 me-2"></i>
          <span class="nav-label ms-1">Laporan</span>
        </a>
        <ul class="mininav-content nav collapse">
          <li class="nav-item">
            <a href="{{ url('laporan') }}" class="nav-link {{ Request::is('laporan') ? 'active' : '' }}">Stok Barang</a>
          </li>
        </ul>
      </li> --}}

      <h6 class="mainnav__caption mt-0 px-3 fw-bold pb-2 pt-3">Data Management</h6>
      <li class="nav-item has-sub">
        <a href="#" class="mininav-toggle nav-link active-sub {{ Request::is('data-master-user/*') || Request::is('roles/*') || Request::is('roles') ? 'active' : '' }}">
          <i class="fa fa-gear fs-5 me-2"></i>
          <span class="nav-label ms-1">Data Master User</span>
        </a>
        <ul class="mininav-content nav collapse">
          <li class="nav-item">
            <a href="{{ url('data-master-user/data-user') }}" class="nav-link {{ Request::is('data-master-user/data-user', 'data-master-user/data-user/*') ? 'active' : '' }}">Data User</a>
          </li>
          {{-- <li class="nav-item">
              <a href="{{ url('roles') }}" class="nav-link {{ Request::is('roles') || Request::is('roles/*') ? 'active' : '' }}">Data Role</a>
            </li> --}}
        </ul>
      </li>

      <li class="nav-item has-sub">
        <a href="#" class="mininav-toggle nav-link active-sub {{ Request::is('data-master/*') ? 'active' : '' }}">
          <i class="fa fa-gear fs-5 me-2"></i>
          <span class="nav-label ms-1">Data Master</span>
        </a>
        <ul class="mininav-content nav collapse">
          <li class="nav-item">
            <a href="{{ url('data-master/data-obat') }}" class="nav-link {{ Request::is('data-master/data-obat') ? 'active' : '' }}">Data Obat</a>
          </li>
          <li class="nav-item">
            <a href="{{ url('data-master/data-customers') }}" class="nav-link {{ Request::is('data-master/data-customers') ? 'active' : '' }}">Data Pelanggan</a>
          </li>
          <li class="nav-item">
            <a href="{{ url('data-master/data-suppliers') }}" class="nav-link {{ Request::is('data-master/data-suppliers') ? 'active' : '' }}">Data Supplier</a>
          </li>
        </ul>
      </li>

      <div class="mainnav__profile">

        <div class="d-mn-max mt-5"></div>
        <div class="mininav-content collapse d-mn-max">
          <div class="d-grid px-3 mt-3">
            <form action="{{ url('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-sm btn-primary w-100">Logout</button>
            </form>
          </div>
        </div>
      </div>
    @endauth
  </ul>

</div>
