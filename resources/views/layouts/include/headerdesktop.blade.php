<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap justify-content-end">
                <div class="header-button">
                    <div class="account-wrap">
                        @if (Auth::user())
                            <div class="account-item clearfix js-item-menu">
                                    <div class="image">
                                        <img src="{{asset('vendor/users.png')}}" alt="Profile Image" class="profile-img">
                                    </div>
                                    <div class="content">
                                        <a class="js-acc-btn" href="#">{{ Auth::user()->nom }}</a>
                                    </div>
                                    <div class="account-dropdown js-dropdown">
                                        <div class="info clearfix">
                                            <div class="image">
                                                <a href="#">
                                                    <img src="{{asset('vendor/users.png')}}" alt="Profile Image" class="profile-img">
                                                </a>
                                            </div>
                                            <div class="content">
                                                <h5 class="name">
                                                    {{ Auth::user()->nom }}
                                                </h5>
                                                <span class="email">{{ Auth::user()->email }}</span>
                                            </div>
                                        </div>
                                        <div class="account-dropdown__body">
                                            <div class="account-dropdown__item">
                                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                    <i class="zmdi zmdi-settings"></i>Déconnexion
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
  