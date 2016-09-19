<?php
/**
* 
*/
class ProductController
{
	// Hàm xóa 1 bản ghi trong table product
	function Remove(){

		// 1. Kiểm tra xem biến id có tồn tại hay không
		if(isset($_GET['id'])){
			$pId = $_GET['id'];
			// Kiểm tra giá trị của id có tồn tại trong cơ sở dữ liệu hay không
			if(ProductModel::GetOne($pId)){
				// Xoá bản ghi trong db
				ProductModel::Remove($pId);
				Call("Home", "Index");
			}else{
				$errMsg = "Product ID không tồn tại.";
				include './app/views/home/notfound.php';
			}
			
		}else{ // Trường hợp không có biến id trên url thì sẽ hiển thị view notfound với message
			$errMsg = "Đường dẫn không hợp lệ.";
			include './app/views/home/notfound.php';			
		}
	}

	// Hàm hiển thị form để tạo mới 1 sản phẩm
	function AddNew(){
		$product = new ProductModel();
		$categories = CategoryModel::All();
		include './app/views/product/productform.php';
	}

	// Hàm hiển thị form để update thông tin 1 sản phẩm
	function Update(){
		$id = $_GET['id'];    
		$product = ProductModel::GetOne($id);
		$categories = CategoryModel::All();
		include './app/views/product/productform.php';
	}

	// Hàm hiển thị form để tạo mới 1 sản phẩm
	function SaveProduct(){
		$pId = isset($_POST["pro_id"]) == true ? $_POST["pro_id"] : null;
		$pName = isset($_POST["pro_name"]) == true ? $_POST["pro_name"] : null;
		$pPrice = isset($_POST["pro_price"]) == true ? $_POST["pro_price"] : null;
		$pImage = isset($_POST["pro_image"]) == true ? $_POST["pro_image"] : null;
		$pCateId = isset($_POST["cate_id"]) == true ? $_POST["cate_id"] : null;
		$product = new ProductModel($pId, $pName, $pImage, $pPrice, null, $pCateId);
		
		ProductModel::Save($product);
		header('location: index.php');
		
	}
}

?>