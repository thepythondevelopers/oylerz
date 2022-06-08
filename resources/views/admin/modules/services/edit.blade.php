@extends('admin.layouts.layout')

@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
                <h3 class="page-title">Services</h3>
            </div>
            <div class="content-body">
                <div class="csm-card">
                    <div class="csm-card-head a-i-c d-f j-c-s-b">
                            <h3 class="csm-title">Services</h3>
                            <a href="javascript:void(0);" data-toggle="modal" class="btn primary-btn" data-target="#newBooking">Sub New Service </a>
                        </div>
                    <div class="csm-body">
                        <form id="service-edit" method="POST" action="{{route('admin.services.update',$service->id)}}">
                            {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Name<span class="astrick">*</span></label>
                                    <input type="text" name="name" value="{{$service->name}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Description<span class="astrick">*</span></label>
                                    <textarea class="form-control" name="description">{{$service->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="sub-ser-wrap">
                                <h3 class="csm-title mb-3">Sub Services</h3>
                            <ul class="sub-ser-list">
                            @if($sub_service->count() > 0)
                            @foreach($sub_service->get() as $sub_ser)
                            <li><div class="sub-ser-card"><div class="sub-ser-head d-f j-c-s-b a-i-c"><h3>{{$sub_ser->name}}</h3> <div class="action-btns">
                              <a href="javascript:void(0);" data-action="{{route('admin.services.sub.edit',$sub_ser->id)}}" title="Edit" class="icon-btn btn-primary edit sub_service-edit"><i class="bx bxs-edit"></i></a>
                                        
                                        
                                        </div>
                                      </div>
                            </div>
                          </li>
                            @endforeach
                            @endif
                          </ul>
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


@section('modal')
<div class="modal fade" id="newBooking" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">New Service</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="service-create" data-action="{{route('admin.service.save')}}">
                <input type="hidden" name="parent_id" value="{{$service->id}}">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Name<span class="astrick">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="Name" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Description<span class="astrick">*</span></label>
                                    <textarea name="description" class="form-control" autocomplete="off"></textarea>
                                </div>
                            </div>
                            
                            
                            <div class="col-lg-12">
                                <div class="btn-wrap d-f a-i-c">
                                    <button type="button" data-dismiss="modal" class="btn primary-btn mr-3">Close</button>
                                    <button type="submit" class="main-btn">Save</button>
                                </div>
                            </div>
                        </div>
            </form>              
                    
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="editservice" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Edit Service</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                         
                    
      </div>
    </div>
  </div>
</div>
@stop
@section('scripts')
<script type="text/javascript">
    jQuery("form[id='service-edit']").validate({

    rules: {

      'name': 
      {
        required: true, 
        nowhitespace: true,
        maxlength:35  
      },
      'description': 
      {
        required: true, 
        nowhitespace: true
      },
      'price': 
      {
        required: true, 
        digits : true,
      },
    },  
});


jQuery("form[id='service-create']").validate({

    rules: {

      'name': 
      {
        required: true, 
        nowhitespace: true,
        maxlength:35  
      },
      'description': 
      {
        required: true, 
        nowhitespace: true
      }
    },  
});

function sub_service_validation(){


jQuery("form[id='sub-service-edit']").validate({

    rules: {

      'name': 
      {
        required: true, 
        nowhitespace: true,
        maxlength:35  
      },
      'description': 
      {
        required: true, 
        nowhitespace: true
      }
    },  
});
}
$('body').on('submit','#service-create,#sub-service-edit', function(e){
       e.preventDefault();
       $this = $(this);
       submitForm($this);
  });        

$('body').on('click','.sub_service-delete', function(e){
       e.preventDefault();
       $this = $(this);
       submitForm($this);
  });        


$('body').on('click','.sub_service-edit', function(e){
       e.preventDefault();
       $('#editservice').modal('show');
       $.ajax({
                url : $(this).attr('data-action'),
                type: 'GET',       
                dataTYPE:'JSON',
                headers: {
                 'X-CSRF-TOKEN': $('input[name=_token]').val()
                },
                beforeSend: function() {

                },
                success: function (data) {                                   
                    $('#editservice .modal-body').html(data.html);
                    sub_service_validation();
                },
                complete: function(result) {
                },
                error: function (jqXhr, textStatus, errorMessage) {
                     
                }

        });
       
  });        

function submitForm($this){
    
$.ajax({
                url : $this.attr('data-action'),
                type: 'POST',  
                data:$this.serialize(),     
                dataTYPE:'JSON',
                headers: {
                 'X-CSRF-TOKEN': $('input[name=_token]').val()
                },
                beforeSend: function() {
                  $this.attr('disabled','true');                          
                },
                success: function (data) {                                   
                  $this.removeAttr('disabled');
                  if(data.success==true){
                    toastr.success(data.message);
                    setTimeout(function () {
                        location.reload(true);
                    }, 1000);
                   }
                },
                complete: function(result) {
                },
                error: function (jqXhr, textStatus, errorMessage) {
                     
                }

        });     
}    
</script>
@endsection