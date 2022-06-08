@extends('frontend.layouts.layout')
@section('meta')
<title>{{ $data->meta_title!=null ? $data->meta_title : 'Oylerz'}}</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="title" content="{{ $data->meta_title!=null ? $data->meta_title : 'Oylerz' }}">
    <meta name="keywords" content="{{ $data->meta_keywords!=null ? $data->meta_keywords : 'Oylerz' }}">
  <meta name="description" content="{{ $data->meta_description!=null ? $data->meta_description : 'Oylerz'}}">
@endsection
@section('content')
<section class="contact_us-sec">
  <div class="container">
    <div class="sec-heading text-center mb-5">
            <h2 class="mb-4"  >{{$data->title}}</h2>
            {!! $data->description !!}
         </div>

         <div class="contact-content">
           <div class="row">            
             <div class="col-lg-6"><h3 class="contact-form-title">Get in touch with us :</h3></div>
              <div class="col-lg-6"></div>
              <div class="col-lg-6">
                <form class="contact-form" id="contact" method="post" action="{{route('contact.save')}}">
                  @csrf
                  <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Your full name" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="Your email" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <input type="text" name="subject" class="form-control" placeholder="Query Related" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" name="message" placeholder="Message" autocomplete="off"></textarea>
                  </div>
                  <div class="btn-wrap">
                    <button type="submit"  class="oylerz-btn primary-btn full-width">Send Message</button>
                  </div>
                </form>
              </div>
              <div class="col-lg-6">
                {!! $data->description1 !!}
          
              </div>
           </div>
         </div>
  </div>
</section>
 @include('frontend.includes.find_us')
@endsection

@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{setting('google_maps_key')}}&libraries=places&callback=initialize" async defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/geocomplete/1.7.0/jquery.geocomplete.min.js"></script>
<script type="text/javascript">
    $('#geocomplete').on('input',function(e){    
    $("#location_rest_lat_store").val('');
    $("#location_rest_long_store").val('');

        $("#country_store").val('');
        $("#pin_code_store").val('');
    
});
    function initialize() {
        
var myOptions = {
      center: new google.maps.LatLng({{user_location()->latitude}},{{ user_location()->longitude}}),
      zoom: 5,
      mapTypeId: "terrain"

    };

    var map = new google.maps.Map(document.getElementById("map_find_us"),
        myOptions);

    setMarkers(map,locations);
/*$("#geocomplete").geocomplete({
    fields: ["formatted_address", "geometry", "name","address_components"],
    strictBounds: false,
    componentRestrictions: { country: "<? echo  user_location()->countryCode?>" },
    types: ["address"],
  }).bind("geocode:result", function(event, result) {
    var myLatlng = new google.maps.LatLng(parseFloat(result.geometry.location.lat()), parseFloat(result.geometry.location.lng()));
    $("#location_rest_lat_store").val(result.geometry.location.lat());
    $("#location_rest_long_store").val(result.geometry.location.lng());
     $.each(result.address_components, function (i, address_component) {
    if (address_component.types[0] == "country"){ 
        $("#country_store").val(address_component.long_name);
    }
    if (address_component.types[0] == "postal_code"){ 
        $("#pin_code_store").val(address_component.long_name);
    }
});
    
});*/

        }

        
        var locations = <?php print_r($loc_array)?>;

  



  function setMarkers(map,locations){

      var marker, i

for (i = 0; i < locations.length; i++)
 {  

 var name = locations[i][0]
 var lat = locations[i][1]
 var long = locations[i][2]
 //var add =  locations[i][3]

 latlngset = new google.maps.LatLng(lat, long);

  var marker = new google.maps.Marker({  
          map: map, title: name , position: latlngset  
        });
        map.setCenter(marker.getPosition())


        var content = "Name: " + name +  '</h3>'    

  var infowindow = new google.maps.InfoWindow()

google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
        return function() {
           infowindow.setContent(content);
           infowindow.open(map,marker);
        };
    })(marker,content,infowindow)); 

  }
  }

$('body').on('submit','#store-find', function(e){
       e.preventDefault();
       


        var location_name = $("input[name=store]").val();
       var lat = $("#location_rest_lat_store").val();
       var long = $("#location_rest_long_store").val();
       var country = $("#country_store").val();
       if(location_name !=''  && lat!='' && long!=''  && country!='')
        {
       $this = $(this);
       submitFormstore($this);
        }else{
            toastr.error('Please choose Location from the Google suggestion.');
        }
  });        

function submitFormstore($this){
      window.location.href = $this.attr('data-action')+'?'+$this.serialize();
}                


	jQuery("form[id='contact']").validate({
    rules: {
      'name': 
      {
        required: true, 
        nowhitespace: true,
        maxlength:35
      },
      'email': 
      {
        required: true, 
        nowhitespace: true,
        customemail:true
      },
      'subject': 
      {
        required: true, 
        nowhitespace: true,
        maxlength:35  
      },
      'message': 
      {
        required: true, 
        nowhitespace: true
      },
    },  
});


</script>
@endsection