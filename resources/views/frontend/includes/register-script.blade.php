<script type="text/javascript">
	   var $emailTseturl = $("body").find("#email-check").attr('data-action');
jQuery("form[id='front-login']").validate({
    rules: {
      'email': 
      {
        required: true, 
        nowhitespace: true,
        customemail:true
      },
      'password': 
      {
        required: true, 
        nowhitespace: true,
        maxlength:35  
      },
    },  
});

jQuery("form[id='front-register']").validate({
    rules: {
      'name':{
         required: true, 
         nowhitespace: true,
         maxlength:35
      },
      'email': 
      {
        required: true, 
        nowhitespace: true,
        customemail:true,
            remote: {
               url: $emailTseturl,
               type: "get"
            }
      },
      'password': 
      {
        required: true, 
        nowhitespace: true,
        maxlength:35  
      },
      'mobile':{
                 required: true, 
        nowhitespace: true,
        maxlength:35,
        digits:true
      },
      'service_address':{
                 required: true, 
        nowhitespace: true,
        maxlength:35
      },
      'c_password':{
                 required: true, 
        nowhitespace: true,
        maxlength:35,
        equalTo : "#password"
      },
      'agree':{
        required: true
      }
    },
    messages: {
        email: {
            remote: "Email already used!"
        } 
    },  
});
           
$('body').on('submit','#front-register,#front-login', function(e){
       e.preventDefault();
       $this = $(this);
       submitForm($this);
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

$('body').on('click','.front-sign-modal', function(e){
       e.preventDefault();
       $("#createAccount").modal('toggle');
       $("#loginAccount").modal('show');
  });  

$('body').on('click','.front-signup-modal', function(e){
       e.preventDefault();
       $("#loginAccount").modal('toggle');
       $("#createAccount").modal('show');
  });  
</script>