@extends('layouts.user-no-nav')
@section('page_title', __('Build My Network'))

@section('styles')
<link href="{{asset('/css/buildnetwork.css')}}" rel="stylesheet">
@stop




@section('content')

    <div class="row">
        <div class="min-vh-100 border-right col-12 pr-md-0">
            <div class="pt-4 d-flex justify-content-between align-items-center px-3 pb-3 border-bottom">
                <h5 class="text-bold {{(Cookie::get('app_theme') == null ? (getSetting('site.default_user_theme') == 'dark' ? '' : 'text-dark-r') : (Cookie::get('app_theme') == 'dark' ? '' : 'text-dark-r'))}}">{{__('Build my Network')}}</h5>
                </div>

    <div class="d-lg-block settings-nav fancci" id="">
	<div class="card-settings border-bottom">
		<div class="list-group list-group-sm list-group-flush ntab">
		<a href="#mylink" class="list-group-item list-group-item-action d-flex justify-content-between">
					<div class="d-flex align-items-center">
						<div class="ion-icon-wrapper mr-3 icon-medium d-flex justify-content-center align-items-center">
			<div class="ion-icon-inner">
			<svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M9.16488 17.6505C8.92513 17.8743 8.73958 18.0241 8.54996 18.1336C7.62175 18.6695 6.47816 18.6695 5.54996 18.1336C5.20791 17.9361 4.87912 17.6073 4.22153 16.9498C3.56394 16.2922 3.23514 15.9634 3.03767 15.6213C2.50177 14.6931 2.50177 13.5495 3.03767 12.6213C3.23514 12.2793 3.56394 11.9505 4.22153 11.2929L7.04996 8.46448C7.70755 7.80689 8.03634 7.47809 8.37838 7.28062C9.30659 6.74472 10.4502 6.74472 11.3784 7.28061C11.7204 7.47809 12.0492 7.80689 12.7068 8.46448C13.3644 9.12207 13.6932 9.45086 13.8907 9.7929C14.4266 10.7211 14.4266 11.8647 13.8907 12.7929C13.7812 12.9825 13.6314 13.1681 13.4075 13.4078M10.5919 10.5922C10.368 10.8319 10.2182 11.0175 10.1087 11.2071C9.57284 12.1353 9.57284 13.2789 10.1087 14.2071C10.3062 14.5492 10.635 14.878 11.2926 15.5355C11.9502 16.1931 12.279 16.5219 12.621 16.7194C13.5492 17.2553 14.6928 17.2553 15.621 16.7194C15.9631 16.5219 16.2919 16.1931 16.9495 15.5355L19.7779 12.7071C20.4355 12.0495 20.7643 11.7207 20.9617 11.3787C21.4976 10.4505 21.4976 9.30689 20.9617 8.37869C20.7643 8.03665 20.4355 7.70785 19.7779 7.05026C19.1203 6.39267 18.7915 6.06388 18.4495 5.8664C17.5212 5.3305 16.3777 5.3305 15.4495 5.8664C15.2598 5.97588 15.0743 6.12571 14.8345 6.34955" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
</svg></div></div><span>My Link</span></div>
			<div class="d-flex align-items-center">
			<div class="ion-icon-wrapper  d-flex justify-content-center align-items-center">
			<div class="ion-icon-inner">
			<svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M184 112l144 144-144 144"></path></svg>
			</div></div></div>
        </a>

		<a href="#mynetwork" class="list-group-item list-group-item-action d-flex justify-content-between">
					<div class="d-flex align-items-center">
						<div class="ion-icon-wrapper mr-3 icon-medium d-flex justify-content-center align-items-center">
			<div class="ion-icon-inner">
			<svg fill="currentColor" width="800px" height="800px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
