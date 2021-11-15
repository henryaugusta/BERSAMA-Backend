@include('main.components.sidebar.left-sidebar-admin')

<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="{{ URL('/home') }}"
                                            aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                            class="hide-menu">Dashboard</span></a></li>
                <li class="list-divider"></li>


                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Makan Gratis</span></li>


                <li class="sidebar-item active">
                    <a class="sidebar-link" href="{{ URL('makan-gratis/cari') }}" aria-expanded="false">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">Cari Lokasi
                        </span>
                    </a>
                </li>

                <li class="sidebar-item"><a class="has-arrow sidebar-link" href="javascript:void(0)"
                                            aria-expanded="false"><span class="hide-menu">Kegiatanku</span></a>
                    <ul aria-expanded="false" class="collapse second-level base-level-line">
                        <li class="sidebar-item"><a href="{{ URL('makan-gratis/my/activity?type=not_taken') }}"
                                                    class="sidebar-link"><span
                                    class="hide-menu">Belum Diambil</span></a></li>
                        <li class="sidebar-item"><a href="{{ URL('makan-gratis/my/activity?type=taken') }}"
                                                    class="sidebar-link"><span
                                    class="hide-menu">Diambil</span></a></li>
                    </ul>
                </li>


                <li class="sidebar-item"><a class="has-arrow sidebar-link" href="javascript:void(0)"
                                            aria-expanded="false"><span class="hide-menu">Manage Event</span></a>
                    <ul aria-expanded="false" class="collapse second-level base-level-line">

                        <li class="sidebar-item active">
                            <a class="sidebar-link" href="{{ URL('makan-gratis/create') }}" aria-expanded="false">
                                <span class="hide-menu">Buat Event
                        </span>
                            </a>
                        </li>

                        <li class="sidebar-item"><a href="{{ URL('makan-gratis/manage') }}" class="sidebar-link"><span
                                    class="hide-menu"> Manage Event</span></a></li>
                    </ul>
                </li>


                @if (Auth::user()->role != 2)
                    <li class="list-divider"></li>

                    <li class="nav-small-cap"><span class="hide-menu">Data Pengguna</span></li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{ URL('/admin/user/create') }}" aria-expanded="false">
                            <i data-feather="tag" class="feather-icon"></i>
                            <span class="hide-menu">Tambah Pengguna
                            </span>
                        </a>
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{ URL('/admin/user/manage') }}" aria-expanded="false">
                            <i data-feather="tag" class="feather-icon"></i>
                            <span class="hide-menu">Manage
                            </span>
                        </a>
                    </li>
                @endif

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Konten</span></li>

                <li class="sidebar-item active">
                    <a class="sidebar-link" href="{{ URL('news/create') }}" aria-expanded="false">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">Tambah Konten
                        </span>
                    </a>
                </li>
                <li class="sidebar-item active">
                    <a class="sidebar-link" href="{{ URL('news/manage') }}" aria-expanded="false">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">Manage Konten
                        </span>
                    </a>
                </li>

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Laporan Pengeluaran</span></li>

                <li class="sidebar-item active">
                    <a class="sidebar-link" href="{{ URL('expenses/report') }}" aria-expanded="false">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">Laporan
                        </span>
                    </a>
                </li>

                <li class="sidebar-item"><a class="has-arrow sidebar-link" href="javascript:void(0)"
                                            aria-expanded="false"><span class="hide-menu">Manage Laporan</span></a>
                    <ul aria-expanded="false" class="collapse second-level base-level-line">
                        <li class="sidebar-item"><a href="{{ URL('expenses/create') }}" class="sidebar-link"><span
                                    class="hide-menu">Input Pengeluaran</span></a></li>
                        <li class="sidebar-item"><a href="{{ URL('expenses/manage') }}" class="sidebar-link"><span
                                    class="hide-menu">Manage</span></a></li>
                    </ul>
                </li>


                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Donasi</span></li>

                <li class="sidebar-item active">
                    <a class="sidebar-link" href="{{ URL('donasi/ikut-donasi') }}" aria-expanded="false">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">Ikut Donasi
                        </span>
                    </a>
                </li>

                <li class="sidebar-item"><a class="has-arrow sidebar-link" href="javascript:void(0)"
                                            aria-expanded="false"><span class="hide-menu">Data Donasi</span></a>
                    <ul aria-expanded="false" class="collapse second-level base-level-line">
                        <li class="sidebar-item"><a href="{{ URL('donasi/donasi-saya') }}" class="sidebar-link"><span
                                    class="hide-menu"> Daftar Donasi Saya </span></a></li>
                        <li class="sidebar-item"><a href="{{ URL('donasi/all') }}"
                                                    class="sidebar-link"><span
                                    class="hide-menu">Seluruh Donasi</span></a></li>
                    </ul>
                </li>

                <li class="sidebar-item"><a class="has-arrow sidebar-link" href="javascript:void(0)"
                                            aria-expanded="false"><span class="hide-menu">Payment Merchant</span></a>
                    <ul aria-expanded="false" class="collapse second-level base-level-line">
                        <li class="sidebar-item"><a href="{{ URL('payment-merchant/tambah') }}"
                                                    class="sidebar-link"><span
                                    class="hide-menu"> Tambah </span></a></li>
                        <li class="sidebar-item"><a href="{{ URL('payment-merchant/manage') }}"
                                                    class="sidebar-link"><span
                                    class="hide-menu"> Manage</span></a></li>
                    </ul>
                </li>

                <li class="sidebar-item"><a class="has-arrow sidebar-link" href="javascript:void(0)"
                                            aria-expanded="false"><span class="hide-menu">Donation Account</span></a>
                    <ul aria-expanded="false" class="collapse second-level base-level-line">
                        <li class="sidebar-item"><a href="{{ URL('donation-account/tambah') }}"
                                                    class="sidebar-link"><span
                                    class="hide-menu"> Tambah </span></a></li>
                        <li class="sidebar-item"><a href="{{ URL('donation-account/manage') }}"
                                                    class="sidebar-link"><span
                                    class="hide-menu"> Manage</span></a></li>
                    </ul>
                </li>

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Pembagian Makanan</span></li>

                <li class="sidebar-item active">
                    <a class="sidebar-link" href="{{ URL('barang/tambah') }}" aria-expanded="false">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">Example Menu
                        </span>
                    </a>
                </li>
                <li class="sidebar-item active">
                    <a class="sidebar-link" href="{{ URL('barang/manage') }}" aria-expanded="false">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">Example Menu
                        </span>
                    </a>
                </li>


                <li class="list-divider"></li>


                <li class="nav-small-cap"><span class="hide-menu">Extra</span></li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();  document.getElementById('logout-form').submit();"
                                            aria-expanded="false"><i data-feather="log-out"
                                                                     class="feather-icon"></i><span
                            class="hide-menu">Logout</span></a></li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

