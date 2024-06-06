
<div class="side-menu px-1 px-md-2 px-lg-3">
    <!-- <div class="user-details mb-4 d-flex open-menu pointer-cursor flex-row-no-rtl">
        <div class="ml-0 ml-md-2">
            @if(Auth::check())
                <img src="{{Auth::user()->avatar}}" class="rounded-circle user-avatar">
            @else
                <div class="avatar-placeholder">
                    @include('elements.icon',['icon'=>'person-circle','variant'=>'xlarge text-muted'])
                </div>
            @endif
        </div>
        @if(Auth::check())
            <div class="d-none d-lg-block overflow-hidden">
                <div class="pl-2 d-flex justify-content-center flex-column overflow-hidden">
                    <div class="ml-2 d-flex flex-column overflow-hidden">
                        <span class="text-bold text-truncate {{(Cookie::get('app_theme') == null ? (getSetting('site.default_user_theme') == 'dark' ? '' : 'text-dark-r') : (Cookie::get('app_theme') == 'dark' ? '' : 'text-dark-r'))}}">{{Auth::user()->name}}</span>
                        <span class="text-muted"><span>@</span>{{Auth::user()->username}}</span>
                    </div>
                </div>
            </div>
        @endif
    </div> -->

<div class="luser">

   <div class="lucont">
	  <div class="lu-avatar">
		 <img alt="" src="{{Auth::user()->avatar}}">
	  </div>
	  <div class="lu-name">
      <div class="snm">{{Auth::user()->name}}</div> <span class="free">Free Member</span>
	  </div>
	  <i class="fa fa-info-circle"></i>
   </div>
   <div class="lucont">
	  <div class="lu-box">My Score: <strong>0</strong></div>
	  <a href="/gamification"><i class="fa fa-info-circle"></i></a>
   </div>
   <div class="lucont">
	  <div class="lu-box">My Level: Not active yet</div>
	  <a href="/gamification"><i class="fa fa-info-circle"></i></a>
   </div>
   <p>Progress to next Level</p>
   <div class="lucont">
	  <div class="lvl-bar"><span style="width: 30%;">30%</span></div>
	  <a href="/gamification"><i class="fa fa-info-circle"></i></a>
   </div>
   <div class="comp-share">
	  <a href="/company-share">
		 <span>Company <br>Shares:</span>
		 <h5>1'000</h5>
		 <img src="/img/new-coin-eq-bitcci.png" alt="">
	  </a>
   </div>
   <div class="comp-share">
	  <a href="/cash-token">
		 <span>CC Cash <br>Token:</span>
		 <h5>5'000</h5>
		 <img src="/img/cc-cash-coin-blu.png" alt="">
	  </a>
   </div>
   <div class="comp-share mob">
	  <a href="/fancci-credits">
		 <span>fancci <br>credits:</span>
		 <h5>0</h5>
		 <img src="/img/fancci-credit-sml2.png" alt="coins">
	  </a>
   </div>
   <div class="mob-lft">
	  <a class="pnk-btn" href="/buy-credits">Buy fancci credits</a>
   </div>

   <div class="crtprmlnk">
    <a href="#" class="btn btn-round btn-primary btn-block">Show Promotion Link</a>
    <!-- @if(!getSetting('site.hide_create_post_menu'))
        @if(GenericHelper::isEmailEnforcedAndValidated())
   <a role="button" class="btn btn-round btn-primary btn-block" href="{{route('posts.create')}}"><span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate new-post-label">{{__('Create New Post')}}</span></a>
        @endif
    @endif -->
   </div>

