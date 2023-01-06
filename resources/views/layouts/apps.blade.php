<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title }} &mdash; Application</title>

    <!-- General CSS Files -->
	<link rel="icon" href="http://sintesaniaga.com/assets/img/sintesa1.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="{{ asset('/select2/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}?_={{ rand(1000,2000) }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('/fpro/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <style>
        tr#table-row:nth-child(odd) {
            background-color: rgb(249 250 251 / 1) !important;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @livewireStyles

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/components.css') }}">
</head>

<body class="layout-3" style="font-family: Inter">
    
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar px-2">
                <a href="{{ url('dashboard') }}" class="navbar-brand sidebar-gone-hide">STOCK MANAGE MINI</a>
                <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars mt-4"></i></a>
                <ul class="navbar-nav navbar-right mt-3 lg:tw-mt-1 ml-auto">
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                            class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Notifications
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-icon bg-primary text-white">
                                        <i class="fas fa-code"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Template update is available now!
                                        <div class="time text-primary">2 Min Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                                        <div class="time">10 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-success text-white">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                                        <div class="time">12 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-danger text-white">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Low disk space. Let's clean it!
                                        <div class="time">17 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Welcome to Stisla template!
                                        <div class="time">Yesterday</div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Logged in 5 min ago</div>
                            <a href="#" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <a href="#" class="dropdown-item has-icon">
                                <i class="fas fa-bolt"></i> Activities
                            </a>
                            <a href="#" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="dropdown-item has-icon" onclick="event.preventDefault();
                                this.closest('form').submit();">
                                    <i class="far fa-sign-out-alt"></i> Logout
                                </a>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>

            <nav class="navbar navbar-secondary navbar-expand-lg tw-shadow-md tw-shadow-gray-200">
                <div class="container">
                    <ul class="navbar-nav">
                        @if( Auth::user()->hasRole('admin') )
                            <li class="nav-item {{ (request()->is('dashboard')) ? 'active' : '' }}">
                                <a href="{{ url('dashboard') }}" class="nav-link"><i class="far fa-fire"></i><span>Dashboard</span></a>
                            </li>
                            <li class="nav-item dropdown
                                    {{ (request()->is('admin/master-kategori')) ? 'active' : '' }}
                                    {{ (request()->is('admin/master-jenis')) ? 'active' : '' }}
                                    {{ (request()->is('admin/master-merek')) ? 'active' : '' }}
                                    {{ (request()->is('admin/master-satuan')) ? 'active' : '' }}
                                    {{ (request()->is('admin/master-rak')) ? 'active' : '' }}
                                    {{ (request()->is('admin/master-barang')) ? 'active' : '' }}
                                ">
                                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown">
                                    <i class="far fa-archive"></i>
                                    <span>Data Master</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item {{ (request()->is('admin/master-kategori')) ? 'active' : '' }}">
                                        <a href="{{ url('admin/master-kategori') }}" class="nav-link">Kategori</a>
                                    </li>
                                    <li class="nav-item {{ (request()->is('admin/master-jenis')) ? 'active' : '' }}">
                                        <a href="{{ url('admin/master-jenis') }}" class="nav-link">Jenis</a>
                                    </li>
                                    <li class="nav-item {{ (request()->is('admin/master-merek')) ? 'active' : '' }}">
                                        <a href="{{ url('admin/master-merek') }}" class="nav-link">Merek</a>
                                    </li>
                                    <li class="nav-item {{ (request()->is('admin/master-satuan')) ? 'active' : '' }}">
                                        <a href="{{ url('admin/master-satuan') }}" class="nav-link">Satuan</a>
                                    </li>
                                    <li class="nav-item {{ (request()->is('admin/master-rak')) ? 'active' : '' }}">
                                        <a href="{{ url('admin/master-rak') }}" class="nav-link">Lokasi Rak</a>
                                    </li>
                                    <li class="nav-item {{ (request()->is('admin/master-barang')) ? 'active' : '' }}">
                                        <a href="{{ url('admin/master-barang') }}" class="nav-link">Data Barang</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown
                                    {{ (request()->is('admin/saldo-awal-item')) ? 'active' : '' }}
                                    {{ (request()->is('admin/barang-masuk')) ? 'active' : '' }}
                                    {{ (request()->is('admin/barang-keluar')) ? 'active' : '' }}
                                    {{ (request()->is('admin/barang-opname')) ? 'active' : '' }}
                                ">
                                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown">
                                    <i class="far fa-inventory"></i>
                                    <span>Persediaan</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item {{ (request()->is('admin/saldo-awal-item')) ? 'active' : '' }}">
                                        <a href="{{ url('admin/saldo-awal-item') }}" class="nav-link">Saldo Awal Item</a>
                                    </li>
                                    <li class="nav-item {{ (request()->is('admin/barang-masuk')) ? 'active' : '' }}">
                                        <a href="{{ url('admin/barang-masuk') }}" class="nav-link">Barang Masuk</a>
                                    </li>
                                    <li class="nav-item {{ (request()->is('admin/barang-keluar')) ? 'active' : '' }}">
                                        <a href="{{ url('admin/barang-keluar') }}" class="nav-link">Barang Keluar</a>
                                    </li>
                                    <li class="nav-item {{ (request()->is('admin/barang-opname')) ? 'active' : '' }}">
                                        <a href="{{ url('admin/barang-opname') }}" class="nav-link">Barang Opname</a>
                                    </li>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item {{ (request()->is('admin/kartu-stock')) ? 'active' : '' }}">
                                <a href="{{ url('admin/kartu-stock') }}" class="nav-link"><i class="far fa-pallet"></i><span>Kartu Stock</span></a>
                            </li>
                            <li class="nav-item dropdown
                                    {{ (request()->is('admin/laporan/saldo-awal-item')) ? 'active' : '' }}
                                    {{ (request()->is('admin/laporan/barang-masuk')) ? 'active' : '' }}
                                    {{ (request()->is('admin/laporan/barang-keluar')) ? 'active' : '' }}
                                    {{ (request()->is('admin/laporan/barang-opname')) ? 'active' : '' }}
                            ">
                                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown">
                                    <i class="far fa-file-archive"></i>
                                    <span>Laporan</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item {{ (request()->is('admin/laporan/saldo-awal-item')) ? 'active' : '' }}">
                                        <a href="{{ url('admin/laporan/saldo-awal-item') }}" class="nav-link">Saldo Awal Item</a>
                                    </li>
                                    <li class="nav-item {{ (request()->is('admin/laporan/barang-masuk')) ? 'active' : '' }}">
                                        <a href="{{ url('admin/laporan/barang-masuk') }}" class="nav-link">Barang Masuk</a>
                                    </li>
                                    <li class="nav-item {{ (request()->is('admin/laporan/barang-keluar')) ? 'active' : '' }}">
                                        <a href="{{ url('admin/laporan/barang-keluar') }}" class="nav-link">Barang Keluar</a>
                                    </li>
                                    <li class="nav-item {{ (request()->is('admin/laporan/barang-opname')) ? 'active' : '' }}">
                                        <a href="{{ url('admin/laporan/barang-opname') }}" class="nav-link">Barang Opname</a>
                                    </li>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item {{ (request()->is('setting-user')) ? 'active' : '' }}">
                                <a href="{{ url('setting-user') }}" class="nav-link"><i class="far fa-cogs"></i><span>Setting User</span></a>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
            <div class="main-content px-3">
                <section class="section custom-section">
                    @yield('content')
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; {{ date('Y') }} <div class="bullet"></div> Created By <a href="https://github.com/fahmiibrahimdev">Fahmi Ibrahim</a>
                </div>
                <div class="footer-right">
                    1.0
                </div>
            </footer>
        </div>
    </div>

		<!-- General JS Scripts -->
		<script src="{{ asset('/select2/jquery.min.js') }}"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
			integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
		<script src="{{ asset('/assets/js/stisla.js') }}"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

		<!-- JS Libraies -->
		<script src="{{ asset('/js/app.js') }}?_={{ rand(1000,2000) }}"></script>
		<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
		<script src="{{ asset('/select2/select2.full.min.js') }}"></script>
		<script src="{{ asset('/assets/js/scripts.js') }}"></script>

		@yield('js')
		<script>
			$(document).keydown(function (e) {
				if (e.keyCode == 112) {
					e.preventDefault()
					$('#tambahDataModal').modal('show')
				}
			});
			$(document).ready(function () {
				$('#dataTable').DataTable();
			});
		</script>
		@livewireScripts
		{{-- Livewire Scripts --}}
		<script>
			window.livewire.on("dataStore", () => {
				$("#tambahDataModal").modal("hide");
				$("#ubahDataModal").modal("hide");
			});
			window.addEventListener("swal", function () {
			Swal.fire({
					title: 'Are you sure?',
					text: 'Jika kamu menghapus data ini, data tersebut tidak bisa dikembalikan',
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: 'Ya, Delete saja!',
				}).then((result) => {
					if (result.isConfirmed) {
						livewire.emit("deleteConfirmed");
						Swal.fire(
							'Successfully',
							'Data deleted successfully!',
							'success',
						);
					}
				});
			});
			window.addEventListener("swal:deleteChecked", function (event) {
				Swal.fire({
					title: '{{ __('messages.alert.delete.title') }}',
					text: '{{ __('messages.alert.delete.notice') }}',
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: '{{ __('messages.alert.delete.confirm') }}',
				}).then((result) => {
					if (result.isConfirmed) {
						window.livewire.emit("deleteCheckedData",event.detail.checkedIDs);
						Swal.fire(
							'{{ __('messages.alert.success') }}',
							'{{ __('messages.alert.delete.deleted') }}',
							'{{ __('messages.alert.type') }}',
						);
					}
				});
			});
			window.addEventListener("swal:modal", function () {
				Swal.fire({
					title: event.detail.message,
					html: event.detail.html,
					text: event.detail.text,
					icon: event.detail.type,
				});
			});
			window.addEventListener("swal:active", function () {
				Swal.fire({
					title: event.detail.message,
					html: event.detail.html,
					text: event.detail.text,
					icon: event.detail.type, // warning, success, alert
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: event.detail.confirmText,
				}).then((result) => {
					if (result.isConfirmed) {
						livewire.emit("activeConfirmed");
						Swal.fire(
							'{{ __('messages.alert.success') }}',
							'{{ __('messages.alert.updated') }}',
							'{{ __('messages.alert.type') }}',
						);
					}
				});
			});
			window.addEventListener("swal:unactive", function () {
				Swal.fire({
					title: event.detail.message,
					html: event.detail.html,
					text: event.detail.text,
					icon: event.detail.type, // warning, success, alert
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: event.detail.confirmText,
				}).then((result) => {
					if (result.isConfirmed) {
						livewire.emit("unactiveConfirmed");
						Swal.fire(
							'{{ __('messages.alert.success') }}',
							'{{ __('messages.alert.updated') }}',
							'{{ __('messages.alert.type') }}',
						);
					}
				});
			});
			window.addEventListener("deleteSwal", function () {
			Swal.fire({
				title: "Are you sure?",
				text: "Jika kamu menghapus data tersebut, datanya tidak bisa dikembalikan!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, delete it!",
			}).then((result) => {
				if (result.isConfirmed) {
					livewire.emit("deleteConfirmed");
					Swal.fire("Deleted!", "Data Berhasil Dihapus", "success");
				}
			});
		});
		window.addEventListener("activeSwal", function () {
			Swal.fire({
				title: "Apa kamu yakin?",
				text: "Kamu ingin mengaktifkan akun ini?",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Ya, Aktifkan!",
			}).then((result) => {
				if (result.isConfirmed) {
					livewire.emit("activeConfirmed");
					Swal.fire("Berhasil!", "Akun berhasil diaktifkan", "success");
				}
			});
		});
        window.addEventListener("nonActiveSwal", function () {
			Swal.fire({
				title: "Apa kamu yakin?",
				text: "Kamu ingin menonaktifkan akun ini?",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Ya, Nonaktifkan!",
			}).then((result) => {
				if (result.isConfirmed) {
					livewire.emit("nonActiveConfirmed");
					Swal.fire("Berhasil!", "Akun berhasil dinonaktifkan", "success");
				}
			});
		});
		</script>
		<script>
			window.onbeforeunload = function () {
				window.scrollTo(5,75);
			};
		</script>
		@stack('scripts')

		<!-- Template JS File -->
		<script src="{{ asset('/assets/js/custom.js') }}"></script>
	{{-- Javascript Source --}}
	
</body>

</html>
