<?php
function Call($controller, $action){
	require_once("./app/controllers/" . $controller . "Controller.php");
	switch ($controller) {
		case 'Home':
			require_once("./app/models/ProductModel.php");
			$ctr = new HomeController();
			$ctr->{$action}();
			break;
		case 'Product':
			require_once("./app/models/ProductModel.php");
			require_once("./app/models/CategoryModel.php");
			$ctr = new ProductController();
			$ctr->{$action}();
			break;
		
		default:
			require_once("./app/controllers/" . $controller . "Controller.php");
			$ctr = new HomeController();
			$ctr->NotFound();
			break;
	}
}

// Tap hop cac controller va cac ham cua he thong
// Su dung de check 2 bien $ctr, $action tren url xem co hop le khong
$listCtr = [
	"Home" => ["Index", "NotFound"],
	"Product" => ["Index", "SaveProduct", "AddNew", "Update", "Remove"]
];
// Loc thong tin tu bien $ctr, $action khoi tao tai index.php
if(array_key_exists($ctr ,$listCtr)){ // Check gia tri cua $ctr co trong tap key cua listCtr hay khong
	if(in_array($action, $listCtr[$ctr])){ // Check gia tri cua $action co trong tap value cua listCtr hay khong 
		Call($ctr, $action);
	}else{
		$ctr = "Home";
		$action = "NotFound";
		Call($ctr, $action);
	}
}else{
	var_dump($action);
	$ctr = "Home";
	$action = "NotFound";
	Call($ctr, $action);
}



?>