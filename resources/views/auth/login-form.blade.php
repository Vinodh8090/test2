<form method="POST" action="{{ route('login') }}">
    @csrf
    @if(getSetting('social-login.facebook_client_id') || getSetting('social-login.twitter_client_id') || getSetting('social-login.google_client_id'))
        <div class="my-1">
            <p class="mb-0">
                {{__("Don't have an account?")}}
                @if(isset($mode) && $mode == 'ajax')
                    <a href="javascript:void(0);" onclick="LoginModal.changeActiveTab('register')" class="text-primary text-gradient font-weight-bold">{{__('Sign up')}}</a>
                @else
                    <a href="{{route('register')}}" class="text-primary text-gradient font-weight-bold">{{__('Sign up')}}</a>
                @endif
            </p>
        </div>
    @endif
    <div class="form-group ">
        <div class="">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"  name="email" value="{{ old('email') }}" autocomplete="email" placeholder="{{ __('E-Mail Address') }}" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"  name="password" placeholder="{{ __('Password') }}" autocomplete="current-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>


   
            <button type="submit">
                {{__('Login')}}
            </button>
       

    
        @if (Route::has('password.request'))
            <div class="fgtpass">
                @if(isset($mode) && $mode == 'ajax')
                    <a href="javascript:void(0);" onclick="LoginModal.changeActiveTab('forgot')" class="" id="forgotPass-label">{{ __('Forgot Your Password?') }}</a>
                @else
                    <a href="{{ route('password.request') }}" class="" id="forgotPass-label">{{ __('Forgot Your Password?') }}</a>
                @endif
            </div>
        @endif
  

</form>

@if(!getSetting('social-login.facebook_client_id') && !getSetting('social-login.twitter_client_id') && !getSetting('social-login.google_client_id'))
    <hr>
    <div class=" text-center py-2">
        <p class="">
            {{__("Don't have an account?")}}
            @if(isset($mode) && $mode == 'ajax')
                <a href="javascript:void(0);" onclick="LoginModal.changeActiveTab('register')" class="text-primary text-gradient font-weight-bold">{{__('Sign up')}}</a>
            @else
                <a href="{{route('register')}}" class="text-primary text-gradient font-weight-bold">{{__('Sign up')}}</a>
            @endif
        </p>
    </div>
@endif
