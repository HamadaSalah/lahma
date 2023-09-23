<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('dashboard/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('dashboard/assets/img/favicon.png')}}">
  <title>
    الذهبية للحوم | الادمن
  </title>
  <!--     Fonts and icons     -->
  {{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Noto+Sans:300,400,500,600,700,800|PT+Mono:300,400,500,600,700" rel="stylesheet" /> --}}
  <!-- Nucleo Icons -->
  <link href="{{asset('dashboard/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('dashboard/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/349ee9c857.js" crossorigin="anonymous"></script>
  <link href="{{asset('dashboard/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <script src="{{ asset('dashboard/assets/js/jquery-1.11.1.min.js') }}"></script>

  <link id="pagestyle" href="{{asset('dashboard/assets/css/corporate-ui-dashboard.css?v=1.0.0')}}" rel="stylesheet" />
  {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500&display=swap" rel="stylesheet"> --}}
  <link id="pagestyle" href="{{asset('dashboard/assets/css/dashboard.css')}}" rel="stylesheet" />
  @stack('styles')
</head>

<body class="g-sidenav-show rtl bg-gray-100">
    @include('Admin.layouts.aside')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
