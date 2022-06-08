@extends('frontend.layouts.layout')

@section('meta')
<title>{{ $cms->meta_title}}</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="title" content="{{ $cms->meta_title}}">
    <meta name="keywords" content="{{ $cms->meta_keywords}}">
  <meta name="description" content="{{ $cms->meta_description}}">
@endsection


@section('content')
<input type="hidden" name="" id="email-check" data-action="{{route('admin.profile.email.check')}}">
<!-- Banner starts here -->
    <section class="main-banner-sec" style="background-image: url('{{asset('frontend/images/banner-img.png')}}');">
      <span class="banner-bottom-shape"><img src="{{asset('frontend/images/banner-shape.png')}}"></span>
      <div class="container">
         <div class="banner-content">
            <h1>Schedule Oil Change in less than 60 seconds</h1>
            <div class="btn-wrap">
            <a href="javascript:void(0);" class="oylerz-btn primary-btn" id="schedule_modal">Schedule Now <span class="btn-icon"><i class="fas fa-arrow-right"></i></span></a>
            <a href="https://player.vimeo.com/video/460468465?loop=1" data-fancybox class="oylerz-btn primary-btn">How it Works <span class="btn-icon"><i class="fas fa-video"></i></span></a></div>
         </div>
      </div>
    </section>
    <!-- Banner ends here -->
    <!-- About starts here -->
    <section class="About-sec">
       <div class="container">
          <div class="about-content">
            <div class="row">
             <div class="col-lg-5">
               <!-- <figure class="abt-img">
                  <img src="{{asset('frontend/images/abt-img.png')}}">
               </figure>  -->
             </div>
             <div class="col-lg-7">
                <div class="abt-cnt">
                   
                   

                   <ul class="abt-feature-list">
                      <li>
                         <div class="feature-box"><span class="icon"><img src="{{asset('frontend/images/fire-icon.png')}}"></span>
                          <h4>Fast</h4>
                         </div>
                      </li>
                      <li>
                         <div class="feature-box"><span class="icon"><img src="{{asset('frontend/images/easy-icon.png')}}"></span>
                          <h4>Easy</h4>
                         </div>
                      </li>
                      <li>
                         <div class="feature-box"><span class="icon"><img src="{{asset('frontend/images/convenient-icon.png')}}"></span>
                          <h4>Convenient</h4>
                         </div>
                      </li>
                      <li>
                         <div class="feature-box"><span class="icon"><img src="{{asset('frontend/images/Professional-icon.png')}}"></span>
                          <h4>Professional</h4>
                         </div>
                      </li>                      
                   </ul>
                   <a href="javascript:void(0);" class="oylerz-btn primary-btn"  id="schedule_modal_1">Schedule Now <span class="btn-icon"><i class="far fa-long-arrow-right"></i></span></a>
                   
                </div>
             </div>
           </div>
          </div>
       </div>
    </section>
    <!-- About ends here -->
   <!-- How works starts here -->
    <section class="step-sec">
       <div class="container">
         <div class="sec-heading text-center mb-5 max-w-heading">

              {!! $cms->description1 !!}
         </div>
         <div class="work-step-block">
          <ul class="works-step-list">
             <li> 
                <div class="work-step wk-step-one">
                    <span class="step-icon"><img src="{{asset('frontend/images/step-icon1.png')}}"><span class="step-after"><img src="{{asset('frontend/images/step-after.png')}}"></span></span>
                    <h4>Click the schedule now button.</h4>
                </div>
             </li>
             <li> 
                <div class="work-step wk-step-one">
                    <span class="step-icon"><img src="{{asset('frontend/images/step-icon2.png')}}"><span class="step-after"><img src="{{asset('frontend/images/step-after2.png')}}"></span></span>
                    <h4>Tell us about your location and enter details about your vehicle.</h4>
                </div>
             </li>
             <li> 
                <div class="work-step wk-step-one">
                    <span class="step-icon"><img src="{{asset('frontend/images/step-icon3.png')}}"></span>
                    <h4>Our technicians will come to your given location and change the oil. Voila! You’re done.</h4>
                </div>
             </li>
          </ul>
        </div>
       </div>
    </section>
    <!-- How works ends here -->

     <!--  starts here -->
    <section class="services-prices-sec">
       <div class="container">
         <div class="ser-prices-block">
         <div class="sec-heading text-center max-w-heading mb-5">
                          {!! $cms->description2 !!}
         </div>
          <ul class="ser-prices-list">
            @foreach($service as $ser)
            @php $user_service = \App\Models\UserService::where('service_id',$ser->id)->where('price','!=','')->where('status',1)->orderBy('price')->first(); @endphp
             <li> 
               <a href="{{route('frontend.service')}}" class="ser-price-card">{{$ser->name}} – {{ $user_service!=null ? '$'.$user_service->price : '-' }}+ Tax</a>
             </li>
             @endforeach
             
          </ul>
       </div>
    </div>
    </section>
    <!-- Listing ends here -->
    <!-- Our Latest Studies section starts here -->
    
    <!-- Our Latest Studies section end here -->
    <!-- Find US section -->
    @include('frontend.includes.find_us')
