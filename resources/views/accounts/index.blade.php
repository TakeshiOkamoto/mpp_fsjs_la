@extends('layouts.app')

@section('title', "勘定科目")

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">ホーム</a></li> 
    <li class="breadcrumb-item active">勘定科目</li>     
  </ol> 
</nav>    
<p></p>
<h1>勘定科目</h1>
<p>この画面は<span style="color:red;">システム設定</span>です。複式簿記がわからない方は操作しないでください。</p>
<p>「損益計算書」で利用できる経費の科目は全て登録済みです。その他に必要であれば追加して下さい。<br>
※不要な経費の科目は削除して頂いても構いません。<br>
※誤って変更した場合は「php artisan db:seed」を実行すればデータを復元できます。</p>

<form action="{{ url('accounts') }}" method="get">
  <div class="input-group">
    <input type="search" name="name" class="form-control" placeholder="検索したい名前を入力" value="{{ $name }}">
    <span class="input-group-btn">
      <input type="submit" value="検索" class="btn btn-outline-info"> 
    </span>
  </div>
</form>

<p></p>

<table class="table table-hover">
  <thead class="thead-default">
    <tr>
      <th>{{ trans('validation.attributes.name') }}</th>
      <th class="pc">{{ trans('validation.attributes.types') }}</th>
      <th class="pc">{{ trans('validation.attributes.expense_flg') }}</th>
      <th class="pc">{{ trans('validation.attributes.sort_list') }}</th>
      <th class="pc">{{ trans('validation.attributes.sort_expense') }}</th>
      <th></th>  
    </tr>
  </thead>
  <tbody class="thead-default">
    @foreach ($items as $item)
    <tr>
      <td><a href="{{ url('accounts/' . $item->id) }}">{{ $item->name }}</a></td>
      <td class="pc">{{ $item->types }}</td>
      <td class="pc">{{ $item->expense_flg }}</td>
      <td class="pc">{{ $item->sort_list }}</td>
      <td class="pc">{{ $item->sort_expense }}</td>                
      <td style="width:170px;">
        <a href="{{ url('accounts/' . $item->id . '/edit') }}" class="btn btn-primary">編集</a>
        &nbsp;&nbsp;
        <a href="#" onclick="ajax_delete('「{{ $item->name }}」を削除します。よろしいですか？','{{ url('accounts/' . $item->id) }}','{{ url('accounts') }}');return false;" class="btn btn-danger">削除</a>
      </td>            
    </tr>    
    @endforeach
  </tbody>    
</table>

{{ $items->appends(['name' => $name])->links() }}

@if (count($items) >0)
  <p>全{{ $items->total() }}件中 
       {{  ($items->currentPage() -1) * $items->perPage() + 1 }} - 
       {{ (($items->currentPage() -1) * $items->perPage() + 1) + (count($items) -1) }}件<span class="pc">のデータ</span>が表示されています。</p>
@else
  <p>データがありません。</p>
@endif 

<p></p>
<a href="{{ url('accounts/create') }}" class="btn btn-primary">勘定科目の新規登録</a>
<p><br></p>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">ホーム</a></li> 
    <li class="breadcrumb-item active">勘定科目</li>     
  </ol> 
</nav>    
<p></p>
@endsection