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
    <label for="capital_yyyy">{{ trans('validation.attributes.yyyy') }} ※西暦4桁</label>
    @error('yyyy')
      <input type="number" class="form-control is-invalid" id="capital_yyyy" name="yyyy" value="{{ old('yyyy') }}">
    @else
      @if(isset($item) && is_null(old('_token')))
        <input type="number" class="form-control" id="capital_yyyy" name="yyyy" value="{{ $item->yyyy }}">
      @else
        <input type="number" class="form-control" id="capital_yyyy" name="yyyy" value="{{ old('yyyy') }}">
      @endif            
    @enderror  
  </div>  
  
  <div class="alert alert-primary" role="alert">以下の4項目は1月1日(期首) 時点の「元入金」の金額を入力します。<br>※ない場合は0を入力。繰越の場合は前年の12/31(期末)の金額を入力。</div>
  
  <div class="form-group">
    <label for="capital_m1">{{ trans('validation.attributes.m1') }}</label>
    @error('m1')
      <input type="number" class="form-control is-invalid" id="capital_m1" name="m1" value="{{ old('m1') }}">
    @else
      @if(isset($item) && is_null(old('_token')))
        <input type="number" class="form-control" id="capital_m1" name="m1" value="{{ $item->m1 }}">
      @else
        <input type="number" class="form-control" id="capital_m1" name="m1" value="{{ old('m1', 0) }}">
      @endif            
    @enderror  
  </div>  
  
  <div class="form-group">
    <label for="capital_m2">{{ trans('validation.attributes.m2') }} ※通帳の残高</label>
    @error('m2')
      <input type="number" class="form-control is-invalid" id="capital_m2" name="m2" value="{{ old('m2') }}">
    @else
      @if(isset($item) && is_null(old('_token')))
        <input type="number" class="form-control" id="capital_m2" name="m2" value="{{ $item->m2 }}">
      @else
        <input type="number" class="form-control" id="capital_m2" name="m2" value="{{ old('m2', 0) }}">
      @endif            
    @enderror  
  </div>  
  
  <div class="form-group">
    <label for="capital_m3">{{ trans('validation.attributes.m3') }} ※電子マネーの前払金など</label>
    @error('m3')
      <input type="number" class="form-control is-invalid" id="capital_m3" name="m3" value="{{ old('m3') }}">
    @else
      @if(isset($item) && is_null(old('_token')))
        <input type="number" class="form-control" id="capital_m3" name="m3" value="{{ $item->m3 }}">
      @else
        <input type="number" class="form-control" id="capital_m3" name="m3" value="{{ old('m3', 0) }}">
      @endif            
    @enderror  
  </div>   
  
  <div class="form-group">
    <label for="capital_m4">{{ trans('validation.attributes.m4') }} ※クレジットカードの未払金など</label>
    @error('m4')
      <input type="number" class="form-control is-invalid" id="capital_m4" name="m4" value="{{ old('m4') }}">
    @else
      @if(isset($item) && is_null(old('_token')))
        <input type="number" class="form-control" id="capital_m4" name="m4" value="{{ $item->m4 }}">
      @else
        <input type="number" class="form-control" id="capital_m4" name="m4" value="{{ old('m4', 0) }}">
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
