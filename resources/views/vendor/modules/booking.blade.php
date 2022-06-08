  @extends('vendor.layouts.layout')

@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
                <h3 class="page-title">Bookings</h3>
                <a href="javascript:void(0);" data-toggle="modal" class="btn primary-btn" data-target="#newBooking"> New Booking </a>
            </div>
            <div class="content-body">
                <div class="csm-card">
                    <div class="csm-card-head d-f j-c-s-b">
                            <h3 class="csm-title">User Profile</h3>
                        </div>
                    <div class="csm-body">  
                        <div class="table-responsive">
                            <table class="table dash-table">
                              <thead>
                                <tr>
                                  <th>Bookings#</th>
                                  <th>Date</th>
                                  <th>Time</th>
                                  <th>Status</th>
                                  <th>Total ($)</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($booking as $key=>$book)
                                <tr>
                                  <td>{{$key+1}}</td>
                                  <td>{{$book->date}}</td>
                                  <td>{{$book->time_slot}}</td>
                                  <td>Active</td>
                                  <td>{{$book->price}}</td>
                                  <td>Action</td>
                                </tr>                  
                                @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>
                  </div>  
            </div>
        </div>
@stop        

@section('modal')
<div class="modal fade" id="newBooking" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">New Booking</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Vehicle<span class="astrick">*</span></label>
                                    <select class="form-control">
                                        <option>Select a Vehicle</option>
                                         <option>Select a Vehicle</option>
                                         <option>Select a Vehicle</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Booking Date<span class="astrick">*</span></label>
                                    <input type="date" name="" class="form-control" placeholder="Booking date">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Testing Slot<span class="astrick">*</span></label>
                                    <select class="form-control">
                                        <option>Testing Slot</option>
                                         <option>Select a Vehicle</option>
                                         <option>Select a Vehicle</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                       <ul class="service-charges-list">
                                          <li><label class="ser-chrg">Servie Charges</label> <span class="cgr-amt">$Price</span></li>
                                          <li><label class="ser-chrg">Service Charges</label> <span class="cgr-amt">USD 95</span></li>
                                          <li><label class="ser-chrg">Service Charges</label> <span class="cgr-amt">USD 95</span></li>
                                          <li><label class="ser-chrg">Service Charges</label> <span class="cgr-amt">USD 95</span></li>
                                          <li><label class="ser-chrg">Service Charges</label> <span class="cgr-amt">USD 95</span></li>
                                          <li><label class="ser-chrg">Service Charges</label> <span class="cgr-amt">USD 95</span></li>
                                          <li><label class="ser-chrg">Service Charges</label> <span class="cgr-amt">USD 95</span></li>
                                          <li class="grand-total"><label class="ser-chrg">Grand Total</label> <span class="cgr-amt"> USD 100.00</span></li>
                                       </ul>
                                    </div>
                            </div>
                            <div class="col-lg-6">
                                    <div class="form-group">                            
                                       <input type="text" class="form-control" placeholder="Card Number">                                                      
                                    </div>
                                 </div>
                                 <div class="col-lg-3">
                                    <div class="form-group">                            
                                       <input type="text" class="form-control" placeholder="MM/YY">                                                      
                                    </div>
                                 </div>
                                 <div class="col-lg-3">
                                    <div class="form-group">                            
                                       <input type="text" class="form-control" placeholder="CVV">                                                      
                                    </div>
                                 </div>
                            <div class="col-lg-12">
                                <div class="btn-wrap d-f a-i-c">
                                    <button type="submit" class="btn primary-btn mr-3">Close</button>
                                    <button type="submit" class="main-btn">Update</button>
                                </div>
                            </div>
                        </div>  
                    
      </div>
    </div>
  </div>
</div>
@stop