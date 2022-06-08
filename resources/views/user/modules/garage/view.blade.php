@extends('user.layouts.layout')

@section('content')
<div class="content-wrap">
<div class="content-body">
        <div class="csm-card">
            <div class="csm-card-head d-f j-c-s-b">
                <h3 class="csm-title">Garage</h3>

            </div>
            <div class="csm-body">
                <div class="row">
                <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group show-form-grp">
                            <label class="form-label">Name</label>
                            <span class="input-text">{{$g->name}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group show-form-grp">
                            <label class="form-label">Year</label>
                            <span class="input-text">{{$g->year}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group show-form-grp">
                            <label class="form-label">Make</label>
                            <span class="input-text">{{$g->make}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group show-form-grp">
                            <label class="form-label">Model</label>
                            <span class="input-text">{{$g->model}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group show-form-grp">
                            <label class="form-label">Trim</label>
                            <span class="input-text">{{$g->trim}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group show-form-grp">
                            <label class="form-label">Mileage</label>
                            <span class="input-text">{{$g->mileage}}</span>
                        </div>
                    </div>
                <div class="col-lg-12">
                    <div class="btn-wrap">
                        <a href="{{route('user.garage')}}" class="main-btn">Back</a>
                    </div>
                </div>
            </div>
        </div>

            </div>  
        </div>
    </div>  
</div>
</div>
@endsection