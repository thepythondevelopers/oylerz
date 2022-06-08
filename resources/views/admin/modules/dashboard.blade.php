@extends('admin.layouts.layout')
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
             		<div class="col-xl-3 col-lg-6">
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
             		<div class="col-xl-3 col-lg-6">
             			<div class="csm-card p-4 d-f a-i-c mb-4">
             				<span class="dash-status-icon">
             					<img src="{{asset('backend/images/dash-status2.png')}}">
             				</span>
             				<div class="dash-status-info">
             					<h4>{{$booking_sum}}</h4>
             					<p>Total Revenue</p>
             				</div>
             			</div>
             		</div>
             		<div class="col-xl-3 col-lg-6">
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
             		<div class="col-xl-3 col-lg-6">
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
            <div class="row">
                <div class="col-xl-9 col-lg-8"> 
                <div class="csm-card h-100 mb-sm-4 mb-lg-0">
                    <div class="csm-card-head d-f j-c-s-b">
                            <h3 class="csm-title">Booking</h3> 
                            <select class="form-control vendor_id">
                              <option value="">Vendor</option>
                              @foreach($vendor as $k=>$v)
                                <option value="{{$v->id}}">{{$v->name}}</option>
                                @endforeach
                            </select>
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
            
                  <div class="col-xl-3 col-lg-4">
                <div class="csm-card h-100">
                    <div class="csm-card-head d-f j-c-s-b">
                            <h3 class="csm-title">Total Vendors</h3> 
                            
                        </div>
                    <div class="csm-body">
                        <div id="Vendors-chart"></div>
                        <ul class="Vendors-chart-list">
                          <li><div class="chart-status-inn"><span class="active-dot" style="background: green;"></span> Active Vendors</div></li>
                          <li><div class="chart-status-inn"><span class="active-dot" style="background: #F38D15;"></span> Blocked Vendors</div></li>
                        </ul>
                    </div>
                  </div>
                  </div> 
        </div>
@stop        

@section('scripts')
<script type="text/javascript">
    $(".chart_select").change(function(){

  chart_get($(this).val(),$(".vendor_id").val());
});

    $(".vendor_id").change(function(){

  chart_get($(".chart_select").val(),$(this).val());
});


function chart_get($year=null,vendor_id){
    $year = $year!=null ? $year : '';
$.ajax({
                url : "{{route('admin.dashboard.chart')}}",
                type: 'GET',
                data: {year:$year,vendor_id:vendor_id},       
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
    height: 350,
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
var optionDonut = {
  colors: ['#008000', '#F38D15'],
  chart: {
      type: 'donut',
      width: '100%'
  },
  dataLabels: {
    enabled: false,
  },
  plotOptions: {
    pie: {
      donut: {
        size: '60%',
      },
      offsetY: 20,
    },
    stroke: {
      colors: undefined
    }
  },
  // colors: colorPalette,
  title: {
    // text: 'Department Sales',
    style: {
      fontSize: '18px'
    }
  },
  series: [{{$active_vendor}},{{$blocked_vendor}}],
  labels: ['Active Vendors', 'Blocked Vendors'],
  legend: {
    show: false,
    position: 'left',
    offsetY: 180
  }
}

var donut = new ApexCharts(
  document.querySelector("#Vendors-chart"),
  optionDonut
)
donut.render();

</script>
@endsection