<path d="M27 21.75c-0.795 0.004-1.538 0.229-2.169 0.616l0.018-0.010-2.694-2.449c0.724-1.105 1.154-2.459 1.154-3.913 0-1.572-0.503-3.027-1.358-4.212l0.015 0.021 3.062-3.062c0.57 0.316 1.249 0.503 1.971 0.508h0.002c2.347 0 4.25-1.903 4.25-4.25s-1.903-4.25-4.25-4.25c-2.347 0-4.25 1.903-4.25 4.25v0c0.005 0.724 0.193 1.403 0.519 1.995l-0.011-0.022-3.062 3.062c-1.147-0.84-2.587-1.344-4.144-1.344-0.868 0-1.699 0.157-2.467 0.443l0.049-0.016-0.644-1.17c0.726-0.757 1.173-1.787 1.173-2.921 0-2.332-1.891-4.223-4.223-4.223s-4.223 1.891-4.223 4.223c0 2.332 1.891 4.223 4.223 4.223 0.306 0 0.605-0.033 0.893-0.095l-0.028 0.005 0.642 1.166c-1.685 1.315-2.758 3.345-2.758 5.627 0 0.605 0.076 1.193 0.218 1.754l-0.011-0.049-0.667 0.283c-0.78-0.904-1.927-1.474-3.207-1.474-2.334 0-4.226 1.892-4.226 4.226s1.892 4.226 4.226 4.226c2.334 0 4.226-1.892 4.226-4.226 0-0.008-0-0.017-0-0.025v0.001c-0.008-0.159-0.023-0.307-0.046-0.451l0.003 0.024 0.667-0.283c1.303 2.026 3.547 3.349 6.1 3.349 1.703 0 3.268-0.589 4.503-1.574l-0.015 0.011 2.702 2.455c-0.258 0.526-0.41 1.144-0.414 1.797v0.001c0 2.347 1.903 4.25 4.25 4.25s4.25-1.903 4.25-4.25c0-2.347-1.903-4.25-4.25-4.25v0zM8.19 5c0-0.966 0.784-1.75 1.75-1.75s1.75 0.784 1.75 1.75c0 0.966-0.784 1.75-1.75 1.75v0c-0.966-0.001-1.749-0.784-1.75-1.75v-0zM5 22.42c-0.966-0.001-1.748-0.783-1.748-1.749s0.783-1.749 1.749-1.749c0.966 0 1.748 0.782 1.749 1.748v0c-0.001 0.966-0.784 1.749-1.75 1.75h-0zM27 3.25c0.966 0 1.75 0.784 1.75 1.75s-0.784 1.75-1.75 1.75c-0.966 0-1.75-0.784-1.75-1.75v0c0.001-0.966 0.784-1.749 1.75-1.75h0zM11.19 16c0-0.001 0-0.002 0-0.003 0-2.655 2.152-4.807 4.807-4.807 1.328 0 2.53 0.539 3.4 1.409l0.001 0.001 0.001 0.001c0.87 0.87 1.407 2.072 1.407 3.399 0 2.656-2.153 4.808-4.808 4.808s-4.808-2.153-4.808-4.808c0-0 0-0 0-0v0zM27 27.75c-0.966 0-1.75-0.784-1.75-1.75s0.784-1.75 1.75-1.75c0.966 0 1.75 0.784 1.75 1.75v0c-0.001 0.966-0.784 1.749-1.75 1.75h-0z"></path>
</svg></div></div><span>My network</span></div>
					<div class="d-flex align-items-center">
						<div class="ion-icon-wrapper  d-flex justify-content-center align-items-center">
			<div class="ion-icon-inner">
			<svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M184 112l144 144-144 144"></path></svg>
			</div></div></div>
		</a>
							
        <a href="#bannermrkt" class="list-group-item list-group-item-action d-flex justify-content-between">
					<div class="d-flex align-items-center">
						<div class="ion-icon-wrapper mr-3 icon-medium d-flex justify-content-center align-items-center">
			<div class="ion-icon-inner">
			<svg width="800px" height="800px" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"><g id="Layer_2" data-name="Layer 2"><g id="invisible_box" data-name="invisible box"><rect width="48" height="48" fill="none"/></g><g id="icons_Q2" data-name="icons Q2"><rect x="4" y="7" width="40" height="4" rx="2" ry="2"/><rect x="4" y="27" width="10" height="4" rx="2" ry="2"/><rect x="19" y="27" width="10" height="4" rx="2" ry="2"/><rect x="34" y="27" width="10" height="4" rx="2" ry="2"/><rect x="26" y="17" width="18" height="4" rx="2" ry="2"/><rect x="4" y="17" width="18" height="4" rx="2" ry="2"/><rect x="40" y="37" width="4" height="4" rx="2" ry="2"/><rect x="31" y="37" width="4" height="4" rx="2" ry="2"/><rect x="22" y="37" width="4" height="4" rx="2" ry="2"/><rect x="13" y="37" width="4" height="4" rx="2" ry="2"/><rect x="4" y="37" width="4" height="4" rx="2" ry="2"/></g></g></svg>
			</div></div><span>Banners / Marketing</span></div>
					<div class="d-flex align-items-center">
						<div class="ion-icon-wrapper  d-flex justify-content-center align-items-center">
			<div class="ion-icon-inner">
			<svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M184 112l144 144-144 144"></path></svg>
			</div></div></div>
		</a>
		
		<a href="#vidclps" class="list-group-item list-group-item-action d-flex justify-content-between">
					<div class="d-flex align-items-center">
						<div class="ion-icon-wrapper mr-3 icon-medium d-flex justify-content-center align-items-center">
			<div class="ion-icon-inner">
			<svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8.50989 2.00001H15.49C15.7225 1.99995 15.9007 1.99991 16.0565 2.01515C17.1643 2.12352 18.0711 2.78958 18.4556 3.68678H5.54428C5.92879 2.78958 6.83555 2.12352 7.94337 2.01515C8.09917 1.99991 8.27741 1.99995 8.50989 2.00001Z" fill="currentColor"/>
