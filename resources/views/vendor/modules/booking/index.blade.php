@extends('vendor.layouts.layout')

@section('stylesheets')
<style type="text/css">
    .hide{
        display: none;
    }
</style>
@endsection
@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
                <h3 class="page-title">Bookings</h3>
                <a href="javascript:void(0);" data-toggle="modal" class="btn primary-btn" data-target="#newBooking"> New Booking </a>
                <a href="javascript:void(0);" class="modal_target btn primary-btn" data-action="{{route('vendor.booking.email')}}"> Registered User Booking </a>
            </div>
            <div class="content-body">
                <div class="csm-card">
                    <div class="csm-card-head d-f j-c-s-b">
                            <h3 class="csm-title">Booking</h3>
                        </div>
                    <div class="csm-body">  
                        <div class="table-responsive">
                            <table class="table dash-table cursor-row " id="dataTable">
                              <thead>
                                <tr>
                                  <th>Bookings#</th>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Number</th>
                                  <th>Date</th>
                                  <th>Time</th>
                                  <th>Total ($)</th>
                                  <th>Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($booking as $key=>$book)
                                <tr>
                                  <td>{{$key+1}}</td>
                                  <td>{{$book->name}}</td>
                                  <td>{{$book->email}}</td>
                                  <td>{{$book->mobile}}</td>
                                  <td><a href="{{route('vendor.booking.view',$book->id)}}" class="target_window">{{$book->date}}</a></td>
                                  <td>{{$book->time_slot}}</td>
                                  <td>{{$book->coupon!='' ? $book->after_coupon : $book->price}}</td>
                                  <td><span class="badge {{$book->status==1 ? 'badge-success' : 'badge-danger'}}">{{$book->status==1 ? 'Completed' : 'Booked'}}</span></td>
                                </tr>                  
                                @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>
                  </div>  
            </div>
        </div>
@stop        

