 <form id="booking-registered" data-action="{{route('vendor.booking.save')}}"  class="require-validation-register"
                        data-cc-on-file="false"
                        data-stripe-publishable-key="{{setting('stripe_key')}}">
    <input type="hidden" name="email" value="{{$data->email}}">
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
                                <label class="form-label">Contact Number<span class="astrick">*</span></label>
                                 <input type="number" class="form-control" name="mobile" autocomplete="off" placeholder="Enter Your Number" value="">
                              </div>
                           </div>
    <div class="col-lg-12 vehicle-garage">

                                <div class="form-group">
                                    <label class="form-label">Garage<span class="astrick">*</span></label>
                                    <select class="form-control" name="garage">
                                          <option value="">Garage</option>
                                          <option value="">Select Garage</option>
                                          @foreach($garage as $key=>$g)
                                            <option value="{{$g->id}}">{{$g->name}}</option>
                                          @endforeach
                                       </select>
                                </div>
                             
                            </div>
                              
                     <div class="col-lg-12">
                              <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="manual" name="manual" value="1">
                                  <label class="custom-control-label" for="manual">Manually Add Vehicle</label>
                               </div>
                            </div>
                            </div>
                     <div class="col-lg-12">
                     <div class="manually-add-vehicle row" style="display: none;">
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
                     </div>
                   </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Booking Date<span class="astrick">*</span></label>
                                    <input type="text" name="date" id="filter-date1" class="form-control" placeholder="Booking date" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Time Slot<span class="astrick">*</span></label>
                                    <input type="text" name="time_slot" id="filter-time1" class="form-control" placeholder="Time Slot" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                       <label  id="register-service-error"></label>
                                       <ul class="select-ser-list service-charges-list1">
                                        
                                        <li><label class="ser-chrg">Service Charges</label> <span class="cgr-amt">$Price</span></li>
                                        @foreach($service as $key=>$s)

                                        <li>
                                           <div class="select-ser-card">
                                            <label class="ser-chrg">{{$s->service->name}}   <span class="badge badge-info ml-4">{{$s->parent_service($s->service_id) !=null ? $s->parent_service($s->service_id)->name : ''}}</span></label> 
                                            <div class="custom-control custom-checkbox check-without-label">
                                               <input type="checkbox" name="service[]" class="custom-control-input" id="customCheck{{$key}}" required="" data-value="{{$s->price}}" value="{{$s->service_id}}">
                                               <label class="custom-control-label" for="customCheck{{$key}}"></label>
                                            </div>
                                             </div>
                                             <ul class="service-charges-list">
                                               <li><label class="ser-chrg">{{$s->service->name}}</label></li>
                                               <li class="grand-total"><label class="ser-chrg">{{$s->service->name}}</label> <span class="cgr-amt"> USD {{$s->price}}</span></li>
                                             </ul>
                                          </li>
                                          @endforeach
                                          <li id="coupon-target-register"></li>
                                          <li class="grand-total"><label class="ser-chrg">Grand Total</label> <span class="cgr-amt cgr-total-amt"> USD 0</span></li>
                                      </ul>
                                    </div>
                            </div>
                            <div class="col-lg-12" >
                                    <div class="form-group">
                                       <div class="input-with-btn">
                                          <input type="text" class="form-control" id="coupon-check-register" name="coupon" placeholder="Coupon" value="" data-action="{{route('vendor.coupon.apply')}}">
                                          <button type="button" class="oylerz-btn primary-btn input-btn apply-btn coupon-apply-register">Apply</button>
                                       </div>
                                    </div>
                                 </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="cash-register" name="cash" value="1" >
                                  <label class="custom-control-label" for="cash-register">Cash</label>
                               </div>
                            </div>
                            </div>
                          <div class="col-lg-12">
                            <div class="payment-div-register row">
                            <div class="col-lg-12">
                                    <div class="form-group card required">                            
                                       <input name="credit-number" class="cc-number card-number-register form-control" type="tel"  maxlength="19" placeholder="Card Number">                                                      
                                    </div>
                                 </div>
                                 <div class="col-lg-4 ">
                                    <div class="form-group expiration required">                        
                                     <input class="form-control card-expiry-month-register" maxlength="2" name="credit-expires" placeholder="MM" type="tel">
                                    </div>
                                 </div>
                                 <div class="col-lg-4">
                                    <div class="form-group expiration required">                                                                  
                                     <input class="form-control card-expiry-year-register" maxlength="4" name="credit-expires-yy" placeholder="YYYY" type="tel">
                                    </div>
                                 </div>
                                 <div class="col-lg-4 ">
                                    <div class="form-group cvc required"> 
                                        <input name="credit-cvc" class="cc-cvc form-control card-cvc-register" type="tel" pattern="\d*" maxlength="4" placeholder="CVC">
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
</form>


