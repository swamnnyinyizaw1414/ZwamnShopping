<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>  

<section>

<!--start nav -->
<nav class="navbar navbar-expand-lg bg-light shadow">
  <div class="container-fluid d-flex justify-content-between my-2">
    <a class="navbar-bran mx-3 text-decoration-none text-danger" href="#"><h3>ZwamnShopping</h3></a>
    <div class="mx-3">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" href="{{url('/products')}}">Products</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{url('/carts')}}">Cart</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Order</a>
            </li>
            @guest
            <li class="nav-item">
            <a class="nav-link" href="{{url('/register')}}">Register</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{url('/login')}}">Login</a>
            </li>
            @endguest
            @auth
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{Auth::user()->name}}
                </a>
                <ul class="dropdown-menu">
                    <li class="dropdown-item">
                        <form action="{{url('/logout')}}" method="post">
                            @csrf
                            <button onclick="return confirm('Are you sure you want to logout?')" class="btn btn-danger" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
                </li>
                @if(Auth::user()->role=='1')
                <li class="nav-item">
                <a class="nav-link btn text-light bg-primary" href="{{url('/dashboard')}}">Dashboard</a>
                </li>
                @endif
            @endauth
            
        </ul>
        </div>
    </div>
  </div>
</nav>
<!-- end nav -->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @yield('content')
        </div>
    </div>
</div>

</section>

</body>
</html>