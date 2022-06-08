<form class="oylerz-card" id="step5" data-action="{{route('frontend.step6')}}" >
            <!-- 1 -->
   <input type="hidden" name="address" value="{{isset($data->address) ? $data->address : ''}}">
   <input type="hidden" name="lat" value="{{isset($data->lat) ? $data->lat : ''}}">
   <input type="hidden" name="long" value="{{isset($data->long) ? $data->long : ''}}">
      <input type="hidden" name="pin_code" value="{{isset($data->pin_code) ? $data->pin_code : ''}}">
   <input type="hidden" name="country" value="{{isset($data->country) ? $data->country : ''}}">
   <!-- 2 -->
   <input type="hidden" name="address1" value="{{isset($data->address1) ? $data->address1 : ''}}">
   <!-- 3 -->
   <input type="hidden" name="car_select" value="{{isset($data->car_select) ? $data->car_select : ''}}">
   <input type="hidden" name="date" value="{{isset($data->date) ? $data->date : ''}}">
   <input type="hidden" name="time_slot" value="{{isset($data->time_slot) ? $data->time_slot : ''}}">
   <input type="hidden" name="mobile" value="{{isset($data->mobile) ? $data->mobile : ''}}">
   <input type="hidden" name="name" value="{{isset($data->name) ? $data->name : ''}}">
   <input type="hidden" name="email" value="{{isset($data->email) ? $data->email : ''}}">
   <!-- 4 -->
      <input type="hidden" name="manual" value="{{isset($data->manual) ? $data->manual : ''}}">
   <input type="hidden" name="garage" value="{{isset($data->garage) ? $data->garage : ''}}">
   <input type="hidden" name="year" value="{{isset($data->year) ? $data->year : ''}}">
   <input type="hidden" name="make" value="{{isset($data->make) ? $data->make : ''}}">
   <input type="hidden" name="model" value="{{isset($data->model) ? $data->model : ''}}">
   <input type="hidden" name="trim" value="{{isset($data->trim) ? $data->trim : ''}}">
   <input type="hidden" name="mileage" value="{{isset($data->mileage) ? $data->mileage : ''}}">

<div class="multistep step-four" >
                           <div class="oylerz-head">
                              <h3 class="oylerz-title"><strong class="text-primary">Step 4:</strong> Choose Your Service</h3>
                              <a href="javascript:void(0);" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </a>
                           </div>
                           <div class="oylerz-body">
                              <div class="row">
                                 <div class="col-lg-12">
                                    <div class="form-group d-f a-ic">
                                       <div class="custom-control custom-radio mr-4">
                                          <input type="radio" id="customRadio1" name="service_type" class="custom-control-input" checked>
                                          <label class="custom-control-label" for="customRadio1">Service@Store</label>
                                       </div>
                                       <!-- <div class="custom-control custom-radio">
                                          <input type="radio" id="customRadio2" name="service_type" class="custom-control-input">
                                          <label class="custom-control-label" for="customRadio2">Service@Home</label>
                                       </div> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-12">
                                    <div class="form-group select-ser-wrap">
                                       <select class="form-control" id="vendor" name="location_id" data-action="{{route('frontend.vendor_service','0')}}">
                                          <option value="">Chose your Location </option>
                                          @foreach($location as $k=>$l)
                                          <option value="{{$l->id}}">{{$l->name}}</option>
                                          @endforeach
                                       </select>
                                       <!-- <div class="service-filter d-f j-c-s-b">
                                          <a href="javascript:void();" class="select-ser-toggle">Select your services <span class="toggle-icon ml-4"><i class="far fa-angle-down"></i></span></a>
                                          <ul class="ser-list">
                                             <li><a href="javascript:void(0);" class="ser-link">Sort by <span class="rotate-icon"><i class="fas fa-exchange-alt"></i></span></a></li>
                                             <li><a href="javascript:void(0);" class="ser-link">Filter <span><i class="fas fa-filter"></i></span></a></li>
                                          </ul>
                                       </div> -->
                                        <div class="form-group mt-4" id="selectService" >
                                       
                                    </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="oylerz-foot mt-4">
                           <div class="btn-wrap text-center">
                              <button type="button" id="back" data-action="{{route('frontend.step4')}}" class="oylerz-btn black-btn mr-4">Back</button>
                              <button type="submit" id="nextBtn"  class="oylerz-btn primary-btn">Next</button>
                           </div>
                           <ul class="step-dot-list mt-4">
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt active"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                           </ul>
                        </div>
                     </form>


                     <script type="text/javascript">
                        function checkbox_change(){
                          $('.select-ser-list input:checkbox').change(function(){
                           if($(this).is(":checked")) {
                                   $(this).closest('li').addClass("show");
                               } else {
                                   $(this).closest('li').removeClass("show");
                               }
                           });
                        }  

                        $('#vendor').on('change', function() {
                           var url = $(this).attr('data-action');
                           url = url.replace("0", this.value);
                                       $.ajax({
                                        url : url,
                                        type: 'POST',   
                                        dataTYPE:'JSON',
                                        headers: {
                                         'X-CSRF-TOKEN': $('input[name=_token]').val()
                                        },
                                        beforeSend: function() {
                                          $("#selectService").html('');                          
                                        },
                                        success: function (data) {                                   
                                          $("#selectService").html(data.html);      
                                          checkbox_change();
                                        },
                                        complete: function(result) {
                                        },
                                        error: function (jqXhr, textStatus, errorMessage) {
                                             
                                        }

                                });
                        });
                        
                     </script>