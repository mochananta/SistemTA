<div class="horizontal-menu">
    <nav class="navbar top-navbar col-lg-12 col-12 p-0 shadow-sm bg-white">
        <div class="container-fluid">
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between px-3 py-2">

                <ul class="navbar-nav navbar-nav-left">
                    <li class="nav-item ms-0 me-4 d-lg-flex d-none">
                        <a href="#" class="nav-link horizontal-nav-left-menu text-dark">
                            <i class="mdi mdi-format-list-bulleted fs-4"></i>
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2 mx-auto">
                    <a href="#" class="d-flex align-items-center gap-2 text-decoration-none">
                        <img src="{{ asset('user/kemenag.png') }}" alt="Logo Kemenag" class="h-8 w-auto"
                            style="max-height: 32px;" />
                        <span class="text-dark fw-bold fs-6 d-none d-lg-block">Admin Kementerian Agama Banyuwangi</span>
                    </a>
                </div>

                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#"
                            data-bs-toggle="dropdown" id="profileDropdown">
                            @php
                                $fullName = Auth::user()->name;
                                $parts = explode(' - ', $fullName);
                                $namePart = $parts[0];
                                $desaPart = $parts[1] ?? '';

                                $words = explode(' ', $namePart);
                                $count = count($words);

                                $formatted = '';
                                foreach ($words as $i => $word) {
                                    if ($i < $count - 1) {
                                        $formatted .= strtoupper(substr($word, 0, 1)) . '. ';
                                    } else {
                                        $formatted .= $word;
                                    }
                                }

                                $displayName = trim($formatted);
                                if ($desaPart) {
                                    $displayName .= ' - ' . $desaPart;
                                }
                            @endphp

                            <span class="nav-profile-name text-dark fw-medium">{{ $displayName }}</span>
                            <img src="{{ asset('admin/images/admin.png') }}" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-end navbar-dropdown" aria-labelledby="profileDropdown">
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-logout text-primary me-2"></i>
                                    Logout
                                </a>
                            </form>
                        </div>
                    </li>
                </ul>

                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="horizontal-menu-toggle">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </div>
    </nav>

    <nav class="bottom-navbar shadow-sm bg-white border-top">
        <div class="container">
            <ul class="nav page-navigation justify-content-between">
                <li class="nav-item">
                    <a class="nav-link d-flex flex-column align-items-center text-center"
                        href="{{ url('/dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline menu-icon fs-4"></i>
                        <span class="menu-title small">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.surat.view') }}"
                        class="nav-link d-flex flex-column align-items-center text-center">
                        <i class="mdi mdi-email-edit-outline menu-icon fs-4"></i>
                        <span class="menu-title small text-nowrap">Pengajuan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.konsultasi.view') }}"
                        class="nav-link d-flex flex-column align-items-center text-center">
                        <i class="mdi mdi-account-question-outline menu-icon fs-4"></i>
                        <span class="menu-title small text-nowrap">Konsultasi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.ibadah.view') }}"
                        class="nav-link d-flex flex-column align-items-center text-center">
                        <i class="mdi mdi-home-city-outline menu-icon fs-4"></i>
                        <span class="menu-title small text-nowrap">Ibadah</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.rekap.view') }}"
                        class="nav-link d-flex flex-column align-items-center text-center">
                        <i class="mdi mdi-chart-bar menu-icon fs-4"></i>
                        <span class="menu-title small text-nowrap">Rekap</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

</div>
