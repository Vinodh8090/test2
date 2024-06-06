<a href="{{route('profile',['username'=>$profile->username])}}">
    <div class="img-cont">
        <i class="new-badge"></i>
        <span><img alt="{{$profile->name}}" class="profile-img" src="{{$profile->avatar}}"></span>
        <ul class="mstat">
            <li>VIP</li>
            <li>NEW</li>
            <li>VERIF.</li>
        </ul>
        <!-- <ul class="hvr-icons">
            <li><img src="/img/icon-date.png" alt="Date"> Date</li>
            <li><img src="/img/icon-fans.png" alt="Fans"> Fans</li>
            <li><img src="/img/icon-gallery.png" alt="Gallery"> Gallery</li>
            <li><img src="/img/icon-chat.png" alt="Chat"> Chat</li>
            <li><img src="/img/icon-cam.png" alt="Cam"> Cam</li>
        </ul> -->
        <div class="m-mail chat"><a class="chat-btn" href="/chat/Satang"><img src="/img/icon-chat.png" alt=""> Chat</a></div>
        <div class="model-name">{{$profile->name}}</div>
    </div>
    <div class="btm-loc"><img alt="flag" src="/img/flags/th.png"> Chonburi, TH</div>
</a>