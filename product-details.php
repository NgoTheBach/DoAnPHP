<?php
include 'views/header.php';

$products = new Products();
$product = $products->getProductById($_GET['product_id']);
if ($product == false) echo '<script>location.replace("products.html");</script>';
$product_rental_price = number_format($product['product_rental_price'], 0, ',', '.');
$product_imgs = explode('|', $product['product_img']);
// var_dump($product_imgs);
// $product_img = $product_imgs[0];
?>
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="breadcrumb_content">
					<ul>
						<li><a href="index.html">Trang chủ</a></li>
						<li>Chi tiết sản phẩm</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!--breadcrumbs area end-->

<!--product details start-->
<div class="product_details mt-60 mb-60">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="product-details-tab">
					<div id="img-1" class="zoomWrapper single-zoom">
						<a href="#">
							<img id="zoom1" src="<?php echo $product_imgs[0]; ?>" data-zoom-image="<?php echo $product_imgs[0]; ?>" alt="big-1">
						</a>
					</div>
					<div class="single-zoom-thumb">
						<ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
							<?php
							foreach ($product_imgs as $k => $v) {
								echo '<li><a href="javascript:void();" class="elevatezoom-gallery active" data-update="" data-image="' . $v . '" data-zoom-image="' . $v . '">
										<img src="' . $v . '" alt="zo-th-1" />
									</a></li>';
							}
							?>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="product_d_right">
					<form onsubmit="return false">
						<h1><?php echo $product['product_name']; ?></h1>
						<div class="price_box">
							<span class="current_price"><?php echo $product_rental_price; ?>đ</span>
							<!-- <span class="old_price">$80.00</span> -->
						</div>
						<div class="product_variant quantity">
							<?php if ($product['product_quantity'] > 0) { ?>
								<label>Số lượng</label>
								<input min="1" max="100" value="1" type="number" id="product_quantity" /><br />
								<button class="button" onclick="add_to_cart_(<?php echo $product['product_id']; ?>);">Thêm vào giỏ hàng</button>
							<?php } else echo '<button class="button" disabled>Hết hàng</button>'; ?>
						</div>
						<div class=" product_d_action">
							<p><?php echo $product['product_quantity']; ?> sản phẩm có sẵn</p>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!--product details end-->

<!--product info start-->
<div class="product_d_info mb-58">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="product_d_inner">
					<div class="product_info_button">
						<ul class="nav" role="tablist">
							<li><a class="active" data-bs-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">MÔ TẢ</a></li>
							<li><a data-bs-toggle="tab" href="#sheet" role="tab" aria-controls="sheet" aria-selected="false">CHI TIẾT</a></li>
							<!-- <li><a data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews (1)</a></li> -->
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade show active" id="info" role="tabpanel">
							<div class="product_info_content">
								<p><?php echo $product['product_description']; ?></p>
							</div>
						</div>
						<div class="tab-pane fade" id="sheet" role="tabpanel">
							<div class="product_d_table">
								<form action="#">
									<table>
										<tbody>
											<tr>
												<td class="first_child">Loại sản phẩm</td>
												<td><?php echo $product['product_type_name']; ?></td>
											</tr>
											<tr>
												<td class="first_child">Kho hàng</td>
												<td><?php echo $product['product_quantity']; ?></td>
											</tr>
											<tr>
												<td class="first_child">Gửi từ</td>
												<td>TP. Hồ Chí Minh</td>
											</tr>
										</tbody>
									</table>
								</form>
							</div>
							<!-- <div class="product_info_content">
                                <p>Fashion has been creating well-designed collections since 2010. The brand offers feminine designs delivering stylish separates and statement dresses which have since evolved into a full ready-to-wear collection in which every item is a vital part of a woman's wardrobe. The result? Cool, easy, chic looks with youthful elegance and unmistakable signature style. All the beautiful pieces are made in Italy and manufactured with the greatest attention. Now Fashion extends to a range of accessories including shoes, hats, belts and more!</p>
                            </div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--product info end-->

<!--product area start-->
<section class="product_area related_products">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section_title">
					<h2>Sản phẩm liên quan</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="product_carousel product_column4 owl-carousel">
				<!-- <div class="col-lg-3">
					<article class="single_product">
						<figure>
							<div class="product_thumb">
								<a class="primary_img" href="product-details.html"><img src="assets/img/product/product1.webp" alt=""></a>
								<a class="secondary_img" href="product-details.html"><img src="assets/img/product/product2.webp" alt=""></a>
								<div class="action_links">
									<ul>
										<li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="zmdi zmdi-shopping-cart"></i></a></li>

										<li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="zmdi zmdi-favorite-outline"></i></a></li>

										<li class="compare"><a href="#" title="Add to Compare"><i class="zmdi zmdi-shuffle"></i></a></li>

										<li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="zmdi zmdi-eye"></i></a></li>

									</ul>
								</div>
							</div>
							<figcaption class="product_content">
								<h4 class="product_name"><a href="product-details.html">Donec Ac Tempus</a></h4>
								<div class="price_box">
									<span class="old_price">$420.00</span>
									<span class="current_price">$180.00</span>
								</div>
								<div class="product_rating">
									<ul>
										<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
										<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
										<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
										<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
										<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
									</ul>
								</div>
							</figcaption>
						</figure>
					</article>
				</div> -->
				<?php
				$products = new Products();
				// $products->getProducts();
				foreach ($products->getProductsByProductTypeId($product['product_type_id'], 1, 1, 8) as $k => $v) {
					$product_id = $v['product_id'];
					$product_rental_price = number_format($v['product_rental_price'], 0, ',', '.');
					$product_img = explode('|', $v['product_img'])[0];
					echo '<div class="col-lg-3">
							<article class="single_product">
								<figure>
									<div class="product_thumb">
										<!--<a class="primary_img" href="product-details.html"><img src="' . $product_img . '" alt=""></a>-->
										<a class="primary_img" href="product-details.html?product_id=' . $product_id . '">
											<div style="width: 100%; background-image: url(\'' . $product_img . '\'); background-size: contain; background-repeat: no-repeat; padding-top: 100%;"></div>
										</a>
										<div class="action_links">
											<ul>
												<li class="add_to_cart"><a href="javascript:" onclick="add_to_cart(' . $product_id . ');" title="Thêm vào giỏ hàng"><i class="zmdi zmdi-shopping-cart"></i></a></li>
												<!--<li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="Xem thông tin"> <i class="zmdi zmdi-eye"></i></a></li>-->
												<li class="quick_button"><a href="product-details.html?product_id=' . $product_id . '" title="Xem thông tin"> <i class="zmdi zmdi-eye"></i></a></li>
											</ul>
										</div>
									</div>
									<figcaption class="product_content">
										<h4 class="product_name"><a href="product-details.html?product_id=' . $product_id . '">' . $v['product_name'] . '</a></h4>
										<div class="price_box">
											<span class="current_price">' . $product_rental_price . 'đ</span>
										</div>
									</figcaption>
								</figure>
							</article>
						</div>';
				}
				?>
			</div>
		</div>
	</div>
</section>
<!--product area end-->
<?php
include 'views/footer.php';
?>