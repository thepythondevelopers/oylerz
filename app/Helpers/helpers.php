<?php 

function ActiveMenu($arr,$returnText,$route=null)
{
     $currentRoute = \Request::route()->getName();
         $i=0;

         if($currentRoute == $route){
             return  $returnText;
         }elseif($route == null){

            for($j=0;$j<count($arr); $j++){
                
                if($arr[$j] == $currentRoute){
                    $i++;
                 }
           }

        }
         return $i > 0 ? $returnText : '' ;
}

function car_year($data=null){
    $html = '';
    for($i=date("Y") ; $i>=1960 ;$i--){
        $c = $data==$i ? 'selected' : '';
        $html .='<option value="'.$i.'" '.$c.'>'.$i.'</option>';
    }
    return $html;
}

function setting($name){
    $s = \App\Models\Setting::where('name',$name)->first();
    return $s->value;
}

function stripe_setting($name){
    $s = \App\Models\Setting::where('name',$name)->first();
    return $s->value;
}

function user_location(){
    $ip = \Request::ip();
    $data = \Location::get($ip);
    return $data;
}

function admin(){
    $admin = \App\User::where('role','admin')->first();
    return $admin;
}

function pdf_save($booking,$service,$garage,$order_id){
    $location = \App\Models\Location::where('id',$booking->location_id)->first();
    $vendor = \App\User::where('id',$booking->vendor)->first();
     $message ='<!DOCTYPE html>
<html>
    <head>
        <title>Invoice</title>
    <style>
        .top_rw{ background-color:#101010;  -webkit-print-color-adjust: exact; }
    button{ padding:5px 10px; font-size:14px;}
    .invoice-box {
        max-width: 890px;
        margin: auto;
        padding:10px;
        // border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 14px;
        line-height: 24px;
        font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
        color: #555;
        // border: 1px solid #d1d1d1;
-webkit-print-color-adjust: exact; 
    }
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    .invoice-box table td {
        padding: 5px;
        vertical-align:middle;
    }
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
-webkit-print-color-adjust: exact; 
    }
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    .invoice-box table tr.heading td {
        background: #eee;
-webkit-print-color-adjust: exact; 
        border-bottom: 1px solid #ddd;
        font-weight: bold;
        font-size:12px;
    }
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
-webkit-print-color-adjust: exact; 
    }
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    .invoice-box table tr.total td:nth-child(2) {
        // border-top: 2px solid #eee;
-webkit-print-color-adjust: exact; 
        font-weight: bold;
    }
    .vehicle-detail{
 width:50% !important;
margin-bottom:15px;
page-break-after: always;
}.vehicle-detail th {
    background: #efefef;
    -webkit-print-color-adjust: exact; 
    padding: 6px 20px;
}
.vehicle-detail td {
    background: #f7f7f7;
  -webkit-print-color-adjust: exact; 
    padding:6px 20px !important;
   -webkit-print-color-adjust: exact; 
}
.final-detail{
    max-width:300 !important;
   margin-bottom:15px;
   border: 1px solid #d1d1d1;
}
.final-detail td{
	 background: #f7f7f7;
  -webkit-print-color-adjust: exact; 
    padding:6px 20px !important;
   -webkit-print-color-adjust: exact; 
   font-weight: normal;
   border-bottom: 1px solid #d1d1d1;
}
.final-detail tr:last-child td{
	border-bottom: none;
}
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    /* RTL */
    .rtl {
        direction: rtl;
        font-family: Tahoma, "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
    }
    .rtl table {
        text-align: right;
    }
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>
<body>
    
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top_rw" style="background-color:#000;">
                <td colspan="2" align="left">';
                $logo =asset('frontend/images/logo.png');
                   $message .='<img src="'.$logo.'">
                </td>
                <td colspan="2" align="right" style="margin-right: 10px; color: #ffffff;">
                Order Id: '.$order_id.'
                </td>
                </tr>
             <tr class="top_rw" style="background-color:#000;">
             <td colspan="4" align="right" style="margin-right: 10px; color: #ffffff;">
                Payment Mode: '.$booking->payment.'
                </td>
             </tr>   
            <tr class="top">
                <td colspan="3">
                    <table>
                        <tr>
                            <td>
                            <b> Vendor: </b> <br>
                                '.$vendor->name.' <br>
                                Billing Address : '.$vendor->billing_address.'  <br>
                                Service Address : '.$vendor->billing_address.' <br>
                                '.$vendor->zip_code.' <br>
                                '.$vendor->email.' <br>
                                '.$vendor->mobile.' <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>';
            $address = $booking->address!=null ? $booking->address : '-';
            $address1 = $booking->address1!=null ? $booking->address1 : '-'; 
            $message .='<tr class="information">
                  <td colspan="4">
                    <table>
                        <tr>
                            <td colspan="1" style="width: 50%;">
                            <b> Billing: '.$booking->name.' </b> <br>
                                '.$booking->email.' <br>
                                '.$booking->mobile.'<br>
                                '.$address.'<br>
                                '.$address1.'<br>
                                Date: '.$booking->date.'<br>
                                Time Slot: '.$booking->time_slot.' 
                            </td>
                            <td></td>
                            <td colspan="1" style="width: 40%;"> <b> Location Address: </b><br>
                                '.$location->name.'<br>
                                '.$location->address.'<br>
                                '.$location->postal_code.'<br>
                                '.$location->country.'<br>
                                '.$location->phone_number.'
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
<tr>
<td colspan="4">
<table class="vehicle-detail">
  <thead>
    
  </thead>
  <tbody>
    <tr>
      <th scope="col" colspan="2">Garage</th>
    </tr>
    <tr>
      <th scope="row">Year</th>
      <td>'.$garage->year.'</td>
    </tr>
