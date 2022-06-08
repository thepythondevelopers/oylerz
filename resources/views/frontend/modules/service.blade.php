@extends('frontend.layouts.layout')
@section('content')


<section id="flip" class="py-5">
    <div class="container">
        <div class="row">
            <!-- flip box -->
            @foreach($service as $ser)
            @php $user_service = \App\Models\UserService::where('service_id',$ser->id)->where('price','!=','')->where('status',1)->orderBy('price')->get(); @endphp
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="image-flip" >
                    <div class="mainflip flip-0">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p></p>
                                    <h4 class="card-title">{{$ser->name}}</h4>
                                    <h4 class="card-parent-service">Parent Service : {{$ser->parent_service($ser->id)->name}}</h4>
                                    <p class="card-text">{{$ser->description}}</p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="backside">
                            <div class="card">
                                <div class="card-body text-center mt-4">
								    <table class="table table-bordered border-primary">
									  <thead>
										<tr>
										  <th scope="col"><h4>Name</h4></th>
										  <th scope="col"><h4>Price</h4></th>
										</tr>
									  </thead>
									  <tbody>
										<tr>
										@foreach($user_service as $us)
										  <td>{{$us->user->name}}</td>
										  <td>{{$us->price}}</td>
										</tr>
									  </tbody>
									  @endforeach
									  </table>
                                    <!-- <h4 class="card-title">Sunlimetech</h4>
                                    <p class="card-text">This is basic card with image on top, title, description and button.This is basic card with image on top, title, description and button.This is basic card with image on top, title, description and button.</p> -->
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

         @endforeach   

        </div>
    </div>
</section>
@endsection