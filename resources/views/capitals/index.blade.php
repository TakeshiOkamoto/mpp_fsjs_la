@extends('layouts.app')

@section('title', "会計年度")

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">ホーム</a></li> 
    <li class="breadcrumb-item active">会計年度</li>     
  </ol> 
</nav>    
<p></p>
<h1>会計年度</h1>
<p>「元入金」とは新規開業または前年からの繰越の金額です。</p>

<p></p>

<table class="table table-hover pc">
  <thead class="thead-default">
    <tr>
      <th style="width:100px;"></th>
      <th></th>
      <th>元入金</th>
      <th></th>
    </tr>
  </thead>
  <tbody class="thead-default">
    @foreach ($items as $item)
    <tr>
      <td><a href="{{ url('journals?yyyy=' . $item->yyyy) }}" class="btn btn-outline-info">仕訳帳</a></td>
      <td>{{ $item->yyyy }}年</td>
      <td>{{ trans('validation.attributes.m1') . ' ' . number_format($item->m1) }} 
          {{ trans('validation.attributes.m2') . ' ' . number_format($item->m2) }} 
          {{ trans('validation.attributes.m3') . ' ' . number_format($item->m3) }} 
          {{ trans('validation.attributes.m4') . ' ' . number_format($item->m4) }} </td>            
      <td style="width:170px;">
        <a href="{{ url('capitals/' . $item->id . '/edit') }}" class="btn btn-primary">編集</a>
        &nbsp;&nbsp;
        <a href="#" onclick="ajax_delete('「{{ $item->yyyy }}年」を削除します。よろしいですか？','{{ url('capitals/' . $item->id) }}','{{ url('capitals') }}');return false;" class="btn btn-danger">削除</a>
      </td>            
    </tr>    
    @endforeach
  </tbody>    
</table>

<table class="table table-hover sp">
  <tbody class="thead-default">
    @foreach ($items as $item)
    <tr>
      <td>
         <a href="{{ url('journals?yyyy=' . $item->yyyy) }}" class="btn btn-outline-info">仕訳帳 ({{ $item->yyyy }}年)</a>
         <p></p>
          &lt;元入金&gt;<br>
          ・{{ trans('validation.attributes.m1') . ' ' . number_format($item->m1) }}<br> 
          ・{{ trans('validation.attributes.m2') . ' ' . number_format($item->m2) }}<br> 
          ・{{ trans('validation.attributes.m3') . ' ' . number_format($item->m3) }}<br> 
          ・{{ trans('validation.attributes.m4') . ' ' . number_format($item->m4) }}
          <p></p> 
          <a href="{{ url('capitals/' . $item->id . '/edit') }}" class="btn btn-primary">編集</a>
          &nbsp;
          <a href="#" onclick="ajax_delete('「{{ $item->yyyy }}年」を削除します。よろしいですか？','{{ url('capitals/' . $item->id) }}','{{ url('capitals') }}');return false;" class="btn btn-danger">削除</a>
      </td>
    </tr>    
    @endforeach
  </tbody>    
</table>

{{ $items->links() }}

@if (count($items) >0)
  <p>全{{ $items->total() }}件中 
       {{  ($items->currentPage() -1) * $items->perPage() + 1 }} - 
       {{ (($items->currentPage() -1) * $items->perPage() + 1) + (count($items) -1) }}件<span class="pc">のデータ</span>が表示されています。</p>
@else
  <p>データがありません。</p>
@endif 

<p></p>
<a href="{{ url('capitals/create') }}" class="btn btn-primary">会計年度の新規登録</a>
<p><br></p>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">ホーム</a></li> 
    <li class="breadcrumb-item active">会計年度</li>     
  </ol> 
</nav>    
<p></p>
@endsection