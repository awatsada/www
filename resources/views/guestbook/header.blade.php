@section("header")
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/guestbook') }}">
                    Guestbook
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/guestbook') }}">Home</a></li>                    
                </ul>

                <ul class="nav navbar-nav" style="padding:12px;">
                  <li>
                    <form class="form-inline" action="search" method="POST">            
                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />  
                      <input type="text" class="form-control pull-left" placeholder="Search" name="search">
                      <button type="submit" class="btn btn-default pull-right"><i class="glyphicon glyphicon-search"></i></button>
                    </form>
                  </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>                        
                    @else
                        <li><a href="{{ url('/guestbook/contact') }}">Contact</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li> 
                    @endif

                </ul>


            </div>
        </div>
    </nav>


<div id="masthead">  
  <div class="container">
    <div class="row">

      <div class="col-md-12" >         
          <div align="center">
            <img src="{{ url('/images/banner.jpg') }}">          
          </div>      
      </div> 
    </div> 
  </div><!-- /cont --> 
</div>

<div class="container">
    <div class="row col-md-12">                                       
        <hr>                          
    </div>
@show