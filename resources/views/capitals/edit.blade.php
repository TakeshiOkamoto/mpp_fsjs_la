@extends('layouts.app')

@section('title', '会計年度 - 編集')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">ホーム</a></li> 
    <li class="breadcrumb-item"><a href="{{ url('capitals') }}">会計年度</a></li> 
    <li class="breadcrumb-item active">編集</li>     
  </ol> 
</nav>    
<p></p>
<p></p>
<h1>会計年度の編集</h1>
<p></p>

@include('capitals._form', ['form_action' => url('capitals/' . $item->id)])

<p></p>
<a href="{{ url('capitals') }}">戻る</a>
<p></p>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">ホーム</a></li> 
    <li class="breadcrumb-item"><a href="{{ url('capitals') }}">会計年度</a></li> 
    <li class="breadcrumb-item active">編集</li>     
  </ol> 
</nav>    
<p></p>
@endsection