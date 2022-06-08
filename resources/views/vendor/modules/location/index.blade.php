@extends('vendor.layouts.layout')

@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
                <h3 class="page-title">Location</h3>
                <a href="javascript:void(0);" data-toggle="modal" class="btn primary-btn" data-target="#addStoreLocation">Add Location </a>
            </div>
            <div class="content-body">
                <div class="csm-card">
                    <div class="csm-card-head d-f j-c-s-b">
                            <h3 class="csm-title">Location Info</h3>
                        </div>
                    <div class="csm-body">  
                        <div class="table-responsive">
                            <table class="table dash-table" id="dataTable">
                              <thead>
                                <tr>
                                  <th>Sno</th>
                                  <th>Name</th>
                                  <th>Postal Code</th>
                                  <th>Phone Number</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($location as $key=>$loc)
                                <tr>
                                  <td>{{$key+1}}</td>
                                  <td>{{$loc->name}}</td>
                                  <td>{{$loc->postal_code}}</td>
                                  <td>{{$loc->phone_number}}</td>
                                  <td>
                                    <a href="{{route('vendor.location.edit',$loc->id)}}" title="Edit" class="icon-btn view btn-primary"><i class='bx bxs-edit' ></i></a>
                                    <a href="{{route('vendor.location.view',$loc->id)}}" title="View" class="icon-btn view btn-primary"><i class='bx bxs-show' ></i></a></td>
                                </tr>                  
                                @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>
                  </div>  
            </div>
        </div>


@stop        

@section('modal')
<div class="modal fade" id="addStoreLocation" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Add Store Location</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="location-create" data-action="{{route('vendor.location.save')}}" enctype="multipart/form-data">
                @csrf
                        <div class="row">
                            <div class="col-lg-12">
                               <div class="form-group">
                                    <label class="form-label">Name<span class="astrick">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Name" autocomplete="off">
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Satus<span class="astrick">*</span></label>
                                    <select class="form-control" name="status" autocomplete="off">
                                        <option value="1">Active</option>
                                         <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>                           
                            

                            <div class="col-lg-12">
                               <div class="form-group">
                                    <label class="form-label">Phone Number<span class="astrick">*</span></label>
                                    <input type="text" name="phone_number" class="form-control" placeholder="Enter Phone Number" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-12">
                               <div class="form-group">
                                    <label class="form-label">Pin Code<span class="astrick">*</span></label>
                                    <input type="text" name="pin_code" class="form-control" placeholder="Enter Pin Code" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-12">
                               <div class="form-group">
                                    <label class="form-label">Banner<span class="astrick">*</span></label>
                                     <input type="file" name="banner" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <div class="map-container inset-shadow sm-map-box">
                                <div id="map"></div>
                              </div>
                            </div>
                            </div>
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label class="form-label">Location<span class="astrick">*</span></label>
                                <input id="geocomplete" type="text" name="location_name" class="form-control" placeholder="" >
                                <input type="hidden" id="location_rest_lat" name="lat">
                                <input type="hidden" id="location_rest_long" name="long">
                              <!--   <input type="hidden" id="pin_code" name="pin_code"> -->
                                <input type="hidden" id="country" name="country">
                              </div>
                              </div>
                            <div class="col-lg-12">
                                <div class="btn-wrap d-f a-i-c">
                                    <button type="submit" class="main-btn">Add</button>
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

