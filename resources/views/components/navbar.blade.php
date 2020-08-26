<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand"
           href="{{ url('/') }}"
        >
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse"
             id="navbarSupportedContent"
        >
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @auth
                    @can(\App\Providers\AuthServiceProvider::MANAGE_PUSKESMAS)
                        <a class="nav-link {{ \Illuminate\Support\Facades\Route::is("puskesmas-for-admin.*") ? "active" : ""  }}"
                           href="{{ route("puskesmas-for-admin.index")}}"
                        >
                            Puskesmas
                        </a>
                    @endcan

                    @can(\App\Providers\AuthServiceProvider::MANAGE_UNIT_PUSKESMAS)
                        <a class="nav-link {{ \Illuminate\Support\Facades\Route::is("unit-puskesmas-for-admin.*") ? "active" : ""  }}"
                           href="{{ route("unit-puskesmas-for-admin.index")}}">
                            Unit Puskesmas
                        </a>
                    @endcan

                    @can(\App\Providers\AuthServiceProvider::MANAGE_UPAYA_KESEHATAN)
                        <a class="nav-link {{ \Illuminate\Support\Facades\Route::is("puskesmas-for-admin.*") ? "active" : ""  }}"
                           href="{{ route("puskesmas-for-admin.index")}}"
                        >
                            Upaya Kesehatan
                        </a>
                    @endcan

                    @if(auth()->user()->level === \App\Constants\UserLevel::ADMIN_PUSKESMAS)
                        <a class="nav-link {{ \Illuminate\Support\Facades\Route::is("puskesmas.rencana-lima-tahunan.*") ? "active" : ""  }}"
                           href="{{ route("puskesmas.rencana-lima-tahunan.index")}}"
                        >
                            RLT
                        </a>

                        <a class="nav-link {{ \Illuminate\Support\Facades\Route::is("puskesmas.rencana-usulan-kegiatan.*") ? "active" : ""  }}"
                           href="{{ route("puskesmas.rencana-usulan-kegiatan.index")}}"
                        >
                            RUK
                        </a>

                        <a class="nav-link {{ \Illuminate\Support\Facades\Route::is("puskesmas.rpk-tahunan.*") ? "active" : ""  }}"
                           href="{{ route("puskesmas.rpk-tahunan.index")}}"
                        >
                            RPK Tahunan
                        </a>
                    @endif
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('login') }}"
                        >{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ route('register') }}"
                            >{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown"
                           class="nav-link dropdown-toggle"
                           href="#"
                           role="button"
                           data-toggle="dropdown"
                           aria-haspopup="true"
                           aria-expanded="false"
                           v-pre
                        >
                            {{ Auth::user()->name }}
                            <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right"
                             aria-labelledby="navbarDropdown"
                        >
                            <a class="dropdown-item"
                               href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                            >
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form"
                                  action="{{ route('logout') }}"
                                  method="POST"
                                  style="display: none;"
                            >
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>