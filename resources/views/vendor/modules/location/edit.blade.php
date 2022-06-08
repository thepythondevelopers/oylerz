@extends('vendor.layouts.layout')

@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
                <h3 class="page-title">Location</h3>
                
            </div>
            <div class="content-body">
              <div class="csm-card">
                    <div class="csm-card-head d-f j-c-s-b">
                            <h3 class="csm-title">Location</h3>
                        </div>
                    <div class="csm-body">
                <form method="POST" action="{{route('vendor.location.update',$location->id)}}" id="update-location" enctype="multipart/form-data">
                     @csrf 
                <div class="row">
                            <div class="col-lg-12">
                               <div class="form-group">
                                    <label class="form-label">Name<span class="astrick">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Name" autocomplete="off" value="{{$location->name}}">
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Satus<span class="astrick">*</span></label>
                                    <select class="form-control" name="status" autocomplete="off">
                                        <option value="1" {{$location->status=='1' ? 'selected' : ''}}>Active</option>
                                         <option value="0" {{$location->status=='0' ? 'selected' : ''}}>Inactive</option>
                                    </select>
                                </div>
                            </div>                           
                            

                            <div class="col-lg-12">
                               <div class="form-group">
                                    <label class="form-label">Phone Number<span class="astrick">*</span></label>
                                    <input type="text" name="phone_number" class="form-control" placeholder="Enter Phone Number" autocomplete="off" value="{{$location->phone_number}}">
                                </div>
                            </div>
                                                        <div class="col-lg-12">
                               <div class="form-group">
                                    <label class="form-label">Pin Code<span class="astrick">*</span></label>
                                    <input type="text" name="pin_code" class="form-control" placeholder="Enter Pin Code" autocomplete="off" value="{{$location->postal_code}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                               <div class="form-group">
                                    <label class="form-label">Banner</label>
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
                                <input id="geocomplete" type="text" name="location_name" class="form-control" value="{{$location->address}}" placeholder="" >
                                <input type="hidden" id="location_rest_lat" name="lat" value="{{$location->latitude}}">
                                <input type="hidden" id="location_rest_long" name="long" value="{{$location->longitude}}">
                                <!-- <input type="hidden" id="pin_code" name="pin_code" value="{{$location->postal_code}}"> -->
                                <input type="hidden" id="country" name="country" value="{{$location->country}}">
                              </div>
                              </div>                              
                            <div class="col-lg-12">
                                <div class="btn-wrap d-f a-i-c">
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

    $('#geocomplete').on('input',function(e){    
    $("#location_rest_lat").val('');
    $("#location_rest_long").val('');

        $("#country").val('');
       // $("#pin_code").val('');
    
});
jQuery("form[id='update-location']").validate({

    rules: {
      'name': 
      {
        required: true, 
        nowhitespace: true,
        maxlength:35  
      },
      'address': 
      {
        required: true, 
        nowhitespace: true
      },
      'country': 
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
      'postal_code': 
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
        extension: "jpg|jpeg|png" 
      },
      'pincode':{
                required: true, 
        nowhitespace: true,
        maxlength:10
      }
    }, 
     submitHandler: function (form) {
        var lat = $("#location_rest_lat").val();
       var long = $("#location_rest_long").val();
     //  var pincode = $("#pin_code").val();
       var country = $("#country").val();
        if(location_name !=''  && lat!='' && long!=''  && country!='')
        {
          form.submit();
        }else{
            toastr.error('Please choose Location from the Google suggestion.');
        }
          } 
});    
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{setting('google_maps_key')}}&libraries=places&callback=initialize" async defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/geocomplete/1.7.0/jquery.geocomplete.min.js"></script>
<script type="text/javascript">
        function initialize() {
        
            var map = new google.maps.Map(document.getElementById("map"), {
    zoom: 4,
    center: { lat: {{$location->latitude}}, lng: {{$location->longitude}} },
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
      lat: {{$location->latitude}},
      lng: {{$location->longitude}}
    }
  });
  

 $("#geocomplete").geocomplete({
    fields: ["formatted_address", "geometry", "name","address_components"],
    strictBounds: false,
    types: ["address"],
    componentRestrictions: { country: "<? echo  user_location()->countryCode?>" },
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
</script>
</script>
@endsection