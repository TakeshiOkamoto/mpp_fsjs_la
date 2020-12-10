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
  
  {{-- 日付 --}}
  <div class="alert alert-primary" role="alert">日付</div>    
  <p></p>
  @if(isset($item) && is_null(old('_token')))  
    <h5>{{ $item->yyyy }}年</h5>
    <input type="hidden" name="yyyy" value="{{ $item->yyyy }}">
  @else
    <h5>{{ old('yyyy', isset($yyyy) ? $yyyy : "") }}年</h5>
    <input type="hidden" name="yyyy" value="{{ old('yyyy', isset($yyyy) ? $yyyy : "") }}">
  @endif
  <p></p>
  
  <div class="form-group">
    <label for="journal_mm">{{ trans('validation.attributes.mm') }}</label>
    @error('mm')
      <input type="number" class="form-control is-invalid" id="journal_mm" name="mm" value="{{ old('mm') }}">
    @else
      @if(isset($item) && is_null(old('_token')))
        <input type="number" class="form-control" id="journal_mm" name="mm" value="{{ $item->mm }}">
      @else
        <input type="number" class="form-control" id="journal_mm" name="mm" value="{{ old('mm') }}">
      @endif            
    @enderror  
  </div>  
  
  <div class="form-group">
    <label for="journal_dd">{{ trans('validation.attributes.dd') }}</label>
    @error('dd')
      <input type="number" class="form-control is-invalid" id="journal_dd" name="dd" value="{{ old('dd') }}">
    @else
      @if(isset($item) && is_null(old('_token')))
        <input type="number" class="form-control" id="journal_dd" name="dd" value="{{ $item->dd }}">
      @else
        <input type="number" class="form-control" id="journal_dd" name="dd" value="{{ old('dd') }}">
      @endif            
    @enderror  
  </div>  
  
  {{-- 借方 --}}
  @php
    if(isset($item) && is_null(old('_token'))){
      $val = $item->debit_account_id;
    }else{
      $val = old('debit_account_id');
    }     
  @endphp  
  <div class="alert alert-primary" role="alert">{{ trans('validation.attributes.debit_account_id') }} <span class="sp"><br></span>※大まかに言うとプラスのイメージ</div>   
  <div class="form-group">
    @error('debit_account_id')
      <select id="journal_debit_account_id" class="form-control is-invalid col-sm-3" name="debit_account_id">  
    @else   
      <select id="journal_debit_account_id" class="form-control col-sm-3" name="debit_account_id">  
    @enderror 
        <option value= "">選択して下さい。</option>  
        @foreach ($debit_list as $debit)
          <option value= "{{ $debit->id }}" {!! ($val ==  $debit->id) ? 'selected="selected"' : '' !!}>{{ $debit->name }}</option>
        @endforeach
      </select>
  </div>   
  
  {{-- 貸方 --}}
  @php
    if(isset($item) && is_null(old('_token'))){
      $val = $item->credit_account_id;
    }else{
      $val = old('credit_account_id');
    }     
  @endphp    
  <div class="alert alert-primary" role="alert">{{ trans('validation.attributes.credit_account_id') }} <span class="sp"><br></span>※大まかに言うとマイナスのイメージ</div>    
  <div class="form-group">
    @error('credit_account_id')
      <select id="journal_credit_account_id" class="form-control is-invalid  col-sm-3" name="credit_account_id">  
    @else   
      <select id="journal_credit_account_id" class="form-control  col-sm-3" name="credit_account_id">  
    @enderror 
        <option value= "">選択して下さい。</option>  
        @foreach ($credit_list as $credit)
          <option value= "{{ $credit->id }}" {!! ($val ==  $credit->id) ? 'selected="selected"' : '' !!}>{{ $credit->name }}</option>
        @endforeach
      </select>
  </div> 
  
  {{-- 金額 --}}
  <div class="alert alert-primary" role="alert">{{ trans('validation.attributes.money') }}</div>  
  <div class="form-group">
    @error('money')
      <input type="number" class="form-control is-invalid" id="journal_money" name="money" value="{{ old('money') }}">
    @else
      @if(isset($item) && is_null(old('_token')))
        <input type="number" class="form-control" id="journal_money" name="money" value="{{ $item->money }}">
      @else
        <input type="number" class="form-control" id="journal_money" name="money" value="{{ old('money') }}">
      @endif            
    @enderror  
  </div>  
    
  {{-- 摘要 --}}    
  <div class="alert alert-primary" role="alert">{{ trans('validation.attributes.summary') }}</div>   
  <p>(例)1/24 ご依頼○○様、○○広告収入、○○銀行、 クレジットカード(○○代)、○○引き落とし、携帯通信料金(按分50%)など</p>   
  <div class="form-group">
    @error('summary')
      <input type="text" class="form-control is-invalid" id="journal_summary" name="summary" value="{{ old('summary') }}">
    @else
      @if(isset($item) && is_null(old('_token')))
        <input type="text" class="form-control" id="journal_summary" name="summary" value="{{ $item->summary }}">
      @else
        <input type="text" class="form-control" id="journal_summary" name="summary" value="{{ old('summary') }}">
      @endif
    @enderror  
  </div>    
  
  <p><br></p>  
  
  @if(isset($item))
    <input type="hidden" name="_method" value="PUT">
    <input type="submit" value="更新する" class="btn btn-primary">    
  @else
    <input type="submit" value="登録する" class="btn btn-primary">    
  @endif
</form>
