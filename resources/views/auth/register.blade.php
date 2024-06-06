@extends('layouts.no-nav')

@section('styles')
<link href="{{asset('/css/register.css')}}" rel="stylesheet">
@stop

@section('page_title', __('Register'))

@section('page_description', getSetting('site.description'))
@section('share_url', route('home'))
@section('share_title', getSetting('site.name') . ' - ' .  __('Register'))
@section('share_description', getSetting('site.description'))
@section('share_type', 'article')
@section('share_img', GenericHelper::getOGMetaImage())

@if(getSetting('security.recaptcha_enabled') && !Auth::check())
    @section('meta')
        {!! NoCaptcha::renderJs() !!}
    @stop
@endif

@section('scripts')
<script src="{{asset('/js/jquery.1.11.1.js')}}"></script>
<script src="{{asset('/js/general.js')}}"></script>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="col-md-6">
                <div class="login d-flex align-items-center py-5 h-151">
                    <div class="container">
                        <div class="row">
                            <div class="form-wd">
                                <a href="{{action('HomeController@index')}}">
                                    <img class="brand-logo pb-4" src="{{asset( (Cookie::get('app_theme') == null ? (getSetting('site.default_user_theme') == 'dark' ? getSetting('site.dark_logo') : getSetting('site.light_logo')) : (Cookie::get('app_theme') == 'dark' ? getSetting('site.dark_logo') : getSetting('site.light_logo'))) )}}">
								</a><div class="sfrmttl">Sign Up</div>
								<div class="wya">Please choose a username, your E-Mail address <br>and a password to sign up to FANCCI.</div>
                               
                                @include('auth.register-form')
                                @include('auth.social-login-box')
								
								<div class="join-opt">
									<a href="#"><i class="twtrx-icon"></i>Sign in with X</a>
									<a href="#"><i class="fa fa-google"></i> Sign in with Google</a>
									<a href="#"><i class="fa fa-facebook"></i> Sign in with Facebook</a>
									<a href="#"><i class="fa fa-twitch"></i> Sign in with Twitch</a>
								</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-md-flex bg-image p-0 m-0">
                <div class="m-0 p-0 w-100 bgglobe">
                   
				<div class="hlpr-cont">
				<div class="subttl">Sign Up to the next generation content creator
platform and become successful.</div>
			<!-- <p>As a Model you offer adult entertainment services yourself, like selling digital content, do live webcam sessions, sell products or create pictures &amp; videos for your fans. <br> Sign Up as an Model below.</p> -->
			<div class="join-vid">
				<!-- <div class="royalSlider rsDefault" id="slider-model">
					<img class="rsImg" src="/img/model-slider.jpg" alt="">
					<img class="rsImg" src="/img/model-slider2.jpg" alt="">
					<img class="rsImg" src="/img/model-slider3.jpg" alt="">
					<img class="rsImg" src="/img/model-slider4.jpg" alt="">
					<img class="rsImg" src="/img/model-slider5.jpg" alt="">
					<img class="rsImg" src="/img/model-slider6.jpg" alt="">
					<img class="rsImg" src="/img/model-slider7.jpg" alt="">
					<img class="rsImg" src="/img/model-slider8.jpg" alt="">
				</div> -->
				<div class="vmplyr">
				<iframe _ngcontent-serverapp-c48="" src="https://player.vimeo.com/video/781756369?h=06508c62e8" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen="" data-ready="true"></iframe>
				</div>
			</div>
			<ul class="adv-list">
			   <li>Build your fancci Network</li>
			   <li>Soon: Promote your profile in the fancci directory.</li>
			   <li>Soon: Sell your content and Webcam services.</li>
			   <li>Soon: Get followers and fans, enjoy tips and more.</li>
			   <li>Soon: Get new customers and earn money.</li>
			   <li>81% - Highest Payouts in the Industry.</li>
			   <li>Earn up to 6.5% passive income - 6 Level program</li>
			   <li>Get 1`000 company shares for free.</li>
			</ul>
		 </div>
		 </div>
		 
		
		 		
             
            </div>
        </div>
		<div class="row">
		<div class="cftr">
<p> &copy; 2024 - BITCCI AG, Switzerland <br><a target="_blank" href="imprint.html">Imprint</a> | <a target="_blank" href="dsgvo.html">Privacy policy</a></p>
<span>
	<a href="https://twitter.com/bitcci" target="_blank"><img src="/img/twitterX-sml.png" alt="X"> X Twitter</a>
	<a href="https://t.me/bitcci" target="_blank"><img src="/img/telegram-blk.png" alt="telegram"> News EN</a>
	<a href="https://t.me/bitcci_de" target="_blank"><img src="/img/telegram-blk.png" alt="telegram"> News DE</a><br>
	<a href="https://t.me/bitcciGroupOfficial" target="_blank"><img src="/img/telegram-grp.png" alt="telegram"> Group EN</a>
	<a href="https://t.me/bitcciGroup_Official_Deutsch" target="_blank"><img src="/img/telegram-grp.png" alt="telegram"> Group DE</a>
	<a href="https://www.youtube.com/c/BITCCI/videos" target="_blank"><img src="/img/youtube-icon.png" alt="Youtube"> Youtube</a>
</span>
</div>
		</div>
    </div>
@endsection