@stop    



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
// $("#geocomplete").geocomplete({
//     fields: ["formatted_address", "geometry", "name","address_components"],
//     strictBounds: false,
//     componentRestrictions: { country: "<? echo  user_location()->countryCode?>" },
//     types: ["address"],
//   }).bind("geocode:result", function(event, result) {
//     var myLatlng = new google.maps.LatLng(parseFloat(result.geometry.location.lat()), parseFloat(result.geometry.location.lng()));
//     $("#location_rest_lat_store").val(result.geometry.location.lat());
//     $("#location_rest_long_store").val(result.geometry.location.lng());
//      $.each(result.address_components, function (i, address_component) {
//     if (address_component.types[0] == "country"){ 
//         $("#country_store").val(address_component.long_name);
//     }
//     if (address_component.types[0] == "postal_code"){ 
//         $("#pin_code_store").val(address_component.long_name);
//     }
// });
    
// });

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
/*$.ajax({
                url : $this.attr('data-action'),
                type: 'GET',  
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
                  $("#store-result").html(data);
                },
                complete: function(result) {
                },
                error: function (jqXhr, textStatus, errorMessage) {
                     
                }

        });     */
}                

   
        


$("#schedule_modal,#schedule_modal_1").click(function(){
  $("#VehicleSpecifications").modal('show');
  $url = "{{route('frontend.step1')}}";
  get_modal($url,'',$(this));
});


$('body').on('click','.coupon-apply', function(e){
   if($("#coupon-check").val()!=null){
       $.ajax({
                url : $("#coupon-check").attr('data-action'),
                type: 'POST',   
                data : { coupon: $("#coupon-check").val(),service :$("input[name=service]").val() },
                dataTYPE:'JSON',
                headers: {
                 'X-CSRF-TOKEN': $('input[name=_token]').val()
                },
                beforeSend: function() {
                                            
                },
                success: function (data) {   
                  if(data.status==0){
                      toastr.error(data.message);
                  }  
                  if(data.status==1){
                     $("#coupon-target").html(data.html);
                     $(".grnd-total-target").text(data.discount_price);
                     $(".coupon-apply").remove();
                     $("#coupon-check").prop('readonly', true);
                  }                             
                     

                  
                },
                complete: function(result) {
                },
                error: function (jqXhr, textStatus, errorMessage) {
                     
                }

        });  
    }
});


$('body').on('submit','#step1', function(e){
   e.preventDefault();
   var location_name = $("input[name=location_name]").val();
       var lat = $("#location_rest_lat").val();
       var long = $("#location_rest_long").val();
       var country = $("#country").val();
       if(location_name !=''  && lat!='' && long!=''  && country!='')
        {
            $url = $(this).attr('data-action');
       data = $('.oylerz-card').serialize(); 
       get_modal($url,data,$(this));
        }else{
            toastr.error('Please choose Location from the Google suggestion.');
        }
       
       
  });

$('body').on('submit','#step2,#step3,#step4,#step5', function(e){
       e.preventDefault();
       $url = $(this).attr('data-action');
       data = $('.oylerz-card').serialize(); 
       get_modal($url,data,$(this));
  });        


$('body').on('submit','#thank-you-model', function(e){
       e.preventDefault();
       email = $(this).find('input[name="email"]').val();
       $("#VehicleSpecifications").modal('hide');
       $("#createAccount").modal('show');
       $("#createAccount").find('input[name="email"]').val(email);
  });        
                        

$('body').on('click','#back', function(e){
       e.preventDefault();
       $url = $(this).attr('data-action');
       data = $('.oylerz-card').serialize(); 
       get_modal($url,data,$(this));
  });        





