<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{asset('vendor/logo.PNG')}}" alt="Multi-restaurant" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list sidestyle">
                <li class="{{Route::is('admin') || Route::is('restoAdmin') || Route::is('manager') || Route::is('cuisinier') ? 'active' : ''}}">
                    @php
                        $userType = auth()->user()->type;
                    @endphp
                    <a href="
                        @if($userType == 'admin') 
                            {{ route('admin') }}
                        @elseif($userType == 'restoAdmin') 
                            {{ route('restoAdmin') }}
                        @elseif($userType == 'manager') 
                            {{ route('manager') }}
                        @elseif($userType == 'cuisinier') 
                            {{ route('cuisinier') }}
                        @endif">
                        <i class="fas fa-home"></i> Accueil
                    </a>
                </li>
                <li class="{{Route::is('resto.index') || Route::is('resto.create') || Route::is('resto.show') ? 'active' : ''}}">
                    <a href="{{route('resto.index')}}">
                        <i class="fas fa-home"></i>Restaurant
                    </a>
                </li>
                <li class="">
                    <a href="">
                        <i class="fas fa-user"></i>Utilisateur
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>