<path d="M6.31052 4.72312C4.91989 4.72312 3.77963 5.56287 3.3991 6.67691C3.39117 6.70013 3.38356 6.72348 3.37629 6.74693C3.77444 6.62636 4.18881 6.54759 4.60827 6.49382C5.68865 6.35531 7.05399 6.35538 8.64002 6.35547H15.5321C17.1181 6.35538 18.4835 6.35531 19.5639 6.49382C19.9833 6.54759 20.3977 6.62636 20.7958 6.74693C20.7886 6.72348 20.781 6.70013 20.773 6.67691C20.3925 5.56287 19.2522 4.72312 17.8616 4.72312H6.31052Z" fill="currentColor"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M15.3276 7.54204H8.67239C5.29758 7.54204 3.61017 7.54204 2.66232 8.52887C1.71447 9.5157 1.93748 11.0403 2.38351 14.0896L2.80648 16.9811C3.15626 19.3724 3.33115 20.568 4.22834 21.284C5.12553 22 6.4488 22 9.09534 22H14.9046C17.5512 22 18.8745 22 19.7717 21.284C20.6689 20.568 20.8437 19.3724 21.1935 16.9811L21.6165 14.0896C22.0625 11.0404 22.2855 9.51569 21.3377 8.52887C20.3898 7.54204 18.7024 7.54204 15.3276 7.54204ZM14.5812 15.7942C15.1396 15.4481 15.1396 14.5519 14.5812 14.2058L11.2096 12.1156C10.6669 11.7792 10 12.2171 10 12.9099V17.0901C10 17.7829 10.6669 18.2208 11.2096 17.8844L14.5812 15.7942Z" fill="currentColor"/>
</svg>
			</div></div><span>Video Clips</span></div>
					<div class="d-flex align-items-center">
						<div class="ion-icon-wrapper  d-flex justify-content-center align-items-center">
			<div class="ion-icon-inner">
			<svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M184 112l144 144-144 144"></path></svg>
			</div></div></div>
		</a>

		<a href="#mrktpln" class="list-group-item list-group-item-action d-flex justify-content-between">
					<div class="d-flex align-items-center">
						<div class="ion-icon-wrapper mr-3 icon-medium d-flex justify-content-center align-items-center">
			<div class="ion-icon-inner">
			<svg fill="currentColor" height="800px" width="800px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 viewBox="0 0 247.065 247.065" xml:space="preserve"><g><path d="M160.551,36.935c-0.614-1.892-1.956-3.462-3.727-4.365c-1.774-0.904-3.831-1.065-5.724-0.45l-31.376,10.196
		c-3.939,1.28-6.096,5.511-4.815,9.45l1.568,4.828l-79.811,58.625L5.183,125.448c-1.892,0.615-3.462,1.956-4.365,3.728
		c-0.903,1.772-1.065,3.831-0.45,5.723l19.129,58.862c1.03,3.169,3.97,5.184,7.131,5.184c0.769,0,1.55-0.119,2.32-0.369
		l31.478-10.229l16.173,0.085c3.248,15.336,16.888,26.88,33.176,26.88c16.164,0,29.714-11.371,33.095-26.531l16.587,0.087
		l1.568,4.829c0.614,1.892,1.955,3.462,3.728,4.365c1.064,0.542,2.232,0.817,3.405,0.817c0.78,0,1.563-0.122,2.317-0.367
		l31.377-10.195c3.939-1.28,6.096-5.511,4.816-9.45L160.551,36.935z M31.444,181.992l-14.492-44.597l18.364-5.967l14.49,44.597
		L31.444,181.992z M109.774,200.312c-7.912,0-14.694-4.887-17.513-11.797l34.958,0.184
		C124.356,195.514,117.617,200.312,109.774,200.312z M64.714,173.369l-7.888-24.277l-7.888-24.277l72.419-53.194l22.209,68.349
		l11.006,33.873L64.714,173.369z M172.972,181.929l-0.921-2.833c-0.001-0.005-0.002-0.011-0.004-0.017l-19.815-60.983l-20.74-63.833
		l17.111-5.561l41.48,127.665L172.972,181.929z"/>
	<path d="M185.807,73.393c1.092,0.556,2.254,0.819,3.4,0.819c2.73,0,5.363-1.496,6.688-4.096l13.461-26.41
		c1.882-3.69,0.415-8.207-3.275-10.088c-3.69-1.88-8.207-0.415-10.088,3.276l-13.461,26.41
		C180.65,66.995,182.117,71.512,185.807,73.393z"/>
	<path d="M242.176,144.712l-26.414-13.455c-3.691-1.879-8.207-0.412-10.087,3.279c-1.881,3.691-0.412,8.207,3.278,10.087
		l26.414,13.455c1.091,0.555,2.253,0.818,3.398,0.818c2.73,0,5.364-1.497,6.689-4.097
		C247.335,151.109,245.867,146.593,242.176,144.712z"/>
	<path d="M204.242,101.204c1.03,3.169,3.97,5.184,7.131,5.184c0.769,0,1.55-0.119,2.32-0.369l28.188-9.16
		c3.938-1.28,6.095-5.511,4.814-9.451c-1.28-3.94-5.511-6.092-9.451-4.815l-28.188,9.16
		C205.118,93.034,202.962,97.265,204.242,101.204z"/></g></svg>
			</div></div><span>Marketing Plan</span></div>
					<div class="d-flex align-items-center">
						<div class="ion-icon-wrapper  d-flex justify-content-center align-items-center">
			<div class="ion-icon-inner">
			<svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M184 112l144 144-144 144"></path></svg>
			</div></div></div>
		</a>
							
		</div>
	</div>
