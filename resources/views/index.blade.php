@extends('layouts.app')

@section('title', trans('validation.attributes.app_name'))

@section('content')
<p></p>

{{-- 1. このシステムの流れ --}}
<h2>1. このシステムの流れ</h2>
<p></p>
<p>初めての方は<a href="{{ url('capitals') }}">会計年度</a>で会計年度を新規登録します。<br>次に<a href="{{ url('capitals') }}">会計年度</a>の画面から該当年の「仕訳帳」を選択して「仕訳」を新規登録していきます。</p>

{{-- 2. 仕訳の記入例 --}}
<h2>2. 仕訳の記入例</h2>
<p>「その他の預金」は通帳の事。「前払金」は電子マネーなど先払い。「未払金」はクレジットカードなどの後払い。</p>
<table class="table table-hover">
  <thead>
    <tr>
      <th>例</th>
      <th>借方</th>
      <th>貸方</th>
      <th>摘要</th>
    </tr>
  </thead>
  <tr>
    <td>現金での売上</td>
    <td>現金</td>
    <td>売上(収入)</td>
    <td>1/24 ご依頼○○様、○○広告収入など</td>
  </tr>
  <tr>
    <td>振込での売上</td>
    <td>その他の預金</td>
    <td>売上(収入)</td>
    <td>1/24 ご依頼○○様、○○広告収入など</td>
  </tr>
  <tr>
    <td>旅費または交通費 ※現金</td>
    <td>旅費交通費</td>
    <td>現金</td>
    <td>ホテルまたは交通機関の名称</td>
  </tr>
  <tr>
    <td>旅費または交通費 ※クレジットカード</td>
    <td>旅費交通費</td>
    <td>未払金</td>
    <td>クレカ - ホテルまたは交通機関の名称</td>
  </tr>
  <tr>
    <td>旅費または交通費 ※電子マネーなど</td>
    <td>旅費交通費</td>
    <td>前払金</td>
    <td>○○ - ホテルまたは交通機関の名称</td>
  </tr>
  <tr>
    <td>旅費または交通費 ※引き落とし</td>
    <td>旅費交通費</td>
    <td>その他の預金</td>
    <td>ホテルまたは交通機関の名称</td>
  </tr>
  <tr>
    <td>電子マネーの入金</td>
    <td>前払金</td>
    <td>現金</td>
    <td>○○入金</td>
  </tr>
  <tr>
    <td>クレジットカードの引き落とし</td>
    <td>未払金</td>
    <td>その他の預金</td>
    <td>○○カード引き落とし</td>
  </tr>
  <tr>
    <td rowspan="2">携帯通信料金の引き落とし<br>※50%などで按分して2つの仕訳にする</td>
    <td>通信費</td>
    <td>その他の預金</td>
    <td>携帯通信料金(按分50%)</td>
  </tr>
  <tr>
    <td>事業主貸</td>
    <td>その他の預金</td>
    <td>携帯通信料金(按分50%)</td>
  </tr>
  <tr>
    <td>事業主の引き落とし ※私的利用</td>
    <td>事業主貸</td>
    <td>その他の預金</td>
    <td>事業主○○引き落とし</td>
  </tr>
  <tr>
    <td>事業主のクレジットカード ※私的利用</td>
    <td>事業主貸</td>
    <td>未払金</td>
    <td>○○カード - ○○</td>
  </tr>
  <tr>
    <td>事業主に現金を移動</td>
    <td>事業主貸</td>
    <td>現金</td>
    <td>事業主へ</td>
  </tr>
  <tr>
    <td>事業とは関係がない入金</td>
    <td>その他預金</td>
    <td>事業主借</td>
    <td>給料、年金、生命保険割戻金など</td>
  </tr>
  <tr>
    <td>銀行の利息(ゆうちょ銀行の受取利子)</td>
    <td>その他預金</td>
    <td>事業主借</td>
    <td>利息(受取利子)</td>
  </tr>
  <tr>
    <td>現金が不足した際、現金を増やす</td>
    <td>現金</td>
    <td>事業主借</td>
    <td>事業主からの現金</td>
  </tr>
