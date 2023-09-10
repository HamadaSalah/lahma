  <!--   Core JS Files   -->
  <script src="{{asset('dashboard/assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('dashboard/assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('dashboard/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('dashboard/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script>

  </script>
  <script src="{{asset('dashboard/assets/js/plugins/chartjs.min.js')}}"></script>
  <script src="{{asset('dashboard/assets/js/plugins/swiper-bundle.min.js')}}" type="text/javascript"></script>
  <script>

  </script>
  <script>
      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
          var options = {
              damping: '0.5'
          }
          Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }

  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js')}}"></script>
  <!-- Control Center for Corporate UI Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('dashboard/assets/js/corporate-ui-dashboard.min.js?v=1.0.0')}}"></script>
  <script src="{{asset('dashboard/assets/js/jquery-1.11.1.min.js')}}"></script>
  @stack('scripts')
  <script>
      $(document).ready(function() {
          $('#iconNavbarSidenav').clickToggle(function () {
                  $('.navbar-vertical.navbar-expand-xs.fixed-end').css({
                      right: "270px"
                  }, 1500);
              },
              function () {
                  $('.navbar-vertical.navbar-expand-xs.fixed-end').css({
                    right: "30px"
                  }, 1500);
              });
      });

  </script>
  @stack('scripts')
  </body>

  </html>
