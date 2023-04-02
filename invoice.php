<?php
include 'views/header.php';

$invoices = new Invoice;
$invoice = $invoices->getInvoice($_GET['invoice_id']);
if ($invoice == false)	header('Location: ./');

?>
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="breadcrumb_content">
					<ul>
						<li><a href="index.html">Trang chủ</a></li>
						<li>Chi tiết đơn hàng</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!--breadcrumbs area end-->

<!--shopping cart area start -->
<div class="shopping_cart_area mt-60">
	<div class="container">
		<form action="#">
			<div class="checkout_form">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<h3>Thông tin người nhận</h3>
						<div class="row">
							<div class="col-lg-4 mb-20">
								<label>Họ tên</label>
								<input type="text" name="user_fullname" value="<?php echo $invoice['invoice_user_fullname']; ?>" disabled />
							</div>
							<div class="col-lg-4 mb-20">
								<label>SĐT</label>
								<input type="text" name="user_phone_number" value="<?php echo $invoice['invoice_user_phone_number']; ?>" pattern="(84|0[3|5|7|8|9])+([0-9]{8})" disabled />
							</div>
							<div class="col-lg-4 mb-20">
								<label>Email</label>
								<input type="email" name="user_email" value="<?php echo $invoice['invoice_user_email']; ?>" disabled />
							</div>
							<div class="col-8 mb-20">
								<label>Địa chỉ giao hàng</label>
								<input type="text" name="user_address" value="<?php echo $invoice['invoice_user_address']; ?>" disabled />
							</div>
							<div class="col-4 mb-20">
								<label>Số ngày thuê tối đa</label>
								<input type="number" name="invoice_num_rental_days" value="<?php echo $invoice['invoice_num_rental_days']; ?>" min="3" max="10" disabled />
							</div>
							<div class="col-12">
								<div class="order-notes">
									<label for="order_note">Ghi chú đơn hàng</label>
									<textarea id="order_note" name="order_note" style="height: 100px;" disabled><?php echo $invoice['invoice_note']; ?></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="table_desc">
						<div class="cart_page table-responsive">
							<table>
								<thead>
									<tr>
										<th class="product_thumb">Ảnh sản phẩm</th>
										<th class="product_name">Tên sản phẩm</th>
										<th class="product-price">Đơn giá</th>
										<th class="product_quantity">Số lượng</th>
										<th class="product_total">Số tiền</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($invoices->getInvoiceDetails($_GET['invoice_id']) as $k => $v) {
										$product_id = $v['product_id'];
										$product_img = explode('|', $v['product_img'])[0];
										echo '<tr id="product_' . $product_id . '">
												<td class="product_thumb"><a target="_blank" href="product-details.html?product_id=' . $product_id . '"><img src="' . $product_img . '" alt="" /></a></td>
												<td class="product_name"><a target="_blank" href="product-details.html?product_id=' . $product_id . '">' . $v['product_name'] . '</a></td>
												<td class="product-price product_price" id="product_price_' . $product_id . '">' . number_format($v['invd_product_rental_price'], 0, ',', '.') . 'đ</td>
												<td class="product_quantity">' . $v['invd_product_quantity'] . '</td>
												<td class="product_total">' . number_format(($v['invd_product_quantity'] * $v['invd_product_rental_price']), 0, ',', '.') . 'đ</td>
											</tr>';
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!--coupon code area start-->
			<div class="coupon_area">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<?php if ($invoice['invoice_status_id'] == 2) { ?>
							<div class="coupon_code left">
								<h3>CÁCH THANH TOÁN</h3>
								<div class="coupon_inner">
									<p>Chuyển khoản vào một trong những kênh <b>ví điện tử hoặc ngân hàng</b> bên dưới với nội dung: <b>WIBUSHOP INV<?php echo $invoice['invoice_id']; ?></b></p>
									<p>Shop sẽ kiểm tra trong ngày cho bạn. Nếu có trục trặc shop sẽ liên hệ qua số điện thoại trên tài khoản/đơn hàng để giải quyết.</p>
									<div class="cart_page table-responsive" style="overflow-x: hidden;">
										<table style="width: 100%;">
											<thead>
												<tr>
													<th>Kênh thanh toán</th>
													<th>Số điện thoại / Số tài khoản</th>
													<th>Quét mã</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><b>MOMO</b></td>
													<td>0358 125 xxx</td>
													<td><img src="assets/payment/momo.jpg" alt=""></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="coupon_code right">
							<h3>Tổng giỏ hàng</h3>
							<div class="coupon_inner">
								<div class="cart_subtotal">
									<p>Số tiền</p>
									<p class="cart_amount"><?php echo number_format($invoice['invoice_subtotal'], 0, ',', '.'); ?>đ</p>
								</div>
								<div class="cart_subtotal">
									<p>Phí vận chuyển</p>
									<p class="cart_amount"><?php echo number_format($invoice['invoice_fee_transport'], 0, ',', '.'); ?>đ</p>
								</div>
								<div class="cart_subtotal">
									<p>Phí đảm bảo tài sản</p>
									<p class="cart_amount"><?php echo number_format($invoice['invoice_fee_bond'], 0, ',', '.'); ?>đ</p>
								</div>
								<a target="_blank" href="faq.html">Ấn vào đây để xem Câu hỏi thường gặp!</a>
								<div class="cart_subtotal">
									<p>Tổng cộng</p>
									<p class="cart_amount" id="cart_subtotal"><?php echo number_format(($invoice['invoice_subtotal'] + $invoice['invoice_fee_transport'] + $invoice['invoice_fee_bond']), 0, ',', '.'); ?>đ</p>
								</div>
								<div class="cart_subtotal">
									<p>Trạng thái đơn hàng</p>
									<p class="cart_amount"><?php echo $invoice['invoice_status_name']; ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--coupon code area end-->
		</form>
	</div>
</div>
<!--shopping cart area end -->
<?php
include 'views/footer.php';
?>