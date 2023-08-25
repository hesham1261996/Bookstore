<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&family=IBM+Plex+Sans+Arabic:wght@400;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            /* font-family: 'IBM Plex Sans Arabic', sans-serif; */
            background: "#f0f0f0";
        }
    </style>
    @yield('head')
</head>

<body dir="rtl" style="text-align: right">

    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container-fluid">
                <a class="navbar-brand" href="/"><b>{{ __('بيت الكتب') }}</b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav  mx-auto">
                        <li class="nav-item">
                            <a href="{{route('all_categories')}}" class="nav-link">
                                {{ __('التصنيفات') }}
                                <i class="fa fa-list"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('gallery.publishers')}}" class="nav-link">
                                {{ __('الناشرون') }}
                                <i class="fa fa-table"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('gellery.authors')}}" class="nav-link">
                                {{ __('المؤلفون') }}
                                <i class="fa fa-pen"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                {{ __('مشترياتي') }}
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav mr-auto">
                        @guest
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">{{ __('تسجيل الدخول') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link">{{ __('انشاء حساب') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown justify-content-left">
                                <a id="navbarropdown" class="nav-link" href="#" data-bs-toggle="dropdown">
                                    <img class="rounded-circle" height="36" src="{{ Auth::user()->profile_photo_url }}"
                                        alt="{{ Auth::user()->name }}">
                                </a>
                                <div class="dropdown-menu dropdown-menu-left px-2 text-right mt-2">
                                    <!-- Responsive Settings Options -->
                                    <div class="pt-4 pb-1 border-t border-gray-200">
                                        <div class="flex items-center px-4">
                                            {{-- @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                <div class="shrink-0 mr-3">
                                                    <img class="rounded-circle" height="36" src="{{Auth::user()->profile_photo_url}}" alt="{{Auth::user()->name}}">
                                                </div>
                                            @endif --}}
                                            <div>
                                                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-3 space-y-1">
                                            <!-- Account Management -->
                                            <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                                {{ __('Profile') }}
                                            </x-responsive-nav-link>

                                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                                <x-responsive-nav-link href="{{ route('api-tokens.index') }}"
                                                    :active="request()->routeIs('api-tokens.index')">
                                                    {{ __('API Tokens') }}
                                                </x-responsive-nav-link>
                                            @endif

                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}" x-data>
                                                @csrf

                                                <x-responsive-nav-link href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                    {{ __('Log Out') }}
                                                </x-responsive-nav-link>
                                            </form>

                                            <!-- Team Management -->
                                            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                                <div class="border-t border-gray-200"></div>

                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    {{ __('Manage Team') }}
                                                </div>

                                                <!-- Team Settings -->
                                                <x-responsive-nav-link
                                                    href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                                                    :active="request()->routeIs('teams.show')">
                                                    {{ __('Team Settings') }}
                                                </x-responsive-nav-link>

                                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                                    <x-responsive-nav-link href="{{ route('teams.create') }}"
                                                        :active="request()->routeIs('teams.create')">
                                                        {{ __('Create New Team') }}
                                                    </x-responsive-nav-link>
                                                @endcan

                                                <!-- Team Switcher -->
                                                @if (Auth::user()->allTeams()->count() > 1)
                                                    <div class="border-t border-gray-200"></div>

                                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                                        {{ __('Switch Teams') }}
                                                    </div>

                                                    @foreach (Auth::user()->allTeams() as $team)
                                                        <x-switchable-team :team="$team"
                                                            component="responsive-nav-link" />
                                                    @endforeach
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py=4">
            @yield('content')
        </main>
    </div>
    <script src="https://fastly.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://fastly.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/597cb1f685.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    @yield('script')
</body>

</html>
