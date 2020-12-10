<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<title>@yield('title')</title>
<meta name="robots" content="noindex, nofollow">
<meta name="keywords" content="@yield('keywords')">
<meta name="description" content="@yield('description')">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" media="all" href="{{url('css/bootstrap.min.css')}}">
<link rel="stylesheet" media="all" href="{{url('css/terminal.css')}}">
<script src="{{url('js/common.js')}}"></script>
</head>
<body>

{{-- ヘッダ --}}
<nav class="navbar navbar-expand-md navbar-light bg-primary">
  <div class="navbar-brand text-white">
    {{ trans('validation.attributes.app_name') }}
  </div>
  <ul class="navbar-nav ml-auto">
      @if (session()->has('name'))
      <li class="nav-item">
        <a class="nav-link" style="color:#fff;" href="{{ url('/') }}">ホーム</a>
      </li>    
      <li class="nav-item">
        <a class="nav-link" style="color:#fff;" href="{{ url('capitals') }}">会計年度</a>
      </li>            
      <li class="nav-item">
        <a class="nav-link" style="color:#fff;" href="{{ url('accounts') }}">勘定科目</a>
      </li>    
      <li class="nav-item">
        <a class="nav-link" style="color:#fff;" href="{{ url('logout') }}">ログアウト</a>
      </li>  
      @endif
  </ul>
</nav>

<div class="container">

  {{-- フラッシュ --}}
  @if(session()->has('flash_msg'))
    @if (session('flash_flg') === 1)
      <div class="alert alert-success" id="msg_notice">{{session('flash_msg')}}</div>
    @endif
    @if (session('flash_flg') === 0)
      <div class="alert alert-danger" id="msg_alert">{{session('flash_msg')}}</div>  
    @endif
    {{ session()->forget('flash_msg')}}
    {{ session()->forget('flash_flg')}}    
  @endif  
  
  {{-- メイン --}}
  <div>
    @yield('content')
  </div>
  
  {{-- フッタ --}}
  <nav class="container bg-primary p-2 text-center">
    <div class="text-center text-white">
      {{ trans('validation.attributes.en_app_name') }}<br>
      Copyright 2020 Takeshi Okamoto All Rights Reserved.
    </div>
  </nav>   
</div>
</body>
</html>