<script type="text/javascript">




$(function () {

  // Set up formatting for Credit Card fields
  $('.cc-number').formatCardNumber();
  $('.cc-expires').formatCardExpiry();
  $('.cc-cvc').formatCardCVC();

   jQuery('#filter-date1').datetimepicker({
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
                        jQuery('#filter-time1').datetimepicker({
                            minTime:0
                        });
                     }else{
                        jQuery('#filter-time1').datetimepicker({
                            minTime:false
                        });
                     } 
                }

         });
        
        jQuery('#filter-time1').datetimepicker({
            datepicker:false,
                    format:'h:i a',
        formatTime: 'h:i a',
        validateOnBlur: false,
            @if(isset($timeslot->time_slot))
        allowTimes:<?php print_r ( $timeslot->time_slot) ?>
        @endif
         });
});




  $('.select-ser-list input:checkbox').change(function(){
    if($(this).is(":checked")) {
        $(this).closest('li').addClass("show");
    } else {
        $(this).closest('li').removeClass("show");
    }
});
                 

$("input[name='service[]']").change(function () {
        var price = 0;
        $("input[name='service[]']").each(function () {
            var p = parseInt(this.checked ? $(this).attr('data-value') : 0);
            price = price + p;
        });
        $(".cgr-total-amt").text('USD '+price);
 });


    jQuery("form[id='booking-registered']").validate({
    rules: {
        'location_id':{
            required:true
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
    'garage': 
      {
        required: true 
      },
      'date': 
      {
        required: true 
      },
      'time_slot':{
        required: true,
      },
      'service[]':{
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
      'service[]' : 'Please Select at least One Service' 
   },
    errorPlacement: function (error, element) {
    if (element.attr("type") == "checkbox") {
        error.appendTo('#register-service-error');    
    }else{
          error.insertAfter(element);
    }
    }

});
</script>                        

   <script type="text/javascript">
      $(function() {
    var $form = $(".require-validation-register");
    $('form.require-validation-register').bind('submit', function(e) {
        var $form = $(".require-validation-register"),
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
                number: $('.card-number-register').val(),
                cvc: $('.card-cvc-register').val(),
                exp_month: $('.card-expiry-month-register').val(),
                exp_year: $('.card-expiry-year-register').val()
            }, stripeResponseHandler);
        }
    });
    function stripeResponseHandler(status, response) {
        if($("#cash-register").is(':checked')){
                $this = $("#booking-registered");
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
                $this = $("#booking-registered");
                submitForm($this);             
        }
    }
});

      $("#manual").click(function(){
   if($(this).is(':checked')){
    $(".manually-add-vehicle").show();
    $(".vehicle-garage").hide();
   }else{
    $(".manually-add-vehicle").hide();
   $(".vehicle-garage").show();
}
});
   
   $("#cash-register").click(function(){
   if($(this).is(':checked')){
    $(".payment-div-register").hide();
   }else{
   $(".payment-div-register").show();
}
});
   </script>