</div>

			<div class="ntab-cont" id="mylink">
              
			
	<div class="big-ttl">Build your FANCCI Network </div>
	  <div class="bn-ttxt">
		 With fancci you can build a cool, new and profitable business. When your network creates revenue by selling digital content, webcam services, fan subscriptions or sales in the bitcci shop - you earn passive income. The larger your network is, the more you earn. 
		 <hr>
	  </div>
	  <div class="bn-ttxt">Please use this global link until the special links below are online.</div>
	  <div class="send-lnk">
		 <h5>Build your fancci Business Network and earn passive income. Send your fancci Link to your contacts (Models, Influencers, Agencies, Clubs, Affiliates, Networkers, etc.) and earn commissions in 6 levels.</h5>
		 <div class="sl-link"><a id="refLink" target="_blank" href="https://fancci.net/L_0Chq1"> https://fancci.net/L_0Chq1 </a></div>
		 <div class="sl-icons ficon"><a target="_blank" href="https://api.whatsapp.com/send?text=https://fancci.net/L_0Chq1"><img src="/img/whatsapp-logo.png" alt=""><small>Send via WhatsApp</small></a><a target="_blank" href="https://t.me/share/url?url=https://fancci.net/L_0Chq1"><img src="/img/telegram.png" alt=""><small>Send via Telegram</small></a><a target="_blank" href="https://line.me/R/share?text=https://fancci.net/L_0Chq1"><img src="/img/line-logo.png" alt=""><small>Send via LINE</small></a><a target="_blank" href="https://www.wechat.com/?link=https://fancci.net/L_0Chq1"><img src="/img/wechat.png" alt=""><small>Send via WeChat</small></a><a><img src="/img/copy-link2.png" alt=""><small>Copy Link</small></a></div>
		 <hr>
		 <div class="allw">
			<h5>Allowed</h5>
			You are allowed to share your fancci link with your friends, followers, people you know or post it in all your social media channels. 
		 </div>
		 <div class="sl-notice">
			<h5>Not Allowed</h5>
			You are NOT allowed to share your fancci link in unsolicited emails or in unauthorized postings in social media platforms or any spamming activities to people you dont know. All these activities can result in the blocking of your fancci account and wallet.
		 </div>
	  </div>
	 

			
			</div>

			<div class="ntab-cont" id="mynetwork">
              
			<div class="deTable">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tbody>
					<tr class="glybg">
						<td>Picture</td>
						<td width="70">Level</td>
						<td>Registered</td>
						<td>Status</td>
						<td>Nickname</td>
						<td>City</td>
						<td>Country</td>
						<td>Last online</td>
						<td>Revenue</td>
					</tr>
					<tr>
						<td valign="middle"><img src="/img/01bc6e03-682f-472c-aa92-f714251ed976.png" alt=""></td>
						<td valign="middle">10</td>
						<td valign="middle">10 Aug. 2023</td>
						<td valign="middle">Active</td>
						<td valign="middle">Mika</td>
						<td valign="middle">California</td>
						<td valign="middle">USA</td>
						<td valign="middle">Yesterday</td>
						<td valign="middle">1'021</td>
					</tr>
				</tbody>
			</table>
			</div>

			</div>

            <div class="ntab-cont" id="bannermrkt">
                
			<div class="subtab">

			<div class="subtbtn">
				<a href="#set1">Set 1</a>
				<a href="#set3">Set 2</a>
				<a href="#set3">Set 3</a>
			</div>
			
			<div class="subtcnt" id="set1">
			<div class="sub-ttl">Set 1</div>
				<ul class="bmn-ban">
	                <li><img src="/banners/729x90.jpg" alt=""> <h4>729x90 Pixel</h4></li>
	                <li><img src="/banners/729x90.gif" alt=""> <h4>729x90 Pixel (animated)</h4></li>
	                <li><span><img src="/banners/468x60.jpg" alt=""> <h4>468x60 Pixel</h4></span><span><img src="/banners/468x60.gif" alt=""> <h4>468x60 Pixel (animated)</h4></span></li>
	                <li><span><img src="/banners/320x100.jpg" alt=""> <h4>320x100 Pixel</h4></span><span><img src="/banners/320x100.gif" alt=""> <h4>320x100 Pixel (animated)</h4></span></li>
	                <li><span><img src="/banners/300x250.jpg" alt=""> <h4>300x250 Pixel</h4></span><span><img src="/banners/300x250.gif" alt=""> <h4>300x250 Pixel (animated)</h4></span></li>
	                <li><span><img src="/banners/160x600.jpg" alt=""> <h4>160x600 Pixel</h4></span><span><img src="/banners/160x600.gif" alt=""> <h4>160x600 Pixel (animated)</h4></span></li>
	                <li><img src="/banners/602x583.jpg" alt=""> <h4>602x583 Pixel</h4></li>
	                <li><img src="/banners/602x583.gif" alt=""> <h4>602x583 Pixel (animated)</h4></li>
	                <li><img src="/banners/1640x924.jpg" alt=""> <h4>1640x924 Pixel</h4></li>
	                <li><img src="/banners/1640x924.gif" alt=""> <h4>1640x924 Pixel (animated)</h4></li>
                </ul>
			</div>

			<div class="subtcnt" id="set2">
			<div class="sub-ttl">Set 2</div>
				<ul class="bmn-ban">
	                <li><img src="/banners/729x90.jpg" alt=""> <h4>729x90 Pixel</h4></li>
	                <li><img src="/banners/729x90.gif" alt=""> <h4>729x90 Pixel (animated)</h4></li>
	                <li><span><img src="/banners/468x60.jpg" alt=""> <h4>468x60 Pixel</h4></span><span><img src="/banners/468x60.gif" alt=""> <h4>468x60 Pixel (animated)</h4></span></li>
	                <li><span><img src="/banners/320x100.jpg" alt=""> <h4>320x100 Pixel</h4></span><span><img src="/banners/320x100.gif" alt=""> <h4>320x100 Pixel (animated)</h4></span></li>
	                <li><span><img src="/banners/300x250.jpg" alt=""> <h4>300x250 Pixel</h4></span><span><img src="/banners/300x250.gif" alt=""> <h4>300x250 Pixel (animated)</h4></span></li>
	                <li><span><img src="/banners/160x600.jpg" alt=""> <h4>160x600 Pixel</h4></span><span><img src="/banners/160x600.gif" alt=""> <h4>160x600 Pixel (animated)</h4></span></li>
	                <li><img src="/banners/602x583.jpg" alt=""> <h4>602x583 Pixel</h4></li>
	                <li><img src="/banners/602x583.gif" alt=""> <h4>602x583 Pixel (animated)</h4></li>
	                <li><img src="/banners/1640x924.jpg" alt=""> <h4>1640x924 Pixel</h4></li>
	                <li><img src="/banners/1640x924.gif" alt=""> <h4>1640x924 Pixel (animated)</h4></li>
                </ul>
			</div>

			<div class="subtcnt" id="set3">
			<div class="sub-ttl">Set 3</div>
				<ul class="bmn-ban">
	                <li><img src="/banners/729x90.jpg" alt=""> <h4>729x90 Pixel</h4></li>
	                <li><img src="/banners/729x90.gif" alt=""> <h4>729x90 Pixel (animated)</h4></li>
	                <li><span><img src="/banners/468x60.jpg" alt=""> <h4>468x60 Pixel</h4></span><span><img src="/banners/468x60.gif" alt=""> <h4>468x60 Pixel (animated)</h4></span></li>
	                <li><span><img src="/banners/320x100.jpg" alt=""> <h4>320x100 Pixel</h4></span><span><img src="/banners/320x100.gif" alt=""> <h4>320x100 Pixel (animated)</h4></span></li>
	                <li><span><img src="/banners/300x250.jpg" alt=""> <h4>300x250 Pixel</h4></span><span><img src="/banners/300x250.gif" alt=""> <h4>300x250 Pixel (animated)</h4></span></li>
	                <li><span><img src="/banners/160x600.jpg" alt=""> <h4>160x600 Pixel</h4></span><span><img src="/banners/160x600.gif" alt=""> <h4>160x600 Pixel (animated)</h4></span></li>
	                <li><img src="/banners/602x583.jpg" alt=""> <h4>602x583 Pixel</h4></li>
	                <li><img src="/banners/602x583.gif" alt=""> <h4>602x583 Pixel (animated)</h4></li>
	                <li><img src="/banners/1640x924.jpg" alt=""> <h4>1640x924 Pixel</h4></li>
	                <li><img src="/banners/1640x924.gif" alt=""> <h4>1640x924 Pixel (animated)</h4></li>
                </ul>
			</div>

			</div>

			</div>
               
			<div class="ntab-cont" id="vidclps">
               tab 4
			</div>

			<div class="ntab-cont" id="mrktpln">
               
			<div class="blk-bar">Commissions on revenues</div>
