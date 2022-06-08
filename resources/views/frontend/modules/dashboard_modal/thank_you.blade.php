<div class="multistep step-six oylerz-card" >
                           <div class="oylerz-head">
                              <a href="javascript:void(0);" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </a>
                              <div class="thank-you-icon text-center mb-5">
                                 <img src="{{asset('frontend/images/thank-you-icon.png')}}">
                              </div>
                              <h3 class="tnk-title"><span class="text-primary">Thank You !</span> <small>for the booking with <span class="text-primary">Oylerz</span></small></h3>
                           </div>
                           <form id="thank-you-model">
                           <div class="oylerz-body">
                              <div class="thank-you-content text-center">
                                 <h4>To make any other booking please <span class="text-primary">register</span> with us</h4>
                                 <div class="ckeckbox-grp form-group d-f a-i-c j-c-c">
                                    <div class="custom-control custom-checkbox mr-4">
                                       <input type="checkbox" class="custom-control-input" id="customCheck1" checked disabled>
                                       <label class="custom-control-label" for="customCheck1">with an Email ID</label>
                                    </div>
                                    <!-- <div class="custom-control custom-checkbox">
                                       <input type="checkbox" class="custom-control-input" id="customCheck2">
                                       <label class="custom-control-label" for="customCheck2">with a Phone Number</label>
                                    </div> -->
                                 </div>
                                 <div class="form-group">                            
                                    <input type="email" name="email" class="form-control" placeholder="Enter your email...">                                                      
                                 </div>
                              </div>
                           </div>
                           <div class="btn-wrap text-center">                     
                                 <button type="submit" class="oylerz-btn primary-btn">Continue</button>
                              </div>
                           </form>   
                           <div class="oylerz-foot mt-4">
                              
                              <p class="text-center my-4">or</p>
                              <div class="soicial-log-btn-wrap d-f a-i-c j-c-c">
                                 <a class="btn-google mr-4" href="{{route('google.auth')}}">
                                    <div class="google-content">
                                       <div class="sc-logo">
                                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 48 48">
                                             <defs>
                                                <path id="a" d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z"/>
                                             </defs>
                                             <clipPath id="b">
                                                <use xlink:href="#a" overflow="visible"/>
                                             </clipPath>
                                             <path clip-path="url(#b)" fill="#FBBC05" d="M0 37V11l17 13z"/>
                                             <path clip-path="url(#b)" fill="#EA4335" d="M0 11l17 13 7-6.1L48 14V0H0z"/>
                                             <path clip-path="url(#b)" fill="#34A853" d="M0 37l30-23 7.9 1L48 0v48H0z"/>
                                             <path clip-path="url(#b)" fill="#4285F4" d="M48 48L17 24l-4-3 35-10z"/>
                                          </svg>
                                       </div>
                                       <p>Sign in with Google</p>
                                    </div>
                                 </a>
                                 <a class="btn-fb" href="{{route('facebook.auth')}}">
                                    <div class="fb-content">
                                       <div class="sc-logo">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" version="1">
                                             <path fill="#FFFFFF" d="M32 30a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h28a2 2 0 0 1 2 2v28z"/>
                                             <path fill="#4267b2" d="M22 32V20h4l1-5h-5v-2c0-2 1.002-3 3-3h2V5h-4c-3.675 0-6 2.881-6 7v3h-4v5h4v12h5z"/>
                                          </svg>
                                       </div>
                                       <p>Sign in with Facebook</p>
                                    </div>
                                 </a>
                              </div>
                           </div>
                        </div>