@extends('layouts.user-no-nav')
@section('page_title', __('Buy FANCCI Credits'))

@section('styles')
<link href="{{asset('/css/buycredits.css')}}" rel="stylesheet">
@stop




@section('content')

<div class="row">
     <div class="min-vh-100 border-right col-12 pr-md-0">
        <div class="pt-4 d-flex justify-content-between align-items-center px-3 pb-3 border-bottom">
            <h5 class="text-bold {{(Cookie::get('app_theme') == null ? (getSetting('site.default_user_theme') == 'dark' ? '' : 'text-dark-r') : (Cookie::get('app_theme') == 'dark' ? '' : 'text-dark-r'))}}">{{__('Buy FANCCI Credits')}}</h5>
        </div>

<div class="bc-top">
   <h4>Select one of the credit packages:</h4>
   <div class="value-slt">
      <h5>Display the values in:</h5>
      <div class="dedrp">
         <select name="" id="">
            <option value="EUR">EUR</option>
            <option value="USD">USD</option>
            <option value="CHF">CHF</option>
         </select>
      </div>
   </div>
</div>
<div class="ebc-opt">
   <input type="radio" name="creditopt" id="credits100">
   <label for="credits100" class="ebc-box">
      <div class="ebc-inn">
         <h3>100</h3>
         <h4>FANCCI credits</h4>
         <p>10 EUR</p>
      </div>
      <hr>
      <span>Buy FANCCI credits</span>
   </label>
   <input type="radio" name="creditopt" id="credits250">
   <label for="credits250" class="ebc-box">
      <div class="ebc-inn">
         <h3>250</h3>
         <h4>FANCCI credits</h4>
         <p>25 EUR</p>
      </div>
      <hr>
      <span>Buy FANCCI credits</span>
   </label>
   <input type="radio" name="creditopt" id="credits500">
   <label for="credits500" class="ebc-box">
      <div class="ebc-inn">
         <h3>500</h3>
         <h4>FANCCI credits</h4>
         <p>50 EUR</p>
         <span>+ 50 credits FREE!</span>
      </div>
      <hr>
      <span>Buy FANCCI credits</span>
   </label>
   <input type="radio" name="creditopt" id="credits1k">
   <label for="credits1k" class="ebc-box">
      <div class="ebc-inn">
         <h3>1000</h3>
         <h4>FANCCI credits</h4>
         <p>100 EUR</p>
         <span>+ 100 credits FREE!</span>
      </div>
      <hr>
      <span>Buy FANCCI credits</span>
   </label>
</div>
<div class="big-ttl">Choose your Payment Method</div>
<div class="pay-opt">
   <div class="paym-ebox">
      <span><img src="/img/credit-card.png" alt="icon"></span>
      <div class="pmr">
         <h3>Credit Card</h3>
         <h4>You get 0 FANCCI credits</h4>
		 <a class="pnk-btn">Payment with Credit Card</a>
      </div>
   </div>
   <div class="paym-ebox">
      <span><img src="/img/cryptos.png" alt="icon"></span>
      <div class="pmr">
         <h3>Crypto</h3>
         <h4>You get 0 FANCCI credits</h4>
		 <p>Choose from 60 Cryptocurrencies</p>
      <a class="pnk-btn">Pay with Cryptos</a>
      </div>
   </div>
   <div class="paym-ebox">
      <span><img src="/img/coinbase.png" alt="icon"></span>
      <div class="pmr">
         <h3>Coinbase</h3>
         <h4>You get 0 FANCCI credits</h4>
		 <a class="pnk-btn">Pay with Coinbase</a>
      </div>
     
   </div>
   <div class="paym-ebox">
      <i class="coming-soon"></i><span><img src="/img/cc-cash-coin-blu.png" alt="icon"></span>
      <div class="pmr">
         <h3>CC Cash</h3>
         <h4>You get 0 FANCCI credits</h4>
		 <a class="pnk-btn">Coming in 8/2024</a>
      </div>      
   </div>
</div>		
     
    </div>
</div>


  

@stop