</div>

    <ul class="nav flex-column user-side-menu">
        <li class="nav-item ">
            <a href="{{Auth::check() ? route('feed') : route('home')}}" class="h-pill h-pill-primary nav-link {{Route::currentRouteName() == 'feed' ? 'active' : ''}} d-flex justify-content-between">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="icon-wrapper d-flex justify-content-center align-items-center">
                       <!-- @include('elements.icon',['icon'=>'home-outline','variant'=>'large']) -->
                       <img src="/img/icon-dash.png" alt="{{__('Home')}}">
                    </div>
                    <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('Home')}}</span>
                </div>
            </a>
        </li>
        @if(GenericHelper::isEmailEnforcedAndValidated())
            <li class="nav-item">
                <a href="{{route('my.notifications')}}" class="nav-link h-pill h-pill-primary {{Route::currentRouteName() == 'my.notifications' ? 'active' : ''}} d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center position-relative">
                            <!-- @include('elements.icon',['icon'=>'notifications-outline','variant'=>'large']) -->
                            <img src="/img/icon-noti.png" alt="{{__('Notifications')}}">
                            <div class="menu-notification-badge notifications-menu-count {{(isset($notificationsCountOverride) && $notificationsCountOverride->total > 0 ) || (NotificationsHelper::getUnreadNotifications()->total > 0) ? '' : 'd-none'}}">
                                {{!isset($notificationsCountOverride) ? NotificationsHelper::getUnreadNotifications()->total : $notificationsCountOverride->total}}
                            </div>
                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('Notifications')}}</span>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('my.messenger.get')}}" class="nav-link {{Route::currentRouteName() == 'my.messenger.get' ? 'active' : ''}} h-pill h-pill-primary d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center position-relative">
                            <!-- @include('elements.icon',['icon'=>'chatbubble-outline','variant'=>'large']) -->
                            <img src="/img/icon-msgr.png" alt="{{__('Messages')}}">
                            <div class="menu-notification-badge chat-menu-count {{(NotificationsHelper::getUnreadMessages() > 0) ? '' : 'd-none'}}">
                                {{NotificationsHelper::getUnreadMessages()}}
                            </div>
                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('Messages')}}</span>
                    </div>
                </a>
            </li>
            <li class="nav-item ">
                <a href="#" class="h-pill h-pill-primary {{Route::currentRouteName() == 'nolink' ? 'active' : ''}} nav-link d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center">
                        <img src="/img/icon-wallet.png" alt="{{__('My Wallet')}}">
                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('My Wallet')}}</span>
                    </div>
                </a>
            </li>
            <li class="nav-item ">
                <a href="#" class="h-pill h-pill-primary {{Route::currentRouteName() == 'nolink' ? 'active' : ''}} nav-link d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center">
                        <img src="/img/icon-network.png" alt="{{__('My Network')}}">
                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('My Network')}}</span>
                    </div>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{route('buildmynetwork')}}" class="h-pill h-pill-primary {{Route::currentRouteName() == 'buildmynetwork' ? 'active' : ''}} nav-link d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center">
                        <img src="/img/icon-promo.png" alt="{{__('Build my Network')}}">
                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('Build my Network')}}</span>
                    </div>
                </a>
            </li>
            @if(getSetting('streams.allow_streams'))
                <li class="nav-item">
                    <a href="{{route('search.get')}}?filter=live" class="nav-link {{Route::currentRouteName() == 'search.get' && request()->get('filter') == 'live' ? 'active' : ''}} h-pill h-pill-primary d-flex justify-content-between">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="icon-wrapper d-flex justify-content-center align-items-center position-relative">
                                @include('elements.icon',['icon'=>'play-circle-outline','variant'=>'large'])
                                <div class="menu-notification-badge streams-menu-count {{(StreamsHelper::getPublicLiveStreamsCount() > 0) ? '' : 'd-none'}}">
                                    {{StreamsHelper::getPublicLiveStreamsCount()}}
                                </div>
                            </div>
                            <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('Streams')}}</span>
                        </div>

                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a href="{{route('my.bookmarks')}}" class="nav-link {{Route::currentRouteName() == 'my.bookmarks' ? 'active' : ''}} h-pill h-pill-primary d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center">
                            <!-- @include('elements.icon',['icon'=>'bookmark-outline','variant'=>'large']) -->
                            <img src="/img/icon-bookmark.png" alt="{{__('Bookmarks')}}">
                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('Bookmarks')}}</span>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('my.lists.all')}}" class="nav-link {{Route::currentRouteName() == 'my.lists.all' ? 'active' : ''}} h-pill h-pill-primary d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center">
                            <!-- @include('elements.icon',['icon'=>'list-outline','variant'=>'large']) -->
                            <img src="/img/icon-list.png" alt="{{__('Lists')}}">
                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('Lists')}}</span>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('my.settings',['type'=>'subscriptions'])}}" class="nav-link {{Route::currentRouteName() == 'my.settings' &&  is_int(strpos(Request::path(),'subscriptions')) ? 'active' : ''}} h-pill h-pill-primary d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center">
                            <!-- @include('elements.icon',['icon'=>'people-circle-outline','variant'=>'large']) -->
                            <img src="/img/icon-followers.png" alt="{{__('Subscriptions')}}">
                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('Subscriptions')}}</span>
                    </div>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{route('my.settings')}}" class="h-pill h-pill-primary {{Route::currentRouteName() == 'my.settings' ? 'active' : ''}} nav-link d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center">
                        <img src="/img/icon-designer.png" alt="{{__('Profile Designer')}}">
                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('Profile Designer')}}</span>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('profile',['username'=>Auth::user()->username])}}" class="nav-link {{Route::currentRouteName() == 'profile' && (request()->route("username") == Auth::user()->username) ? 'active' : ''}} h-pill h-pill-primary d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center">
                            <!-- @include('elements.icon',['icon'=>'person-circle-outline','variant'=>'large']) -->
                            <img src="/img/icon-profile.png" alt="{{__('My profile')}}">
                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('My profile')}}</span>
                    </div>
                </a>
            </li>
        @endif

            <li class="nav-item ">
                <a href="#" class="h-pill h-pill-primary {{Route::currentRouteName() == 'nolink' ? 'active' : ''}} nav-link d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center">
                        <img src="/img/icon-galleries.png" alt="{{__('My Gallery')}}">
                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('My Gallery')}}</span>
                    </div>
                </a>
            </li>
            <li class="nav-item ">
                <a href="#" class="h-pill h-pill-primary {{Route::currentRouteName() == 'nolink' ? 'active' : ''}} nav-link d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center">
                        <img src="/img/icon-model.png" alt="{{__('Model Directory')}}">
                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('Model Directory')}}</span>
                    </div>
                </a>
            </li>
            <li class="nav-item ">
                <a href="#" class="h-pill h-pill-primary {{Route::currentRouteName() == 'nolink' ? 'active' : ''}} nav-link d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center">
                        <img src="/img/icon-new-settings.png" alt="{{__('My Settings')}}">
                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('My Settings')}}</span>
                    </div>
                </a>
            </li>

        @if(!Auth::check())
            <li class="nav-item">
                <a href="{{route('search.get')}}" class="nav-link {{Route::currentRouteName() == 'search.get' ? 'active' : ''}} h-pill h-pill-primary d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center">
                            @include('elements.icon',['icon'=>'compass-outline','variant'=>'large'])
                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('Explore')}}</span>
                    </div>
                </a>
            </li>
        @endif

        <li class="nav-item ">
             <a href="#" class="h-pill h-pill-primary {{Route::currentRouteName() == 'nolink' ? 'active' : ''}} nav-link d-flex justify-content-between">
                   <div class="d-flex justify-content-center align-items-center">
                       <div class="icon-wrapper d-flex justify-content-center align-items-center">
                       <img src="/img/icon-faq.png" alt="{{__('Support | FAQ')}}">
                       </div>
                       <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('Support | FAQ')}}</span>
                   </div>
             </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('logout') }}" class="h-pill h-pill-primary d-flex justify-content-between"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="icon-wrapper d-flex justify-content-center align-items-center">
                        <img src="/img/icon-logout.png" alt="{{__('Logout')}}">
                    </div>
                    <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('Logout')}}</span>
                </div>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </li>

       

        <!-- <li class="nav-item">
            <a href="#" role="button" class="open-menu nav-link h-pill h-pill-primary text-muted d-flex justify-content-between">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="icon-wrapper d-flex justify-content-center align-items-center">
                        <img src="/img/icon-more.png" alt="{{__('More')}}">
                    </div>
                    <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('More')}}</span>
                </div>
            </a>
        </li> -->

        

        @if(GenericHelper::isEmailEnforcedAndValidated())
            @if(getSetting('streams.allow_streams'))
                <li class="nav-item-live mt-2 mb-0">
                    <a role="button" class="btn btn-round btn-outline-danger btn-block px-3" href="{{route('my.streams.get')}}{{StreamsHelper::getUserInProgressStream() ? '' : ( !GenericHelper::isUserVerified() && getSetting('site.enforce_user_identity_checks') ? '' : '?action=create')}}">
                        <div class="d-none d-md-flex d-xl-flex d-lg-flex justify-content-center align-items-center ml-1 text-truncate new-post-label">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div class="stream-on-label w-100 {{StreamsHelper::getUserInProgressStream() ? '' : 'd-none'}}">
                                    <div class="d-flex align-items-center w-100">
                                        <div class="mr-4"><div class="blob red"></div></div>
                                        <div class="ml-1">{{__('On air')}} </div>
                                    </div>
                                </div>
                                <div class="stream-off-label w-100 {{StreamsHelper::getUserInProgressStream() ? 'd-none' : ''}}">
                                    <div class="d-flex  align-items-center w-100">
                                        <div class="mr-3"> @include('elements.icon',['icon'=>'ellipse','variant'=>'','classes'=>'flex-shrink-0 text-danger'])</div>
                                        <div class="ml-1">{{__('Go live')}} </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="d-block d-md-none d-flex align-items-center justify-content-center">@include('elements.icon',['icon'=>'add-circle-outline','variant'=>'medium','classes'=>'flex-shrink-0'])</div>
                    </a>
                </li>
            @endif
        @endif

        <!-- @if(!getSetting('site.hide_create_post_menu'))
            @if(GenericHelper::isEmailEnforcedAndValidated())
                <li class="nav-item">
                    <a role="button" class="btn btn-round btn-primary btn-block " href="{{route('posts.create')}}">
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate new-post-label">{{__('New post')}}</span>
                        <span class="d-block d-md-none d-flex align-items-center justify-content-center">@include('elements.icon',['icon'=>'add-circle-outline','variant'=>'medium','classes'=>'flex-shrink-0'])</span>
                    </a>
                </li>
            @endif
        @endif -->


    </ul>

    <div class="lft-ftr"><span><a href="https://www.bitcci.blog" target="_blank"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="5898.42px" height="5898.42px" viewBox="0 0 5898.42 5898.42" xml:space="preserve" style="enable-background: new 0 0 5898.42 5898.42;"><defs></defs><path id="Ellipse_1_copy_7_1_" d="M2949.21,5898.42C1320.4,5898.42,0,4578.01,0,2949.21S1320.4,0,2949.21,0
