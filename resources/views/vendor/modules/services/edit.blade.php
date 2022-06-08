@extends('vendor.layouts.layout')

@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
                <h3 class="page-title">Manage Services</h3>
                
            </div>
            <div class="content-body">
              <div class="csm-card">
                    <div class="csm-card-head d-f j-c-s-b">
                            <h3 class="csm-title">Manage Services</h3>
                        </div>
                    <div class="csm-body">
                <form method="POST" action="{{route('vendor.service.update',$user_service->id)}}" id="update-service">
                     @csrf 
                <div class="form-group">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" value="{{$user_service->price}}" class="form-control">           
                  </div>
                              <div class="btn-wrap d-f a-i-c">
                                
                                  <button type="submit" class="main-btn">Save</button>
                              </div>
                  </form> 
                  </div>
                  </div> 
            </div>
        </div>
@stop        

@section('scripts')
<script type="text/javascript">
    jQuery("form[id='update-service']").validate({

    rules: {

      'price': 
      {
        required: true, 
        digits: true,
      }
    }, 
 
});    
</script>
@endsection