@extends('layouts.app')

@section('title', '勘定科目 - 編集')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">ホーム</a></li> 
    <li class="breadcrumb-item"><a href="{{ url('accounts') }}">勘定科目</a></li> 
    <li class="breadcrumb-item active">編集</li>     
  </ol> 
</nav>    
<p></p>
<p></p>
<h1>勘定科目の編集</h1>
<p></p>

@include('accounts._form', ['form_action' => url('accounts/' . $item->id)])

<p></p>
<a href="{{ url('accounts') }}">戻る</a>
<p></p>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">ホーム</a></li> 
    <li class="breadcrumb-item"><a href="{{ url('accounts') }}">勘定科目</a></li> 
    <li class="breadcrumb-item active">編集</li>     
  </ol> 
</nav>    
<p></p>
@endsection