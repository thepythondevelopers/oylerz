@extends('admin.layouts.layout')

@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
                <h3 class="page-title">Garage</h3>
                <a href="javascript:void(0);" data-toggle="modal" class="btn primary-btn" data-target="#addStoreLocation">Add Location </a>
            </div>
            <div class="content-body">
                <div class="csm-card">
                    <div class="csm-card-head d-f j-c-s-b">
                            <h3 class="csm-title">Garage Info</h3>
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
                                <tr>
                                  <td>001</td>
                                  <td>25 Jan</td>
                                  <td>10AM</td>
                                  <td>Active</td>
                                  <td>$100</td>
                                  <td>Action</td>
                                </tr>                  
                              
                              </tbody>
                            </table>
                        </div>
                    </div>
                  </div>  
            </div>
        </div>


@stop        

@section('modal')
<div class="modal fade" id="addStoreLocation" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Add Store Location</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Address<span class="astrick">*</span></label>
                                    <textarea class="form-control" placeholder="Enter Address"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Country<span class="astrick">*</span></label>
                                    <select class="form-control">
                                        <option>USA</option>
                                         <option>India</option>
                                         <option>Canada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Satus<span class="astrick">*</span></label>
                                    <select class="form-control">
                                        <option>Active</option>
                                         <option>India</option>
                                         <option>Canada</option>
                                    </select>
                                </div>
                            </div>                           
                            <div class="col-lg-12">
                               <div class="form-group">
                                    <label class="form-label">Postal Code<span class="astrick">*</span></label>
                                    <input type="text" name="" class="form-control" placeholder="Postal code">
                                </div>
                            </div>
                            <div class="col-lg-12">
                               <div class="form-group">
                                    <label class="form-label">Latitude<span class="astrick">*</span></label>
                                    <input type="text" name="" class="form-control" placeholder="Enter Latitude*">
                                </div>
                            </div>
                            <div class="col-lg-12">
                               <div class="form-group">
                                    <label class="form-label">Name<span class="astrick">*</span></label>
                                    <input type="text" name="" class="form-control" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="col-lg-12">
                               <div class="form-group">
                                    <label class="form-label">Phone Number<span class="astrick">*</span></label>
                                    <input type="text" name="" class="form-control" placeholder="Enter Phone Number">
                                </div>
                            </div>
                            <div class="col-lg-12">
                               <div class="form-group">
                                    <label class="form-label">Banner<span class="astrick">*</span></label>
                                     <input type="file" name="" class="form-control">
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