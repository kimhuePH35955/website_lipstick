@extends('layouts.client')
@section('content')
<br><br><br>
<!-- breadcrumb -->
<div class="container">
	<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
		<a href="{{route('home')}}" class="stext-109 cl8 hov-cl1 trans-04">
			Home
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<a href="product.html" class="stext-109 cl8 hov-cl1 trans-04">
			{{$shopdetail->name}}
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<span class="stext-109 cl4">
			Lightweight Jacket
		</span>
	</div>
</div>


<!-- Product Detail -->
<section class="sec-product-detail bg0 p-t-65 p-b-60">
	<div class="container">
		<form action="{{route('cart.store')}}" method="POST">
			@csrf
			<input type="hidden" name="product_id" value="{{$shopdetail->id}}">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
							<div class="slick3 gallery-lb">
								<div class="item-slick3" data-thumb="{{ $shopdetail->image?''.Storage::url($shopdetail->image):''}}">
									<div class="wrap-pic-w pos-relative">
										<img src="{{ $shopdetail->image?''.Storage::url($shopdetail->image):''}}" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ $shopdetail->image?''.Storage::url($shopdetail->image):''}}">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
								<div class="item-slick3" data-thumb="{{asset('template/images/test4.jpg')}}">
									<div class="wrap-pic-w pos-relative">
										<img src="{{asset('template/images/test4.jpg')}}" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{asset('template/images/test1.jpg')}}">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>

								<div class="item-slick3" data-thumb="{{asset('template/images/test5.jpg')}}">
									<div class="wrap-pic-w pos-relative">
										<img src="{{asset('template/images/test5.jpg')}}" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{asset('template/images/test2.jpg')}}">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h1>
							{{$shopdetail->name}}
						</h1>
						<br>

						<h2 class="text-danger">
							₫{{$shopdetail->price}}.000
						</h2>

						<p class="stext-102 cl3 p-t-23">
							<strong>{{$shopdetail->quantity}}</strong> sản phẩm còn có sẵn
						</p>
						<br>
						<p class="stext-102 cl3 p-t-23">
						<h5><strong>Mô tả:</strong> {{$shopdetail->description}}</h5>
						</p>
						<br>



						<!--  -->
						<div class="p-t-33">


							<div class="flex-w flex-r-m p-b-10">
								<h5><strong>Số lượng :</strong> </h5>
								<div class="size-204 flex-w flex-m respon6-next">

									<div class="wrap-num-product flex-w m-r-20 m-tb-10">
										<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-minus"></i>
										</div>

										<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

										<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>
									</div>

									<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
										Thêm vào giỏ hàng
									</button>
								</div>
							</div>
						</div>

						<!--  -->
						<div class="flex-w flex-m p-l-100 p-t-40 respon7">
							<div class="flex-m bor9 p-r-10 m-r-11">
								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
									<i class="zmdi zmdi-favorite"></i>
								</a>
							</div>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
								<i class="fa fa-facebook"></i>
							</a>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
								<i class="fa fa-twitter"></i>
							</a>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
								<i class="fa fa-google-plus"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</form>
		<div class="bor10 m-t-50 p-t-43 p-b-40">
			<!-- Tab01 -->
			<div class="tab01">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">




					<li class="nav-item p-b-10">
						<a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Bình luận</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content p-t-43">



					<!-- - -->
					<div class="tab-pane fade" id="reviews" role="tabpanel">
						<div class="row">
							<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
								<div class="p-b-30 m-lr-15-sm">
									<!-- Review -->
									@foreach($feedback as $feedbackItem)
    @if (optional($feedbackItem->users)->image)
        <div class="flex-w flex-t p-b-68">
            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                <img src="{{ Storage::url(optional($feedbackItem->users)->image) }}" alt="AVATAR">
            </div>
            <div class="size-207">
                <div class="flex-w flex-sb-m p-b-17">
                    <span class="mtext-107 cl2 p-r-20">{{ optional($feedbackItem->users)->name }}</span>
                </div>
                <p class="stext-102 cl6">{{ $feedbackItem->content }}</p>
            </div>
        </div>
    @endif
@endforeach

									<!-- Add review -->

									<h5 class="mtext-108 cl2 p-b-7">
										Đánh giá sản phẩm
									</h5>


									<form class="w-full" method="post" action="{{route('feedback.store')}}" enctype="multipart/form-data">
										@csrf
										<div class="row p-b-25">
											<div class="col-12 p-b-5">
												<input type="hidden" value="{{$shopdetail->id}}" name="product_id">
												<input class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="content"></input>
											</div>


										</div>

										<button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
											Submit
										</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
		<span class="stext-107 cl6 p-lr-25">
			SKU: JAK-01
		</span>

		<span class="stext-107 cl6 p-lr-25">
			Categories: Jacket, Men
		</span>
	</div>
</section>


<!-- Related Products -->

@endsection
