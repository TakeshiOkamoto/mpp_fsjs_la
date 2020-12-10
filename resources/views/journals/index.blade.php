@extends('layouts.app')

@section('title', "仕訳帳")

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">ホーム</a></li> 
    <li class="breadcrumb-item"><a href="{{ url('capitals') }}">会計年度</a></li>     
    <li class="breadcrumb-item active">仕訳帳</li>     
  </ol> 
</nav>    
<p></p>
<h1>仕訳帳({{ $yyyy }}年)</h1>
<p>仕訳は1/1から順番に登録して下さい。現金、その他の預金、前払金、未払金は入力誤り判定機能付きです。</p>
<p><a href="{{ url('journals/create?yyyy=' . $yyyy) }}" class="btn btn-primary">仕訳の新規登録</a></p>
<h5>[ 基本情報 ]</h5>
<table class="table table-hover">
  <tbody class="thead-default">
    <tr>
      <th style="width:120px;">元入金</th>
      <td>
          {{ trans('validation.attributes.m1') . ': ' . number_format($capital->m1) }} 
          {{ trans('validation.attributes.m2') . ': ' . number_format($capital->m2) }} 
          {{ trans('validation.attributes.m3') . ': ' . number_format($capital->m3) }} 
          {{ trans('validation.attributes.m4') . ': ' . number_format($capital->m4) }}
      </td>
    </tr>  
    <tr>
      <th>12/31<span class="sp"><br></span>(期末)</th>
      <td>
          {{ trans('validation.attributes.m1') . ': ' . number_format($money) }} 
          {{ trans('validation.attributes.m2') . ': ' . number_format($deposit) }} 
          {{ trans('validation.attributes.m3') . ': ' . number_format($advance_payment) }} 
          {{ trans('validation.attributes.m4') . ': ' . number_format($accounts_payable) }}
          {{ '売上: ' . number_format($sales) }}          
      </td>
    </tr>      
  </tbody>
</table>

<h5>[ 仕訳 ]</h5>  
<table class="table table-hover pc">
  <thead class="thead-default">
    <tr>
      <th>日付</th>
      <th>{{ trans('validation.attributes.debit_account_id') }}</th>
      <th>{{ trans('validation.attributes.credit_account_id') }}</th>
      <th>{{ trans('validation.attributes.money') }}</th>
      <th style="width:300px;">{{ trans('validation.attributes.summary') }}</th>      
      <th></th>  
    </tr>
  </thead>
  <tbody class="thead-default">
    @foreach ($items as $item)
    <tr>
      <td><a href="{{ url('journals/' . $item->id) }}">{{ date('m/d', strtotime($item->mm . '/' . $item->dd)) }}</a></td>
      <td>{{ $item->debit }}</td>
      <td>{{ $item->credit }}</td>
      <td>{{ number_format($item->money) }}</td>
      <td>{{ $item->summary }}</td>                
      <td style="width:170px;">
        <a href="{{ url('journals/' . $item->id . '/edit') }}" class="btn btn-primary">編集</a>
        &nbsp;&nbsp;
        <a href="#" onclick="ajax_delete('「{{ $item->mm . '/' . $item->dd }}」の仕訳を削除します。よろしいですか？','{{ url('journals/' . $item->id) }}','{{ url('journals?yyyy=' . $yyyy) }}');return false;" class="btn btn-danger">削除</a>
      </td>            
    </tr>    
    @endforeach
  </tbody>    
</table>

<table class="table table-hover sp">
  <thead class="thead-default">
    <tr>
      <th>日付</th>
      <th>仕訳</th>
    </tr>
  </thead>
  <tbody class="thead-default">
    @foreach ($items as $item)
    <tr>
      <td><a href="{{ url('journals/' . $item->id) }}">{{ date('m/d', strtotime($item->mm . '/' . $item->dd)) }}</a></td>
      <td>
        {{ $item->debit }} {{ $item->credit }}<br>
        {{ number_format($item->money) }}<br>
        <span class="text-muted" style="font-size:90%">{{ $item->summary }}</span><br>
        <p></p>
        <a href="{{ url('journals/' . $item->id . '/edit') }}" class="btn btn-primary">編集</a>
        &nbsp;&nbsp;
        <a href="#" onclick="ajax_delete('「{{ $item->mm . '/' . $item->dd }}」の仕訳を削除します。よろしいですか？','{{ url('journals/' . $item->id) }}','{{ url('journals?yyyy=' . $yyyy) }}');return false;" class="btn btn-danger">削除</a>
      </td>
    </tr>    
    @endforeach
  </tbody>    
</table>

{{ $items->appends(['yyyy' => $yyyy])->links() }}

@if (count($items) >0)
  <p>全{{ $items->total() }}件中 
       {{  ($items->currentPage() -1) * $items->perPage() + 1 }} - 
       {{ (($items->currentPage() -1) * $items->perPage() + 1) + (count($items) -1) }}件<span class="pc">のデータ</span>が表示されています。</p>
@else
  <p>データがありません。</p>
@endif 

<p><br></p>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">ホーム</a></li> 
    <li class="breadcrumb-item"><a href="{{ url('capitals') }}">会計年度</a></li>     
    <li class="breadcrumb-item active">仕訳帳</li>    
  </ol> 
</nav>    
<p></p>
@endsection