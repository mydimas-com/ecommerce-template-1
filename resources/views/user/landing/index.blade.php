@extends('user.layouts.app')
@section('menu-home', 'active')

@push('js')
@endpush

@push('css')
	<style>
		.thumbnail{
			height: 271px;
			object-fit: cover;
		}
		.image-category{
			height:195px;
			object-fit: cover;
		}
		.carousel-item img {
			height: 300px;
			object-fit: cover;
		}
		.carousel-inner{
			border-radius:10px;
		}
	</style>
@endpush

@section('content')
	<section class="banner-area">
		<div class="container">
			<div class="row fullscreen align-items-center justify-content-start">
				<div class="col-lg-12">
					<div class="active-banner-slider owl-carousel">
						<!-- single-slide -->
						<div class="row single-slide align-items-center d-flex">
							<div class="col-lg-5 col-md-6">
								<div class="banner-content">
									<h1>Nike New <br>Collection!</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
										dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
									<div class="add-bag d-flex align-items-center">
										<a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
										<span class="add-text text-uppercase">Add to Bag</span>
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="banner-img">
									<img class="img-fluid" src="img/banner/banner-img.png" alt="">
								</div>
							</div>
						</div>
						<!-- single-slide -->
						<div class="row single-slide">
							<div class="col-lg-5">
								<div class="banner-content">
									<h1>Nike New <br>Collection!</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
										dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
									<div class="add-bag d-flex align-items-center">
										<a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
										<span class="add-text text-uppercase">Add to Bag</span>
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="banner-img">
									<img class="img-fluid" src="img/banner/banner-img.png" alt="">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="features-area section_gap">
		<div class="container">
			<div class="row features-inner">
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon1.png" alt="">
						</div>
						<h6>Free Delivery</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon2.png" alt="">
						</div>
						<h6>Return Policy</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon3.png" alt="">
						</div>
						<h6>24/7 Support</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon4.png" alt="">
						</div>
						<h6>Secure Payment</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="category-area">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 text-center">
					<div class="section-title">
						<h1>Kategori</h1>
						<p>Kategori pilihan untuk Anda.</p>
					</div>
				</div>
			</div>
			<div class="justify-content-center">
				<div class="row">
					@forelse($categories as $category)
						<div class="col-lg-3 col-md-4">
							<div class="single-deal">
								<div class="overlay"></div>
								<img class="img-fluid w-100 image-category" src="{{ !empty($category->image) ? asset('storage/uploads/images/product-category/'.$category->image) : asset('img/default-img.png') }}" alt="">
								<a href="#">
									<div class="deal-details">
										<h6 class="deal-title">{{$category->name}}</h6>
									</div>
								</a>
							</div>
						</div>
					@empty
						<div class="col-12 py-5 mb-3 text-center">
							<h4>Tidak ada data!</h4>
						</div>
					@endforelse
				</div>
			</div>
			<div class="row justify-content-center mb-5">
				<a href="#" class="genric-btn primary circle">Selengkapnya</a>
			</div>
		</div>
	</section>

	<section class="py-5">
		<div class="container">
			<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					@forelse($bannerPromo as $key => $banner)
					<div class="carousel-item {{$key == '0' ? 'active' : ''}}" data-interval="3000">
						<a href="{{$banner->url}}" target="_blank">
							<img src="{{ asset('storage/uploads/images/banner-promo/'.$banner->image) }}" class="d-block w-100" alt="...">
						</a>
					</div>
					@empty
					<div class="carousel-item active">
						<img src="{{asset('img/default-banner.jpg')}}" class="d-block w-100" alt="...">
					</div>
					@endforelse
				</div>
				<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>

	</section>
	
	<section class="mt-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 text-center">
					<div class="section-title">
						<h1>Produk Pilihan</h1>
						<p>Produk pilihan terbaik untuk Anda.</p>
					</div>
				</div>
			</div>
			<div class="row">
				@forelse($products as $product)
				<div class="col-lg-3 col-md-6">
					<div class="single-product shadow rounded">
						<a href="{{route('product.show', [$product['slug'], $selectedStore, $product['uuid']])}}">
						@if( !$product->images->isEmpty())
							<img class="img-fluid rounded-top mb-0 thumbnail" src="{{ !empty($product->images[0]->url) ? asset('storage/uploads/images/product/'.$product->images[0]->url) : asset('img/default-img.png') }}" alt="">
						@else
							<img class="img-fluid rounded-top mb-0 thumbnail" src="{{ asset('img/default-img.png') }}" alt="">
						@endif
						<div class="product-details p-3">
							
							<h6>{{$product['name']}}</h6>
							<div class="price">
								<h6>@currency($product['price'])</h6>
								<!-- diskon
								<h6 class="l-through">$210.00</h6> -->
							</div>
						</div>

						</a>

					</div>
				</div>
				@empty
				<div class="col-12 py-5 mb-3 text-center">
					<h4>Tidak ada data!</h4>
				</div>
				@endforelse
			</div>

			<div class="row justify-content-center mb-5">
				<a href="{{route('products.all')}}" class="genric-btn primary circle">Selengkapnya</a>
			</div>
		</div>
	</section>

	<section class="brand-area section_gap">
		<div class="container">
			<div class="row">
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/brand/1.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/brand/2.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/brand/3.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/brand/4.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/brand/5.png" alt="">
				</a>
			</div>
		</div>
	</section>
@endsection