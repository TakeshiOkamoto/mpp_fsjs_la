@extends('layouts.app')

@section('title', "勘定科目 - 新規登録")

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">ホーム</a></li> 
    <li class="breadcrumb-item"><a href="{{ url('accounts') }}">勘定科目</a></li> 
    <li class="breadcrumb-item active">新規作成</li>     
  </ol> 
</nav>    
<p></p>
<h1>新規登録 - 勘定科目</h1>
<p></p>

@include('accounts._form', ['form_action' => url('accounts')])

<p></p>
<a href="{{ url('accounts') }}">戻る</a>
<p></p>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">ホーム</a></li> 
    <li class="breadcrumb-item"><a href="{{ url('accounts') }}">勘定科目</a></li> 
    <li class="breadcrumb-item active">新規作成</li>     
  </ol> 
</nav>    
<p></p>
@endsection