<script src="https://maps.googleapis.com/maps/api/js?key={{setting('google_maps_key')}}&libraries=places&callback=initialize" async defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/geocomplete/1.7.0/jquery.geocomplete.min.js"></script>
<script type="text/javascript">
    $('#geocomplete').on('input',function(e){    
    $("#location_rest_lat").val('');
    $("#location_rest_long").val('');

        $("#country").val('');
      //  $("#pin_code").val('');
    
});
    function initialize() {
        
            var map = new google.maps.Map(document.getElementById("map"), {
    zoom: 4,
    center: { lat: {{user_location()->latitude}}, lng: {{user_location()->longitude}} },
    mapTypeId: "terrain"
  });


  var com_Image = {
    url: 'assets/img/single.png',
    size: new google.maps.Size(61, 72),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(0, 32)
  };

  var infowindow = new google.maps.InfoWindow();
  var marker, i;
  var shape = {
    coords: [1, 1, 1, 20, 18, 20, 18, 1],
    type: 'poly'
  };

  

  //set marker to mainlocation
  com_current = new google.maps.Marker({
    map: map,
    draggable: false,
    // icon: 'https://cdn.sstatic.net/Sites/askubuntu/img/favicon.ico?v=eff8fd315b9e',
    animation: google.maps.Animation.DROP,
    position: {
      lat: {{user_location()->latitude}},
      lng: {{user_location()->longitude}}
    }
  });

$("#geocomplete").geocomplete({
        fields: ["formatted_address", "geometry", "name","address_components"],
    strictBounds: false,
        componentRestrictions: { country: "<? echo  user_location()->countryCode?>" },
    types: ["address"],
  }).bind("geocode:result", function(event, result) {
    var myLatlng = new google.maps.LatLng(parseFloat(result.geometry.location.lat()), parseFloat(result.geometry.location.lng()));
    com_current.setPosition (myLatlng);
    map.panTo(myLatlng);
    $("#location_rest_lat").val(result.geometry.location.lat());
    $("#location_rest_long").val(result.geometry.location.lng());
     $.each(result.address_components, function (i, address_component) {
    if (address_component.types[0] == "country"){ 
        $("#country").val(address_component.long_name);
    }
    if (address_component.types[0] == "postal_code"){ 
       // $("#pin_code").val(address_component.long_name);
    }
});
    
});




        }


    $(document).ready(function () {
                var table = $('#dataTable').DataTable({!! json_encode(
                    array_merge([
                        "order" => [],            
                        "columnDefs" => [['targets' => -1, 'searchable' =>  false, 'orderable' => false]],
                    ])
                , true) !!});
       });
jQuery("form[id='location-create']").validate({

    rules: {
      'name': 
      {
        required: true, 
        nowhitespace: true,
        maxlength:35  
      },
      'status': 
      {
        required: true, 
        nowhitespace: true
      },

      'phone_number':{
        required: true, 
        nowhitespace: true,
        digits:true,
        minlength:10,
        maxlength:10
      },
      'banner': 
      {
        required: true,
        extension: "jpg|jpeg|png" 
      },
      'pin_code':{
        required: true, 
        nowhitespace: true,
        maxlength:10
      }
    },  
});    

 $('body').on('submit','#location-create', function(e){
       e.preventDefault();
       var location_name = $("input[name=location_name]").val();
       var lat = $("#location_rest_lat").val();
       var long = $("#location_rest_long").val();
       var country = $("#country").val();
        if(location_name !=''  && lat!='' && long!=''  && country!='')
        {
       submitForm();
        }else{
            toastr.error('Please choose Location from the Google suggestion.');
        }
  });

function submitForm() {
        var form = $('body').find('#location-create')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        var percent = $('body').find('.percent');
        var bar = $('.bar');
        var $this = $('body').find('#location-create');
        $.ajax({
           url:$this.attr('data-action'),
           method:"POST",
           data:formData,
           dataType:'JSON',
           contentType: false,
           cache: false,
           processData: false,
           beforeSend: function() {
                  $this.find('button').attr('disabled','true');
          },
           xhr: function () {
           var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                    $('.progress').find('span.sr-only').text(percentComplete + '%');
                    $('.progress .progress-bar').css('width', percentComplete + '%');
                }
            }, false);
            return xhr;
          },
           success:function(data)
           {
            if(data.success==true){
                    toastr.success(data.message);
                    setTimeout(function () {
                        location.reload(true);
                    }, 1000);
                   }
           }

          });
}
</script>
@endsection