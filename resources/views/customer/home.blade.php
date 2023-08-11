@extends('customer.master')

@section('content')
<div class="row my-5 d-flex align-items-center justify-content-center"x>
    <div class="col-6">
        <h1 class="fw-bold">Welcome to <span class="text-success">ZwamnShopping......</span></h1>
        <p class="fw-bold text-secondary mt-3 w-75">ZwamnShopping was created to fill the void in modern footwear. We blend fashion and functionality to create a shoe just as versatile as the people who wear them.</p>
        <div class="">
        <a href="{{url('/products')}}" class="btn btn-warning">See All Products</a>
        @guest()
        <a href="{{url('/register')}}" class="btn btn-info">Sing Up Now</a>
        @else
        <a href="{{url('/orders')}}" class="btn btn-info">Your Orders</a>
        @endguest
        </div>
        <div class="px-4 py-5" style="position: absolute; left:0; bottom:0;">
            <i class="bi bi-facebook me-2 my-2 d-block" style="font-size: 20px;"></i>
            <i class="bi bi-instagram me-2 my-2 d-block" style="font-size: 20px;"></i>
            <i class="bi bi-twitter me-2 my-2 d-block" style="font-size: 20px;"></i>
            <i class="bi bi-whatsapp me-2 my-2 d-block" style="font-size: 20px;"></i>
        </div>
    </div>
    <div class="col-4">
        <img class="w-100" src="https://freepngimg.com/save/112096-converse-black-shoes-free-clipart-hd/512x512" alt="">
    </div>
    
    <!-- <div class="col-12">
        <div id="carouselExampleControls" class="carousel slide w-100" data-bs-ride="carousel">
            <div class="carousel-inner w-100">
                <div class="carousel-item active d-flex">
                <img src="https://i8.amplience.net/s/scvl/127482_319347_SET/1?fmt=auto&$webPdpThumbnail$&$webPlp$" class="d-block" width="13%" alt="...">
                </div>
                <div class="carousel-item">
                <img src="https://i8.amplience.net/s/scvl/150881_325586_SET/1?fmt=auto&$webPdpThumbnail$&$webPlp$" class="d-block" width="13%" alt="...">
                </div>
                <div class="carousel-item">
                <img src="https://i8.amplience.net/s/scvl/146102_313131_SET/1?fmt=auto&$webPdpThumbnail$&$webPlp$" class="d-block" width="13%" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            </div>
        </div> -->
</div>
@endsection