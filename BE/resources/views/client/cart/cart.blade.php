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

		<span class="stext-109 cl4">
			Shoping Cart
		</span>
	</div>
</div>

<hr>
@if ($errors->any())
<div class="alert alert-danger">
	@foreach ($errors->all() as $error)
	<li>{{ $error }}</li>
	@endforeach
</div>
@endif
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush
<!-- Shoping Cart -->
<form class="bg0 p-t-75 p-b-85" action="{{route('cart.update')}}" method="POST">
	<div class="container">
		<div class="row">
			@csrf
			<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
				<div class="m-l-25 m-r--38 m-lr-0-xl">
					<div class="wrap-table-shopping-cart">
						<table class="table-shopping-cart">
							<tr class="table_head">
								<th class="column-1">Sản phẩm</th>
								<th class="column-2"></th>
								<th class="column-3">Giá</th>
								<th class="column-4">Số lượng</th>
								<th class="column-5">Tổng tiền</th>
								<th class="column-6">Trạng thái</th>
							</tr>
							@foreach ($cart as $cartItem)
							<tr class="table_row" data-product-id="{{ $cartItem->product->id }}">
								<td class="column-1">
									<div class="how-itemcart1">
										<img src="{{ $cartItem->product->image ? Storage::url($cartItem->product->image) : '' }}" alt="IMG">
									</div>
								</td>
								<td><a class="column-3" href="{{ route('product_detail', $cartItem->product->id) }}">{{ $cartItem->product->name }}</a></td>
								<td class="column-3" id="price_{{ $cartItem->product->id }}">{{ $cartItem->product->price }}</td>
								<td class="column-4">
									<div class="wrap-num-product flex-w m-l-auto m-r-0">
										<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m decrease-btn">
											<i class="fs-16 zmdi zmdi-minus"></i>
										</div>

										<input class="mtext-104 cl3 txt-center num-product quantity-input" type="number" name="num-product[{{ $cartItem->product->id }}]" value="{{ $cartItem->quantity }}" data-product-id="{{ $cartItem->product->id }}" class="quantity-input" min=1>

										<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m increase-btn">
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>

									</div>
								</td>
								<td class="column-5 total" id="total_item_{{ $cartItem->product->id }}">{{ $cartItem->quantity * $cartItem->product->price }}</td>
								<td class="column-6"><a href="{{route('cart.destroy',$cartItem->id)}}">Xóa</a></td>
							</tr>
							@endforeach

						</table>
					</div>

					<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
						<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
							<a href="{{route('home')}}" class="text-dark">Mua thêm</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-10 col-lg-8 col-xl-5 m-lr-auto m-b-50">
				<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
					<h4 class="mtext-109 cl2 p-b-30">
						Cart Totals
					</h4>
					<div class="flex-w flex-t bor12 p-t-15 p-b-30">
						<div class="size-208 w-full-ssm">
							<span class="stext-110 cl2">
								Họ và tên:
							</span>
							<span><input type="text" placeholder=" Nhập họ và tên" name="name"></span>
						</div>
					</div>
					<div class="flex-w flex-t bor12 p-t-15 p-b-30">
						<div class="size-208 w-full-ssm">
							<span class="stext-110 cl2">
								Số điện thoại
							</span>
							<span><input type="text" placeholder=" Nhập số điện thoại" name="phone"></span>
						</div>
					</div>
					<div class="flex-w flex-t bor12 p-t-15 p-b-30">
						<div class="size-208 w-full-ssm">
							<span class="stext-110 cl2">
								Email
							</span>
							<span><input type="email" placeholder=" Nhập email" name="email"></span>
						</div>
					</div>
					<div class="flex-w flex-t bor12 p-t-15 p-b-30">
						<div class="size-208 w-full-ssm">
							<span class="stext-110 cl2">
								Địa chỉ
							</span>
							<span><input type="text" placeholder=" Nhập địa chỉ" name="address"></span>
						</div>
					</div>
					<div class="flex-w flex-t bor12 p-t-15 p-b-30">
						<div class="size-208 w-full-ssm">
							<span class="stext-110 cl2">
								Ghi chú
							</span>
							<span><input type="text" placeholder=" Nhập ghi chú" name="note"></span>
						</div>
					</div>
					<div class="flex-w flex-t p-t-27 p-b-33">
						<div class="size-208">
							<span class="mtext-101 cl2">
								Total:
							</span>
						</div>

						<div class="size-209 p-t-1">
							<span class="mtext-110 cl2" id="total">0</span>
						</div>
					</div>
					<a id="proceedToCheckout" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer text-white">
						Proceed to Checkout
					</a>
					<!-- <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
						Proceed to Checkout
					</button> -->
				</div>
			</div>
		</div>
	</div>
