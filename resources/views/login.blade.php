@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<p></p>
<h1>ログイン</h1>
<p></p>

{{-- エラーメッセージ --}}
@if (isset($login_error))
  <div id="error_explanation" class="text-danger">
    <ul>
      <li>ログインIDまたはパスワードが一致しません。</li>
    </ul>
  </div>
@endif
<p></p>

{{-- フォーム --}}
<form action="{{ url('login') }}" method="post">
  @csrf  
  <div class="form-group">
    <label for="user_name">{{ trans('validation.attributes.name') }}</label>
    <input type="text" class="form-control" id="user_name" name="name">
  </div>     
  <div class="form-group">
    <label for="user_password">{{ trans('validation.attributes.password') }}</label>
    <input type="password" class="form-control" id="user_password" name="password">
  </div>     
  <input type="submit" value="ログイン" class="btn btn-primary">  
</form>  
<p><br></p>
@endsection