<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="{{__('IE=edge')}}">
    <meta name="viewport" content="{{__('width=device-width, initial-scale=1.0')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@hasSection('title') @yield('title') | @endif {{ get_option('general')['title'] ?? config('app.name') }}</title>
    @include('layouts.partials.css')
</head>
<body>

<!-- Side Bar Start -->
@include('layouts.partials.side-bar')
<!-- Side Bar End -->
<div class="section-container">
    <!-- header start -->
    @include('layouts.partials.header')
    <!-- header end -->
    <!-- erp-state-overview-section start -->
    @yield('main_content')
    <!-- erp-state-overview-section end -->

    <footer class="container-fluid d-flex align-items-center justify-content-center justify-content-sm-between flex-wrap py-3 mt-4 ms-0 bg-white">
        <p class="mb-0 me-3">© 2023 Acnoo, all rights reserved.</p>
        <p class="mb-0">Development By: acnoo</p>
    </footer>
    @stack('modal')
</div>

@include('layouts.partials.script')
</body>
</html>
