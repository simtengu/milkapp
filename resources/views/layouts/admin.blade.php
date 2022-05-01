<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Mbeya milk</title>
        <link type="text/css" href="{{ asset('admin/css/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/bootstrap.min.css') }}" rel="styleSheet" />
        <link href="{{ asset('/css/app.css') }}" rel="styleSheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;

}
        </style>
    </head> 
    <body class="sb-nav-fixed">
        <div style="z-index: 1051" id="loader_container">
            <div style="z-index: 1051" id="page_loader">
                    <div id="spinner" class="spinner-border text-primary"></div>
            </div>
        </div>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
           <div style="display:inline-block; padding: 0px;"> 
               <a style="margin: 0px; color:#5734a1;text-shadow: 1px  1px black;font-weight:bold;" class="navbar-brand" href="{{ route('dashboard') }}"><span class="text-light">Mbeya</span>Milk</a>
               <div style="position: relative;bottom:4px;left:2px" class="d-flex ml-4 mb-2">
                   <div class="primary-bg" style="height: 3px;width:37px;"></div>
                   <div class="bg-app" style="height: 3px;width:37px;"></div>
               </div>
            </div> 
            <button style="position: relative; right: 9px" class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"> <img src="{{ asset('images') }}/toggler4.png"></button>
            <!-- Navbar Search-->
            <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

            </div>
            
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img width="45" src="{{ asset('images') }}/user1.png"></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                       @if (Auth::user()->isAdmin())
                           <a class="dropdown-item" href="{{ route('edit_details') }}">Edit your details</a>
                       @endif  
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
                          @auth
                          
                            <a  class="nav-link text-uppercase" href="{{ route('dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                           
                            <a  class="nav-link text-capitalize" href="{{ route('income.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa fa-wallet"></i></div>
                                Incomes
                            </a>
                            <a  class="nav-link text-capitalize" href="{{ route('expense.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa fa-wallet"></i></div>
                                Expenses
                            </a>
                            <a  class="nav-link text-capitalize" href="{{ route('production') }}">
                                <div class="sb-nav-link-icon"><i class="fa fa-wallet"></i></div>
                                Production
                            </a>
                            <a  class="nav-link text-capitalize" href="{{ route('stock.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa fa-wallet"></i></div>
                                Stock
                            </a>                 
                         @endauth

                            @auth
                             @if(Auth::user()->isAdmin())
                            <a  class="nav-link text-capitalize" href="{{ route('edit_info') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>
                                Edit information
                            </a>

                            <a  class="nav-link text-capitalize" href="{{route('new_user')  }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Add user
                            </a>
                            
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Reports
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class=" text-light" href="{{ route('general.report') }}" >
                                        Income&cost reports
                                    </a>
                                    <a class="text-light " href="{{ route('print_reports') }}" >
                                        Print Income&cost reports
                                    </a>
                                    <a class="text-light " href="{{ route('production.today_report') }}" >
                                        production reports
                                    </a>

                                    <a class="text-light " href="{{ route('production.index') }}" >
                                        Achievement reports
                                    </a>
                             
                                    
                                </nav>
                            </div>
                             @endif
                            @endauth

                        </div>
                    </div>
                    @auth                      
                    <div class="sb-sidenav-footer">
                        <div style="text-shadow: 1px 1px black" class="small text-lead font-16 text-app">Logged in as:</div>
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
                            <div class="text-info">Copyright &copy; Mbeya Milk</div>
                            <div>
                                <span class="text-muted">By </span><a href="#" class="text-muted">albertsimtengu@gmail.com</a>
                                 
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
