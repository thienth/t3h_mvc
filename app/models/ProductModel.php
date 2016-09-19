<?php
/**
* Tạo Model để tương tác với data trong bảng product
*/
class ProductModel
{
	public $id;
	public $name;
	public $image;
	public $price;
	public $cate_id;
	public $cate_name;

	function __construct($id = null, 
			$name = null, $image = null,
			$price = null, $cate_name = null,
			$cate_id = null)
	{
		$this->id = $id;
		$this->name = $name;
		$this->image = $image;
		$this->price = $price;
		$this->price = $price;
		$this->cate_name = $cate_name;
		$this->cate_id = $cate_id;
	}

	/**
	*	Hàm lấy toàn bộ dữ liệu trong bảng product
	*/
	public static function All(){
		$db = Db::GetInstance(); // Lấy kết nối đến db từ đối tượng Db (nằm trong file connection.php)
		$stmt = $db->prepare("
				select 	p.id as id,
						p.name as name,
						p.image as image,

						p.price as price,
						c.cate_name as cate_name
				from product as p
				left join category as c
					on p.cate_id = c.cate_id
			"); // Chuẩn bị 1 câu query để lấy toàn bộ dữ liệu từ trong bảng product
		$stmt->execute(); // Thực thi câu query ở trên 
		$rs = $stmt->fetchAll(); // Lấy ra toàn bộ dữ liệu trả về
		$arr = [];
		if(count($rs) > 0){
			foreach ($rs as $v) {
				array_push($arr, 
					new ProductModel($v["id"], $v["name"], $v["image"], $v["price"], $v["cate_name"])
				);
			}
		}

		return $arr;
	}

	/**
	*	Hàm lấy 1 bản ghi từ csdl với id truyền vào
	*/
	public static function GetOne($id){
		$db = Db::GetInstance(); // Lấy kết nối đến db từ đối tượng Db (nằm trong file connection.php)
		$stmt = $db->prepare("
				select 	p.id as id,
						p.name as name,
						p.image as image,

						p.price as price,
						p.cate_id as cate_id,
						c.cate_name as cate_name
				from product as p
				left join category as c
					on p.cate_id = c.cate_id
				where p.id = :id
			"); // Chuẩn bị 1 câu query để lấy toàn bộ dữ liệu từ trong bảng product
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute(); // Thực thi câu query ở trên 
		$rs = $stmt->fetch(); // Lấy ra 1 bản ghi trả về
		if($rs){
			$result = new ProductModel($rs["id"], $rs["name"], $rs["image"], $rs["price"], $rs["cate_name"], $rs['cate_id']);
		}else{
			$result = null;
		}
		return $result;
	}

	/**
	*	Hàm xóa 1 bản ghi trong db
	*/
	public static function Remove($id){
		$db = Db::GetInstance(); // Lấy kết nối đến db từ đối tượng Db (nằm trong file connection.php)
		$stmt = $db->prepare("
				delete from product where id = :id
			"); // Chuẩn bị 1 câu query xóa 1 bản ghi trong
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute(); // Thực thi câu query ở trên 
		return true;
	}

	/**
	*	Hàm save dữ liệu vào bảng product
	*/
	public static function Save($product){
		$db = Db::GetInstance(); // Lấy kết nối đến db từ đối tượng Db (nằm trong file connection.php)

		if($product->id == 0){
			$stmt = $db->prepare("
				insert into product
					(name, image, price, cate_id)
				values
					(:name, :image, :price, :cate_id)
			"); // Chuẩn bị 1 câu query để insert dữ liệu trong bảng product
		}else{
			$stmt = $db->prepare("
				update 	product
				set 	name 		= :name, 
						image 		= :image, 
						price 		= :price, 
						cate_id 	= :cate_id
				where 	id 			= :id
			"); // Chuẩn bị 1 câu query để update dữ liệu trong bảng product
			$stmt->bindParam(':id', $product->id, PDO::PARAM_STR);
		}
		$stmt->bindParam(':name', $product->name, PDO::PARAM_STR);
		$stmt->bindParam(':image', $product->image, PDO::PARAM_STR);
		$stmt->bindParam(':price', $product->price, PDO::PARAM_STR);
		$stmt->bindParam(':cate_id', $product->cate_id, PDO::PARAM_INT);
		$stmt->execute(); // Thực thi câu query ở trên 
		return true;
	}
}
