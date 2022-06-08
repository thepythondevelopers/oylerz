<!DOCTYPE html>
<html>
   <head>
      
      <link rel="shortcut icon" href="{{asset('frontend/images/fire-icon.png')}}" type="image/x-icon">
      @yield('meta')
      

      <link rel="stylesheet" href="https://cdn.rawgit.com/michalsnik/aos/2.0.4/dist/aos.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
      <link href="{{asset('frontend/css/owl.carousel.min.css')}}" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/animate.css')}}">
      <link rel="stylesheet" href="{{asset('backend/css/jquery.datetimepicker.css')}}">   
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
      <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css">
      <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/responsive.css')}}">
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> 
      
   </head>
   <body>

     <!-- header starts here -->
    @include('frontend.includes.header')      
    <!-- header ends here -->
     @yield('content')
     @include('frontend.includes.register-login')      
    <!-- Find US section End -->
    <!-- FOOTER START -->
      @include('frontend.includes.footer')
    <!-- FOOTER END -->

      @yield('modal')
      <!-- Scripting starts here -->
      <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> 
      <script src="https://cdn.rawgit.com/michalsnik/aos/2.0.4/dist/aos.js"></script>
      <script src="{{asset('frontend/js/animation.js')}}"></script>
      <script type="text/javascript" src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
      <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>   
      <script type="text/javascript" src="{{asset('frontend/js/custom.js')}}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.0.1/jquery.payment.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      <script src="{{asset('backend/js/jquery.datetimepicker.full.js')}}"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
      <script>
         AOS.init();
      </script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> 
      <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>  
      <script type="text/javascript">        
                jQuery.validator.addMethod("nowhitespace", function(value, element) {
          return this.optional(element) || /^\S+/i.test(value);
        }, "Space is not allowed at the beginning.");

         jQuery.validator.addMethod("customemail", function(value, element) {
          return this.optional(element) || /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
        }, "Please enter a valid email address.");  

         toastr.options = {
        'closeButton': true,
        'debug': false,
        'newestOnTop': false,
        'progressBar': false,
        'positionClass': 'toast-top-right',
        'preventDuplicates': false,
        'showDuration': '1000',
        'hideDuration': '1000',
        'timeOut': '5000',
        'extendedTimeOut': '1000',
        'showEasing': 'swing',
        'hideEasing': 'linear',
        'showMethod': 'fadeIn',
        'hideMethod': 'fadeOut',
      }
      


    jQuery("form[id='blog_subscribe']").validate({
    rules: {
      'email':{
         required: true, 
         nowhitespace: true,
         customemail: true
      },
    },
   });


    $('body').on('submit','#blog_subscribe', function(e){
       e.preventDefault();
       
$.ajax({
                url : $(this).attr('data-action'),
                type: 'POST',  
                data:$(this).serialize(),     
                dataTYPE:'JSON',
                headers: {
                 'X-CSRF-TOKEN': $('input[name=_token]').val()
                },
                beforeSend: function() {
                  $(this).find(':input[type=submit]').prop('disabled', true);                          
                },
                success: function (data) {                                   
                  $(this).find(':input[type=submit]').removeAttr('disabled');
                  if(data.status==1){
                    $("#blog_subscribe")[0].reset();
                    $(".blog_subscribe_message").html(data.message);
                  }
                },
                complete: function(result) {
                },
                error: function (jqXhr, textStatus, errorMessage) {
                     
                }

        });
  });        
      </script>

      @if(session('message'))
     <script type="text/javascript">
       toastr.{{session('message_type')}}('{{session('message')}}');
     </script> 
@endif
      @yield('scripts')
      @include('frontend.includes.register-script')
   </body>
</html>