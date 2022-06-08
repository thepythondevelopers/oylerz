@extends('vendor.layouts.layout')
@section('content')
@php
$days = (isset($ts->days) && $ts->days!=null) ? json_decode($ts->days) : [];
$time_slot = (isset($ts->time_slot) && $ts->time_slot!=null) ? json_decode($ts->time_slot) : [];
@endphp
<div class="content-wrap">
   <div class="content-head mb-4 d-f j-c-s-b a-i-c">
      <h3 class="page-title">Time Slot</h3>
   </div>
   <div class="content-body">
      <div class="csm-card">
         <div class="csm-card-head d-f j-c-s-b">
            <h3 class="csm-title">Time Slot</h3>
         </div>
         <div class="csm-body">
            <form method="POST" action="{{route('vendor.timeslot.save')}}" id="update-time-slot">
               @csrf 
               <div class="time-slop-inn border-bottom mb-4">
                        <div class="row">    
                                              <div class="col-lg-12">
                               <div class="form-group">
                                    <label class="form-label">Slots<span class="astrick">*</span></label>
                                    <input type="text" name="slot" class="form-control" placeholder="Slots" value="{{isset($ts->slot) ? $ts->slot : ''}}" autocomplete="off">
                                </div>
                            </div>
                        </div>    
                  <h3 class="form-title mb-4">Days on which you are not available?</h3>
                  
                  <div class="row">
                     <div class="col-lg-4">
                        <div class="form-group">
                           <div class="custom-control custom-checkbox">
                              <input class="form-check-input custom-control-input" name="days[]" type="checkbox" value="0" id="defaultCheck1" {{in_array('0',$days) ? 'checked' : ''}} >
                              <label class="custom-control-label" for="defaultCheck1">Sunday</label>
                           </div>
                            
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-group">
                           <div class="custom-control custom-checkbox">
                              <input class="form-check-input custom-control-input" name="days[]" type="checkbox" value="1" id="defaultCheck2" {{in_array('1',$days) ? 'checked' : ''}}>
                              <label class="custom-control-label" for="defaultCheck2">Monday</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-group">
                           <div class="custom-control custom-checkbox">
                              <input class="form-check-input custom-control-input" name="days[]" type="checkbox" value="2" id="defaultCheck3" {{in_array('2',$days) ? 'checked' : ''}}>
                              <label class="custom-control-label" for="defaultCheck3">Tuesday</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-group">
                           <div class="custom-control custom-checkbox">
                              <input class="form-check-input custom-control-input"  name="days[]" type="checkbox" value="3" id="defaultCheck31" {{in_array('3',$days) ? 'checked' : ''}}>
                              <label class="custom-control-label" for="defaultCheck31">Wednesday</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-group">
                           <div class="custom-control custom-checkbox">
                              <input class="form-check-input custom-control-input"  name="days[]" type="checkbox" value="4" id="defaultCheck4" {{in_array('4',$days) ? 'checked' : ''}}>
                              <label class="custom-control-label" for="defaultCheck4">Thrusday</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-group">
                           <div class="custom-control custom-checkbox">
                              <input class="form-check-input custom-control-input"  name="days[]" type="checkbox" value="5" id="defaultCheck5" {{in_array('5',$days) ? 'checked' : ''}}>
                              <label class="custom-control-label" for="defaultCheck5">Friday</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-group">
                           <div class="custom-control custom-checkbox">
                              <input class="form-check-input custom-control-input"  name="days[]" type="checkbox" value="6" id="defaultCheck5" {{in_array('6',$days) ? 'checked' : ''}}>
                              <label class="custom-control-label" for="defaultCheck5">Saturday</label>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="time-slop-inn">
                  <h3 class="form-title mb-4">Time Slots of Availability</h3>
                  <span id="errtime1"></span>
                  <div class="row">
                     <div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="00:00" id="dayCheck1" {{in_array('00:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck1">12:00 am</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="01:00" id="dayCheck2" {{in_array('01:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck2">01:00 am</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="02:00" id="dayCheck3" {{in_array('02:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck3">02:00 am</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="03:00" id="dayCheck4" {{in_array('03:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck4">03:00 am</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="04:00" id="dayCheck5" {{in_array('04:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck5">04:00 am</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="05:00" id="dayCheck6" {{in_array('05:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck6">05:00 am</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="06:00" id="dayCheck7" {{in_array('06:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck7">06:00 am</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="07:00" id="dayCheck8" {{in_array('07:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck8">07:00 am</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="08:00" id="dayCheck9" {{in_array('08:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck9">08:00 am</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="09:00" id="dayCheck10" {{in_array('09:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck10">09:00 am</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="10:00" id="dayCheck11" {{in_array('10:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck11">10:00 am</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="11:00" id="dayCheck12" {{in_array('11:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck12">11:00 am</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="12:00" id="dayCheck13" {{in_array('12:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck13">12:00 pm</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="13:00" id="dayCheck14" {{in_array('13:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck14">01:00 pm</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="14:00" id="dayCheck15" {{in_array('14:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck15">02:00 pm</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="15:00" id="dayCheck16" {{in_array('15:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck16">03:00 pm</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="16:00" id="dayCheck17" {{in_array('16:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck17">04:00 pm</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="17:00" id="dayCheck18" {{in_array('17:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck18">05:00 pm</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="18:00" id="dayCheck19" {{in_array('18:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck19">06:00 pm</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="19:00" id="dayCheck20" {{in_array('19:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck20">07:00 pm</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="20:00" id="dayCheck21" {{in_array('20:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck21">08:00 pm</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="21:00" id="dayCheck22" {{in_array('21:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck22">09:00 pm</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="22:00" id="dayCheck23" {{in_array('22:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck23">10:00 pm</label>
        </div>
   </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input class="form-check-input custom-control-input"  name="time_slot[]" type="checkbox" value="23:00" id="dayCheck24" {{in_array('23:00',$time_slot) ? 'checked' : ''}} data-error="#errtime1">
            <label class="custom-control-label" for="dayCheck24">11:00 pm</label>
        </div>
   </div>
</div>
                     <div class="col-lg-12">
                        <div class="btn-wrap d-f a-i-c">
                           <button type="submit" class="main-btn">Save</button>
                        </div>
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
   jQuery("form[id='update-time-slot']").validate({
   rules: {
   'days[]': 
     {
      // required: true
     },
     'time_slot[]': 
     {
       required: true
     },
     'slot':{
      required:true,
      digits:true,
      maxlength:4
     }
   },
   messages: {
      'time_slot[]' : 'Time Slot Should be selected' 
   },
    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    }  
   });
</script>
@endsection