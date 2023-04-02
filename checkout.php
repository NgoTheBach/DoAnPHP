<?php
include 'views/header.php';


if (isset($_POST['submit'])) {
    $invoices = new Invoice;
    if ($invoices->postInvoice($_SESSION['user_id'], $_POST['user_fullname'], $_POST['user_phone_number'], $_POST['user_email'], $_POST['user_address'], $_POST['invoice_num_rental_days'], $_POST['order_note'])) {
        echo '<script>location.replace("order-success.html");</script>';
    }
}

$users = new User;
$user = $users->getUser($_SESSION['user_id']);
?>
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="index.html">Trang chủ</a></li>
                        <li>Thanh toán</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--Checkout page section-->
<div class="Checkout_section mt-60">
    <div class="container">
        <div class="checkout_form">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <form method="POST" action="">
                        <h3>Thông tin người nhận</h3>
                        <div class="row">
                            <div class="col-lg-12 mb-20">
                                <label>Họ tên <span>*</span></label>
                                <input type="text" name="user_fullname" value="<?php echo $user['user_fullname']; ?>" required />
                            </div>
                            <div class="col-lg-6 mb-20">
                                <label>SĐT <span>*</span></label>
                                <input type="text" name="user_phone_number" value="<?php echo $user['user_phone_number']; ?>" pattern="(84|0[3|5|7|8|9])+([0-9]{8})" required />
                            </div>
                            <div class="col-lg-6 mb-20">
                                <label>Email <span>*</span></label>
                                <input type="email" name="user_email" value="<?php echo $user['user_email']; ?>" required />
                            </div>
                            <div class="col-8 mb-20">
                                <label>Địa chỉ giao hàng <span>*</span></label>
                                <input type="text" name="user_address" placeholder="House number and street name" value="<?php echo $user['user_address']; ?>" required />
                            </div>
                            <div class="col-4 mb-20">
                                <label>Số ngày thuê tối đa <span>*</span></label>
                                <input type="number" name="invoice_num_rental_days" value="3" min="3" max="10" required />
                            </div>
                            <div class="col-12">
                                <div class="order-notes">
                                    <label for="order_note">Ghi chú đơn hàng</label>
                                    <textarea id="order_note" name="order_note" placeholder="Size sản phẩm, thông tin giao hàng..." style="height: 100px;"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="order_button">
                                    <button type="submit" name="submit" value="submit_order">Đặt hàng</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-md-6">
                    <form action="#">
                        <h3>SẢN PHẨM</h3>
                        <p>(Kiểm tra kĩ SỐ LƯỢNG và ĐƠN GIÁ, dữ liệu có thể thay đổi từng thời điểm)</p>
                        <p><a target="_blank" href="faq.html">Ấn vào đây để xem Câu hỏi thường gặp!</a></p>
                        <div class="order_table table-responsive" style="overflow-x: hidden;">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Số tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $carts = new Cart;
                                    $cart_subtotal = 0;
                                    $cart_weight = 0;
                                    foreach ($carts->getCart($_SESSION['user_id']) as $k => $v) {
                                        $product_id = $v['product_id'];
                                        $product_img = explode('|', $v['product_img'])[0];
                                        if ($v['cart_product_quantity'] > $v['product_quantity']) {
                                            $cart_product_quantity = $v['product_quantity'];
                                            $carts->updateCart($_SESSION['user_id'], $product_id, $cart_product_quantity);
                                        } else $cart_product_quantity = $v['cart_product_quantity'];
                                        $product_price_total = $cart_product_quantity * $v['product_rental_price'];
                                        echo '<tr>
                                                <td>' . $v['product_name'] . '<strong> × ' . $cart_product_quantity . '</strong></td>
                                                <td>' . number_format($product_price_total, 0, ',', '.') . 'đ</td>
                                            </tr>';
                                        $cart_subtotal += $product_price_total;
                                        $cart_weight += $cart_product_quantity * $v['product_weight'];
                                    }
                                    $fee = new Fee;
                                    $fee_transport = $fee->transport($cart_weight);
                                    $fee_bond = $fee->bond($cart_subtotal);
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tạm tính</th>
                                        <td><?php echo number_format($cart_subtotal, 0, ',', '.'); ?>đ</td>
                                    </tr>
                                    <tr>
                                        <th>Phí vận chuyển</th>
                                        <td><?php echo number_format($fee_transport, 0, ',', '.'); ?>đ</td>
                                    </tr>
                                    <tr>
                                        <th>Phí đảm bảo tài sản</th>
                                        <td><?php echo number_format($fee_bond, 0, ',', '.'); ?>đ</td>
                                    </tr>
                                    <tr class="order_total">
                                        <th>Tổng thanh toán</th>
                                        <td><strong><?php echo number_format($cart_subtotal + $fee_transport + $fee_bond, 0, ',', '.'); ?>đ</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment_method">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Checkout page section end-->
<?php
include 'views/footer.php';
?>