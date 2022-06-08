<form class="oylerz-card" id="step3" data-action="{{route('frontend.step4')}}" >
         <!-- 1 -->
   <input type="hidden" name="address" value="{{isset($data->address) ? $data->address : ''}}">
   <input type="hidden" name="lat" value="{{isset($data->lat) ? $data->lat : ''}}">
   <input type="hidden" name="long" value="{{isset($data->long) ? $data->long : ''}}">
      <input type="hidden" name="pin_code" value="{{isset($data->pin_code) ? $data->pin_code : ''}}">
   <input type="hidden" name="country" value="{{isset($data->country) ? $data->country : ''}}">
   <!-- 2 -->
   <input type="hidden" name="address1" value="{{isset($data->address1) ? $data->address1 : ''}}">
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
                   @if(Auth::check() && Auth::user()->role=='user') 
                        <div class="vehicle-garage">
                        <div class="oylerz-head">
                        <h3 class="oylerz-title"><strong class="text-primary">Add Vehicle From</strong> Garage</h3>
                        <a href="javascript:void(0);" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </a>
                     </div>
                     <div class="oylerz-body">
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label class="form-label">Name</label>
                                 <select class="form-control" name="garage">
                                    <option value="">Select from Garage</option>
                                    @foreach($garage as $key=>$g)
                                    <option value="{{$g->id}}" {{isset($data->garage) ? ($data->garage==$g->id ? 'selected' : '') : ''}}>{{$g->name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                     <input type="checkbox" id="manual" name="manual" value="1" {{isset($data->manual) ? ($data->manual==1 ? 'checked' : '') : ''}}>
                     <label for="manual"> Manually Add Vehicle</label><br>
                     <div class="manually-add-vehicle" style="display: {{isset($data->manual) ? ($data->manual==1 ? 'block' : 'none') : 'none'}};" >
                     <div class="oylerz-head">
                        <h3 class="oylerz-title"><strong class="text-primary">Add Vehicle</strong> Specifications</h3>
                        <a href="javascript:void(0);" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </a>
                     </div>
                     <div class="oylerz-body">
                        <div class="row">

                           <div class="col-lg-12">
                              <div class="form-group">
							     <label>Year</label>	
                                 <select class="form-control" name="year">
                                    {!! car_year(isset($data->year) ? $data->year : '') !!}
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
							       <label>Make</label>	
                                 <input type="text" class="form-control" placeholder="Make" name="make" value="{{isset($data->make) ? $data->make : ''}}" autocomplete="off">                               
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
							     <label>Model</label>	
                                 <input type="text" class="form-control" placeholder="Model" name="model" value="{{isset($data->model) ? $data->model : ''}}" autocomplete="off">                               
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
							     <label>Trim</label>	
                                 <input type="text" class="form-control" placeholder="Trim" name="trim" value="{{isset($data->trim) ? $data->trim : ''}}" autocomplete="off">                               
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
							     <label>Mileage</label>	
                                 <input type="text" class="form-control" placeholder="Enter Mileage" name="mileage" value="{{isset($data->mileage) ? $data->mileage : ''}}" autocomplete="off">                               
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                     @else
                                          <div class="oylerz-head">
                        <h3 class="oylerz-title"><strong class="text-primary">Add Vehicle</strong> Specifications</h3>
                        <a href="javascript:void(0);" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </a>
                     </div>
                     <div class="oylerz-body">
                        <div class="row">

                              <div class="col-lg-12">
                              <div class="form-group">
                                 <select class="form-control" name="car_select" id="car_select">
                                       <option value="">Select from Car</option>
                                 @foreach($cars as $car)
                                    <option value="{{$car->id}}" data-year="{{$car->year}}" data-make="{{$car->make}}" data-model="{{$car->model}}" {{isset($data->car_select) ? ($data->car_select==$car->id ? 'selected' : '' ) : ''}}>{{$car->make}}</option>
                                 @endforeach   
                                 </select>
                              </div>
                           </div>

                           <div class="col-lg-12">
                              <div class="form-group">
                                 <select class="form-control" name="year" id="year">
                                    {!! car_year(isset($data->year) ? $data->year : '') !!}
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <input type="text" class="form-control" placeholder="Make" name="make" id="make" value="{{isset($data->make) ? $data->make : ''}}" autocomplete="off">                               
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <input type="text" class="form-control" placeholder="Model" name="model" id="model" value="{{isset($data->model) ? $data->model : ''}}" autocomplete="off">                               
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <input type="text" class="form-control" placeholder="Trim" name="trim" value="{{isset($data->trim) ? $data->trim : ''}}" autocomplete="off">                               
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <input type="text" class="form-control" placeholder="Enter Mileage" name="mileage" value="{{isset($data->mileage) ? $data->mileage : ''}}" autocomplete="off">                               
                              </div>
                           </div>
                        </div>
                     </div>
                     @endif

                  <div class="oylerz-foot mt-4">
                           <div class="btn-wrap text-center">
                              <button type="button" id="back" data-action="{{route('frontend.step2')}}" class="oylerz-btn black-btn mr-4">Back</button>
                              <button type="submit" id="nextBtn"  class="oylerz-btn primary-btn">Next</button>
                           </div>
                           <ul class="step-dot-list mt-4">
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt active"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                           </ul>
                        </div>
               </form>

   <script type="text/javascript">
      $("#manual").click(function(){
   if($(this).is(':checked')){
    $(".manually-add-vehicle").show();
    $(".vehicle-garage").hide();
   }else{
    $(".manually-add-vehicle").hide();
   $(".vehicle-garage").show();
}
});

      $('#car_select').on('change', function() {
         if($(this).val()!=''){
           $year = $('option:selected', this).attr('data-year');
           $make = $('option:selected', this).attr('data-make'); 
           $model = $('option:selected', this).attr('data-model'); 
         
         $("#year").val($year);
         $("#model").val($model);
         $("#make").val($make);

        // $("#year").attr('disabled', true);
         $("#make").attr('readonly', true);
         $("#model").attr('readonly', true);

      }else{
         //$("#year").attr('disabled', false);
         $("#make").attr('readonly', false);
         $("#model").attr('readonly', false);
      }
});
   </script>            