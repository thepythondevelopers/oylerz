<form class="oylerz-card" id="step2" data-action="{{route('frontend.step3')}}" >
   <!-- 1 -->
   <input type="hidden" name="address" value="{{isset($data->address) ? $data->address : ''}}">
   <input type="hidden" name="lat" value="{{isset($data->lat) ? $data->lat : ''}}">
   <input type="hidden" name="long" value="{{isset($data->long) ? $data->long : ''}}">
      <input type="hidden" name="pin_code" value="{{isset($data->pin_code) ? $data->pin_code : ''}}">
   <input type="hidden" name="country" value="{{isset($data->country) ? $data->country : ''}}">
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
   <input type="hidden" name="date" value="{{isset($data->date) ? $data->date : ''}}">
   <input type="hidden" name="time_slot" value="{{isset($data->time_slot) ? $data->time_slot : ''}}">
   <input type="hidden" name="mobile" value="{{isset($data->mobile) ? $data->mobile : ''}}">
   <input type="hidden" name="name" value="{{isset($data->name) ? $data->name : ''}}">
   <input type="hidden" name="email" value="{{isset($data->email) ? $data->email : ''}}">
   <!-- 5 -->
      <input type="hidden" name="vendor" value="{{isset($data->vendor) ? $data->vendor : ''}}">
   <input type="hidden" name="service" value="{{isset($data->service) ? json_encode($data->service) : ''}}">
   

                        @csrf
<div class="multistep step-one" >
                           <div class="oylerz-head">
                              <h3 class="oylerz-title"><strong class="text-primary">Step 1:</strong> Specify Your Location</h3>
                              <a href="javascript:void(0);" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </a>
                           </div>
                           <div class="oylerz-body">
                              <div class="row">
                                 <div class="col-lg-12">
                                    <div class="form-group">   
                                       <label>Address</label>									
                                       <input type="text" class="form-control" name="address" placeholder="Address line 1" value="{{isset($data->address) ? $data->address : ''}}" autocomplete="off">

                                    </div>
                                 </div>
                                 <div class="col-lg-12">
                                    <div class="form-group">  
                                             <label>Address Line 2</label>									
                                             <input type="text" class="form-control" name="address1" placeholder="11704 97th St NW..." value="{{isset($data->address1) ? $data->address1 : ''}}" autocomplete="off">                                                   
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">  
                                       <label>Country</label>									
                                       <input type="text" class="form-control" name="country" placeholder="Country" value="{{isset($data->country) ? $data->country : ''}}" autocomplete="off"  >     
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group"> 
                                       <label>Postal Code</label>									
                                       <input type="text" class="form-control" name="pin_code" value="{{isset($data->pin_code) ? $data->pin_code : ''}}" placeholder="Postal Code/Zipcode" autocomplete="off"  >                                                      
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="oylerz-foot mt-4">
                           <div class="btn-wrap text-center">
                              <button type="button" id="back" data-action="{{route('frontend.step1')}}" class="oylerz-btn black-btn mr-4">Back</button>
                              <button type="submit" id="nextBtn"  class="oylerz-btn primary-btn">Next</button>
                           </div>
                           <ul class="step-dot-list mt-4">
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt active"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                           </ul>
                        </div>
                     </form>

