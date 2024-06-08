<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Include necessary meta tags, stylesheets, and scripts -->
    @include('template.head')
</head>
<body>
    @include('elements.impersonation-header')
    @include('template.header')
    <div id="app">
        <video-chat :allusers="{{ $users }}" :authUserId="{{ auth()->id() }}" turn_url="{{ env('TURN_SERVER_URL') }}"
        turn_username="{{ env('TURN_SERVER_USERNAME') }}" turn_credential="{{ env('TURN_SERVER_CREDENTIAL') }}" />
    </div>
    @include('template.footer')
    @include('template.jsVars')
    @include('template.jsAssets')
    @include('elements.language-selector-box')

    <!-- Include your app.js file -->
    <script src="{{ mix('js/app.js') }}"></script>

    <!-- Additional script to log callee_id -->

</body>
</html>
