@extends('layouts.user-no-nav')

@section('page_title',  __("user_profile_title_label",['user' => $user->name]))
@section('share_url', route('home'))
@section('share_title',  __("user_profile_title_label",['user' => $user->name]) . ' - ' .  getSetting('site.name'))
@section('share_description', $seo_description ?? getSetting('site.description'))
@section('share_type', 'article')
@section('share_img', $user->cover)

@section('scripts')
    {!!
        Minify::javascript(array_merge([
            '/js/PostsPaginator.js',
            '/js/CommentsPaginator.js',
            '/js/StreamsPaginator.js',
            '/js/Post.js',
            '/js/pages/profile.js',
            '/js/pages/lists.js',
            '/js/pages/checkout.js',
            '/libs/swiper/swiper-bundle.min.js',
            '/js/plugins/media/photoswipe.js',
            '/libs/photoswipe/dist/photoswipe-ui-default.min.js',
            '/libs/@joeattardi/emoji-button/dist/index.js',
            '/js/plugins/media/mediaswipe.js',
            '/js/plugins/media/mediaswipe-loader.js',
            '/js/LoginModal.js',
            '/js/messenger/messenger.js',
         ],$additionalAssets))->withFullUrl()
    !!}
@stop

@section('styles')
    {!!
        Minify::stylesheet([
            '/css/pages/profile.css',
            '/css/pages/checkout.css',
            '/css/pages/lists.css',
            '/libs/swiper/swiper-bundle.min.css',
            '/libs/photoswipe/dist/photoswipe.css',
            '/libs/photoswipe/dist/default-skin/default-skin.css',
            '/css/pages/profile.css',
            '/css/pages/lists.css',
            '/css/posts/post.css'
         ])->withFullUrl()
    !!}
    @if(getSetting('feed.post_box_max_height'))
        @include('elements.feed.fixed-height-feed-posts', ['height' => getSetting('feed.post_box_max_height')])
    @endif
@stop

@section('meta')
    @if(getSetting('security.recaptcha_enabled') && !Auth::check())
        {!! NoCaptcha::renderJs() !!}
    @endif
    @if($activeFilter)
        <link rel="canonical" href="{{route('profile',['username'=> $user->username])}}" />
    @endif
@stop

@section('content')