<div class="top-ecomm">
   <h4>You earn 6.5 % of all revenues which happen inside your fancci network.</h4>
   <p>(picture &amp; video sales, webcam services, live streaming, fan subscriptions and more)</p>
</div>
<div class="deTable sml btxt">
   <table id="preComm" width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
      <tbody>
         <tr class="glybg">
            <td>Level</td>
            <td>Commission</td>
         </tr>
         <tr>
            <td>1</td>
            <td>2.6</td>
         </tr>
         <tr>
            <td>2</td>
            <td>1.3</td>
         </tr>
         <tr>
            <td>3</td>
            <td>1.3</td>
         </tr>
         <tr>
            <td>4</td>
            <td>0.65</td>
         </tr>
         <tr>
            <td>5</td>
            <td>0.325</td>
         </tr>
         <tr>
            <td>6</td>
            <td>0.325</td>
         </tr>
      </tbody>
   </table>
</div>
<div class="blk-bar">Commissions on consumer spendings</div>
<div class="top-ecomm">
   <p>Once a customer in your first line has spend money inside the fancci platform you get 13% commission.</p>
</div>
<div class="top-ecomm">
   <div class="deTable sml btxt">
      <table id="preComm" width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
         <tbody>
            <tr class="glybg">
               <td>Level</td>
               <td>Commission</td>
            </tr>
            <tr>
               <td>1</td>
               <td>13%</td>
            </tr>
         </tbody>
      </table>
   </div>
