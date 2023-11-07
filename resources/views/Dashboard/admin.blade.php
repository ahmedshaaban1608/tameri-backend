<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Dashboard Admin </title>
  {{-- <link rel="stylesheet" href="style.css"> --}}
  <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  <style>
    
@import url(https://unpkg.com/@webpixels/css@1.1.5/dist/index.css);

/* Bootstrap Icons */
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css");
    </style>
</head>
<!-- bytewebster.com -->
<!-- bytewebster.com -->
<!-- bytewebster.com -->
<body>
<!-- Dashboard -->
<div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
    <!-- Vertical Navbar -->
    <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="navbar-brand py-lg-2 px-lg-6 me-0" href="#">
                   <a class="sidebar-brand brand-logo" href="/"><img src="../../assets/images/logo.png" alt="logo" /></a>
            </a>
            <!-- User menu (mobile) -->
           
           
           
            <!-- Collapse -->
            <div class="collapse navbar-collapse mt-4" id="sidebarCollapse">
                <!-- Navigation -->
                <ul class="navbar-nav">
                  
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('reports.index') }}"> 
                      <i class="bi bi-people"></i> Collection
                          </a>
                      </li>

                 
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('tourguides.index') }}">
                      <i class="bi bi-people"></i> Tourguides
                      </a>
                  </li>


                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('tourists.index') }}">
                      <i class="bi bi-people"></i>Tourists
                      </a>
                  </li>

                
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('users.index') }}">  
                        <i class="bi bi-people"></i> Users
                        </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('reviews.index') }}">  
                        <i class="bi bi-globe-americas"></i> Reviews
                        </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('orders.index') }}">
                          <i class="bi bi-file-text"></i> Orders
                        </a>
                    </li>
                    
                
                    <li class="nav-item">
                      <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                          @csrf 
                          <a href="#" class="nav-link" onclick="document.getElementById('logoutForm').submit()">
                              <i class="bi bi-box-arrow-left"></i>Logout
                          </a>
                      </form>
                  </li>
                  
                </ul>
              
        </div>
    </nav>
    <!-- Main content -->
    <div class="h-screen flex-grow-1 overflow-y-lg-auto">
        <!-- Header -->
        <header class="bg-surface-primary border-bottom py-3">
            <div class="container-fluid">
                <div class="mb-npx">
                    <div class="row align-items-center">
                        <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                            <!-- Title -->
                            <h1 class="h2 mb-0 ls-tight">
                              <a class="sidebar-brand brand-logo text-decoration-none text-danger" href="/">
                               <h2 class="text-danger fw-bold" style="font-weight:bold!important; font-size:25px!important">Tameri Dashboard</h2>
                              </a>
                                                          </div>
                        <!-- Actions -->
                        <div class="col-sm-6 col-12 text-sm-end">
                          
                                  <div class="count-indicator d-flex justify-content-end me-3 align-items-center">
                                 
                                  <span class="count bg-success"></span>
                                  
                                  @if (Auth::check())
                                  <div class="profile-name">
                                  <h5 class="mb-0 font-weight-normal">{{ Auth::user()->name }} ({{Auth::user()->type}})</h5>
                                 
                                  </div>
                                  @else
                                  <div class="profile-name">
                                  <h5 class="mb-0 font-weight-normal"></h5>
                                  </div>
                                  @endif
                                  </div>
                                  <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
            
                    </div>
                   
                    <!-- Nav -->
                    
                </div>
            </div>
        </header>
        <!-- Main -->
        <main class="py-6 bg-surface-secondary">
            <div class="container-fluid">
               
                    <div class="card-footer border-0 py-5">
                        
   <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            @if(isset($reports))
            @include('Report.index')
            @endif
            @if(isset($users))
            @include('User.index')
            @endif
            @if(isset($tourists))
            @include('Tourist.index')
            @endif
            @if(isset($orders))
            @include('Order.index')
            @endif
            @if(isset($reviews))
            @include('Review.index')
            @endif
            @if(isset($tourguides))
            @include('Tourguide.index')
            @endif
            
            </div>
            <!-- content-wrapper ends -->
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <!-- plugins:js -->
  <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  {{-- <script>
    const adminUsersRoute = "{{ route('admin.users') }}";
</script> --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
 
  $(document).ready(function() {
      $('#tourists').on('click', function(e) {
          e.preventDefault();
          $.get("{{ route('tourists.index') }}", function(data) {
              $('#displayContent').html(data);
          });
      });

      $('#users').on('click', function(e) {
  e.preventDefault();
  $.get("{{ route('users.index') }}", function(data) {
      $('#displayContent').html(data);
  });
});
  })
  

</script>

</body>
</html>
</body>
</html>