<section class="find-us-sec">
      <!-- <div class="map-block">
        <img src="{{asset('frontend/images/map-bg.png')}}">
      </div> -->
      <!-- <div class="container"> -->
        <!-- <form class="find-us-card" id="store-find" data-action="{{route('store')}}">
          <div class="label-content">
            <h4>Having Trouble?</h4>
            <h5> Finding a store near you</h5>

          </div>
         
          <div class="addres-fld-wrap">
            <input type="text" name="store" id="geocomplete" placeholder="Enter Starting Address" class="form-control" autocomplete="off">
             <input type="hidden" id="location_rest_lat_store" name="lat" value="">
                                <input type="hidden" id="location_rest_long_store" name="long" value="">
                                <input type="hidden" id="pin_code_store" name="pin_code" value="">
                                <input type="hidden" id="country_store" name="country" value="">
          </div>
          <button class="oylerz-btn primary-btn" type="submit">Find Us</button>
       </form> -->
       <div class="map-container inset-shadow sm-map-box">
                                <div id="map_find_us"></div>
                              </div>
      <!-- </div> -->
    </section>
    <div class="address-row">
      <div class="container">
         <ul class="address-list">
          @php
          $under_map = \App\Models\CmsPage::where('slug','Under Map')->first();
          @endphp
           <li>{!! $under_map->description !!}</li>
           <li>{!! $under_map->description1 !!}</li>
           <li>{!! $under_map->description2 !!}</li>
           <li>{!! $under_map->description3 !!}</li>
         </ul>
      </div>
    </div>