</div>
<div class="blk-bar">Commissions on company shares sold in publice sale</div>
<div class="top-ecomm">
   <p>Once we have the approval of the financial regulation authorities to start the public sale of company shares you get commissions once a partner in your network has bought company shares.</p>
</div>
<div class="deTable sml btxt">
   <table id="preComm" width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
      <tbody>
         <tr class="glybg">
            <td>Level</td>
            <td>Commission</td>
         </tr>
         <tr>
            <td>1</td>
            <td>10%</td>
         </tr>
         <tr>
            <td>2</td>
            <td>10%</td>
         </tr>
         <tr>
            <td>3</td>
            <td>5%</td>
         </tr>
      </tbody>
   </table>
</div>
<div class="top-ecomm"><small><strong>* LEGAL NOTICE - NO PUBLIC OFFERING OF SECURITIES.</strong><br> A bitcci Equity Token represents a tokenized preferred share of the bitcci Group AG. bitcci Equity Tokens are currently NOT available for purchase by the public or retail investors and we are not communicating any offerings, pricing information, etc. to the public until we have received approval from financial regulators. This approval process includes the approval of a securities prospectus containing detailed information about the project, the company and potential risks to protect retail investors. Shares (bitcci Equity Token) of the bitcci Group AG are currently awarded exclusively as a free bonus for activities &amp; performance inside the fancci platform. A purchase of shares in the form of a public offering by retail investors is only possible after approval of the offering prospectus by the financial supervisory authorities. Of course qualified investors can contact us already via email to 'investment@bitcci.ag' to talk about investment opportunities.</small></div>
<div class="blk-bar">further income opportunities in planning</div>
<div class="top-ecomm">
   <p>The fancci Platform is growing fast and we are planning more income opportunities in the future.</p>
</div>

			</div>

     
            </div>
         
        </div>


  

@stop