<div class="prof-hdr" style="background-image: url({{$user->cover}}); background-position: right center;">
   <div class="mob-cont">
	  <div class="phdr-avatar"><a class="avail mob-chat"><i class="fa fa-comments-o"></i> Send me a Message</a><img alt="" src="{{$user->avatar}}"></div>
	  <div class="ph-cont">
		 <div class="phl">
			<h1>{{$user->name}}</h1>
			<ul class="bp-vvno">
			   <li>NEW</li>
			   <li>VERIFIED</li>
			</ul>
			<i class="fa fa-venus"></i>
			<div class="lang-mob">
            <img alt="" src="/img/flags/us.png" data-toggle="tooltip" data-original-title="Good"><img alt="" src="/img/flags/de.png" data-toggle="tooltip" data-original-title="Fluent / Native skills">
			</div>
            <div class="nbtn">
            @if(!Auth::check() || Auth::user()->id !== $user->id)
            @if($hasSub || $viewerHasChatAccess)
			<a href="#" onclick="messenger.showNewMessageDialog()"><i class="fa fa-comments"></i> Chat with me</a>
            @endif
            <a href="#" @if(!Auth::user()->email_verified_at && getSetting('site.enforce_email_validation'))
                                      data-placement="top"
                                      title="{{__('Please verify your account')}}"
                                      @elseif(!\App\Providers\GenericHelperServiceProvider::creatorCanEarnMoney($user))
                                      data-placement="top"
                                      title="{{__('This creator cannot earn money yet')}}"
                                      @else
                                      data-placement="top"
                                      title="{{__('Send a tip')}}"
                                      data-toggle="modal"
                                      data-target="#checkout-center"
                                      data-type="tip"
                                      data-first-name="{{Auth::user()->first_name}}"
                                      data-last-name="{{Auth::user()->last_name}}"
                                      data-billing-address="{{Auth::user()->billing_address}}"
                                      data-country="{{Auth::user()->country}}"
                                      data-city="{{Auth::user()->city}}"
                                      data-state="{{Auth::user()->state}}"
                                      data-postcode="{{Auth::user()->postcode}}"
                                      data-available-credit="{{Auth::user()->wallet->total}}"
                                      data-username="{{$user->username}}"
                                      data-name="{{$user->name}}"
                                      data-avatar="{{$user->avatar}}"
                                      data-recipient-id="{{$user->id}}"
                                      @endif><i class="fa fa-gift"></i> Send a Tip</a>
            <a href="#"><i class="fa fa-heart"></i> Subscribe</a>
            @if($user->paid_profile && (!getSetting('profiles.allow_users_enabling_open_profiles') || (getSetting('profiles.allow_users_enabling_open_profiles') && !$user->open_profile)))
   @elseif(!Auth::check() || (Auth::check() && Auth::user()->id !== $user->id))
                        @if(Auth::check())
                        <a href="#" onclick="Lists.manageFollowsAction('{{$user->id}}')">{{\App\Providers\ListsHelperServiceProvider::getUserFollowingType($user->id, true)}}</a>
                        @else
                        <a href="#" data-toggle="modal" data-target="#login-dialog"><i class="fa fa-user-plus"></i>{{__('Follow Me')}}</a> 
                        @endif
                @endif
            <a href="#"><i class="nft-icon"></i> Buy my NFT</a>
            @else
            <a href="{{route('my.settings')}}"><i class="fa fa-cog"></i> {{__('Edit profile')}}</a>
            @endif
            </div>
           
		 </div>
	  </div>
   </div>
   <div class="btm-pnk">
	  <div class="lang-loc">
		 <span>Location:  Germany <img alt="" src="/img/flags/de.png"></span>
		 <span>Languages <img alt="" src="/img/flags/us.png" data-toggle="tooltip" data-original-title="Good"><img alt="" src="/img/flags/de.png" data-toggle="tooltip" data-original-title="Fluent / Native skills">
		 </span>
	  </div>
	  <ul class="bp-stats">
		 <li><img src="/img/icon-wht-users.png" alt=""><span>Coming <br>Soon</span></li>
		 <li><img src="/img/icon-wht-photo.png" alt=""><span>Coming <br>Soon</span></li>
		 <li><img src="/img/icon-wht-photo-video.png" alt=""><span>Coming <br>Soon</span></li>
		 <li><img src="/img/icon-wht-model.png" alt=""><span>Coming <br>Soon</span></li>
		 <li><img src="/img/icon-wht-chart-line.png" alt=""><span>Coming <br>Soon</span></li>
		 <li><img src="/img/icon-wht-plus.png" alt=""><span>Coming <br>Soon</span></li>
	  </ul>
	  <div class="sm"><span><a target="_blank" href="https://instagram.com/jessi.a" class="active-link"><img src="/img/instagram.png" alt=""></a><a target="_blank" href="" class="inactive-link"><img src="/img/facebook.png" alt=""></a><a target="_blank" href="https://mobile.twitter.com/jessica_only_" class="active-link"><img src="/img/twitter.png" alt=""></a><a class="inactive-link"><img src="/img/snapchat.png" alt=""></a><a target="_blank" href="" class="inactive-link"><img src="/img/tiktok.png" alt=""></a><a class="inactive-link"><img src="/img/youtube.png" alt=""></a><a class="inactive-link"><img src="/img/twitch.png" alt=""></a><a class="inactive-link"><img src="/img/vimeo.png" alt=""></a></span></div>
   </div>
   <div class="phr">
   @if(!Auth::check() || Auth::user()->id !== $user->id)
   <a href="#" class="inact">Boost me</a>
   <a href="#" onclick="Lists.showListAddModal();">{{__('Add to your lists')}}</a>
   @else
   <a href="{{route('my.settings')}}">{{__('Edit profile')}}</a>
   @endif
</div>
</div>