s2949.21,1320.4,2949.21,2949.21S4578.01,5898.42,2949.21,5898.42z M2950.34,2108.43c-335.56,0-637.7,129.6-906.43,388.79V1296.63
c0-47.9-19.3-85.87-57.56-114.07c-71.22-67.93-184.03-65.26-251.96,5.97c-0.33,0.35-0.66,0.69-0.99,1.04
c-32.34,27.39-48.65,63.03-48.65,107.06v2012.39c0,327.65,89.59,611.29,268.76,850.93c293.18,319.51,609.98,479.26,950.41,479.25
h73.29c180.8,0,368.11-48.9,561.94-146.71c449.55-272.22,674.33-645.52,674.32-1119.89c0.02-43.56-2.23-87.1-6.73-130.43
l-380.86,372.05c-5.26,23.33-11.25,47.93-17.98,73.81c-187.32,394.51-464.22,591.75-830.69,591.73h-56.19
c-84.71,0-180-15.49-285.86-46.46c-394.2-184.19-591.28-464.57-591.25-841.14v-46.46c0-88.03,18.73-186.65,56.19-295.87
c171.48-355.21,418.1-547.8,739.85-577.78l328.88-344.15C3096.74,2114.85,3023.61,2108.34,2950.34,2108.43L2950.34,2108.43z
 M2930.12,2892.83c-11.72,11.72-18.3,27.62-18.3,44.19v473.39c0,34.52,27.98,62.5,62.5,62.5h473.36c16.58,0,32.47-6.59,44.19-18.31
