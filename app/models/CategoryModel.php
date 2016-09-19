<?php
/**
* 
*/
class CategoryModel
{
	
	public $cate_id;
	public $cate_name;
	public $cate_image;

	function __construct($cate_id = null, 
			$cate_name = null, $cate_image = null)
	{
		$this->cate_id = $cate_id;
		$this->cate_name = $cate_name;
		$this->cate_image = $cate_image;
	}

	/**
	*	Hàm lấy toàn bộ dữ liệu trong bảng category
	*/
	public static function All(){
		$db = Db::GetInstance(); // Lấy kết nối đến db từ đối tượng Db (nằm trong file connection.php)
		$stmt = $db->prepare("
				select 	c.cate_id as cate_id,
						c.cate_name as cate_name,
						c.cate_image as cate_image
				from category as c
			"); // Chuẩn bị 1 câu query để lấy toàn bộ dữ liệu từ trong bảng category
		$stmt->execute(); // Thực thi câu query ở trên 
		$rs = $stmt->fetchAll(); // Lấy ra toàn bộ dữ liệu trả về
		$arr = [];
		if(count($rs) > 0){
			foreach ($rs as $v) {
				array_push($arr, 
					new CategoryModel($v["cate_id"], $v["cate_name"], $v["cate_image"])
				);
			}
		}

		return $arr;
	}
}
?>