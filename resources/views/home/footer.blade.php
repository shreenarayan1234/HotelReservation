<footer>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class=" col-md-4">
                     <h3>Contact US</h3>
                     <ul class="conta">
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i> Address</li>
                        <li><i class="fa fa-mobile" aria-hidden="true"></i> +977-9805952134</li>
                        <li> <i class="fa fa-envelope" aria-hidden="true"></i><a href="#"> shreenarayan@gmail.com</a></li>
                     </ul>
                  </div>
                  <div class="col-md-4">
                     <h3>Menu Link</h3>
                     <ul class="link_menu">
                              <li class="nav-item active">
                                 <a class="nav-link" href="{{url('/')}}">Home</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="{{url('our_rooms')}}">Our room</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="{{url('hotel_gallary')}}">Gallery</a>
                              </li>

                              @if (Route::has('login'))
                                 @auth
                              <li class="nav-item">
                                 <a class="nav-link" href="{{url('mybooking')}}">My Booking</a>
                              </li>
                                 @endauth
                              @endif

                              <li class="nav-item">
                                 <a class="nav-link" href="{{url('contact_us')}}">Contact Us</a>
                              </li>
                     </ul>
                  </div>
                  <div class="col-md-4">
                     <ul class="social_icon">
                        <li><a href="https://www.facebook.com/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="https://x.com/"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="https://www.linkedin.com/"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="https://www.youtube.com/"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>