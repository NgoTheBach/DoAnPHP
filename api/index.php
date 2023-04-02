<?php
include '../config.php';


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$res['success'] = false;

$users = new User;
$products = new Products;
$product_types = new ProductTypes;
$carts = new Cart;
$invoices = new Invoice;

switch (strtolower(getREQUEST('action'))) {
	case 'post_cart':
		$res['success'] = $carts->postCart(getREQUEST('user_id'), getREQUEST('product_id'), getREQUEST('cart_product_quantity'));
		break;
	case 'update_cart':
		$res['success'] = $carts->updateCart(getREQUEST('user_id'), getREQUEST('product_id'), getREQUEST('cart_product_quantity'));
		break;
	case 'delete_cart':
		$res['success'] = $carts->deleteCart(getREQUEST('user_id'), getREQUEST('product_id'));
		break;
	default:
		# code...
		break;
}
echo json_encode($res);
