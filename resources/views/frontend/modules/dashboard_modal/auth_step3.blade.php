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
                                    @foreach($garage as $key=>$g)
                                    <option value="{{$g->id}}" {{isset($data->garage) ? ($data->year==$g->id ? 'selected' : '') : ''}}>{{$g->name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>

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

               