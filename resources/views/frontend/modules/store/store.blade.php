@extends('frontend.layouts.layout')
@section('meta')
<title>{{ $cms->meta_title!=null ? $cms->meta_title : 'Oylerz'}}</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="title" content="{{ $cms->meta_title!=null ? $cms->meta_title : 'Oylerz' }}">
    <meta name="keywords" content="{{ $cms->meta_keywords!=null ? $cms->meta_keywords : 'Oylerz' }}">
  <meta name="description" content="{{ $cms->meta_description!=null ? $cms->meta_description : 'Oylerz'}}">
@endsection
@section('content')
<!-- Banner starts here -->
    <section class="main-banner-sec inner-hero-banner" style="background-image: url('{{url('frontend/images/banner-img.png')}}');">
      <span class="banner-bottom-shape"><img src="{{url('frontend/images/banner-shape.png')}}"></span>
      <div class="container">
         <div class="banner-content">
            <h1>Stores</h1>
         </div>
      </div>
    </section>
    <!-- Banner ends here -->
<section class="contact_us-sec">
  <div class="container">

  <div class="form_card-container oylerz-card">
    <form  id="store" data-action="{{route('store.search')}}" >
                         <div class="form-group">
                            <label class="form-label">Location<span class="astrick">*</span></label>
                              @csrf
                                <input id="geocomplete" type="text" name="location_name" class="form-control" placeholder=""  value="{{isset($data->store) ? $data->store : ''}}" autocomplete="off">
                                
                                <input type="hidden" id="location_rest_lat" name="lat" value="{{isset($data->lat) ? $data->lat : ''}}">
                                <input type="hidden" id="location_rest_long" name="long" value="{{isset($data->long) ? $data->long : ''}}">
                                <input type="hidden" id="pin_code" name="pin_code" value="{{isset($data->pincode) ? $data->pincode : ''}}">
                                <input type="hidden" id="country" name="country" value="{{isset($data->country) ? $data->country : ''}}">
                             </div>
                                <button type="submit" class="oylerz-btn primary-btn" id="searchButton">Search</button>
                               </form> 
                               <div id="store-result">
                                <div class="row" id="store-target">
                                  
                                  
                                  
                                </div>
                                
                               </div>
          </div>
  </div>
</section>
 
@endsection

@section('scripts')
   <script src="https://maps.googleapis.com/maps/api/js?key={{setting('google_maps_key')}}&libraries=places&callback=initialize" async defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/geocomplete/1.7.0/jquery.geocomplete.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
      var location_name = $("input[name=location_name]").val();
       var lat = $("#location_rest_lat").val();
       var long = $("#location_rest_long").val();
       var country = $("#country").val();
       if(location_name !=''  && lat!='' && long!=''  && country!='')
        {
       $this = $("#store");
       submitFormstore($this);
        }
});

    $('#geocomplete').on('input',function(e){    
    $("#location_rest_lat").val('');
    $("#location_rest_long").val('');

        $("#country").val('');
        $("#pin_code").val('');
    
});
    function initialize() {
        
   


  

  

 

$("#geocomplete").geocomplete({
    fields: ["formatted_address", "geometry", "name","address_components"],
    strictBounds: false,
    componentRestrictions: { country: "<? echo  user_location()->countryCode?>" },
    types: ["address"],
  }).bind("geocode:result", function(event, result) {
    var myLatlng = new google.maps.LatLng(parseFloat(result.geometry.location.lat()), parseFloat(result.geometry.location.lng()));
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

  jQuery("form[id='store']").validate({
    rules: {
      'location_name':{
         required: true, 
         nowhitespace: true
      },
    },
   });

$('body').on('submit','#store', function(e){
       e.preventDefault();
       


        var location_name = $("input[name=location_name]").val();
       var lat = $("#location_rest_lat").val();
       var long = $("#location_rest_long").val();
       var country = $("#country").val();
       if(location_name !=''  && lat!='' && long!=''  && country!='')
        {
       $this = $(this);
       submitFormstore($this);
        }else{
            toastr.error('Please choose Location from the Google suggestion.');
        }
  });        

function submitFormstore($this){
    
$.ajax({
                url : $this.attr('data-action'),
                type: 'POST',  
                data:$this.serialize(),     
                dataTYPE:'JSON',
                headers: {
                 'X-CSRF-TOKEN': $('input[name=_token]').val()
                },
                beforeSend: function() {
                  $this.find(':input[type=submit]').prop('disabled', true);                          
                },
                success: function (data) {                                   
                  $this.find(':input[type=submit]').removeAttr('disabled');
                  $("#store-target").html(data);
                },
                complete: function(result) {
                },
                error: function (jqXhr, textStatus, errorMessage) {
                     
                }

        });     
}        
     </script>             
@endsection