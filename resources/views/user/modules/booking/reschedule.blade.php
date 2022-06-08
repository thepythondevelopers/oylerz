@extends('user.layouts.layout')

@section('stylesheets')
<style type="text/css">
    .hide{
        display: none;
    }
</style>
@endsection
@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
                <h3 class="page-title">Booking Reschedule</h3>
            </div>
            <div class="content-body">
                <form method="POST" action="{{route('user.booking.reschedule.save',$booking->id)}}" id="booking-reschedule">
                    @csrf
                                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Booking Date<span class="astrick">*</span></label>
                                    <input type="text" name="date" id="filter-date" class="form-control" placeholder="Booking date" value="{{$booking->date}}" required="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Time Slot<span class="astrick">*</span></label>
                                    <input type="text" name="time_slot" id="filter-time" class="form-control" placeholder="Time Slot" required=""  value="{{$booking->time_slot}}" autocomplete="off">
                                    
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="btn-wrap d-f a-i-c">
                                    <button type="submit" class="main-btn">Book</button>
                                </div>
                            </div>
        </div>
    </div>
@stop        



@section('scripts')
<script type="text/javascript">
    $(function () {
         jQuery('#filter-date').datetimepicker({
            minDate:0,
            disabledWeekDays:"{{ $timeslot->days!=null ? $timeslot->days : [] }}",
             timepicker:false,
               format: 'd/m/Y',
                 onChangeDateTime:function(dp,$input){
                    var d_day = moment(dp).format('YYYY/MM/DD');
                    var c_day = moment().format('YYYY/MM/DD');
                    $("#filter-time").val('');
                     if(d_day == c_day){
                        jQuery('#filter-time').datetimepicker({
                            minTime:0
                        });
                     }else{
                        jQuery('#filter-time').datetimepicker({
                            minTime:false
                        });
                     } 
                }

         });
        
        
         $('#filter-time').datetimepicker({
        datepicker: false, 
        format:'h:i a',
        formatTime: 'h:i a',

        validateOnBlur: false,
        allowTimes:<?php echo $timeslot->time_slot!=null ? $timeslot->time_slot : [] ?>
    });

});         

jQuery("form[id='booking-reschedule']").validate({
    rules: {
        'date':{
            required: true,
        },
        'time_slot':{
                 required: true, 
      },
    }
});          
</script>         





@endsection