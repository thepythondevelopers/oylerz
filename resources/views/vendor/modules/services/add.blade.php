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
                <form method="POST" action="{{route('vendor.service.save')}}" id="add-service">
                     @csrf 
                     <div class="form-group">
                    <select id="multiple" name="service_id[]" class="js-states form-control" multiple>
                        @foreach($service as $s)
                            <optgroup label="{{$s->name}}">
                                @php $sub_service = \App\Models\Service::where('parent_id',$s->id)->get(); @endphp
                                    @foreach($sub_service as $key=>$sub_s)
                                    <option value="{{$sub_s->id}}" {{in_array($sub_s->id, $user_service) ? 'selected' : ''}}>{{$sub_s->name}}</option>
                                    @endforeach
                            </optgroup>
                        @endforeach    
                    </select> 
                    </div>            
  
                                <div class="btn-wrap d-f a-i-c mt-4">
                                  
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
          $("#multiple").select2();

jQuery("form[id='add-service']").validate({

    rules: {

      'service_id[]': 
      {
        required: true
      }
    }, 
 
});          
</script>
@stop