<div class="main-tabs2">
   <input type="radio" name="tabset" id="tab1" aria-controls="mtab1C" checked=""><label for="tab1">About me</label>
   <input type="radio" name="tabset" id="tab2" aria-controls="mtab2C"><label for="tab2">6 Galleries </label>
   <input type="radio" name="tabset" id="tab3" aria-controls="mtab3C"><label for="tab3" class="inactive">My Shop</label>
   <div class="tab-panels">
	  <div id="mtab1C" class="main-tabc">
		 <ul class="prof-photos">
			<li><a data-fancybox="gallery" href="/img/jessican-1.jpg"><img alt="" src="/img/jessican-1.jpg"></a></li>
			<li><a data-fancybox="gallery" href="/img/jessican-2.jpg"><img alt="" src="/img/jessican-2.jpg"></a></li>
			<!-- <li class="lock">
			   <a>
				  <div class="lockalbm">
					 <div class="ldp">
                     <h4>Check my Galleries</h4>
						<button><i class="fa fa-picture-o"></i><span>Galleries</span></button>
                        <hr>
						<h4>Contact me via <br>fancci messenger</h4>
						<button><i class="fa fa-comments-o"></i><span>Send me a <br>Message</span></button>
					 </div>
				  </div>
				  <img src="/img/tn-de.jpg" alt="">
			   </a>
			</li> -->
            <li><a data-fancybox="gallery" href="/img/jessican-1.jpg"><img alt="" src="/img/jessican-1.jpg"></a></li>
			<li><a data-fancybox="gallery" href="/img/jessican-3.jpg"><img alt="" src="/img/jessican-3.jpg"></a></li>
			<li><a data-fancybox="gallery" href="/img/jessican-2.jpg"><img alt="" src="/img/jessican-2.jpg"></a></li>
		 </ul>
		 <div class="phr mob"><a href="#" class="inact">Follow me</a><a href="#" class="inact">Boost me</a><a>Tip me</a><a href="#" class="inact">Subscribe</a></div>
		 <div class="sm mob"><span><a target="_blank" href="https://instagram.com/jessi.a" class="active-link"><img src="/img/instagram.png" alt=""></a><a target="_blank" href="" class="inactive-link"><img src="/img/facebook.png" alt=""></a><a target="_blank" href="https://mobile.twitter.com/jessica_only_" class="active-link"><img src="/img/twitter.png" alt=""></a><a class="inactive-link"><img src="/img/snapchat.png" alt=""></a><a target="_blank" href="" class="inactive-link"><img src="/img/tiktok.png" alt=""></a><a class="inactive-link"><img src="/img/youtube.png" alt=""></a><a class="inactive-link"><img src="/img/twitch.png" alt=""></a><a class="inactive-link"><img src="/img/vimeo.png" alt=""></a></span></div>
		
	  </div>
      
      <div id="mtab2C" class="main-tabc">
        <div class="gallery">
            <h2>Check out my private Galleries</h2>
            <div class="gall-cont">
                <div class="gall-box">
                    <div class="gall-ttl">Car shooting</div>
                    <div class="gall-dtls"><span>4 Pictures </span><small> Produced: <br> 09 March 2023 </small></div>
                    <div class="gall-media"><i class="pic-icon"></i><img alt="" src="/img/67b13732-6abc-4e6c-a3f2-2d1bb878ffd1.png"></div>
                    <div class="gall-btm"></div>
                </div>
                <div class="gall-box">
                    <div class="gall-ttl">❤</div>
                    <div class="gall-dtls"><span>1 Picture </span><small> Produced: <br> 09 March 2023 </small></div>
                    <div class="gall-media"><i class="pic-icon"></i><img alt="" src="/img/08ce846d-2a6b-404d-9a05-624984c93180.png"></div>
                    <div class="gall-btm"></div>
                </div>
                <div class="gall-box">
                    <div class="gall-ttl">❤️‍🔥</div>
                    <div class="gall-dtls"><span>1 Picture </span><small> Produced: <br> 09 March 2023 </small></div>
                    <div class="gall-media"><i class="pic-icon"></i><img alt="" src="/img/51507d15-990e-4a1f-8f39-06bc31863568.png"></div>
                    <div class="gall-tags"><a href="#">#nude</a><a href="#">#naturalboobs</a><a href="#">#eroticmodel</a><a href="#">#hot</a></div>
                    <div class="gall-btm"><span><i class="blk-coin"></i> 50 FCR </span><a class="pnk-btn">Unlock Album</a></div>
                </div>
                <div class="gall-box">
                    <div class="gall-ttl">🔥</div>
                    <div class="gall-dtls"><span>1 Picture </span><small> Produced: <br> 09 March 2023 </small></div>
                    <div class="gall-media"><i class="pic-icon"></i><img alt="" src="/img/aaa2f1d4-d129-4453-bc85-d937ac1244a7.png"></div>
                    <div class="gall-tags"><a href="#">#nude</a><a href="#">#hot</a><a href="#">#naturalboobs</a><a href="#">#erotic</a><a href="#">#model</a></div>
                    <div class="gall-btm"><span><i class="blk-coin"></i> 50 FCR </span><a class="pnk-btn">Unlock Album</a></div>
                </div>
                <div class="gall-box">
                    <div class="gall-ttl">Table fun 🍆</div>
                    <div class="gall-dtls"><span>0 Picture</span><small> Produced: <br> 06 April 2023 </small></div>
                    <div class="gall-media"><img alt="" src="/img/dc3c457c-6a9f-4ee1-b7da-fefbf6e8cc8c.png"></div>
                    <div class="gall-tags"><a href="#">#vibrator</a><a href="#">#pussy</a></div>
                    <div class="gall-btm"><span><i class="blk-coin"></i> 400 FCR </span><a class="pnk-btn">Unlock Album</a></div>
                </div>
                <div class="gall-box">
                    <div class="gall-ttl">Vibrator and kitty</div>
                    <div class="gall-dtls"><span>1 Picture </span><small> Produced: <br> 06 April 2023 </small></div>
                    <div class="gall-media"><i class="pic-icon"></i><img alt="" src="/img/766fc0ed-383b-402a-8dfb-769201a00627.png"></div>
                    <div class="gall-btm"><span><i class="blk-coin"></i> 400 FCR </span><a class="pnk-btn">Unlock Album</a></div>
                </div>
            </div>
        </div>
        </div>

   </div>
