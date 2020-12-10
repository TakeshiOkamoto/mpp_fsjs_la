@extends('layouts.app')

@section('title', '仕訳 - 表示')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">ホーム</a></li> 
    <li class="breadcrumb-item"><a href="{{ url('capitals') }}">会計年度</a></li> 
    <li class="breadcrumb-item active">仕訳の表示</li>     
  </ol> 
</nav>    
<p></p>


<p></p>
<table class="table table-hover">
  <tbody class="thead-default">
    <tr>
      <th>日付</th><td>{{ date('Y/m/d', strtotime($item->yyyy . '/' . $item->mm . '/' . $item->dd)) }}</td>
    </tr>
    <tr>
      <th>{{ trans('validation.attributes.debit_account_id') }}</th><td>{{ $item->debit }}</td>
    </tr>
    <tr>
      <th>{{ trans('validation.attributes.credit_account_id') }}</th><td>{{ $item->credit }}</td>
    </tr>
    <tr>
      <th>{{ trans('validation.attributes.money') }}</th><td>{{ number_format($item->money) }}</td>
    </tr>
    <tr>
      <th>{{ trans('validation.attributes.summary') }}</th><td>{{ $item->summary }}</td>
    </tr>
    <tr>
      <th>{{ trans('validation.attributes.created_at') }}</th><td>{{ $item->created_at }}</td>
    </tr>    
    <tr>
      <th>{{ trans('validation.attributes.updated_at') }}</th><td>{{ $item->updated_at }}</td>
    </tr>                    
  </tbody>
</table>
<p></p>

<a href="{{ url('journals/' . $item->id . '/edit')}}">編集</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="{{ url('journals?yyyy=' . $item->yyyy)}}">戻る</a>
<p></p>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">ホーム</a></li> 
    <li class="breadcrumb-item"><a href="{{ url('capitals') }}">会計年度</a></li> 
    <li class="breadcrumb-item active">仕訳の表示</li>     
  </ol> 
</nav>    
<p></p>
@endsection
