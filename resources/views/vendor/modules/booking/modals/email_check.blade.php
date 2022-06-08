<form id="booking-email" data-action="{{route('vendor.booking.email.check')}}">
            
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Email<span class="astrick">*</span></label>
                                    <input type="text" name="email" class="form-control" placeholder="Email" autocomplete="off">
                                    <label id="t_error"></label>
                                </div>
                            </div>
                        <div class="col-lg-12">
                                <div class="btn-wrap d-f a-i-c">
                                    <button type="submit" class="main-btn">Check</button>
                                </div>
                            </div>
                        </div>
                        </form>

<script type="text/javascript">
    jQuery("form[id='booking-email']").validate({
    rules: {
      'email': 
      {
        required: true, 
        nowhitespace: true,
        customemail:true  
      }
    },  
});
</script>                        