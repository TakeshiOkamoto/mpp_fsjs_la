{{-- エラーメッセージ --}}
@if (count($errors) > 0)
<div id="error_explanation" class="text-danger">
  <ul>
     @foreach ($errors->all() as $error)
       <li>{{ $error }}</li>
     @endforeach
  </ul>
</div>
@endif

{{-- フォーム --}} 
<form action="{{ $form_action }}" method="post">
  @csrf
  
  {{-- 初期表示(編集) --}}
  @if(isset($item) && is_null(old('_token')))  
    <input type="hidden" name="id" value="{{ $item->id }}">
  {{-- 新規/編集 --}}    
  @else
    <input type="hidden" name="id" value="{{ old('id') }}">
  @endif
      
  <div class="form-group">
    <label for="account_name">{{ trans('validation.attributes.name') }}</label>
    @error('name')
      <input type="text" class="form-control is-invalid" id="account_name" name="name" value="{{ old('name') }}">
    @else
      @if(isset($item) && is_null(old('_token')))
        <input type="text" class="form-control" id="account_name" name="name" value="{{ $item->name }}">
      @else
        <input type="text" class="form-control" id="account_name" name="name" value="{{ old('name') }}">
      @endif
    @enderror  
  </div>    
  
  @php
    if(isset($item) && is_null(old('_token'))){
      $val = $item->types;
    }else{
      $val = old('types');
    }     
  @endphp  
  <div class="form-group">
    <label for="account_types">{{ trans('validation.attributes.types')}}</label>
    @error('types')
      <select id="account_types" class="form-control is-invalid" name="types">  
    @else
      <select id="account_types" class="form-control col-sm-3" name="types">    
    @enderror 
        <option value= "">選択してください。</option>      
        <option value= "1" {{ ($val ==  "1") ? 'selected="selected"' : '' }}>借方</option>
        <option value= "2" {{ ($val ==  "2") ? 'selected="selected"' : '' }}>貸方</option>
        <option value= "3" {{ ($val ==  "3") ? 'selected="selected"' : '' }}>借方 + 貸方</option>
      </select>    
  </div> 
  
  <div class="form-group" style="float: left;">
    <label for="account_expense_flg">{{ trans('validation.attributes.expense_flg') }}</label>
    @if(isset($item) && is_null(old('_token')))
      <input type="checkbox" class="form-control" id="account_expense_flg" name="expense_flg" value="1" {!! $item->expense_flg == "1" ? 'checked="checked"' : '' !!}>
    @else
      <input type="checkbox" class="form-control" id="account_expense_flg" name="expense_flg" value="1" {!! (old('expense_flg') == "1") ? 'checked="checked"' : '' !!}>
    @endif    
  </div>    
  <div style="clear:both;"></div>  

  <div class="form-group">
    <label for="account_sort_list">{{ trans('validation.attributes.sort_list') }}</label>
    @error('sort_list')
      <input type="number" class="form-control is-invalid" id="account_sort_list" name="sort_list" value="{{ old('sort_list') }}">
    @else
      @if(isset($item) && is_null(old('_token')))
        <input type="number" class="form-control" id="account_sort_list" name="sort_list" value="{{ $item->sort_list }}">
      @else
        <input type="number" class="form-control" id="account_sort_list" name="sort_list" value="{{ old('sort_list') }}">
      @endif            
    @enderror  
  </div>  
  
  <div class="form-group">
    <label for="account_sort_expense">{{ trans('validation.attributes.sort_expense') }}</label>
    @error('sort_expense')
      <input type="number" class="form-control is-invalid" id="account_sort_expense" name="sort_expense" value="{{ old('sort_expense') }}">
    @else
      @if(isset($item) && is_null(old('_token')))
        <input type="number" class="form-control" id="account_sort_expense" name="sort_expense" value="{{ $item->sort_expense }}">
      @else
        <input type="number" class="form-control" id="account_sort_expense" name="sort_expense" value="{{ old('sort_expense') }}">
      @endif            
    @enderror  
  </div>      
  
  <p></p>  
  
  @if(isset($item))
    <input type="hidden" name="_method" value="PUT">
    <input type="submit" value="更新する" class="btn btn-primary">    
  @else
    <input type="submit" value="登録する" class="btn btn-primary">    
  @endif
</form>
