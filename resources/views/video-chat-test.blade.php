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
        <example-component/>
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