</div>

    <div class="row">
        <div class="col-12 col-md-8 border-right pr-md-0">

         

            <div class="container pt-2 pl-0 pr-0">



                @include('elements.message-alert',['classes'=>'px-2 pt-4'])
                <div class="mt-3 inline-border-tabs">
                    <nav class="nav nav-pills nav-justified text-bold">
                        <a class="nav-item nav-link {{$activeFilter == false ? 'active' : ''}}" href="{{route('profile',['username'=> $user->username])}}">{{trans_choice('posts', $posts->total(), ['number'=>$posts->total()])}} </a>

                        @if($filterTypeCounts['image'] > 0)
                            <a class="nav-item nav-link {{$activeFilter == 'image' ? 'active' : ''}}" href="{{route('profile',['username'=> $user->username]) . '?filter=image'}}">{{trans_choice('images', $filterTypeCounts['image'], ['number'=>$filterTypeCounts['image']])}}</a>
                        @endif

                        @if($filterTypeCounts['video'] > 0)
                            <a class="nav-item nav-link {{$activeFilter == 'video' ? 'active' : ''}}" href="{{route('profile',['username'=> $user->username]) . '?filter=video'}}">{{trans_choice('videos', $filterTypeCounts['video'], ['number'=>$filterTypeCounts['video']])}}</a>

                        @endif

                        @if($filterTypeCounts['audio'] > 0)
                            <a class="nav-item nav-link {{$activeFilter == 'audio' ? 'active' : ''}}" href="{{route('profile',['username'=> $user->username]) . '?filter=audio'}}">{{trans_choice('audio', $filterTypeCounts['audio'], ['number'=>$filterTypeCounts['audio']])}}</a>
                        @endif

                        @if(getSetting('streams.allow_streams'))
                            @if(isset($filterTypeCounts['streams']) && $filterTypeCounts['streams'] > 0)
                                <a class="nav-item nav-link {{$activeFilter == 'streams' ? 'active' : ''}}" href="{{route('profile',['username'=> $user->username]) . '?filter=streams'}}"> {{$filterTypeCounts['streams']}} {{trans_choice('streams', $filterTypeCounts['streams'], ['number'=>$filterTypeCounts['streams']])}}</a>
                            @endif
                        @endif

                    </nav>
                </div>
                <div class="justify-content-center align-items-center {{(Cookie::get('app_feed_prev_page') && PostsHelper::isComingFromPostPage(request()->session()->get('_previous'))) ? 'mt-3' : 'mt-4'}}">
                    @if($activeFilter !== 'streams')
                        @include('elements.feed.posts-load-more', ['classes' => 'mb-2'])
                        <div class="feed-box mt-0 posts-wrapper">
                            @include('elements.feed.posts-wrapper',['posts'=>$posts])
                        </div>
                    @else
                        <div class="streams-box mt-4 streams-wrapper mb-4">
                            @include('elements.search.streams-wrapper',['streams'=>$streams,'showLiveIndicators'=>true, 'showUsername' => false])
                        </div>
                    @endif
                    @include('elements.feed.posts-loading-spinner')
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 d-none d-md-block pt-3">
            <!-- @include('elements.profile.widgets') -->
            <div class="cbox">
				  <div class="de-ttlb">MY MESSAGE</div>
				  <p>Welcome 😍! Here I share intimate erotic adult content with you 🔥 do you have any wishes? 💋 Let's talk about 😈 PS: I am not as well behaved as I look 🥵 I gonna tease you like no other💥! and yes, I’m all natural!💦</p>
			   </div>
               <div class="de-box">
				  <div class="de-ttlb"> MY BASICS</div>
				  <ul class="aboutm">
					 <li><span>Gender:</span><strong>Female</strong></li>
					 <li><span>Age:</span><strong>25 years</strong></li>
					 <li><span>Sexual Orientation:</span><strong>Bisexual</strong></li>
					 <li><span>Figure:</span><strong>Normal</strong></li>
					 <li><span>Height:</span><strong>159 cm</strong></li>
					 <li><span>Weight:</span><strong>49 kg</strong></li>
					 <li><span>Cup size:</span><strong>D</strong></li>
					 <li><span>Clothing size:</span><strong>36/S</strong></li>
					 <li><span>Shoe size:</span><strong>36</strong></li>
					 <li><span>Bust size:</span><strong>78-81</strong></li>
					 <li><span>Hair Colour:</span><strong>Brown</strong></li>
					 <li><span>Skin Colour:</span><strong>Middle</strong></li>
					 <li><span>Eye Colour:</span><strong>Green</strong></li>
					 <li><span>Hair:</span><strong>Sleek Medium Length</strong></li>
					 <li><span>Drink Alcohol:</span><strong>Ocassionally</strong></li>
					 <li><span>Smoker:</span><strong>No</strong></li>
					 <li><span>Tattoos:</span><strong>Yes</strong></li>
					 <li><span>Piercings:</span><strong>Yes</strong></li>
					 <li><span>Occupation:</span><strong>(erotic) model</strong></li>
					 <li><span>Favorite Sex Position:</span><strong>text me ;)</strong></li>
					 <li><span>Favorite Food:</span><strong>Watermelon</strong></li>
					 <li><span>Favorite Drink:</span><strong>Aperol, Champagne</strong></li>
					 <li><span>Favorite Perfume:</span><strong>Si Armani</strong></li>
					 <li><span>Hobbies:</span><strong>sunny weather, sauna, dancing,...</strong></li>
					 <li><span>Secrets and desires:</span><strong>let's find out together ;)</strong></li>
					 <li><span>Things Liked:</span><strong>nice people, nature, traveling,...</strong></li>
					 <li><span>Things Not Liked:</span><strong>bad vibes, impolite messages</strong></li>
				  </ul>
			   </div>

        </div>
    </div>

    <div class="d-none">
        <ion-icon name="heart"></ion-icon>
        <ion-icon name="heart-outline"></ion-icon>
    </div>

    @if(Auth::check())
        @include('elements.lists.list-add-user-dialog',['user_id' => $user->id, 'lists' => ListsHelper::getUserLists()])
        @include('elements.checkout.checkout-box')
        @include('elements.messenger.send-user-message',['receiver'=>$user])
    @else
        @include('elements.modal-login')
    @endif

    @include('elements.profile.qr-code-dialog')

@stop