l1037.71-1037.72l-179.2-179.2l2-1.8l-153.01-149.19l-231.54-231.56L2930.12,2892.83z M4056.21,1766.72l561.73,561.74l148.29-148.29
l-561.73-561.74L4056.21,1766.72z M4928.78,1455.91c-75-75.01-174.74-116.32-280.86-116.34h-0.03
c-106.09,0-205.83,41.33-280.84,116.36l-74.16,74.14l561.77,561.73l74.14-74.13c75.03-75.04,116.34-174.78,116.34-280.88
C5045.43,1631.38,5003.53,1530.24,4928.78,1455.91L4928.78,1455.91z M3189.54,3347.91l-152.72-152.74v-195.64l348.36,348.38H3189.54
L3189.54,3347.91z" class="st0"></path></svg></a><a href="https://twitter.com/bitcci" target="_blank"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="267.87px" height="267.88px" viewBox="0 0 267.87 267.88" xml:space="preserve" style="overflow: visible; enable-background: new 0 0 267.87 267.88;"><defs></defs><g id="Ellipse_1_3_"><g><path d="M133.94,0C59.97,0,0,59.97,0,133.94s59.97,133.94,133.94,133.94s133.94-59.97,133.94-133.94
	  S207.91,0,133.94,0z M192.83,103.53c0.09,1.31,0.09,2.61,0.09,3.92c0,39.86-30.34,85.78-85.78,85.78
	  c-17.08,0-32.95-4.95-46.3-13.53c2.43,0.28,4.76,0.37,7.28,0.37c14.09,0,27.07-4.76,37.43-12.88
	  c-13.25-0.28-24.36-8.96-28.19-20.91c1.87,0.28,3.73,0.47,5.69,0.47c2.71,0,5.41-0.37,7.93-1.03
	  c-13.81-2.8-24.17-14.93-24.17-29.59v-0.37c4.01,2.24,8.68,3.64,13.63,3.83c-8.12-5.41-13.44-14.65-13.44-25.11
	  c0-5.6,1.49-10.73,4.11-15.21c14.84,18.29,37.15,30.24,62.16,31.55c-0.47-2.24-0.75-4.57-0.75-6.91
	  c0-16.61,13.44-30.15,30.15-30.15c8.68,0,16.52,3.64,22.03,9.52c6.81-1.31,13.35-3.83,19.13-7.28c-2.24,7-7,12.88-13.25,16.61
	  c6.07-0.65,11.95-2.33,17.36-4.67C203.85,93.91,198.71,99.23,192.83,103.53z" class="st0"></path></g></g></svg></a><a href="https://www.instagram.com/bitcci" target="_blank"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="267.88px" height="267.88px" viewBox="0 0 267.88 267.88" xml:space="preserve" style="overflow: visible; enable-background: new 0 0 267.88 267.88;"><defs></defs><g id="Ellipse_1_copy_2_3_"><g><path d="M134.4,109.59c-13.16,0-23.89,10.73-23.89,23.89c0,13.16,10.73,23.89,23.89,23.89
	  c13.16,0,23.89-10.73,23.89-23.89C158.3,120.33,147.56,109.59,134.4,109.59z M133.94,0C59.97,0,0,59.97,0,133.94
	  s59.97,133.94,133.94,133.94c73.97,0,133.94-59.97,133.94-133.94S207.91,0,133.94,0z M205.62,163.08
	  c-0.56,11.48-3.17,21.65-11.57,30.06c-8.4,8.4-18.57,11.01-30.05,11.57c-9.89,0.56-19.69,0.47-29.59,0.47s-19.69,0.09-29.59-0.47
	  c-11.48-0.56-21.65-3.17-30.06-11.57c-8.4-8.4-11.01-18.57-11.57-30.06c-0.56-9.89-0.47-19.69-0.47-29.59
	  c0-9.89-0.09-19.69,0.47-29.59c0.56-11.48,3.17-21.65,11.57-30.06c8.4-8.4,18.57-11.01,30.06-11.57
	  c9.89-0.56,19.69-0.47,29.59-0.47s19.69-0.09,29.59,0.47c11.48,0.56,21.65,3.17,30.05,11.57c8.4,8.4,11.01,18.57,11.57,30.06
	  c0.56,9.89,0.47,19.69,0.47,29.59C206.09,143.38,206.18,153.18,205.62,163.08z M190.31,91.21c-1.31-3.27-2.89-5.69-5.41-8.21
	  c-2.52-2.52-4.95-4.11-8.21-5.41c-9.43-3.73-31.83-2.89-42.28-2.89c-10.45,0-32.86-0.84-42.28,2.89
	  c-3.27,1.31-5.69,2.89-8.21,5.41c-2.52,2.52-4.11,4.95-5.41,8.21c-3.73,9.43-2.89,31.83-2.89,42.28c0,10.45-0.84,32.86,2.89,42.28
	  c1.31,3.27,2.89,5.69,5.41,8.21c2.52,2.52,4.95,4.11,8.21,5.41c9.43,3.73,31.83,2.89,42.28,2.89c10.45,0,32.86,0.84,42.28-2.89
	  c3.27-1.31,5.69-2.89,8.21-5.41c2.52-2.52,4.11-4.95,5.41-8.21c3.73-9.43,2.89-31.83,2.89-42.28
	  C193.21,123.04,194.05,100.63,190.31,91.21z M134.4,170.27c-20.35,0-36.78-16.43-36.78-36.78c0-20.35,16.43-36.78,36.78-36.78
	  c20.35,0,36.78,16.43,36.78,36.78C171.18,153.84,154.75,170.27,134.4,170.27z M172.67,103.81c-4.76,0-8.59-3.83-8.59-8.59
	  s3.83-8.59,8.59-8.59s8.59,3.83,8.59,8.59S177.43,103.81,172.67,103.81z" class="st0"></path></g></g></svg></a><a href="https://youtube.com/channel/UCUQaBV1jdt8UkmxnB8veYCg" target="_blank"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="267.88px" height="267.88px" viewBox="0 0 267.88 267.88" xml:space="preserve" style="overflow: visible; enable-background: new 0 0 267.88 267.88;"><defs></defs><g id="Ellipse_1_copy_4_3_"><g><path d="M133.94,0C59.97,0,0,59.97,0,133.94s59.97,133.94,133.94,133.94s133.94-59.97,133.94-133.94
	  S207.91,0,133.94,0z M204.47,162.38c-1.28,9.82-5.67,14.21-5.67,14.21c-5.43,5.67-11.57,5.67-14.36,5.99
	  c0,0-19.95,1.52-50.04,1.52c-37.19-0.32-48.6-1.44-48.6-1.44c-3.19-0.56-10.38-0.4-15.8-6.07c0,0-4.39-4.39-5.67-14.21
	  c-1.52-11.57-1.44-23.14-1.44-23.14v-10.85c0,0-0.08-11.57,1.44-23.14C65.61,95.34,70,91.03,70,91.03
	  c5.43-5.75,11.57-5.75,14.37-6.07c0,0,19.95-1.44,50.04-1.44s50.04,1.44,50.04,1.44c2.79,0.32,8.94,0.32,14.36,6.07
	  c0,0,4.39,4.31,5.67,14.21c1.52,11.57,1.44,23.14,1.44,23.14v10.85C205.91,139.24,205.99,150.81,204.47,162.38z M119.64,152.32
	  l38.63-19.95l-38.63-20.19V152.32z" class="st0"></path></g></g></svg></a><a href="https://soundcloud.com/bitcci/bitcci-queen" target="_blank"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="267.88px" height="267.88px" viewBox="0 0 267.88 267.88" xml:space="preserve" style="overflow: visible; enable-background: new 0 0 267.88 267.88;"><defs></defs><g id="Ellipse_1_copy_3_3_"><g><path d="M133.94,0C59.97,0,0,59.97,0,133.94s59.97,133.94,133.94,133.94c73.97,0,133.94-59.97,133.94-133.94
	  S207.91,0,133.94,0z M45.26,162.62c-0.08,0.4-0.32,0.72-0.72,0.72c-0.4,0-0.64-0.32-0.72-0.72l-1.36-10.06l1.36-10.22
	  c0.08-0.4,0.32-0.72,0.72-0.72c0.4,0,0.64,0.32,0.72,0.72l1.6,10.22L45.26,162.62z M52.12,168.76c-0.08,0.4-0.4,0.72-0.8,0.72
	  c-0.4,0-0.72-0.32-0.72-0.8l-1.84-16.12c1.84-16.52,1.84-16.52,1.84-16.52c0-0.4,0.32-0.72,0.72-0.72c0.4,0,0.72,0.32,0.8,0.72
	  l2.08,16.52L52.12,168.76z M59.46,171.48c0,0.48-0.4,0.88-0.88,0.88s-0.88-0.4-0.96-0.88l-1.68-18.91l1.68-19.55
	  c0.08-0.56,0.48-0.96,0.96-0.96s0.88,0.4,0.88,0.96l2,19.55L59.46,171.48z M66.96,172.04c-0.08,0.64-0.56,1.04-1.12,1.04
	  c-0.56,0-1.04-0.4-1.04-1.04l-1.68-19.47l1.68-20.11c0-0.64,0.48-1.04,1.04-1.04c0.56,0,1.04,0.4,1.12,1.04l1.84,20.11
	  L66.96,172.04z M74.47,172.2c-0.08,0.72-0.64,1.28-1.28,1.28c-0.64,0-1.2-0.56-1.2-1.28l-1.6-19.63l1.6-18.67
	  c0-0.64,0.56-1.2,1.2-1.2c0.64,0,1.2,0.56,1.28,1.2l1.68,18.67L74.47,172.2z M81.97,172.2c0,0.8-0.64,1.44-1.36,1.44
	  c-0.8,0-1.36-0.64-1.44-1.44l-1.44-19.63c1.44-30.33,1.44-30.33,1.44-30.33c0.08-0.8,0.64-1.44,1.44-1.44
	  c0.72,0,1.36,0.64,1.36,1.44l1.68,30.33L81.97,172.2z M89.47,172.2c0,0.88-0.72,1.52-1.52,1.52c-0.88,0-1.52-0.64-1.6-1.52
	  l-1.28-19.47c1.28-37.35,1.28-37.35,1.28-37.35c0.08-0.88,0.72-1.52,1.6-1.52c0.8,0,1.52,0.64,1.52,1.52l1.52,37.35L89.47,172.2z
	   M97.29,171.88c-0.08,0.96-0.8,1.68-1.76,1.68c-0.88,0-1.6-0.72-1.68-1.68l-1.28-19.31l1.28-40.38c0-0.96,0.8-1.76,1.68-1.76
	  c0.96,0,1.68,0.8,1.76,1.76l1.44,40.38L97.29,171.88z M105.03,171.8c-0.08,1.04-0.88,1.84-1.92,1.84c-0.96,0-1.76-0.8-1.84-1.84
	  l-1.12-19.23l1.12-41.74c0-1.04,0.88-1.92,1.84-1.92c1.04,0,1.84,0.88,1.92,1.92l1.28,41.74L105.03,171.8z M112.77,171.64
	  c0,1.12-0.88,2-2,2c-1.12,0-1.92-0.88-2-2l-1.12-19.07l1.12-40.7c0-1.12,0.88-2,2-2c1.12,0,2,0.88,2,2l1.2,40.7L112.77,171.64z
	   M120.67,171.48c0,1.2-0.96,2.15-2.15,2.15c-1.2,0-2.15-0.96-2.23-2.15l-0.96-18.83l0.96-39.26c0.08-1.28,1.04-2.23,2.23-2.23
	  c1.2,0,2.07,0.96,2.15,2.23l1.12,39.26L120.67,171.48z M128.65,169.48l-0.08,1.92c0,0.64-0.24,1.2-0.72,1.6
	  c-0.4,0.4-0.96,0.72-1.6,0.72c-0.72,0-1.36-0.32-1.84-0.88c-0.32-0.4-0.48-0.88-0.48-1.36c0-0.08,0-0.08,0-0.08
	  c-0.88-18.75-0.88-18.83-0.88-18.83l0.8-46.21l0.08-0.48c0-0.8,0.4-1.52,1.04-1.92c0.4-0.24,0.8-0.4,1.28-0.4
	  c0.48,0,0.88,0.16,1.28,0.4c0.64,0.4,1.04,1.12,1.04,1.92l0.96,46.77L128.65,169.48z M136.48,171.08c0,1.36-1.12,2.47-2.47,2.47
	  c-1.36,0-2.47-1.12-2.55-2.47l-0.48-9.1l-0.48-9.34l0.96-50.76v-0.24c0.08-0.72,0.4-1.44,0.96-1.92c0.4-0.32,0.96-0.56,1.6-0.56
	  c0.4,0,0.88,0.16,1.2,0.4c0.72,0.4,1.2,1.2,1.28,2.07l1.12,51L136.48,171.08z M203.75,173.63c-62.65,0-62.73,0-62.73,0
	  c-1.36-0.16-2.47-1.2-2.47-2.63V99.25c0-1.36,0.48-2,2.23-2.63c4.39-1.76,9.34-2.71,14.45-2.71c20.83,0,37.91,15.96,39.74,36.31
	  c2.71-1.12,5.67-1.76,8.78-1.76c12.45,0,22.59,10.14,22.59,22.67C226.34,163.58,216.2,173.63,203.75,173.63z" class="st0"></path></g></g></svg></a><a href="https://www.facebook.com/bitcci" target="_blank"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="267.88px" height="267.88px" viewBox="0 0 267.88 267.88" xml:space="preserve" style="overflow: visible; enable-background: new 0 0 267.88 267.88;"><defs></defs><g id="Ellipse_1_copy_3_"><g><path d="M133.94,0C59.97,0,0,59.97,0,133.94s59.97,133.94,133.94,133.94s133.94-59.97,133.94-133.94 S207.91,0,133.94,0z M174.13,81.62h-14.65c-11.48,0-13.63,5.51-13.63,13.44v17.64h27.35l-3.64,27.63h-23.71v70.84h-28.56v-70.84 h-23.8V112.7h23.8V92.35c0-23.61,14.47-36.5,35.56-36.5c10.08,0,18.76,0.75,21.28,1.12V81.62z" class="st0"></path></g></g></svg></a></span><p> © 2022 - bitcci AG, Switzerland <br><a href="https://bitcci.ag" target="_blank">Company Info</a> | <a target="_blank" href="/imprint">Imprint</a> | <a target="_blank" href="/privacy">Privacy Policy</a></p></div>

</div>
