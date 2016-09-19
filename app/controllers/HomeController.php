<?php
/**
* Home controller - se xu ly nhung logic lien quan den trang hien thi san pham, tim kiem,..
*/
class HomeController
{
	// Hien thi trang chu (co data)
	function Index(){
		$products = ProductModel::All();
		
		include "./app/views/home/index.php";
	}
	
	function NotFound(){
		include './app/views/home/notfound.php';	
	}
}
?>