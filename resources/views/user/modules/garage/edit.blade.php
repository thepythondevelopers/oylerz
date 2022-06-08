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
                    <form id="garage-edit" method="POST" action="{{route('user.garage.update',$garage->id)}}">    
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Name<span class="astrick">*</span></label>
                                 <input type="text" class="form-control" placeholder="Name" name="name" value="{{$garage->name}}" autocomplete="off">                               
                              </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                 <label class="form-label">Year<span class="astrick">*</span></label>
                                 <select class="form-control valid" name="year" aria-invalid="false">
                                    <option value="2018" {{$garage->year=='2018' ? 'selected' : ''}}>2018</option>
                                    <option value="2019" {{$garage->year=='2019' ? 'selected' : ''}}>2019</option>
                                    <option value="2020" {{$garage->year=='2020' ? 'selected' : ''}}>2020</option>
                                    <option value="2021" {{$garage->year=='2021' ? 'selected' : ''}}>2021</option>
                                    <option value="2022" {{$garage->year=='2022' ? 'selected' : ''}}>2022</option>
                                 </select>
                              </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                 <label class="form-label">Make<span class="astrick">*</span></label>   
                                 <input type="text" class="form-control" placeholder="Make" name="make" value="{{$garage->make}}" autocomplete="off">
                              </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Model<span class="astrick">*</span></label>
                                 <input type="text" class="form-control" placeholder="Model" name="model" value="{{$garage->model}}" autocomplete="off">
                              </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Trim<span class="astrick">*</span></label>
                                 <input type="text" class="form-control" placeholder="Trim" name="trim" value="{{$garage->trim}}" autocomplete="off">
                              </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Mileage<span class="astrick">*</span></label>
                                 <input type="text" class="form-control" placeholder="Enter Mileage" name="mileage" value="{{$garage->mileage}}" autocomplete="off">                               
                              </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="btn-wrap">
                                    <button type="submit" class="main-btn">Update</button>
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


jQuery("form[id='garage-edit']").validate({
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