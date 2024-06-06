<div class="home-hdr">
   <div class="logo"><a href="/"><img src="img/fancci-logo-wht.png" alt=""></a></div>
   <div class="openbeta">Closed beta <br> V 1.05</div>
   <div class="slogan">
      <h2>The new 5 Star Hub for Premium Lifestyle, First <br> Class Events and Entertainment.</h2>
   </div>
   <div class="hdr-btn"><a>Queens</a><a>Events</a></div>
   <div class="navcat">
   <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-right align-items-center" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           {{ Auth::user()->name }} <img src="{{Auth::user()->avatar}}" class="rounded-circle home-user-avatar">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('feed')}}">
                                {{__('Feed')}}
                            </a>
                            <a class="dropdown-item" href="{{route('my.settings')}}">
                                {{__('Settings')}}
                            </a>
                            <a class="dropdown-item" href="{{route('profile',['username'=>Auth::user()->username])}}">
                                {{__('Profile')}}
                            </a>
                            <a class="dropdown-item" href="{{route('my.settings',['type'=>'subscriptions'])}}">
                                {{__('Subscriptions')}}
                            </a>
                            <a class="dropdown-item" href="{{route('my.settings',['type'=>'payments'])}}">
                                {{__('Payments')}}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
            </div>
</div>