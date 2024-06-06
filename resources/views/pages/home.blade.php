@extends('layouts.generic')

@section('page_description', getSetting('site.description'))
@section('share_url', route('home'))
@section('share_title', getSetting('site.name') . ' - ' . getSetting('site.slogan'))
@section('share_description', getSetting('site.description'))
@section('share_type', 'article')
@section('share_img', GenericHelper::getOGMetaImage())

@section('scripts')
    <script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "Organization",
    "name": "{{getSetting('site.name')}}",
    "url": "{{getSetting('site.app_url')}}",
    "address": ""
  }
</script>
@stop

@section('styles')
    {!!
        Minify::stylesheet([
            '/css/pages/home.css',
            '/css/pages/search.css',
         ])->withFullUrl()
    !!}
@stop

@section('content')
   



<ul class="home-list">
@if(count($featuredMembers))
@foreach($featuredMembers as $member)
<li class="profileonly">@include('elements.vertical-member-card',['profile' => $member])</li>
@endforeach
@endif
</ul>

<div class="sub-hdr">FANCCI closed Beta is running...</div>
<div class="prize-ttl"><h3>FANCCI is invite only right now.</h3></div>
<div class="main-txt"><div class="inner"><h3>You need an invitation from a registered FANCCI Model, Agency or Affiliate, to join the FANCCI network. Please ask the person who have invited you to FANCCI to share a link with you.</h3><hr></div></div>



   
@stop