</table>
<p>※「通帳、クレジットカード」などを事業利用と私的利用の両方で使用している場合はその全てを仕訳に登録します。<br>※「携帯通信料金、水道光熱費、地代家賃」などは客観的で合理性がある按分で事業利用と私的利用で金額を分割します。</p>

{{-- 3. 青色申告決算書の出力 --}}
<div id="report"></div>
<h2>3. 青色申告決算書の出力</h2>
<p style="margin-top:24px;margin-bottom:24px;">
@foreach($capitals as $index => $capital)
  <span><a href="{{ url('/?yyyy=' . $capital->yyyy. '#report' )}}">{{ $capital->yyyy }}年度</a></span>&nbsp;&nbsp;
  @if(($index+1) % 3 === 0)
    <span class="sp"><br></span>
  @endif        
  @if(($index+1) % 5 === 0)
    <span class="pc"><br></span>
  @endif        
@endforeach

@if(count($capitals) === 0)
  <p>会計年度が登録されていません。</p>
@endif
</p>

@if (isset($yyyy))
  <p>次の3つの表を元に国税庁のWebサイトで青色申告決算書を作成します。</p>
  
  <h3>{{ $yyyy }}年度</h3>
  
  {{-- 損益計算書 --}}
  <div class="p-1 bg-primary text-white">損益計算書</div>  
  
  <p></p>  
  <h5>[売上]</h5>
  <p></p>
  <table class="table table-hover">
    <thead>
      <tr>
        <th style="width:250px;">科目</th>
        <th>金額</th>
      </tr>
    </thead>
    <tbody>                  
      <tr>
        <td>売上(収入)金額</td>
        <td>{{ number_format($report_pl_total) }}</td>
      </tr>            
    </tbody>
  </table>
  
  <p></p>
  <h5>[経費]</h5>
  <p></p>
  <table class="table table-hover">
    <thead>
      <tr>
        <th style="width:250px;">科目</th>
        <th>金額</th>
      </tr>
    </thead>
    <tbody>                  
      @php 
        $keihi_total = 0;
      @endphp
      @foreach($report_pl_keihi as $item) 
      <tr>
         <td>{{ $item->name }}</td>
         <td>{{ number_format($item->money) }}</td>
      </tr> 
      @php
        $keihi_total += $item->money;
      @endphp                       
      @endforeach
      <tr>
         <th>計</th>
         <td>{{ number_format($keihi_total) }}</td>
      </tr>             
    </tbody>
  </table>  
  
  <p></p>
  <h5>[所得金額]</h5>
  <p></p>
  @php
    $income = ($report_pl_total - $keihi_total);
  @endphp        
  <table class="table table-hover">
    <thead>
      <tr>
        <th style="width:250px;">科目</th>
        <th>金額</th>
      </tr>
    </thead>
    <tbody>                  
      <tr>
         <td>青色申告特別控除前の<br>所得金額 ※売上 - 経費</td>
         <td>{{ number_format($income) }}</td>
      </tr> 
      <tr>
         <td>青色申告特別控除額</td>
         <td>650,000</td>
      </tr>   
      <tr>
         <th>所得金額</th>
         @if (($income - 650000) > 0)
           <td>{{ number_format($income - 650000) }}</td>
         @else
           <td>0</td>
         @endif  
      </tr>                            
    </tbody>
  </table>    
  
  {{-- 月別売上(収入)金額及び仕入金額 ※売上のみ --}}
  <div class="p-1 bg-primary text-white">月別売上(収入)金額及び仕入金額 ※売上のみ</div>
  
  <p></p>
  @php
    $income = ($report_pl_total - $keihi_total);
  @endphp        
  <table class="table table-hover">
    <thead>
      <tr>
        <th style="width:250px;">月</th>
        <th>売上(収入)金額</th>
      </tr>
    </thead>
    <tbody>                  
      @foreach($report_month as $index => $item) 
      <tr>
         <td>{{ ($index+1) }}月</td>
         <td>{{ number_format($item->money) }}</td>
      </tr>             
      @endforeach      
      <tr>
         <th>計</th>
         <td>{{ number_format($report_pl_total) }}</td>
      </tr>                                  
    </tbody>
  </table>   
  <p></p>
          
  {{-- 月別売上(収入)金額及び仕入金額 ※売上のみ --}}
  <div class="p-1 bg-primary text-white">貸借対照表</div> 
   
  <p></p>  
  <h5>[資産の部]</h5>
  <p></p>
  @php
    $income = ($report_pl_total - $keihi_total);
  @endphp        
  <table class="table table-hover">
    <thead>
      <tr>
        <th style="width:250px;">科目</th>
        <th>1月1日(期首)</th>
        <th>12月31日(期末)</th>              
      </tr>
    </thead>
    <tbody>            
      <tr>
         <td>現金</td>
         <td>{{ number_format($report_bs_st->m1) }}</td>
         <td>{{ number_format($report_bs_m1) }}</td>               
      </tr>             
      <tr>
         <td>その他の預金</td>
         <td>{{ number_format($report_bs_st->m2) }}</td>
         <td>{{ number_format($report_bs_m2) }}</td>               
      </tr>
      <tr>
         <td>前払金</td>
         <td>{{ number_format($report_bs_st->m3) }}</td>
         <td>{{ number_format($report_bs_m3) }}</td>               
      </tr> 
      <tr>
         <td>事業主貸</td>
         <td></td>
         <td>{{ number_format($report_bs_debit) }}</td>               
      </tr>
      <tr>
         <th>合計</th>
         <td>{{ number_format($report_bs_st->m1 + $report_bs_st->m2 + $report_bs_st->m3) }}</td>
         <td>{{ number_format($report_bs_m1 + $report_bs_m2 + $report_bs_m3 + $report_bs_debit) }}</td>               
      </tr>                                                                
    </tbody>
  </table>   
  <p></p>
  
  <h5>[負債・資本の部]</h5>
  <p></p>
  @php
    $capital_total = $report_bs_st->m1 + $report_bs_st->m2 + $report_bs_st->m3 - $report_bs_st->m4;
  @endphp        
  <table class="table table-hover">
    <thead>
      <tr>
        <th style="width:250px;">科目</th>
        <th>1月1日(期首)</th>
        <th>12月31日(期末)</th>              
      </tr>
    </thead>            
    <tbody>            
      <tr>
         <td>未払金</td>
         <td>{{ number_format($report_bs_st->m4) }}</td>
         <td>{{ number_format($report_bs_m4) }}</td>               
      </tr>             
      <tr>
         <td>事業主借</td>
         <td></td>
         <td>{{ number_format($report_bs_credit) }}</td>               
      </tr>
      <tr>
         <td>元入金</td>
         <td>{{ number_format($capital_total) }}</td>
         <td>{{ number_format($capital_total) }}</td>               
      </tr> 
      <tr>
         <td>青色申告特別控除前の<br>所得金額 ※売上 - 経費</td>
         <td></td>
         <td>{{ number_format($income) }}</td>               
      </tr>
      <tr>
         <th>合計</th>
         <td>{{ number_format($report_bs_st->m4 + $capital_total) }}</td>
         <td>{{ number_format($report_bs_m4 + $report_bs_credit + $capital_total + $income) }}</td>               
      </tr>                                                                
    </tbody>
  </table>   
  <p></p>  
  @php
    $a1 = ($report_bs_st->m1 + $report_bs_st->m2 + $report_bs_st->m3);
    $a2 = ($report_bs_m1 + $report_bs_m2 + $report_bs_m3 + $report_bs_debit);
    $b1 = ($report_bs_st->m4 + $capital_total);
    $b2 = ($report_bs_m4 + $report_bs_credit + $capital_total + $income);
  @endphp    
  @if (!($a1 == $b1 && $a2 == $b2)) 
    <p style="color:red;">「資産の部」と「負債・資本の部」の1月1日、12月31日の合計が一致しません。全ての仕訳を確認して下さい。</p>
  @endif                                    
@endif

<p><br></p>
@endsection