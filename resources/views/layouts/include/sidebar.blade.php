<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{asset('vendor/logo.PNG')}}" alt="Multi-restaurant" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list sidestyle">
                @auth
                    <li class="{{request()->is('admin*') || request()->is('restoAdmin*') || request()->is('manager*') || request()->is('cuisinier*') ? 'active' : ''}}">
                        <a href="{{ auth()->user()->getHomeRoute() }}">
                            <i class="fas fa-home"></i> Accueil
                        </a>
                    </li>
                    @if(auth()->user()->type === 'admin')
                        <li class="{{request()->routeIs('resto.index') || request()->routeIs('resto.create') || request()->routeIs('resto.show') ? 'active' : ''}}">
                            <a href="{{route('resto.index')}}">
                                <i class="fas fa-utensils"></i> Restaurant
                            </a>
                        </li>
                    @endif

                    @if(auth()->user()->type === 'restoAdmin')
                        <li class="">
                            <a href="{{route('ptvente.index')}}">
                                <i class="fas fa-shopping-basket"></i> Point de vente
                            </a>
                        </li>
                        <li class="">
                            <a href="">
                                <i class="fas fa-book"></i> Menus
                            </a>
                        </li>
                        <li class="">
                            <a href="">
                                <i class="fas fa-utensils"></i> Sous-menus
                            </a>
                        </li>
                    @endif
                 @endauth
                <li class="{{request()->routeIs('users.index') || request()->routeIs('users.create') || request()->routeIs('users.show') ? 'active' : ''}}">
                    <a href="{{route('users.index')}}">
                        <i class="fas fa-user"></i>Utilisateur
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>