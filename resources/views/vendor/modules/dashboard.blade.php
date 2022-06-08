@extends('vendor.layouts.layout')
<style type="text/css">


</style>
@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
                <h3 class="page-title">Dashboard </h3>
            </div>
            <div class="content-body">
             <div class="dash-status-block">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="csm-card p-4 d-f a-i-c mb-4">
                            <span class="dash-status-icon">
                                <img src="{{asset('backend/images/dash-status1.png')}}">
                            </span>
                            <div class="dash-status-info">
                                <h4>{{$booking_count}}</h4>
                                <p>Total Booking</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="csm-card p-4 d-f a-i-c mb-4">
                            <span class="dash-status-icon">
                                <img src="{{asset('backend/images/dash-status2.png')}}">
                            </span>
                            <div class="dash-status-info">
                                <h4>{{$booking_sum}}</h4>
                                <p>Booking Revenue</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="csm-card p-4 d-f a-i-c mb-4">
                            <span class="dash-status-icon">
                                <img src="{{asset('backend/images/dash-status5.png')}}">
                            </span>
                            <div class="dash-status-info">
                                <h4>{{$booking_completed}}</h4>
                                <p>Booking Completed</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="csm-card p-4 d-f a-i-c mb-4">
                            <span class="dash-status-icon">
                                <img src="{{asset('backend/images/dash-status4.png')}}">
                            </span>
                            <div class="dash-status-info">
                                <h4>{{$booking_today}}</h4>
                                <p>Today Bookings</p>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
              
                <div class="csm-card">
                    <div class="csm-card-head d-f j-c-s-b">
                            <h3 class="csm-title">Booking</h3> 
                            <select class="form-control chart_select">
                                @for($y=date('Y') ; $y>=2022 ; $y--)
                                <option value="{{$y}}">{{$y}}</option>
                                @endfor

                            </select>
                        </div>
                    <div class="csm-body">
                        <div id="Booking-chart">
                       </div>
                    </div>
                  </div>
                  </div> 
                   

           

@stop        

@section('scripts')
<script type="text/javascript">
    $(".chart_select").change(function(){
  chart_get($(this).val());
});


function chart_get($year=null){
    $ear = $year!=null ? $year : '';
$.ajax({
                url : "{{route('vendor.dashboard.chart')}}",
                type: 'GET',
                data: {year:$year},       
                dataTYPE:'JSON',
                beforeSend: function() {
                    
                },
                success: function (data) {                                   
                                        chart.updateSeries([{
            name: 'Booked',
            data: data.booked
          }, {
            name: 'Completed',
            data: data.completed
          }])
                },
                complete: function(result) {
                },
                error: function (jqXhr, textStatus, errorMessage) {
                     
                }

        });     
    
} 






        var options = {
  chart: {
     toolbar: {
      show: false
    },
    height: 385,
    type: "area"
  },
  dataLabels: {
    enabled: false
  },
  colors: ['#008FFB', '#28A745'],
  series: [
    {
      name: "Booked",
      data: [0,0,0,0,0,0,0,0,0,0,0,0]
    },
    {
      name: "Completed",
      data: [0,0,0,0,0,0,0,0,0,0,0,0]
    }
  ],
  fill: {
    type: "gradient",
    gradient: {
      shadeIntensity: 1,
      opacityFrom: 0.7,
      opacityTo: 0.9,
      stops: [0, 90, 100]
    }
  },
  xaxis: {
    categories: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sept",
      "Oct",
      "Nov",
      "Dec"
    ]
  }
};

var chart = new ApexCharts(document.querySelector("#Booking-chart"), options);

chart.render();

chart_get();
</script>
@endsection