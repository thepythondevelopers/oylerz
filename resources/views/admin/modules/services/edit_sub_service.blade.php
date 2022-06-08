<form id="sub-service-edit" data-action="{{route('admin.services.sub.update',$service->id)}}">
                
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Name<span class="astrick">*</span></label>
                                    <input type="text" name="name" value="{{$service->name}}" class="form-control" placeholder="Name" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Description<span class="astrick">*</span></label>
                                    <textarea name="description"  class="form-control" autocomplete="off">{{$service->description}}</textarea>
                                </div>
                            </div>
                            
                            
                            <div class="col-lg-12">
                                <div class="btn-wrap d-f a-i-c">
                                    <button type="button" data-dismiss="modal" class="btn primary-btn mr-3">Close</button>
                                    <button type="submit" class="main-btn">Save</button>
                                </div>
                            </div>
                        </div>
            </form> 