<form  id="step6" data-action="{{route('frontend.schedule.save')}}"   class="require-validation oylerz-card"
                        data-cc-on-file="false"
                        data-stripe-publishable-key="{{setting('stripe_key')}}">

            <!-- 1 -->
   <input type="hidden" name="address" value="{{isset($data->address) ? $data->address : ''}}">
   <input type="hidden" name="lat" value="{{isset($data->lat) ? $data->lat : ''}}">
   <input type="hidden" name="long" value="{{isset($data->long) ? $data->long : ''}}">
      <input type="hidden" name="pin_code" value="{{isset($data->pin_code) ? $data->pin_code : ''}}">
   <input type="hidden" name="country" value="{{isset($data->country) ? $data->country : ''}}">
   <!-- 2 -->
   <input type="hidden" name="address1" value="{{isset($data->address1) ? $data->address1 : ''}}">

   <input type="hidden" name="date" value="{{isset($data->date) ? $data->date : ''}}">
   <input type="hidden" name="time_slot" value="{{isset($data->time_slot) ? $data->time_slot : ''}}">
   <input type="hidden" name="mobile" value="{{isset($data->mobile) ? $data->mobile : ''}}">
   <input type="hidden" name="name" value="{{isset($data->name) ? $data->name : ''}}">
   <input type="hidden" name="email" value="{{isset($data->email) ? $data->email : ''}}">
   
   <input type="hidden" name="car_select" value="{{isset($data->car_select) ? $data->car_select : ''}}">
      <input type="hidden" name="manual" value="{{isset($data->manual) ? $data->manual : ''}}">
   <input type="hidden" name="garage" value="{{isset($data->garage) ? $data->garage : ''}}">
   <input type="hidden" name="year" value="{{isset($data->year) ? $data->year : ''}}">
   <input type="hidden" name="make" value="{{isset($data->make) ? $data->make : ''}}">
   <input type="hidden" name="model" value="{{isset($data->model) ? $data->model : ''}}">
   <input type="hidden" name="trim" value="{{isset($data->trim) ? $data->trim : ''}}">
   <input type="hidden" name="mileage" value="{{isset($data->mileage) ? $data->mileage : ''}}">

   <input type="hidden" name="vendor" value="{{isset($data->vendor) ? $data->vendor : ''}}">
   <input type="hidden" name="service" value="{{isset($data->service) ? json_encode($data->service) : ''}}">
   <input type="hidden" name="location_id" value="{{isset($data->location_id) ? $data->location_id : ''}}">

   

<div class="multistep step-five" >
                           <div class="oylerz-head">
                              <h3 class="oylerz-title"><strong class="text-primary">Step 5:</strong> Specify Payment Info</h3>
                              <a href="javascript:void(0);" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </a>
                           </div>
                           <div class="oylerz-body">
                              <div class="row">
                                 <div class="col-lg-12" >
                                    <div class="form-group">
                                       <div class="input-with-btn">
                                          <input type="text" class="form-control" id="coupon-check" name="coupon" placeholder="Coupon" value="" data-action="{{route('frontend.coupon.check')}}">
                                          <button type="button" class="oylerz-btn primary-btn input-btn apply-btn coupon-apply">Apply</button>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-12">
                                    <div class="form-group">
                                       <ul class="service-charges-list">
                                          <li><label class="ser-chrg">Service Charges</label> <span class="cgr-amt">USD {{$price}}</span></li>

                                          <li id="coupon-target"></li>
                                          <li class="grand-total"><label class="ser-chrg">Grand Total</label>USD <span class="cgr-amt grnd-total-target">  {{$price}}</span></li>
                                       </ul>
                                    </div>
                                 </div>
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
                                        <input name="credit-cvc" class="cc-cvc form-control card-cvc-register" type="tel" pattern="\d*" maxlength="4" placeholder="CVC">
                                    </div>
                                 </div>
                               
                           <div class='form-row col-md-12'>
                           <div class='error form-group hide'>
                              <div class='alert-danger alert w-100'>Please correct the errors and try
                                 again.
                              </div>
                           </div>
                        </div>
                              </div>
                           </div>
                        </div>
                        <div class="oylerz-foot mt-4">
                           <div class="btn-wrap text-center">
                              <button type="button" id="back" data-action="{{route('frontend.step5')}}" class="oylerz-btn black-btn mr-4">Back</button>
                              <button type="submit" id="nextBtn"  class="oylerz-btn primary-btn">Next</button>
                           </div>
                           <ul class="step-dot-list mt-4">
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt active"><span class="step-dot"></span></li>
                           </ul>
                        </div>
                     </form>

                     

                     <script type="text/javascript">
                        $(function () {

                          // Set up formatting for Credit Card fields
                          $('.cc-number').formatCardNumber();
                          $('.cc-expires').formatCardExpiry();
                          $('.cc-cvc').formatCardCVC();
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
            if($("#step6").valid() ==true){
               $url = $("#step6").attr('data-action');
               data = $('#step6').serialize(); 
               get_modal($url,data,$("#step6"));    
            }    
        }
    }
});


</script>