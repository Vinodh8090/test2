@if(!Auth::user()->email_verified_at) @include('elements.resend-verification-email-box') @endif

@if(getSetting('ai.open_ai_enabled'))
    @include('elements.suggest-description')
@endif

<form method="POST" action="{{route('my.settings.profile.save',['type'=>'profile'])}}">
    @csrf
    @include('elements.dropzone-dummy-element')
<div class="big-ttl">Manage your Model profile</div>
   <div class="manage-model">
	  <div class="mm-progress"><span style="width: 81%;">81% <small>PROGRESS</small></span></div>
	  <div class="mm-drop">
		 <div class="mmslt"><i class="fa fa-th-list"></i> Select Profile Steps</div>
		 <ul style="display: none;">
			<li>
			   <a>
				  Profile Pictures 
				  <div class="sub-prog"><span class="ready" style="width: 100%;">100% Ready</span></div>
			   </a>
			</li>
			<li>
			   <a>
				  Personal Infos 
				  <div class="sub-prog"><span class="half-ready" style="width: 75%;">75% Ready</span></div>
			   </a>
			</li>
			<li>
			   <a>
				  Appearance Infos 
				  <div class="sub-prog"><span class="half-ready" style="width: 25%;">25% Ready</span></div>
			   </a>
			</li>
			<li>
			   <a>
				  Favourites &amp; Habits 
				  <div class="sub-prog"><span class="not-ready" style="width: 0%;">0% Ready</span></div>
			   </a>
			</li>
			<li>
			   <a>
				  Language Skills 
				  <div class="sub-prog"><span class="ready" style="width: 100%;">100% Ready</span></div>
			   </a>
			</li>
			<li>
			   <a>
				  Welcome Message 
				  <div class="sub-prog"><span class="ready" style="width: 100%;">100% Ready</span></div>
			   </a>
			</li>
		 </ul>
	  </div>
	  <div class="saveprev">
	  <button><i class="fa fa-floppy-o"></i> Save All</button> <a href="{{route('profile',['username'=>Auth::user()->username])}}"><i class="fa fa-eye"></i> Preview Profile</a>
	  </div>
   </div>
   
   @if(session('success'))
        <div class="alert alert-success text-white font-weight-bold mt-2" role="alert">
            {{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

   <div id="mms1" class="mm-cont">
	  <div class="pinfo">
		 <div class="pdintro">
			<div class="pi-txt">Here you can create your online profile which is published within the fancci platform and the bitcci ecosystem. The more detailed info you enter, the better the visibility of your profile will be.</div>
			<button type="submit">Save Personal Info </button>
		 </div>
		 <hr>
		 <div class="ttl-bart">Profile Pictures</div>
		 <div class="pro-avatar">
		 <div class="avatar-holder">
			<img class="card-img-top" alt="" src="{{Auth::user()->avatar}}">
            <div class="upload-button" data-toggle="tooltip" data-placement="top" title="{{__('Upload avatar')}}">Change Main Picture</div>
		</div>
		 </div>
		 <div class="gall-photos">
			<h5>Other profile pictures </h5>
			<div onclick="document.getElementById('selectedFileProfilePic').click();" class="add-photo">
			   <div class="up-icon"><i class="fa fa-plus-circle"></i><img src="/img/upload-img.jpg" alt=""></div>
			   <h6>New Picture Upload</h6>
			   <input name="file" type="file" id="selectedFileProfilePic" accept="image/*" style="display: none;">
			</div>
			<div class="added-photo">
			   <div class="img-cont"><img alt="" src="/img/1ed2e6d6-9950-4ed5-8bec-45afad7e3c05.png"></div>
			   <button>Edit</button><button>Delete</button>
			   <div class="inswitch"><label class="switch"><input type="checkbox"><span class="swt-sldr"><span class="yes">Visible</span><span class="no">Invisible</span></span></label></div>
			</div>
			<div class="added-photo inact">
			   <div class="img-cont">
				  <i class="warning-imhq"></i>
				  <div class="cc-error low">
					 <h5>Low image Resolution.</h5>
					 <p>fancci wants to help you to increase your sales. Therefore we recommend to use high quality pictures in public profiles. This will give you better positions in the fancci directory too.</p>
				  </div>
				  <img alt="" src="/img/b9732820-24f6-4a29-9a05-4eac4dbc24f3.png">
			   </div>
			   <button>Edit</button><button>Delete</button>
			   <div class="inswitch"><label class="switch"><input type="checkbox"><span class="swt-sldr"><span class="yes">Visible</span><span class="no">Invisible</span></span></label></div>
			</div>
			<div class="added-photo inact">
			   <div class="img-cont">
				  <i class="warning-imhq"></i>
				  <div class="cc-error low">
					 <h5>Low image Resolution.</h5>
					 <p>fancci wants to help you to increase your sales. Therefore we recommend to use high quality pictures in public profiles. This will give you better positions in the fancci directory too.</p>
				  </div>
				  <img src="/img/7034e194-14b0-4fcc-b207-80338b337e47.png">
			   </div>
			   <button>Edit</button><button>Delete</button>
			   <div class="inswitch"><label class="switch"><input type="checkbox"><span class="swt-sldr"><span class="yes">Visible</span><span class="no">Invisible</span></span></label></div>
			</div>
			<div class="added-photo">
			   <div class="img-cont"><img alt="" src="/img/fe19ee0d-cad5-4c69-9a73-347cac3a1ef7.png"></div>
			   <button>Edit</button><button>Delete</button>
			   <div class="inswitch"><label class="switch"><input type="checkbox"><span class="swt-sldr"><span class="yes">Visible</span><span class="no">Invisible</span></span></label></div>
			</div>
			<div class="gall-photos sml profile-cover-bg">
			   <h5>Profile Header Image </h5>
			   <div class="bgimg"><img class="card-img-top centered-and-cropped" alt="" src="{{Auth::user()->cover}}"></div>
			   <a href="#">Choose from Gallery</a>  <div class="upload-button" data-toggle="tooltip" data-placement="top" title="{{__('Upload cover image')}}">Upload Your Own</div>

			   <!-- <div class="profile-cover-bg">
                <img class="card-img-top centered-and-cropped" src="{{Auth::user()->cover}}">
				<span class="upload-button" style="margin-top:-30px" data-toggle="tooltip" data-placement="top" title="{{__('Upload cover image')}}">
                             @include('elements.icon',['icon'=>'image','variant'=>'medium'])
                        </span>
            	</div> -->
				


			</div>
			<button type="submit">Save Personal Info</button>
			<hr>
			<div class="ttl-bart">What I offer</div>
			<div class="boxpd cat">
			   <div class="ttl-lang">Selling Pictures &amp; Videos</div>
			   <div class="profdrp ryt inswitch"><label class="switch"><input name="havePiercing" type="checkbox"><span class="swt-sldr"><span class="yes">Yes</span><span class="no">No</span></span></label></div>
			</div>
			<div class="boxpd cat">
			   <div class="ttl-lang">Offering Chat via Messenger</div>
			   <div class="profdrp ryt inswitch"><label class="switch"><input name="havePiercing" type="checkbox"><span class="swt-sldr"><span class="yes">Yes</span><span class="no">No</span></span></label></div>
			</div>
			<div class="boxpd cat">
			   <div class="ttl-lang">Offering Live-Webcam</div>
			   <div class="profdrp ryt inswitch"><label class="switch"><input name="havePiercing" type="checkbox"><span class="swt-sldr"><span class="yes">Yes</span><span class="no">No</span></span></label></div>
			</div>
			<div class="boxpd cat">
			   <div class="ttl-lang">Fan Creation / Subscribers</div>
			   <div class="profdrp ryt inswitch"><label class="switch"><input name="havePiercing" type="checkbox"><span class="swt-sldr"><span class="yes">Yes</span><span class="no">No</span></span></label></div>
			</div>
			<hr>
			<div class="ttl-bart">Block my profile in special countries</div>
			<div class="sub-txt"> Please choose one or more countries where your fancci profile must not be visible. <br> Customers who visit your profile link from those blocked countries get a screen "This profile does not exist" </div>
			<div class="boxpd nonum imp">
			   <div class="ttl-lang">Blocked in:</div>
			   <div class="profdrp ryt multilang">
					<input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="ac79e400fc55">
			   </div>
			</div>
			<hr>
			<div class="ttl-bart">Personal Info</div>
			<div class="boxpd long imp">
			   <div class="numpd red">1</div>
			   <div class="ttl-lang">Full Name <i class="med icon-imp-green"></i></div>
			   <div class="profdrp ryt">
			   <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" aria-describedby="emailHelp" value="{{Auth::user()->name}}">
        @if($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{$errors->first('name')}}</strong>
            </span>
        @endif
			   </div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">2</div>
			   <div class="ttl-lang">Username </div>
			   <div class="profdrp ryt">
			   <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" id="username" name="username" aria-describedby="emailHelp" value="{{Auth::user()->username}}">
        @if($errors->has('username'))
            <span class="invalid-feedback" role="alert">
                <strong>{{$errors->first('username')}}</strong>
            </span>
        @endif
			   </div>
			</div>
			<div class="boxpd long imp">
			   <div class="numpd red">3</div>
			   <div class="ttl-lang">Gender </div>
			   <div class="profdrp ryt">
			   <select class="form-control" id="gender" name="gender" >
                    <option value=""></option>
                    @foreach($genders as $gender)
                        <option value="{{$gender->id}}" {{Auth::user()->gender_id == $gender->id ? 'selected' : ''}}>{{__($gender->gender_name)}}</option>
                    @endforeach
                </select>
                @if($errors->has('gender'))
                    <span class="invalid-feedback" role="alert">
                <strong>{{$errors->first('gender')}}</strong>
            </span>
                @endif
			   </div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">4</div>
			   <div class="ttl-lang">Address (City) </div>
			   <div class="profdrp ryt"><input name="address_city" type="text" id="city" maxlength="50"></div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">5</div>
			   <div class="ttl-lang">Address (Country) <i class="med icon-imp-green"></i></div>
			   <div class="profdrp ryt">
				 <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="a28e4ddb1b9c">
			   </div>
			</div>
			<div class="boxpd long imp">
			   <div class="numpd red">6</div>
			   <div class="ttl-lang">Sexual orientation </div>
			   <div class="profdrp ryt">
				 <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="abf29d02df01">
			   </div>
			</div>
			<div class="boxpd long imp">
			   <div class="numpd red">7</div>
			   <div class="ttl-lang">Age <i class="med icon-imp-green"></i></div>
			   <div class="profdrp ryt">
				  <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="ac31c8c4c480">
			   </div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">8</div>
			   <div class="ttl-lang">Occupation </div>
			   <div class="profdrp ryt"><input type="text" name="occupation" id="occupation" maxlength="100"></div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">9</div>
			   <div class="ttl-lang">Character </div>
			   <div class="profdrp ryt multi">
				 <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="ac41d70f9b2f">
			   </div>
			</div>
			<hr>
			<div class="ttl-bart">Appearance Infos</div>
			<div class="boxpd long imp">
			   <div class="numpd red">10</div>
			   <div class="ttl-lang">Body height <small>(cm)</small><i class="med icon-imp-green"></i></div>
			   <div class="profdrp ryt">
				 <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="a6bc4fa092f6">
			   </div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">11</div>
			   <div class="ttl-lang">Clothing size </div>
			   <div class="profdrp ryt">
				  <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="a60a4ae80b88">
			   </div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">12</div>
			   <div class="ttl-lang">Figure </div>
			   <div class="profdrp ryt">
				 <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="a6007b9e2260">
			   </div>
			</div>
			<div class="boxpd long imp">
			   <div class="numpd red">13</div>
			   <div class="ttl-lang">Body weight <small>(kg)</small><i class="med icon-imp-green"></i></div>
			   <div class="profdrp ryt">
				 <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="aa39af54f831">
			   </div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">14</div>
			   <div class="ttl-lang">Shoe size </div>
			   <div class="profdrp ryt">
				  <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="a65bc6410cb4">
			   </div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">15</div>
			   <div class="ttl-lang">Skin colour </div>
			   <div class="profdrp ryt">
				  <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="a462f4995666">
			   </div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">16</div>
			   <div class="ttl-lang">Eye Colour </div>
			   <div class="profdrp ryt">
				 <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="a05b90d0a27e">
			   </div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">17</div>
			   <div class="ttl-lang">Bust </div>
			   <div class="profdrp ryt">
				 <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="a215064d4863">
			   </div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">18</div>
			   <div class="ttl-lang">Bust size </div>
			   <div class="profdrp ryt">
				 <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="a6fac1de7cad">
			   </div>
			</div>
			<div class="boxpd long imp">
			   <div class="numpd red">19</div>
			   <div class="ttl-lang">Cup size <i class="med icon-imp-green"></i></div>
			   <div class="profdrp ryt">
				  <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="a69c62c30364">
			   </div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">20</div>
			   <div class="ttl-lang">Hair </div>
			   <div class="profdrp ryt">
				 <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="a61f2ddd0fc3">
			   </div>
			</div>
			<div class="boxpd long imp">
			   <div class="numpd red">21</div>
			   <div class="ttl-lang">Hair Colour </div>
			   <div class="profdrp ryt">
				  <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="a381e9550446">
			   </div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">22</div>
			   <div class="ttl-lang">Body hair </div>
			   <div class="profdrp ryt">
				 <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="ae1f40bac822">
			   </div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">23</div>
			   <div class="ttl-lang">Intimate Hair </div>
			   <div class="profdrp ryt">
				 <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="a72be57c782b">
			   </div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">24</div>
			   <div class="ttl-lang">Piercings </div>
			   <div class="profdrp ryt inswitch"><label class="switch"><input name="havePiercing" type="checkbox"><span class="swt-sldr"><span class="yes">Yes</span><span class="no">No</span></span></label></div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">25</div>
			   <div class="ttl-lang">Tattoos </div>
			   <div class="profdrp ryt inswitch"><label class="switch"><input name="haveTatoos" type="checkbox"><span class="swt-sldr"><span class="yes">Yes</span><span class="no">No</span></span></label></div>
			</div>
			<hr>
			<div class="ttl-bart">Favourites &amp; Habits</div>
			<div class="boxpd long">
			   <div class="numpd red">26</div>
			   <div class="ttl-lang">Favorite Sex Position</div>
			   <div class="profdrp ryt"><input type="text" name="favPosition"></div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">27</div>
			   <div class="ttl-lang">Favorite Food</div>
			   <div class="profdrp ryt"><input type="text" name="favFood"></div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">28</div>
			   <div class="ttl-lang">Favorite Drink</div>
			   <div class="profdrp ryt"><input type="text" name="favDrink"></div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">29</div>
			   <div class="ttl-lang">Favorite Perfume</div>
			   <div class="profdrp ryt"><input type="text" name="favPerfume"></div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">30</div>
			   <div class="ttl-lang">Hobbies</div>
			   <div class="profdrp ryt"><input type="text" name="hobbies"></div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">31</div>
			   <div class="ttl-lang">Secrets and desires</div>
			   <div class="profdrp ryt"><input type="text" name="secrets"></div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">32</div>
			   <div class="ttl-lang">Things I like</div>
			   <div class="profdrp ryt"><input type="text" name="thingsLiked"></div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">33</div>
			   <div class="ttl-lang">Things I don't like</div>
			   <div class="profdrp ryt"><input type="text" name="thingsNotLiked"></div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">34</div>
			   <div class="ttl-lang">Smoker </div>
			   <div class="profdrp ryt">
				  <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="ac7ed04d5348">
			   </div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">35</div>
			   <div class="ttl-lang">Drink Alcohol</div>
			   <div class="profdrp ryt">
				 <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="a73cb1eeeb37">
			   </div>
			</div>
			<hr>
			<div class="ttl-bart">Language Skills</div>
			<div class="boxpd long imp">
			   <div class="numpd red">36</div>
			   <div class="ttl-lang sml">Language </div>
			   <div class="profdrp sml">
				  <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="a404b276ce94">
			   </div>
			   <div class="ttl-lang sml">Skill Level</div>
			   <div class="profdrp sml">
				  <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="a0f0defb67e4">
			   </div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">37</div>
			   <div class="ttl-lang sml">Language </div>
			   <div class="profdrp sml">
				 <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="a2a2a73a913c">
			   </div>
			   <div class="ttl-lang sml">Skill Level</div>
			   <div class="profdrp sml">
				 <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="ae48ce3495f9">
			   </div>
			</div>
			<div class="boxpd long">
			   <div class="numpd red">38</div>
			   <div class="ttl-lang sml">Language </div>
			   <div class="profdrp sml">
				 <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="a66d9058c6b9">
			   </div>
			   <div class="ttl-lang sml">Skill Level</div>
			   <div class="profdrp sml">
				  <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="a02fb3c00243">
			   </div>
			</div>
			<hr>
			<div class="ttl-bart">Social Media Links &amp; Website</div>
			<div class="smboxp">
			   <div class="smbp-col"><i class="fa fa-facebook-square"></i><input name="facebookLink" type="text" placeholder="Enter your facebook Link here"></div>
			   <div class="smbp-col"><i class="fa fa-instagram"></i><input type="text" name="instagramLink" placeholder="Enter your Instagram Link here"></div>
			</div>
			<div class="smboxp">
			   <div class="smbp-col"><i class="fa fa-twitter-square"></i><input name="twitterLink" type="text" placeholder="Enter your Twitter Link here"></div>
			   <div class="smbp-col"><i class="tiktok"></i><input name="tiktokLink" type="text" placeholder="Enter your Tiktok Link here"></div>
			</div>
			<div class="smboxp">
			   <div class="smbp-col"><i class="fa fa-desktop"></i><input type="url" class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" id="website" name="website" aria-describedby="emailHelp" value="{{Auth::user()->website}}">
        @if($errors->has('website'))
            <span class="invalid-feedback" role="alert">
                <strong>{{$errors->first('website')}}</strong>
            </span>
        @endif</div>
			   <div class="smbp-col"><i class="fa fa-desktop"></i><input type="text" name="websiteLink2" placeholder="Enter your Website Link here"></div>
			</div>
			<div class="boxpd tags">
			   <div class="ttl-lang"><i class="fa fa-tags"></i> Tags </div>
			   <div class="profdrp ryt multi">
				  <input aria-autocomplete="list" type="text" autocorrect="off" autocapitalize="off" autocomplete="adcff9f9cc6d">
			   </div>
			</div>
			<hr id="pwel">
			<div class="ttl-bart">Welcome Message</div>
			<div class="welbox">
			   <div class="pdintro">
				  <p>Please write a Welcome message for your customers. (Max 300 characters)</p>
			   </div>
			   <textarea name="welcomeMessage" id="profile-message" cols="30" rows="4" maxlength="300" placeholder="(Max 300 characters)"></textarea>
			</div>
			<button type="submit">Save Personal Info</button>
		 </div>
	  </div>
	  <div class="popupbgsltd">
		 <div class="uploadp">
			<div class="popttl"> Choose the background for your bitcci profile page <i class="fa fa-times-circle"></i></div>
			<div class="fdrp">
			   <span>Choose banner category</span>
			   <ul class="bgtabs">
				  <li id="btnflw">Flowers</li>
				  <li id="btnfood">Food</li>
			   </ul>
			</div>
			<div id="bgflwr" class="bgtab active">
			   <ul class="hdrbgslt">
				  <li><label for="bghdr1_1"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_1.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_1"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_2"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_2.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_2"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_3"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_3.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_3"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_4"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_4.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_4"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_5"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_5.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_5"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_6"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_6.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_6"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_7"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_7.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_7"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_8"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_8.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_8"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_9"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_9.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_9"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_10"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_10.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_10"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_11"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_11.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_11"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_12"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_12.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_12"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_13"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_13.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_13"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_14"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_14.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_14"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_15"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_15.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_15"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_16"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_16.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_16"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_17"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_17.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_17"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_18"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_18.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_18"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_19"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_19.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_19"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_20"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_20.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_20"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_21"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_21.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_21"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_22"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_22.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_22"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_23"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_23.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_23"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_24"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_24.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_24"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_25"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_25.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_25"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_26"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_26.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_26"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_27"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_27.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_27"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_28"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_28.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_28"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_29"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_29.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_29"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_30"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_30.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_30"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_31"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_31.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_31"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr1_32"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/flower_32.jpg"><input type="radio" name="bghdrgrp" id="bghdr1_32"><i class="radbtn"></i></label></li>
			   </ul>
			</div>
			<div id="bgfood" class="bgtab">
			   <ul class="hdrbgslt">
				  <li><label for="bghdr5_1"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/food_1.jpg"><input type="radio" name="bghdrgrp" id="bghdr5_1"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr5_2"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/food_2.jpg"><input type="radio" name="bghdrgrp" id="bghdr5_2"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr5_3"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/food_3.jpg"><input type="radio" name="bghdrgrp" id="bghdr5_3"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr5_4"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/food_4.jpg"><input type="radio" name="bghdrgrp" id="bghdr5_4"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr5_5"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/food_5.jpg"><input type="radio" name="bghdrgrp" id="bghdr5_5"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr5_6"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/food_6.jpg"><input type="radio" name="bghdrgrp" id="bghdr5_6"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr5_7"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/food_7.jpg"><input type="radio" name="bghdrgrp" id="bghdr5_7"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr5_8"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/food_8.jpg"><input type="radio" name="bghdrgrp" id="bghdr5_8"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr5_9"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/food_9.jpg"><input type="radio" name="bghdrgrp" id="bghdr5_9"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr5_10"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/food_10.jpg"><input type="radio" name="bghdrgrp" id="bghdr5_10"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr5_11"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/food_11.jpg"><input type="radio" name="bghdrgrp" id="bghdr5_11"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr5_12"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/food_12.jpg"><input type="radio" name="bghdrgrp" id="bghdr5_12"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr5_13"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/food_13.jpg"><input type="radio" name="bghdrgrp" id="bghdr5_13"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr5_14"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/food_14.jpg"><input type="radio" name="bghdrgrp" id="bghdr5_14"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr5_15"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/food_15.jpg"><input type="radio" name="bghdrgrp" id="bghdr5_15"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr5_16"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/food_16.jpg"><input type="radio" name="bghdrgrp" id="bghdr5_16"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr5_17"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/food_17.jpg"><input type="radio" name="bghdrgrp" id="bghdr5_17"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr5_18"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/food_18.jpg"><input type="radio" name="bghdrgrp" id="bghdr5_18"><i class="radbtn"></i></label></li>
				  <li><label for="bghdr5_19"><img alt="" src="https://d1dsq2r56d1e1h.cloudfront.net/escortbackground/food_19.jpg"><input type="radio" name="bghdrgrp" id="bghdr5_19"><i class="radbtn"></i></label></li>
			   </ul>
			</div>
			<div class="savebtn"><input type="submit" value="Save"></div>
		 </div>
	  </div>
   </div>
   </form>


<!-- <form method="POST" action="{{route('my.settings.profile.save',['type'=>'profile'])}}">
    @csrf
    @include('elements.dropzone-dummy-element')
    <div class="mb-4">
        <div class="">
            <div class="card profile-cover-bg">
                <img class="card-img-top centered-and-cropped" src="{{Auth::user()->cover}}">
                <div class="card-img-overlay d-flex justify-content-center align-items-center">
                    <div class="actions-holder d-none">

                        <div class="d-flex">
                        <span class="h-pill h-pill-accent pointer-cursor mr-1 upload-button" data-toggle="tooltip" data-placement="top" title="{{__('Upload cover image')}}">
                             @include('elements.icon',['icon'=>'image','variant'=>'medium'])
                        </span>
                            <span class="h-pill h-pill-accent pointer-cursor" onclick="ProfileSettings.removeUserAsset('cover')" data-toggle="tooltip" data-placement="top" title="{{__('Remove cover image')}}">
                            @include('elements.icon',['icon'=>'close','variant'=>'medium'])
                        </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card avatar-holder">
                <img class="card-img-top" src="{{Auth::user()->avatar}}">
                <div class="card-img-overlay d-flex justify-content-center align-items-center">
                    <div class="actions-holder d-none">
                        <div class="d-flex">
                        <span class="h-pill h-pill-accent pointer-cursor mr-1 upload-button" data-toggle="tooltip" data-placement="top" title="{{__('Upload avatar')}}">
                            @include('elements.icon',['icon'=>'image','variant'=>'medium'])
                        </span>
                            <span class="h-pill h-pill-accent pointer-cursor" onclick="ProfileSettings.removeUserAsset('avatar')" data-toggle="tooltip" data-placement="top" title="{{__('Remove avatar')}}">
                             @include('elements.icon',['icon'=>'close','variant'=>'medium'])
                        </span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success text-white font-weight-bold mt-2" role="alert">
            {{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="form-group">
        <label for="username">{{__('Username')}}</label>
        <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" id="username" name="username" aria-describedby="emailHelp" value="{{Auth::user()->username}}">
        @if($errors->has('username'))
            <span class="invalid-feedback" role="alert">
                <strong>{{$errors->first('username')}}</strong>
            </span>
        @endif

    </div>
    <div class="form-group">
        <label for="name">{{__('Full name')}}</label>
        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" aria-describedby="emailHelp" value="{{Auth::user()->name}}">
        @if($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{$errors->first('name')}}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <div class="d-flex justify-content-between">
            <label for="bio">
                {{__('Bio')}}
            </label>
            <div>
                @if(getSetting('ai.open_ai_enabled'))
                    <a href="javascript:void(0)" onclick="{{"AiSuggestions.suggestDescriptionDialog();"}}" data-toggle="tooltip" data-placement="left" title="{{__('Use AI to generate your description.')}}">{{trans_choice("Suggestion",2)}}</a>
                @endif
            </div>
        </div>
        <textarea class="form-control {{ $errors->has('bio') ? 'is-invalid' : '' }}" id="bio" name="bio" rows="3" spellcheck="false">{{Auth::user()->bio}}</textarea>
        @if($errors->has('bio'))
            <span class="invalid-feedback" role="alert">
                <strong>{{$errors->first('bio')}}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="birthdate">{{__('Birthdate')}}</label>
        <input type="date" class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" id="birthdate" name="birthdate" aria-describedby="emailHelp"  value="{{Auth::user()->birthdate}}" max="{{$minBirthDate}}">
        @if($errors->has('birthdate'))
            <span class="invalid-feedback" role="alert">
                <strong>{{$errors->first('birthdate')}}</strong>
            </span>
        @endif
    </div>

    <div class="d-flex flex-row">
        <div class="{{getSetting('profiles.allow_gender_pronouns') ? 'w-50' : 'w-100'}} pr-2">
            <div class="form-group">
                <label for="gender">{{__('Gender')}}</label>
                <select class="form-control" id="gender" name="gender" >
                    <option value=""></option>
                    @foreach($genders as $gender)
                        <option value="{{$gender->id}}" {{Auth::user()->gender_id == $gender->id ? 'selected' : ''}}>{{__($gender->gender_name)}}</option>
                    @endforeach
                </select>
                @if($errors->has('gender'))
                    <span class="invalid-feedback" role="alert">
                <strong>{{$errors->first('gender')}}</strong>
            </span>
                @endif
            </div>
        </div>

        @if(getSetting('profiles.allow_gender_pronouns'))
            <div class="w-50 pl-2">
                <div class="form-group">
                    <label for="pronoun">{{__('Gender pronoun')}}</label>
                    <input class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" id="pronoun" name="pronoun" aria-describedby="emailHelp"  value="{{Auth::user()->gender_pronoun}}">
                    @if($errors->has('pronoun'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{$errors->first('pronoun')}}</strong>
                    </span>
                    @endif
                </div>
            </div>
        @endif

    </div>

   
    <button type="submit" style="font-size:18px;color:#000">{{__('Save')}}</button>
</form> -->
