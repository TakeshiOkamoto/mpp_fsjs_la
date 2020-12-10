@extends('layouts.app')

@section('title', "会計年度 - 新規登録")

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">ホーム</a></li> 
    <li class="breadcrumb-item"><a href="{{ url('capitals') }}">会計年度</a></li> 
    <li class="breadcrumb-item active">新規作成</li>     
  </ol> 
</nav>    
<p></p>
<h1>新規登録 - 会計年度</h1>
<p></p>

@include('capitals._form', ['form_action' => url('capitals')])

<p></p>
<a href="{{ url('capitals') }}">戻る</a>
<p></p>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">ホーム</a></li> 
    <li class="breadcrumb-item"><a href="{{ url('capitals') }}">会計年度</a></li> 
    <li class="breadcrumb-item active">新規作成</li>     
  </ol> 
</nav>    
<p></p>
@endsection