@section('modal')
<div class="modal fade" id="newBooking" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">New Booking</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="create-booking" data-action="{{route('vendor.booking.guest.save')}}" class="require-validation"
                        data-cc-on-file="false"
                        data-stripe-publishable-key="{{setting('stripe_key')}}">
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="form-group">
                                <label class="form-label">Location<span class="astrick">*</span></label>
                                 <select name="location_id" class="form-control">
                                     <option value="">Select Location</option>
                                     @foreach($location as $key=>$value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                     @endforeach
                                 </select>
                              </div>
                           </div>

                           <div class="col-lg-12">
                              <div class="form-group">
                                <label class="form-label">Name<span class="astrick">*</span></label>
                                 <input type="text"  autocomplete="off" name="name" class="form-control" placeholder="Name" value="" required>
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                <label class="form-label">Email<span class="astrick">*</span></label>
                                 <input type="text" class="form-control" placeholder="Email" name="email" value="" autocomplete="off" required="">  
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                <label class="form-label">Contact Number<span class="astrick">*</span></label>
                                 <input type="number" class="form-control" name="mobile" autocomplete="off" placeholder="Enter Your Number" value="">
                              </div>
                           </div> 
                           <div class="col-lg-12">
                              <div class="form-group">
                                <label class="form-label">Year<span class="astrick">*</span></label>
                                 <select class="form-control valid" name="year" aria-invalid="false" required="">
                                    {!! car_year() !!}
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                <label class="form-label">Make<span class="astrick">*</span></label>
                                 <input type="text" class="form-control" placeholder="Make" name="make" value="" autocomplete="off" required="">  
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                <label class="form-label">Model<span class="astrick">*</span></label>
                                 <input type="text" class="form-control" placeholder="Model" name="model" value="" autocomplete="off" required=""> 
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                <label class="form-label">Trim<span class="astrick">*</span></label>
                                 <input type="text" class="form-control" placeholder="Trim" name="trim" value="" autocomplete="off" required="">
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                <label class="form-label">Mileage<span class="astrick">*</span></label>
                                 <input type="number" class="form-control" placeholder="Enter Mileage" name="mileage" value="" autocomplete="off" required="">                               
                              </div>
                           </div>
                        
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Booking Date<span class="astrick">*</span></label>
                                    <input type="text" name="date" id="filter-date" class="form-control" placeholder="Booking date" required="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Time Slot<span class="astrick">*</span></label>
                                    <input type="text" name="time_slot" id="filter-time" class="form-control" placeholder="Time Slot" required="" autocomplete="off" >
                                    
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                  <label  id="service-error"></label>
                                       <ul class="select-ser-list-new service-charges-list">                                        
                                        <li><label class="ser-chrg">Service Charges</label> <span class="cgr-amt">$Price</span></li>
                                        @foreach($service as $key=>$s)

                                        <li>
                                           <div class="select-ser-card">
                                            
                                            <label class="ser-chrg">{{$s->service->name}}   <span class="badge badge-info ml-4">{{$s->parent_service($s->service_id) !=null ? $s->parent_service($s->service_id)->name : ''}}</span></label> 
                                            <div class="custom-control custom-checkbox check-without-label">
                                               <input type="checkbox" name="newservice[]" class="custom-control-input" id="customCheck{{$key}}v{{$s->id}}"  data-value="{{$s->price}}" value="{{$s->service_id}}">
                                               <label class="custom-control-label" for="customCheck{{$key}}v{{$s->id}}"></label>
                                            </div>
                                             </div>
                                             <ul class="service-charges-list ser_price_info_blck">
                                               <li><label class="ser-chrg">{{$s->service->name}}</label></li>

                                               <li class="grand-total"><label class="ser-chrg">{{$s->service->name}}</label> <span class="cgr-amt"> USD {{$s->price}}</span></li>
                                             </ul>
                                          </li>
                                          @endforeach
                                          <li id="coupon-target"></li>
                                          <li class="grand-total"><label class="ser-chrg">Grand Total</label> <span class="cgr-amt cgr-total-amt-new"> USD 0</span></li>
                                      </ul>

                                    </div>
                            <div class="col-lg-12" >
                                    <div class="form-group">
                                       <div class="input-with-btn">
                                          <input type="text" class="form-control" id="coupon-check" name="coupon" placeholder="Coupon" value="" data-action="{{route('vendor.coupon.apply')}}">
                                          <button type="button" class="oylerz-btn primary-btn input-btn apply-btn coupon-apply">Apply</button>
                                       </div>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" name="cash" class="custom-control-input" id="cash"  value="1">
                                  <label class="custom-control-label" for="cash">Cash</label>
                               </div>
                            </div>
                            </div>
                          <div class="col-lg-12">
                            <div class="payment-div row">
                            <div class="col-lg-12">
                                    <div class="form-group card required">                            
                                       <input name="credit-number" class="cc-number card-number form-control" type="tel"  maxlength="19" placeholder="Card Number">                                                      
                                    </div>
                                 </div>
                                 <div class="col-lg-4 ">
                                    <div class="form-group expiration required">                        
                                     <input class="form-control card-expiry-month" maxlength="2" name="credit-expires" placeholder="MM" type="tel">
                                    </div>
                                 </div>
                                 <div class="col-lg-4">
                                    <div class="form-group expiration required">                                                                  
                                     <input class="form-control card-expiry-year" maxlength="4" name="credit-expires-yy" placeholder="YYYY" type="tel">
                                    </div>
                                 </div>
                                 <div class="col-lg-4 ">
                                    <div class="form-group cvc required"> 
                                        <input name="credit-cvc" class="cc-cvc form-control card-cvc" type="tel" pattern="\d*" maxlength="4" placeholder="CVC">
                                    </div>
                                 </div>
                           <div class='col-md-12 error form-group hide'>
                              <div class='alert-danger alert'>Please correct the errors and try
                                 again.
                              </div>
                           </div>
                          </div> 
                        </div>
                           <div class="col-lg-12">
                                <div class="btn-wrap d-f a-i-c">
                                    @if(!isset($timeslot->time_slot))
                                        <div class='alert-danger alert'>Time Slots Are not Given by Vendor</div>
                                    @else
                                        <button type="submit" class="main-btn">Book</button>
                                    @endif
                                </div>
                            </div>
                        
                        </div>
                            
                        </div>
                        </form>  
                    
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="registeredBooking" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">New Booking</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="registered-email">
          
                    
      </div>
    </div>
  </div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
    $(function () {
         jQuery('#filter-date').datetimepicker({
            minDate:0,
            @if(isset($timeslot->days))
            disabledWeekDays:"{{  $timeslot->days }}",
            @endif
             timepicker:false,
               format: 'd/m/Y',
                 onChangeDateTime:function(dp,$input){
                    var d_day = moment(dp).format('YYYY/MM/DD');
                    var c_day = moment().format('YYYY/MM/DD');
                    $("#filter-time").val('');
                     if(d_day == c_day){
                        jQuery('#filter-time').datetimepicker({
                            minTime:0
                        });
                     }else{
                        jQuery('#filter-time').datetimepicker({
                            minTime:false
                        });
                     } 
                }

         });
        
        
         $('#filter-time').datetimepicker({
        datepicker: false, 
         format:'h:i a',
         formatTime: 'h:i a',
        // format:'H:i',
        validateOnBlur: false,
        @if(isset($timeslot->time_slot))
        allowTimes:<?php print_r ( $timeslot->time_slot) ?>
        @endif
    });

         
         
  // Set up formatting for Credit Card fields
  $('.cc-number').formatCardNumber();
  $('.cc-expires').formatCardExpiry();
  $('.cc-cvc').formatCardCVC();
});



  $('.select-ser-list-new input:checkbox').change(function(){
    if($(this).is(":checked")) {
        $(this).closest('li').addClass("show");
    } else {
        $(this).closest('li').removeClass("show");
    }
});
                 

$("input[name='newservice[]']").change(function () {
        var price = 0;
        $("input[name='newservice[]']").each(function () {
            var p = parseInt(this.checked ? $(this).attr('data-value') : 0);
            price = price + p;
        });
        $(".cgr-total-amt-new").text('USD '+price);
 });

    $(document).ready(function () {
               
                var table = $('#dataTable').DataTable({!! json_encode(
                    array_merge([
                        "order" => [],
                     "columnDefs" => [['targets' => -1, 'searchable' =>  false, 'orderable' => false]],
                    ])
                , true) !!});
       });
$('#dataTable').on('click', 'tbody td:not(.checkbox_in)', function(){
       window.location = $(this).closest('tr').find('.target_window').attr('href');
    });

$('body').on('click','.modal_target', function(e){
       $("#registeredBooking").modal('show');
          $.ajax({
                url : $(this).attr('data-action'),
                type: 'GET',   
                dataTYPE:'JSON',
                headers: {
                 'X-CSRF-TOKEN': $('input[name=_token]').val()
                },
                beforeSend: function() {
                                            
                },
                success: function (data) {                                  
                if(data.success==true){
                  $("#registered-email").html(data.html);      
                }

                  
                },
                complete: function(result) {
                },
                error: function (jqXhr, textStatus, errorMessage) {
                     
                }

        });
  });        


$('body').on('submit','#booking-email', function(e){
       e.preventDefault();
       $this = $(this);
       submitForm($this);
  });        

function submitForm($this){
    if($($this).valid() ==true){

$.ajax({
                url : $this.attr('data-action'),
                type: 'POST',  
                data:$this.serialize(),     
                dataTYPE:'JSON',
                headers: {
                 'X-CSRF-TOKEN': $('input[name=_token]').val()
                },
                beforeSend: function() {
                    $this.find(':input[type=submit]').prop('disabled', true);
                                            
                },
                success: function (data) {                                   
                  $this.find(':input[type=submit]').removeAttr('disabled');
                  if(data.success==true){
                    $("#registered-email").html(data.html)
                   }else if(data.status==1){
                    toastr.success(data.message);
                    setTimeout(function () {
                        location.reload(true);
                    }, 1000);
                   }else if(data.status==0){
                    toastr.error(data.message);
                   }
                   else{
                    $("#t_error").html(data.message);
                    setTimeout(function () {
                        $("#t_error").html("");
                    }, 8000);
                   }
                },
                complete: function(result) {
                },
                error: function (jqXhr, textStatus, errorMessage) {
                     
                }

        });     
    }
}    

jQuery("form[id='create-booking']").validate({
    rules: {
        'location_id':{
            required: true,
        },
        'name':{
                 required: true, 
        nowhitespace: true,
        maxlength:35,
        
      },
        'mobile':{
                 required: true, 
        nowhitespace: true,
        minlength:10,
        digits:true
      },
    'email':{
        required: true,
        customemail: true
    },    
    'year': 
      {
        required: true 
      },
      'make': 
      {
        required: true 
      },
      'model': 
      {
        required: true 
      },
      'trim': 
      {
        required: true 
      },
      'mileage': 
      {
        required: true,
        digits:true 
      },
      'date': 
      {
        required: true 
      },
      'time_slot':{
        required: true,
      },
      'newservice[]':{
        required:true
      },
      'credit-number':{
        required:true
      },
     'credit-expires':{
        required:true
     },
     'credit-expires-yy':{
        required:true
     },
    'credit-cvc':{
        required:true
    }
    },
       messages: {
      'newservice[]' : 'Please Select at least One Service' 
   },
    errorPlacement: function (error, element) {
    if (element.attr("type") == "checkbox") {
        error.appendTo('#service-error');    
    }else{
          error.insertAfter(element);
    }
    }
});



</script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
   <script type="text/javascript">
      $(function() {
    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
                'input[type=text]', 'input[type=file]',
                'textarea'
            ].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
        $errorMessage.addClass('hide');
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();
            }
        });
        if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
        }
    });
    function stripeResponseHandler(status, response) {
        if($("#cash").is(':checked')){
                $this = $("#create-booking");
                submitForm($this);
        }
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            
           
                $this = $("#create-booking");
                submitForm($this);           
        }
    }
});

