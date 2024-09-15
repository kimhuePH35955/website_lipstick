@extends('layouts.client')
@section('content')
<!-- Slider -->
<section class="section-slide">
	<div class="wrap-slick1">
		<div class="slick1">
			<div class="item-slick1" style="background-image: url({{asset('template/images/banner-07.jpg')}});">
				<div class="container h-full">
					<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
						<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
							<span class="ltext-101 cl2 respon2">
								Women Collection 2024
							</span>
						</div>
						<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
							<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
								NEW SEASON
							</h2>
						</div>

						<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
							<a href="{{route('shop')}}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
								Shop Now
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="item-slick1" style="background-image: url({{asset('template/images/banner-10.jpg')}});">
				<div class="container h-full">
					<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
						<div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
							<span class="ltext-101 cl2 respon2">
								Men New-Season
							</span>
						</div>

						<div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn" data-delay="800">
							<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
								Jackets & Coats
							</h2>
						</div>

						<div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
							<a href="{{route('shop')}}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
								Shop Now
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="item-slick1" style="background-image: url({{asset('template/images/banner-11.jpg')}});">
				<div class="container h-full">
					<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
						<div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
							<span class="ltext-101 cl2 respon2">
								Men Collection 2024
							</span>
						</div>

						<div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
							<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
								New arrivals
							</h2>
						</div>

						<div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
							<a href="{{route('shop')}}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
								Shop Now
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<br><br>
<section class="bg0 p-t-23 p-b-140">
	<div class="container">
		<div class="p-b-10">
			<h3 class="ltext-103 cl5">
				Tất cả sản phẩm
			</h3>
		</div>
		<br>
		<br>
		<div class="flex-w flex-sb-m p-b-52">
			<div class="flex-w flex-l-m filter-tope-group m-tb-10">
				<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
					All Products
				</button>
				@foreach($category as $category)
				<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".{{$category -> name}}">
					{{$category -> name}}
				</button>
				@endforeach
			</div>

			<div class="flex-w flex-c-m m-tb-10">


				<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
					<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
					<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
					Search
				</div>
			</div>

			<!-- Search product -->
			<div class="dis-none panel-search w-full p-t-10 p-b-15">
				<div class="bor8 dis-flex p-l-15">
					<form action="{{route('home')}}" method="post">
						@csrf
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>
						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search" placeholder="Search">
					</form>

				</div>
			</div>

			<!-- Filter -->

		</div>
		<div class="row isotope-grid">
			@foreach($product as $product)
			@foreach($product->categories as $category)
			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{$category->name}}">
				<div class="block2 card">
					<div class="block2-pic hov-img0">
						<img src="{{ $product->image ? ''.Storage::url($product->image) : '' }}" alt="IMG-PRODUCT">
                        {{-- <img src="{{ Storage::url($product->image) }}" alt="IMG-PRODUCT"> --}}


						<a href="{{ route('product_detail', $product->id) }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
							Mua hàng
						</a>
					</div>

					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l">
							<a href="{{ route('product_detail', $product->id) }}" class="stext-104 cl-gray hov-cl1 trans-04 js-name-b2 p-b-6">
								<h4>{{ $product->name }}</h4>
							</a>
							<div class="stext-105">
								<span class="price">
									Giá bán :
									<del>
										<h6 style="display: inline; margin-right: 10px;">₫1.268.000</h6>
									</del>
									<br>
									<h4 style="display: inline; margin-right: 10px;">₫{{ $product->price}}.000 </h4>
								</span>
								<div class="price-sold cl-gray">
									<span>Đã bán {{ $product->sold }}</span>
								</div>
							</div>
						</div>
						<img class="icon-heart1 dis-block trans-04" src="{{asset('template/images/icons/sale-tag (1).png')}}" alt="ICON" style="margin-top: 55px;">
					</div>
				</div>
			</div>
			@endforeach
			@endforeach
		</div>











		<!-- Load more -->
		<div class="flex-c-m flex-w w-full p-t-45">
			<a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
				Load More
			</a>
		</div>
	</div>
</section>


<!-- Footer -->
@endsection
