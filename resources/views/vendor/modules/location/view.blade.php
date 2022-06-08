@extends('vendor.layouts.layout')

@section('content')
<div class="content-wrap">
        <div class="csm-card">
            <div class="csm-card-head d-f j-c-s-b">
                <h3 class="csm-title">Location</h3>

            </div>
            <div class="csm-body">
                <div class="row"> 
                    <div class="col-lg-6">
                <ul class="booking-detial_info">
                    <li><label class="booking-info-label">Name</label><p>{{$location->name}}</p></li>
                     <li><label class="booking-info-label">Address</label><p>{{$location->address}}</p></li>
                     <li><label class="booking-info-label">Country</label><p>{{$location->country}}</p></li>
                     <li><label class="booking-info-label">Postal Code</label><p>{{$location->postal_code}}</p></li>
                     <li><label class="booking-info-label">Longitude</label><p>{{$location->longitude}}</p></li>
                     <li><label class="booking-info-label">Phone Number</label><p>{{$location->phone_number}}</p></li>
                     <li><label class="booking-info-label">Banner</label><p><img style="max-width: 100px;" src="{{asset($location->banner)}}" /></p></li>

                </ul>
            </div>
                                  
                    <div class="col-lg-6">
                             
                                <div class="map-container inset-shadow sm-map-box cstm-map-wrap">
                                <div id="map"></div>
                              </div>
                           
                            </div>
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <!-- <label class="form-label">Location</label> -->
                                <!-- <input id="geocomplete" type="text" name="location_name" class="form-control" placeholder="" > -->
                              </div>
                              </div>
                <div class="col-lg-12">
                    <div class="btn-wrap">
                        <a href="{{route('vendor.location')}}" class="main-btn">Back</a>
                    </div>
                </div>

            </div>  
        </div>
    </div>  
</div>
@endsection

@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{setting('google_maps_key')}}&libraries=places&callback=initialize" async defer></script>
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
 } 
</script>
@endsection