$("#cash").click(function(){
   if($(this).is(':checked')){
    $(".payment-div").hide();
   }else{
   $(".payment-div").show();
}
});
      
$('body').on('click','.coupon-apply', function(e){
    var val = [];
  
  $('input[name="newservice[]"]:checkbox:checked').each(function(i){
    val[i] = $(this).val();
  });
   if($("#coupon-check").val()!='' && val!=''){
       $.ajax({
                url : $("#coupon-check").attr('data-action'),
                type: 'POST',   
                data : { coupon: $("#coupon-check").val(),service :val },
                dataTYPE:'JSON',
                headers: {
                 'X-CSRF-TOKEN': $('input[name=_token]').val()
                },
                beforeSend: function() {
                                            
                },
                success: function (data) {   
                  if(data.status==0){
                      toastr.error(data.message);
                  }  
                  if(data.status==1){
                     $("#coupon-target").html(data.html);
                     $(".cgr-total-amt-new").text(data.discount_price);
                     $(".coupon-apply").remove();
                     $("#coupon-check").prop('readonly', true);
                  }                             
                     

                  
                },
                complete: function(result) {
                },
                error: function (jqXhr, textStatus, errorMessage) {
                     
                }

        });  
    }else{
       toastr.error('Please check services and coupon code'); 
    }
});



















$('body').on('click','.coupon-apply-register', function(e){
    var val = [];
  
  $('input[name="service[]"]:checkbox:checked').each(function(i){
    val[i] = $(this).val();
  });
   if($("#coupon-check-register").val()!='' && val!=''){
       $.ajax({
                url : $("#coupon-check-register").attr('data-action'),
                type: 'POST',   
                data : { coupon: $("#coupon-check-register").val(),service :val },
                dataTYPE:'JSON',
                headers: {
                 'X-CSRF-TOKEN': $('input[name=_token]').val()
                },
                beforeSend: function() {
                                            
                },
                success: function (data) {   
                  if(data.status==0){
                      toastr.error(data.message);
                  }  
                  if(data.status==1){
                     $("#coupon-target-register").html(data.html);
                     $(".cgr-total-amt").text(data.discount_price);
                     $(".coupon-apply-register").remove();
                     $("#coupon-check-register").prop('readonly', true);
                  }                             
                     

                  
                },
                complete: function(result) {
                },
                error: function (jqXhr, textStatus, errorMessage) {
                     
                }

        });  
    }else{
       toastr.error('Please check services and coupon code'); 
    }
});

   </script>
@endsection