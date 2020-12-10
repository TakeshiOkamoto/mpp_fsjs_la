@extends('layouts.app')

@section('title', '勘定科目 - 表示')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">ホーム</a></li> 
    <li class="breadcrumb-item"><a href="{{ url('accounts') }}">勘定科目</a></li> 
    <li class="breadcrumb-item active">表示</li>     
  </ol> 
</nav>    
<p></p>

<h1>{{$item->name}}</h1>
<p></p>

<p>
  <strong>{{trans('validation.attributes.types')}} : </strong>
  {{$item->types}}
</p>

<p>
  <strong>{{trans('validation.attributes.expense_flg')}} : </strong>
  {{$item->expense_flg}}
</p>

<p>
  <strong>{{trans('validation.attributes.sort_list')}} : </strong>
  {{$item->sort_list}}
</p>

<p>
  <strong>{{trans('validation.attributes.sort_expense')}} : </strong>
  {{$item->sort_expense}}
</p>

<p>
  <strong>{{trans('validation.attributes.created_at')}} : </strong>
  {{$item->created_at}}
</p>

<p>
  <strong>{{trans('validation.attributes.updated_at')}} : </strong>
  {{$item->updated_at}}
</p>


<a href="{{ url('accounts/' . $item->id . '/edit')}}">編集</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="{{ url('accounts')}}">戻る</a>
<p></p>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">ホーム</a></li> 
    <li class="breadcrumb-item"><a href="{{ url('accounts') }}">勘定科目</a></li> 
    <li class="breadcrumb-item active">表示</li>     
  </ol> 
</nav>    
<p></p>
@endsection
