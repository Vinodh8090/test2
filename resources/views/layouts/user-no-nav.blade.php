<!doctype html>
<html class="h-100" dir="{{GenericHelper::getSiteDirection()}}" lang="{{session('locale')}}">
<head>
    @include('template.head',['additionalCss' => [
                '/libs/animate.css/animate.css',
                '/libs/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css',
                '/css/side-menu.css',
             ]])
</head>
<body class="d-flex flex-column">
<div class="hs-nav"><span></span></div>
<div class="hdr">
	  <div class="logo"><a href="/"><img src="/img/fancci-logo-wht.png" alt="FANCCI"></a></div>
	  <div class="hdr-ryt">
		 <a class="pnk-btn" href="{{route('buycredits')}}">Buy fancci credits</a>
         <a class="dark-mode-switcher drkmode" href="#">
                    @if(Cookie::get('app_theme') == 'dark' || (!Cookie::get('app_theme') && getSetting('site.default_user_theme') == 'dark'))
                    @include('elements.icon',['icon'=>'contrast-outline','variant'=>'medium','centered'=>false,'classes'=>'mr-2'])
                        {{__('Light mode')}}
                    @else
                        @include('elements.icon',['icon'=>'contrast','variant'=>'medium','centered'=>false,'classes'=>'mr-2'])
                        {{__('Dark mode')}}
                    @endif
                </a>
		 <div class="ryt-nav">
			<div class="mob-bar"><span></span><span></span><span></span><span></span></div>
			<div class="top-noti"><a href="{{route('my.notifications')}}"><i class="fa fa-bell"></i> 
            <div class="menu-notification-badge notifications-menu-count {{(isset($notificationsCountOverride) && $notificationsCountOverride->total > 0 ) || (NotificationsHelper::getUnreadNotifications()->total > 0) ? '' : 'd-none'}}">
             {{!isset($notificationsCountOverride) ? NotificationsHelper::getUnreadNotifications()->total : $notificationsCountOverride->total}}
            </div>
            </a>
        </div>
			<div class="lang-cont">
			   <a id="lang" style="cursor: pointer;"><img alt="" src="/img/flags/en.png"></a>
			   <div class="lang-drp"><a><img src="/img/flags/en.png" alt=""> English</a><a><img src="/img/flags/de.png" alt=""> German</a><a href="#" class="nolnk"><img src="/img/flags/in.png" alt=""> Hindustani</a><a><img src="/img/flags/es.png" alt=""> Spanish</a><a href="#" class="nolnk"><img src="/img/flags/ae.png" alt=""> Arabic</a><a href="#" class="nolnk"><img src="/img/flags/my.png" alt=""> Malay</a><a href="#" class="nolnk"><img src="/img/flags/ru.png" alt=""> Russian</a><a href="#" class="nolnk"><img src="/img/flags/bd.png" alt=""> Bengali</a><a href="#" class="nolnk"><img src="/img/flags/pt.png" alt=""> Portuguese</a><a href="#" class="nolnk"><img src="/img/flags/fr.png" alt=""> French</a><a href="#" class="nolnk"><img src="/img/flags/jp.png" alt=""> Japanese</a><a href="#" class="nolnk"><img src="/img/flags/cn.png" alt=""> Chinese</a><a href="#" class="nolnk"><img src="/img/flags/vn.png" alt=""> Vietnamese</a><a href="#" class="nolnk"><img src="/img/flags/it.png" alt=""> italian</a><a href="#" class="nolnk"><img src="/img/flags/kr.png" alt=""> korean</a><a href="#" class="nolnk"><img src="/img/flags/tr.png" alt=""> Turkish</a><a href="#" class="nolnk"><img src="/img/flags/pl.png" alt=""> Polish</a><a href="#" class="nolnk"><img src="/img/flags/ua.png" alt=""> Ukrainian</a><a href="#" class="nolnk"><img src="/img/flags/ro.png" alt=""> Romanian</a><a href="#" class="nolnk"><img src="/img/flags/nl.png" alt=""> Dutch</a><a href="#" class="nolnk"><img src="/img/flags/gr.png" alt=""> Greek</a><a href="#" class="nolnk"><img src="/img/flags/hu.png" alt=""> Hungarian</a><a href="#" class="nolnk"><img src="/img/flags/cz.png" alt=""> Czech</a><a href="#" class="nolnk"><img src="/img/flags/bg.png" alt=""> Bulgarian</a></div>
			</div>
		 </div>
	  </div>
   </div>
@include('elements.impersonation-header')
<div class="flex-fill mt">
    @include('template.user-side-menu')

    <div class="container-xl overflow-x-hidden-m">
        <div class="row main-wrapper">
            <div class="col-2 col-md-3 pt-4 p-0 d-none d-md-block fside">
                @include('template.side-menu')
            </div>
            <div class="col-12 col-md-9 min-vh-100 border-left px-0 overflow-x-hidden-m content-wrapper fside {{(in_array(Route::currentRouteName(),['feed','profile','my.messenger.get','search.get','my.notifications','my.bookmarks','my.lists.all','my.lists.show','my.settings','posts.get']) ? '' : 'border-right' )}}">
                @yield('content')
            </div>
        </div>
        <div class="d-block d-md-none fixed-bottom">
            @include('elements.mobile-navbar')
        </div>
    </div>

</div>
@if(getSetting('compliance.enable_age_verification_dialog'))
    @include('elements.site-entry-approval-box')
@endif
@include('template.footer-compact',['compact'=>true])
@include('template.jsVars')
@include('template.jsAssets',['additionalJs' => [
               '/libs/jquery-backstretch/jquery.backstretch.min.js',
               '/libs/wow.js/dist/wow.min.js',
               '/libs/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
               '/js/SideMenu.js'
]])
@include('elements.language-selector-box')

<script src="/js/general.js"></script>
</body>
</html>
