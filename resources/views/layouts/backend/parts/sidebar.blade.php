<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img
            src="{{ asset('/') }}dist/img/AdminLTELogo.png"
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: 0.8"
        />
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img
                    src="{{ asset('/') }}dist/img/user2-160x160.jpg"
                    class="img-circle elevation-2"
                    alt="User Image"
                />
            </div>
            <div class="info">
                <a href="#" class="d-block ">{{ auth()->user()->username }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul
                class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false"
            >

            @can('kasir')
            <li class="nav-item">
                <a href="{{ url('/home') }}" class="nav-link">
                    <i class="nav-icon fa fa-columns"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            @endcan

               @can('admin')
               <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link">
                    <i class="nav-icon fa fa-columns"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-header">MASTER</li>
            <li class="nav-item">
                <a href="{{ route('kategori.index') }}" class="nav-link">
                    <i class="nav-icon fa fa-cube"></i>
                    <p>Kategori</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('produk.index') }}" class="nav-link">
                    <i class="nav-icon fa fa-cubes"></i>
                    <p>Produk</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('member.index') }}" class="nav-link">
                    <i class="nav-icon fa fa-id-card"></i>
                    <p>Member</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('supplier.index') }}" class="nav-link">
                    <i class="nav-icon fa fa-truck"></i>
                    <p>Supplier</p>
                </a>
            </li>
               @endcan
                <li class="nav-header">TRANSACTION</li>
                @can('admin')
                <li class="nav-item">
                    <a href="{{ route('pengeluaran.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-wallet"></i>
                        <p>Pengeluaran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pembelian.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-money-check"></i>
                        <p>Pembelian</p>
                    </a>
                </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route('penjualan.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-dollar-sign"></i>
                        <p>Penjualan</p>
                    </a>
                </li>
          
                @can('admin')
                <li class="nav-header">REPORT</li>
                <li class="nav-item">
                    <a href="{{ route('laporan.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-file-alt"></i>
                        <p>Laporan</p>
                    </a>
                </li>
                <li class="nav-header">SETTINGS</li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="gallery.html" class="nav-link">
                        <i class="nav-icon fa fa-cogs"></i>
                        <p>Pengaturan</p>
                    </a>
                </li>
                @endcan
            </ul>
        </nav>
    </div>
</aside>
