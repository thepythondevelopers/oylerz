
<!--  CREATE ACCOUNT  -->
      <div class="modal fade oylerz-modal" id="createAccount" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-body">
                  <div class="oylerz-card">
                     <div class="oylerz-head border-none text-center">
                        <h3 class="oylerz-title"> Welcome to <span class="text-primary">Oylerz</span> Oil Change</h3>
                        <a href="javascript:void(0);" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </a>
                        <p>Already have an account? <a href="javascript:void();" class="link text-primary front-sign-modal">Sign In</a></p>
                        
                     </div>
                     <form id="front-register" method="POST" data-action="{{route('user.register')}}">  
                     {{ csrf_field() }} 
                     <div class="oylerz-body">
                        <div class="row">
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <input type="text" class="form-control" placeholder="Full Name" name="name">                               
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <input type="text" class="form-control" placeholder="Phone Number" name="mobile">                               
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <input type="text" class="form-control" placeholder="Email" name="email">                            
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <textarea class="form-control" placeholder="Enter your address here..." name="service_address"></textarea>                           
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <input type="password" class="form-control" id="password" placeholder="Password" name="password">                               
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <input type="password" class="form-control" placeholder="Retype Password" name="c_password">                               
                              </div>
                           </div>
                        </div>

                     </div>
                     <div class="custom-control custom-checkbox d-i-f mt-4">
                           <input type="checkbox" name="agree" class="custom-control-input" id="customCheck2">
                           <label class="custom-control-label" for="customCheck2">I have read and agree to the Terms of Service</label>
                        </div>
                     <div class="oylerz-foot text-center mt-4">
                        <div class="btn-wrap">
                           <button type="submit" class="oylerz-btn primary-btn">Create Account</button>
                        </div>
                        
                     </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--  CREATE ACCOUNT END -->
      <!--  LOGIN ACCOUNT  -->
      <div class="modal fade oylerz-modal" id="loginAccount" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-body">
                  <div class="oylerz-card">
                     <div class="oylerz-head border-none text-center">
                        <h3 class="oylerz-title"> log In to <span class="text-primary">Oylerz</span> Oil Change</h3>
                        <a href="javascript:void(0);" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </a>
                        <p>Don’t have an account? <a href="javascript:void();" class="link text-primary front-signup-modal">Sign Up Free!</a></p>
                     </div>
                     <form id="front-login" method="POST" data-action="{{route('user.login')}}">
                        {{ csrf_field() }} 
                     <div class="oylerz-body">
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <input type="text" class="form-control" name="email" placeholder="Enter your email">                               
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <input type="password" class="form-control" placeholder="Enter Password" name="password">                               
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group d-f j-c-s-b">
                                 <div class="custom-control custom-checkbox d-i-f">
                                    <input type="checkbox" class="custom-control-input" id="customCheck4">
                                    <label class="custom-control-label" for="customCheck4">Remember Me</label>
                                 </div>
                                 <p>Forgot <a href="{{route('password.request')}}" class="link text-primary">password?</a></p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="oylerz-foot text-center mt-4">
                        <div class="btn-wrap">
                           <button type="submit" class="oylerz-btn primary-btn">Sign In</button>
                        </div>
                     </div>
                  </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--  LOGIN ACCOUNT END -->
      <!--OIL CHANGE STEP FORM -->
      <div class="modal fade oylerz-modal" id="VehicleSpecifications" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <h2 class="modal-title">Schedule <span class="text-primary">Oil Change</span> in less <br>than 60 seconds</h2>
               </div>
               <div class="modal-body content-target">
                  
                  
                  
               </div>
            </div>
         </div>
      </div>
      <!--OIL CHANGE STEP FORM -->