<tr>
      <th scope="row">Make</th>
      <td>'.$garage->make.'</td>
    </tr>
<tr>
      <th scope="row">Model</th>
      <td>'.$garage->model.'</td>
    </tr>
<tr>
      <th scope="row">Trim</th>
      <td>'.$garage->trim.'</td>
    </tr>
<tr>
      <th scope="row">Mileage</th>
      <td>'.$garage->mileage.'</td>
    </tr>
  </tbody>
</table>
</td>
</tr>
<tr>
          <td colspan="4">
            <table class="final-detail" cellspacing="0px" cellpadding="2px">
            <tr class="heading">
                <td style="width:30%;">
                    Sno.
                </td>
                <td style="width:35%;">
                    Name
                </td>
                <td style="width:30%; text-align:center;">
                    Category
                </td>
                 <td style="width:30%; text-align:right;">
                   Price
                </td>
            </tr>';
              foreach($service as $key=>$ser){
                $key = $key+1;
            $message .='<tr class="item">
               <td style="width:10%;">'.$key.'</td>
               <td style="width:25%;">'.$ser->name.'</td>
                <td style="width:10%; text-align:center;">'.$ser->category_name.'</td>
                <td style="width:10%; text-align:right;">'.$ser->price.'</td>
                 
            </tr>';
        }
            $message .='</td>
</tr>
            </table>
            <tr class="total">
                 <td colspan="2"></td>
                  <td colspan="2">
                    <table class="final-detail" cellspacing="0px" cellpadding="2px">
                    ';
                    if($booking->coupon !=''){
                      $message .='<tr><td><b>Price</b></td>
                      <td>'.$booking->price.'</td>
                      </tr>
                      <tr><td><b>Coupon</b></td>
                      <td>'.$booking->coupon.'</td>
                      </tr>
                      <tr>
                      <td><b>Discount</b></td>
                      <td>'.$booking->coupon_discount.'</td>
                      </tr><tr><td><b>Grand Price</b></td>
                      <td>'.$booking->after_coupon.'</td>
                      </tr>
                      ';
                    }else{
                        $message .='<tr><td><b>Grand Price</b></td>
                      <td>'.$booking->price.'</td>
                      </tr>';
                    }  
                      $message .='</table>
                    </td>
            </tr>
        </table>
    </div>

</body>
</html>';

$pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($message);
     $pdf_name =  $order_id;
      $pdf->save(public_path('images/invoices/').$pdf_name.'.pdf');
      $pdf_path = public_path('images/invoices/').$pdf_name;
      $pdf_ext = $pdf_path.'.pdf';
      return $pdf_ext; 
}