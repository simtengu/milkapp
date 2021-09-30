<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Chuobusiness admin</title>
        <link type="text/css" href="{{ asset('admin/css/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/bootstrap.min.css') }}" rel="styleSheet" />
        <link href="{{ asset('/css/app.css') }}" rel="styleSheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style type="text/css">
            
            .text-arial {
                font-family: arial narrow;
            }
            .text-times {
                font-family: times new roman;
            }
            .font-15 {
                font-size: 15px;
            }

            .font-16 {
              font-size: 16px;
            }

            .font-17 {
              font-size: 16px;
            }

            .font-18 {
              font-size: 16px;
            }

            #adminProductLink:hover {
                text-decoration: none;
                
            }
            #delete-form {
                position: fixed;
                top: 10%;
                left: 50%;
                z-index: 10;
                box-shadow: 3px 3px 180px black;
                padding: 12px;
                background-color: #7ad9f1;
                display: none;
            }
           #userProductsDiv .link {
            text-decoration: none;
            color: black;
           }
           #userProductsDiv .media:hover {
              box-shadow:  2px 2px 4px black;
           }
        </style>
    </head> 
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route('dashboard') }}">MilkApp</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"> <img src="{{ asset('images') }}/toggler4.png"></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                @csrf
                 <input type="hidden" id="user_search_path" value="{{ url('/admin_email_fetch') }}" >
                <div style="position: relative;" class="input-group">
                    <input id="user_search_field" class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                     
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                     <ul id="search_results_ul" style="position: absolute;left: 0px;top:42px; z-index:110; width: 100%;" class="list-group">
                      
                     </ul>
                </div>
            </form>
            
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img width="45" src="{{ asset('images') }}/user.png"></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Home</a>
                        <a class="dropdown-item" href="#">Activity Log</a>
                        <a class="dropdown-item" href="#"
			                     onclick="event.preventDefault();
			                    document.getElementById('logout-form').submit();">logout </a>  
			                  <form class="d-none" id="logout-form" method="POST" action="{{ route('signout') }}">
			                    @csrf 
			                  </form> 
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a  class="nav-link text-uppercase" href="{{ route('dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a  class="nav-link text-capitalize" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Incomes
                            </a>
                            <a  class="nav-link text-capitalize" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Consumptions
                            </a>
                            @auth
                             @if(Auth::user()->isAdmin())

                           
                                
                            <a  class="nav-link text-capitalize" href="{{route('new_user')  }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Add user
                            </a>
                            
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Reports
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class=" text-light" href="#" >
                                        income reports
                                    </a>
                                    <a class="text-light " href="#" >
                                        consumption reports
                                    </a>
                                    <a class="text-light " href="#" >
                                        Reported posts
                                    </a>
                                    
                                </nav>
                            </div>
                             @endif
                            @endauth
                      
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>

                        </div>
                    </div>
                    @auth                      
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                         {{ Auth::user()->name }}
                    </div>
                    @endauth
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                 @yield('content')
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="{{ asset('admin/js/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('admin/js/scripts.js') }}" type="text/javascript"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> --}}
        @yield('scripts')
       
    </body>
</html>
