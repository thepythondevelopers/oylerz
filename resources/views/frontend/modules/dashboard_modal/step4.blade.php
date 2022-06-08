<form class="oylerz-card" id="step4" data-action="{{route('frontend.step5')}}" >
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
    
   <input type="hidden" name="manual" value="{{isset($data->manual) ? $data->manual : ''}}">
   <input type="hidden" name="garage" value="{{isset($data->garage) ? $data->garage : ''}}">
   <input type="hidden" name="year" value="{{isset($data->year) ? $data->year : ''}}">
   <input type="hidden" name="make" value="{{isset($data->make) ? $data->make : ''}}">
   <input type="hidden" name="model" value="{{isset($data->model) ? $data->model : ''}}">
   <input type="hidden" name="trim" value="{{isset($data->trim) ? $data->trim : ''}}">
   <input type="hidden" name="mileage" value="{{isset($data->mileage) ? $data->mileage : ''}}">
   <!-- 4 -->
      <input type="hidden" name="vendor" value="{{isset($data->vendor) ? $data->vendor : ''}}">
   <input type="hidden" name="service" value="{{isset($data->service) ? json_encode($data->service) : ''}}">




<div class="multistep step-three" >
                           <div class="oylerz-head">
                              <h3 class="oylerz-title"><strong class="text-primary">Step 3:</strong> Choose Scheduling Details</h3>
                              <a href="javascript:void(0);" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </a>
                           </div>
                           <div class="oylerz-body">
                              <div class="row">
                                 
                        @if(Auth::check() && Auth::user()->role=='user')                           
                                 <div class="col-lg-6">
                                    <div class="form-group "> 
                                      <div class="input-wrap">
									  <label>Name</label>	
                                       <input type="text"  autocomplete="off" name="name" class="form-control" placeholder="Name" value="{{isset($data->name) ? $data->name : Auth::user()->name}}"> 
                                    </div>                                     
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group "> 
                                      <div class="input-wrap">
									  <label>Email</label>	
                                       <input type="text"  autocomplete="off" name="email" class="form-control" placeholder="Email" value="{{isset($data->email) ? $data->email : Auth::user()->email}}"> 
                                    </div>                                     
                                    </div>
                                 </div>
                        @else  
                        <div class="col-lg-6">
                                    <div class="form-group "> 
                                      <div class="input-wrap">
									  <label>Name</label>	
                                       <input type="text"  autocomplete="off" name="name" class="form-control" placeholder="Name" value="{{isset($data->name) ? $data->name : ''}}">        
                                    </div>                                     
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group "> 
                                      <div class="input-wrap">
									  <label>Email</label>	
                                       <input type="text"  autocomplete="off" name="email" class="form-control" placeholder="Email" value="{{isset($data->email) ? $data->email : ''}}"> 
                                    </div>                                     
                                    </div>
                                 </div>


                        @endif 
                                 <div class="col-lg-6">
                                    <div class="form-group datepicker-wrap"> 
                                      <div class="input-wrap">   
									   <label>Booking Date</label>	
                                       <input type="text" id="filter-date" autocomplete="off" name="date" class="form-control" placeholder="Booking Date" value="{{isset($data->date) ? $data->date : ''}}" readonly="true"/> 
                                       <label for="filter-date" class="input-icon"><i class="fas fa-calendar-alt"></i></label>
                                    </div>                                     
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
									   <label>Time Slot</label>	
                                       <input type="text" id="filter-time" autocomplete="off" name="time_slot" class="form-control" placeholder="Time Slot" value="{{isset($data->time_slot) ? $data->time_slot : ''}}" readonly="true"/>
                                    </div>
                                 </div>
                                 <div class="col-lg-12">
                                    <div class="form-group"> 
									   <label>Phone Number</label>	
                                       <input type="number" class="form-control" name="mobile" autocomplete="off" placeholder="Enter Your Number" value="{{isset($data->mobile) ? $data->mobile : ''}}">
                                       <small class="form-text text-muted">This will be your service contact number</small>                                                      
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="oylerz-foot mt-4">
                           <div class="btn-wrap text-center">
                              <button type="button" id="back" data-action="{{route('frontend.step3')}}" class="oylerz-btn black-btn mr-4">Back</button>
                              <button type="submit" id="nextBtn"  class="oylerz-btn primary-btn">Next</button>
                           </div>
                           <ul class="step-dot-list mt-4">
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt active"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                           </ul>
                        </div>
                     </form>

                     <script type="text/javascript">
                         
         jQuery('#filter-date').datetimepicker({
            minDate:0,
             timepicker:false,
              focusOnShow: false,
              ignoreReadonly: true,
               format: 'm/d/Y',
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
        
        jQuery('#filter-time').datetimepicker({
            datepicker:false,
            format:'h:i a',
             formatTime: 'h:i a',
             validateOnBlur: false,

              ignoreReadonly: true,
         });

  
                     </script>

                     