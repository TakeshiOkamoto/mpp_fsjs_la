@extends('layouts.app')

@section('title', "仕訳 - 新規登録")

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">ホーム</a></li> 
    <li class="breadcrumb-item"><a href="{{ url('capitals') }}">会計年度</a></li> 
    <li class="breadcrumb-item active">仕訳の新規登録</li>     
  </ol> 
</nav>    
<p></p>
<h1>仕訳の新規登録</h1>
<p></p>

@include('journals._form', ['form_action' => url('journals')])

<p><br></p>
<a href="{{ url('journals?yyyy=' . $yyyy) }}">戻る</a>
<p></p>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">ホーム</a></li> 
    <li class="breadcrumb-item"><a href="{{ url('capitals') }}">会計年度</a></li> 
    <li class="breadcrumb-item active">仕訳の新規登録</li>     
  </ol> 
</nav>    
<p></p>
@endsection