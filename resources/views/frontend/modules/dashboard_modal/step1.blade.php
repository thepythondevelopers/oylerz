<div class="multistep-wrap">
                     <form class="oylerz-card" id="step1" data-action="{{route('frontend.step2')}}" >
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
                                <div class="map-container inset-shadow sm-map-box">
                                <div id="map"></div>
                              </div>
                            </div>
                            </div>
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label class="form-label">Address<span class="astrick">*</span></label>
                                <input id="geocomplete1" type="text" name="address" class="form-control" placeholder=""  value="{{isset($data->address) ? $data->address : ''}}">
                                <input type="hidden" id="location_rest_lat" name="lat" value="{{isset($data->lat) ? $data->lat : ''}}">
                                <input type="hidden" id="location_rest_long" name="long" value="{{isset($data->long) ? $data->long : ''}}">
                                <input type="hidden" id="pin_code" name="pin_code" value="{{isset($data->pin_code) ? $data->pin_code : ''}}">
                                <input type="hidden" id="country" name="country" value="{{isset($data->country) ? $data->country : ''}}">
                              </div>
                              </div>
                              </div>
                           </div>
                        </div>
                        
                        
                        
                        
                        
                        <div class="oylerz-foot mt-4">
                           <div class="btn-wrap text-center">
                              <!-- <a href="javascript:void(0);" id="prevBtn" onclick="nextPrev(-1)" class="oylerz-btn black-btn mr-4">Back</a> -->
                              <button type="submit" id="nextBtn"  class="oylerz-btn primary-btn">Next</button>
                           </div>
                           <ul class="step-dot-list mt-4">
                              <li class="step-dt active"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                              <li class="step-dt"><span class="step-dot"></span></li>
                           </ul>
                        </div>
                     </form>
                  </div>

     <script src="https://maps.googleapis.com/maps/api/js?key={{setting('google_maps_key')}}&libraries=places&callback=initializestep" async defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/geocomplete/1.7.0/jquery.geocomplete.min.js"></script>
<script type="text/javascript">
    $('#geocomplete').on('input',function(e){    
    $("#location_rest_lat").val('');
    $("#location_rest_long").val('');

        $("#country").val('');
        $("#pin_code").val('');
    
});
    function initializestep() {
        
            var map = new google.maps.Map(document.getElementById("map"), {
    zoom: 4,
    center: { lat: {{isset($data->lat) ? $data->lat : user_location()->latitude}}, lng: {{isset($data->long) ? $data->long : user_location()->longitude}} },
    mapTypeId: "terrain"
  });


  var com_Image = {
    url: 'assets/img/single.png',
    size: new google.maps.Size(61, 72),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(0, 32)
  };

  var infowindow = new google.maps.InfoWindow();
   const geocoder = new google.maps.Geocoder();
  var marker, i;
  var shape = {
    coords: [1, 1, 1, 20, 18, 20, 18, 1],
    type: 'poly'
  };

  const locationButton = document.createElement("button");
  
  locationButton.setAttribute("type", "button");
  locationButton.textContent = "Pan to Current Location";
  locationButton.classList.add("custom-map-control-button");

  map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

  const latlng = {
    lat: parseFloat({{user_location()->latitude}}),
    lng: parseFloat({{user_location()->longitude}}),
  };

  locationButton.addEventListener("click", () => {
     geocoder
    .geocode({ location: latlng })
    .then((response) => {
      if (response.results[0]) {
        map.setZoom(4);
        com_current.setPosition (latlng);
        // const marker = new google.maps.Marker({
        //   position: latlng,
        //   map: map,
        // });
        $("#geocomplete1").val(response.results[0].formatted_address);

        $.each(response.results[0].address_components, function (i, address_component) {

    if (address_component.types[0] == "country"){ 
        $("#country").val(address_component.long_name);
    }
    if (address_component.types[0] == "postal_code"){
        $("#pin_code").val(address_component.long_name);
    }
    $("#location_rest_lat").val({{user_location()->latitude}});
    $("#location_rest_long").val({{user_location()->longitude}});
});

        infowindow.open(map, marker);
      } else {
        window.alert("No results found");
      }
    })
    .catch((e) => window.alert("Geocoder failed due to: " + e));

  });


  //set marker to mainlocation
  com_current = new google.maps.Marker({
    map: map,
    draggable: false,
    // icon: 'https://cdn.sstatic.net/Sites/askubuntu/img/favicon.ico?v=eff8fd315b9e',
    animation: google.maps.Animation.DROP,
    position: {
      lat: {{isset($data->lat) ? $data->lat : user_location()->latitude}},
      lng: {{isset($data->long) ? $data->long : user_location()->longitude}}
    }
  });

$("#geocomplete1").geocomplete({
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
        $("#pin_code").val(address_component.long_name);
    }
});
    
});




        }
     </script>             