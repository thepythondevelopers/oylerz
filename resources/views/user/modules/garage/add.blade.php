@extends('user.layouts.layout')

@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
                <h3 class="page-title">Garage </h3>
            </div>
            <div class="content-body">
                <div class="csm-card">
                    <div class="csm-card-head d-f j-c-s-b">
                            <h3 class="csm-title">Garage</h3>
                        </div>
                    <div class="csm-body">
                    <form id="garage-create" method="POST" action="{{route('user.garage.save')}}">    
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                 <label class="form-label">Name<span class="astrick">*</span></label>   
                                 <input type="text" class="form-control" placeholder="Name" name="name" value="" autocomplete="off">
                              </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                 <label class="form-label">Year<span class="astrick">*</span></label>
                                 <select class="form-control valid" name="year" aria-invalid="false">
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                 </select>
                              </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                 <label class="form-label">Make<span class="astrick">*</span></label>   
                                 <input type="text" class="form-control" placeholder="Make" name="make" value="" autocomplete="off">
                              </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Model<span class="astrick">*</span></label>
                                 <input type="text" class="form-control" placeholder="Model" name="model" value="" autocomplete="off">
                              </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Trim<span class="astrick">*</span></label>
                                 <input type="text" class="form-control" placeholder="Trim" name="trim" value="" autocomplete="off">
                              </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Mileage<span class="astrick">*</span></label>
                                 <input type="text" class="form-control" placeholder="Enter Mileage" name="mileage" value="" autocomplete="off">                               
                              </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="btn-wrap">
                                    <button type="submit" class="main-btn">Save</button>
                                </div>
                            </div>
                        </div>
                        </form>  
                    </div>
                  </div>  
            </div>
        </div>
@stop        

@section('scripts')
<script type="text/javascript">


jQuery("form[id='garage-create']").validate({
    rules: {
      'year':{
         required: true
      },
      'name':{
        required: true, 
         nowhitespace: true,
         maxlength:35 
      },
      'make':{
        required: true, 
         nowhitespace: true,
         maxlength:35 
      },
      'model':{
         required: true, 
         nowhitespace: true,
         maxlength:35
      },
      'trim':{
         required: true, 
         nowhitespace: true,
         maxlength:35
      },
      'mileage':{
         required: true, 
         nowhitespace: true,
         maxlength:35,
         digits:true
      },
    }
   });    
</script>
@stop