</form>
@endsection
@push('scripts')
<!-- Đảm bảo bạn đã bao gồm thư viện jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
	$(document).ready(function() {
		// Lắng nghe sự kiện thay đổi giá trị của input số
		$('.quantity-input').on('change', function() {
			updateCartItemTotal($(this)); // Gọi hàm cập nhật tổng giá trị cho sản phẩm cụ thể
			updateTotal(); // Gọi hàm cập nhật tổng giá trị chung
		});

		// Hàm cập nhật tổng giá trị cho sản phẩm cụ thể
		function updateCartItemTotal(input) {
			var quantity = parseInt(input.val());
			var productId = input.data('product-id');
			var price = parseFloat($('#price_' + productId).text());
			var subtotal = quantity * price;

			// Cập nhật tổng giá trị cho sản phẩm cụ thể
			$('#total_item_' + productId);
		}

		// Hàm cập nhật tổng giá trị chung
		function updateTotal() {
			var total = 0;

			// Lặp qua mỗi sản phẩm trong giỏ hàng
			$('.table_row').each(function() {
				var subtotal = parseFloat($(this).find('.total').text().replace('$', ''));
				total += subtotal;
			});

			// Cập nhật tổng giá trị chung
			$('#total').text(total.toFixed(2) + ' Vnđ');
		}

		// Gọi hàm cập nhật tổng giá trị khi trang tải
		updateTotal();
	});
</script>
<script>
	$(document).ready(function() {
		$('#proceedToCheckout').on('click', function() {
			// Lấy dữ liệu từ các trường input
			var name = $('input[name="name"]').val();
			var phone = $('input[name="phone"]').val();
			var email = $('input[name="email"]').val();
			var address = $('input[name="address"]').val();
			var note = $('input[name="note"]').val();
			var total = $('#total').text();
			var orderDetails = [];

			$('.table_row').each(function() {
				var productId = $(this).data('product-id');
				var quantity = $(this).find('.quantity-input').val();
				var subtotal = $(this).find('.total').text();

				// Tạo object chứa thông tin của mỗi sản phẩm
				var productInfo = {
					product_id: productId,
					quantity: quantity,
					subtotal: subtotal
				};

				// Thêm object vào mảng orderDetails
				orderDetails.push(productInfo);
			});
			// Gửi dữ liệu đến server bằng AJAX
			$.ajax({
				type: 'POST',
				url: '{{ route("order.store") }}', // Thay đổi đường dẫn tương ứng với route của bạn
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {
					_token: $('meta[name="csrf-token"]').attr('content'),
					name: name,
					phone: phone,
					email: email,
					address: address,
					note: note,
					total: total,
					orderDetails: orderDetails
				},
				success: function(response) {
					// Xử lý khi request thành công (nếu cần)
					console.log(response);
					location.reload();
				},
				error: function(error) {
					toastr.error('Đặt hàng không thành công!');
					console.log(error);
				}
			});
		});
	});
</script>
<script>
	$(document).ready(function() {
		// Initialize the overall total
		var overallTotal = 0;

		// Listen for changes in the quantity input
		$('.quantity-input').on('input', function() {
			updateTotal($(this));
		});

		// Listen for clicks on the decrease button
		$('.decrease-btn').on('click', function() {
			var input = $(this).closest('tr').find('.quantity-input');
			var currentQuantity = parseInt(input.val());

			if (currentQuantity > 1) {
				input.val(currentQuantity);
			}

			// Update the total after changing the quantity
			updateTotal(input);
		});

		// Listen for clicks on the increase button
		$('.increase-btn').on('click', function() {
			var input = $(this).closest('tr').find('.quantity-input');
			var currentQuantity = parseInt(input.val());

			input.val(currentQuantity);

			// Update the total after changing the quantity
			updateTotal(input);
		});

		// Function to update the total based on quantity
		function updateTotal(input) {
			var productId = input.data('product-id');
			var quantity = input.val();
			var price = parseFloat($('#price_' + productId).text());
			var total = quantity * price;

			// Update the total for the specific product
			$('#total_item_' + productId).text(total);

			// Update the overall total
			overallTotal = calculateOverallTotal();
			$('#total').text(overallTotal);
		}

		// Function to calculate the overall total
		function calculateOverallTotal() {
			var total = 0;
			$('.total').each(function() {
				total += parseFloat($(this).text());
			});
			return total;
		}
	});
</script>
@endpush