function get_modal($url,$data,$this){

   $.ajax({
                url : $url,
                type: 'POST',   
                data : $data,
                dataTYPE:'JSON',
                headers: {
                 'X-CSRF-TOKEN': $('input[name=_token]').val()
                },
                beforeSend: function() {
                  $this.find(':input[type=submit]').prop('disabled', true);                                                                
                },
                success: function (data) {     
                       $this.find(':input[type=submit]').removeAttr('disabled');                             
                if(data.status==1){
                  $(".content-target").html(data.html);      
                  check_validation();
                }
                if(data.status==2){
                  $('#VehicleSpecifications').modal('toggle');
                  toastr.success('Booking Saved.');
                }
                if(data.status==0){
                  toastr.error(data.message);
                }

                  
                },
                complete: function(result) {
                },
                error: function (jqXhr, textStatus, errorMessage) {
                     
                }

        });
}

function check_validation(){
    
   
    jQuery("form[id='thank-you-model']").validate({
    rules: {
      'email':{
         required: true, 
         nowhitespace: true,
         customemail:true
      },
    },
   });

   jQuery("form[id='step1']").validate({
    rules: {
      'address':{
         required: true, 
         nowhitespace: true
      },
    },
   });

   jQuery("form[id='step2']").validate({
    rules: {
      'address':{
         // required: true, 
         nowhitespace: true
      },
      'location_name':{
         required: true, 
         nowhitespace: true
      },
      'address2':{
         required: true, 
         nowhitespace: true
      },
      'city':{
         required: true, 
         nowhitespace: true
      },
      'state':{
         required: true, 
         nowhitespace: true
      },
      'country':{
         required: true, 
         nowhitespace: true
      },
      'zip_code':{
         required: true, 
         nowhitespace: true
      },
    },
   });

   jQuery("form[id='step3']").validate({
    rules: {
      'garage':{
         required: true
      },
      'year':{
         required: true
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
         maxlength:8,
         digits:true
      },
    }
   });

   jQuery("form[id='step4']").validate({
    rules: {
            'email': 
      {
        required: true, 
        nowhitespace: true,
        customemail:true
      },
        'name':{
         required: true, 
         nowhitespace: true,
         maxlength:35
      },
      'date':{
         required: true, 
         nowhitespace: true,
         maxlength:35
      },
      'time_slot':{
        required: true, 
         nowhitespace: true,
         maxlength:35 
      },
      'mobile':{
         required: true, 
         nowhitespace: true,
         minlength:10
      }
    }
   });

   jQuery("form[id='step5']").validate({
    rules: {
      'location_id':{
         required: true, 
      },
      'service[]':{
         required: true
      }

    },
           messages: {
      'service[]' : 'Please Select at least One Service' 
   },
    errorPlacement: function (error, element) {
    if (element.attr("type") == "checkbox") {
        error.appendTo('#service-error');    
    }else{
          error.insertAfter(element);
    }
    }
   });

   jQuery("form[id='step6']").validate({
    rules: {
      'name':{
         required: true, 
         nowhitespace: true,
         maxlength:35
      },
      'card_number':{
         required: true
      },
      'mm':{
         required: true
      },
      'cvv':{
         required: true
      }




    }
   });

   
}










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
                  $this.find(':input[type=submit]').prop('disabled', true);                          
                },
                success: function (data) {                                   
                  $this.find(':input[type=submit]').removeAttr('disabled');
                  if(data.success==true){
                    toastr.success(data.message);
                    setTimeout(function () {
                        location.reload(true);
                    }, 1000);
                   }else{
                     toastr.error(data.message);
                   }
                },
                complete: function(result) {
                },
                error: function (jqXhr, textStatus, errorMessage) {
                     
                }

        });     
}

  jQuery("form[id='store-find']").validate({
    rules: {
      'store':{
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
       submitForm($this);
        }else{
            toastr.error('Please choose Location from the Google suggestion.');
        }
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
                  $this.find(':input[type=submit]').prop('disabled', true);                          
                },
                success: function (data) {                                   
                  $this.find(':input[type=submit]').removeAttr('disabled');
                  $("#store-result").html(data);
                },
                complete: function(result) {
                },
                error: function (jqXhr, textStatus, errorMessage) {
                     
                }

        });     
}        







</script>

@endsection