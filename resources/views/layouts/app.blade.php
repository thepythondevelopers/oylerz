<!DOCTYPE html>
<html>
   <head>
      <title>{{ config('app.name', 'Oylerz') }}</title>
      <link rel="shortcut icon" href="{{asset('frontend/images/favicon.ico')}}" type="image/x-icon">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   </head>
   <body>

     @yield('content')


      <script src="https://code.jquery.com/jquery-3.1.0.js"></script>

      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> 
      <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>        
      <script type="text/javascript">
                jQuery.validator.addMethod("nowhitespace", function(value, element) {
          return this.optional(element) || /^\S+/i.test(value);
        }, "Space is not allowed at the beginning.");

         jQuery.validator.addMethod("customemail", function(value, element) {
          return this.optional(element) || /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
        }, "Please enter a valid email address.");  

      
      </script>
      @yield('scripts')
   </body>
</html>