@extends('frontend.layouts.layout')
@section('meta')
<title>{{ $data->meta_title}}</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="title" content="{{ $data->meta_title}}">
    <meta name="keywords" content="{{ $data->meta_keywords}}">
  <meta name="description" content="{{ $data->meta_description}}">
@endsection
@section('content')
<section class="contact_us-sec">
  <div class="container">
    <div class="sec-heading text-center mb-5">
            <h2 class="mb-4"  >{{$data->title}}</h2>
            {!! $data->description !!}
         </div>

         
  </div>
</section>
 
@endsection

