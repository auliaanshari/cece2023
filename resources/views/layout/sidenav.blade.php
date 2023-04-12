@section('sidenav')
    <div class="offcanvas offcanvas-start" id="affanOffcanvas" data-bs-scroll="true" tabindex="-1" aria-labelledby="affanOffcanvsLabel">
      <button class="btn-close btn-close-white text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      <div class="offcanvas-body p-0">
        <!-- Side Nav Wrapper -->
        <div class="sidenav-wrapper">
          <!-- Sidenav Profile -->
          <div class="sidenav-profile bg-gradient">
            <div class="sidenav-style1"></div>
            <!-- User Thumbnail -->
            <div class="user-profile"><img src="{{ asset('img/bg-img/2.jpg') }}" alt=""></div>
            <!-- User Info -->
            <div class="user-info">
              <h6 class="user-name mb-0">IRAMA MUSLIM</h6><span>Bulakan, Tanjuang Gadang</span>
            </div>
          </div>
          <!-- Sidenav Nav -->
          <ul class="sidenav-nav ps-0">
            <li><a href="{{ url('/') }}"><i class="bi bi-house-door"></i>Home</a></li>
            <li><a href="{{ url('/play') }}"><i class="bi bi-play"></i>Play</a></li>
            <li><a href="{{ url('/game') }}"><i class="bi bi-collection"></i>Game</a></li>
            <li><a href="{{ url('/team') }}"><i class="bi bi-people"></i>Kelompok</a></li>
            <li><a href="{{ url('/soal') }}"><i class="bi bi-folder2-open"></i>Soal</a></li>
            <li><a href="{{ url('/play/tanding') }}"><i class="bi bi-calendar4-week"></i>Pertandingan</a></li>
            <li>
              <div class="night-mode-nav"><i class="bi bi-moon"></i>Night Mode
                <div class="form-check form-switch">
                  <input class="form-check-input form-check-success" id="darkSwitch" type="checkbox">
                </div>
              </div>
            </li>
            <li><a href="page-login.html"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
          </ul>
          <!-- Social Info -->
          <div class="social-info-wrap"><a href="#"><i class="bi bi-facebook"></i></a><a href="#"><i class="bi bi-twitter"></i></a><a href="#"><i class="bi bi-linkedin"></i></a></div>
          <!-- Copyright Info -->
          <div class="copyright-info">
            <p>2021 &copy; Made by<a href="#">Radar Bulakan</a></p>
          </div>
        </div>
      </div>
    </div>
@endsection