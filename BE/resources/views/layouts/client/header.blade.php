<!-- Header -->
<header>
	<!-- Header desktop -->
	<div class="container-menu-desktop">
		<!-- Topbar -->

		<div class="top-bar">
			<div class="content-topbar flex-sb-m h-full container">
				<li>
					@auth
					<div class="left-top-bar">
						Chào mừng {{ auth()->user()->name }} đã đến với cửa hàng
					</div>
					@endauth
				</li>

				<li>
					@auth
					<div class="right-top-bar flex-w h-full">
						<a href="#" class="flex-c-m p-lr-50 trans-04">
							{{ auth()->user()->email }}
						</a>
						<a href="{{route('logout')}}" class="flex-c-m p-lr-50 trans-04">
							Đăng xuất
						</a>
					</div>
					@endauth
				</li>
			</div>
		</div>
		<div class="wrap-menu-desktop">
			<nav class="limiter-menu-desktop container">

				<!-- Logo desktop -->
				<a href="{{route('home')}}" class="logo">
					<img src="{{asset('template/images/icons/logo-01.png')}}" alt="IMG-LOGO">
				</a>

				<!-- Menu desktop -->
				<div class="menu-desktop">
					<ul class="main-menu">
						<li class="active-menu">
							<a href="{{route('home')}}">Home</a>

						</li>

						<li>
							<a href="{{route('shop')}}">Shop</a>
						</li>


						<li>
							<a href="{{route('blog')}}">Blog</a>
						</li>

						<li>
							<a href="{{route('about')}}">About</a>
						</li>

						<li>
							<a href="{{route('contact')}}">Contact</a>
						</li>
					</ul>
				</div>

				<!-- Icon header -->
				<div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti " data-notify="{{$count}}">
                        <a class="zmdi zmdi-shopping-cart" href="{{route('cart')}}"></a>
                    </div>

                    @auth
                        <a href="{{route('userdetail')}}" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                @if(auth()->user()->image)
                                    <img src="{{ Storage::url(auth()->user()->image) }}" alt="AVATAR">
                                @endif
                            </div>
                        </a>
                    @endauth
                </div>
			</nav>
		</div>
	</div>
</header>
