<?php
class CategoryData {
	public static $tablename = "category";

	public function __construct(){
		$this->name = "";
		$this->lastname = "";
		$this->username = "";
		$this->email = "";
		$this->password = "";
		$this->created_at = "NOW()";
	}

	public function getItem(){ return GerenciasData::getById($this->id_gerencia); }
	public function add(){

		$prueba = Core::$user->id;
		$sql = "insert into ".self::$tablename." (name,id_gerencia,id_username,created_at) ";
		$sql .= "value (\"$this->name\",\"$this->id_gerencia\",\"$prueba\",$this->created_at)";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

	public static function delBy($k,$v){
		$sql = "delete from ".self::$tablename." where $k=\"$v\"";
		Executor::doit($sql);
	}

	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\" where id=$this->id";
		Executor::doit($sql);
	}

	public function update_passwd(){
		$sql = "update ".self::$tablename." set password=\"$this->password\" where id=$this->id";
		Executor::doit($sql);
	}

	public function updateById($k,$v){
		$sql = "update ".self::$tablename." set $k=\"$v\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		 $sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CategoryData());
	}

	public static function getBy($k,$v){
		$sql = "select * from ".self::$tablename." where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CategoryData());
	}

	public static function getAll(){
		 
		$sql = "select * from ".self::$tablename." order by id asc";
		 //$sql = "select * from category order by created_at asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CategoryData());
	}
	

	public static function getAllg($grupo){
		 
		
		if ($grupo == "g1"){

			$sql = "select * from ".self::$tablename." where name = 1 or name = 3 or name = 4 or name = 12 order by id asc";
		} elseif($grupo == "g2") {

			$sql = "select * from ".self::$tablename." where name = 2 or name = 5 or name = 6 or name = 'B' order by id asc";
		}elseif($grupo == "g3") {

			$sql = "select * from ".self::$tablename." where name = 7 or name = 8 or name = 9 or name = 'A' order by id asc";
		}else{

			$sql = "select * from ".self::$tablename." order by id asc";
		}
		//$sql = "select * from ".self::$tablename." order by id asc";
		 //$sql = "select * from category order by created_at asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CategoryData());
	}

	public static function getAllBy($k,$v){
		 $sql = "select * from ".self::$tablename." where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CategoryData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CategoryData());
	}


}

?>