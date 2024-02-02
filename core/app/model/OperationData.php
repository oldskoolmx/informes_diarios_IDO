<?php
class OperationData {
	public static $tablename = "operation";
	public static $tablename1 = "person1";


	public function __construct(){
		$this->name = "";
		$this->lastname = "";
		$this->email = "";
		$this->password = "";
		$this->created_at = "NOW()";
	}

	public function getItem(){ return CategoryData::getById($this->id_linea); }
	public function getEvento(){ return EventosData::getById($this->evento); }
	public function getArea(){ return AreasData::getById($this->id_area); }

	

	public function add(){
		$sql = "insert into ".self::$tablename." (item_id,client_id,start_at,finish_at,user_id) ";
		$sql .= "value (\"$this->item_id\",\"$this->client_id\",\"$this->start_at\",\"$this->finish_at\",\"$this->user_id\")";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto OperationData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\" where id=$this->id";
		Executor::doit($sql);
	}

	public function finalize(){
		$sql = "update ".self::$tablename." set returned_at=NOW() where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new OperationData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}
	public static function getRentsByRange($start,$finish){
		$sql = "select * from ".self::$tablename." where (  (\"$start\">=start_at and \"$finish\"<=finish_at) or (start_at>=\"$start\" and finish_at<=\"$finish\") )  and returned_at is NULL ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}


	public static function getByRange($start,$finish){
		$sql = "select * from ".self::$tablename1." where fecha>=\"$start\" and fecha<=\"$finish\" and fecha is not NULL ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}
	
	// Query para tabla 
	public static function getByRange1($start,$finish){
		
		$sql = "SELECT id_linea, 
				SUM(CASE WHEN clasificacion = '01:00 A 05:00' THEN retardo ELSE 0 END) AS uno,
		   		COUNT(CASE WHEN clasificacion = '01:00 A 05:00' THEN 1  END) AS uno_a_4,
				SUM(CASE WHEN clasificacion = '05:01 A 15:00' THEN retardo ELSE 0 END) AS cinco,
		  		COUNT(CASE WHEN clasificacion = '05:01 A 15:00' THEN 1 END) AS cinco_a_14,
		  		SUM(CASE WHEN clasificacion = '15:01 A 30:00' THEN retardo ELSE 0 END) AS quince,
		  		COUNT(CASE WHEN clasificacion = '15:01 A 30:00' THEN 1 END) AS quince_a_29,
		   		SUM(CASE WHEN clasificacion = 'MAS DE 30:00' THEN retardo ELSE 0 END) AS mas,
		  		COUNT(CASE WHEN clasificacion = 'MAS DE 30:00' THEN 1 END) AS mas_de_30,
				count(evento) as T_eventos, sum(retardo) as T_retardos
				FROM person1 where fecha>=\"$start\" and fecha<=\"$finish\" and fecha is not NULL  
				GROUP BY id_linea";

		//$sql = "select * from ".self::$tablename1." where fecha>=\"$start\" and fecha<=\"$finish\" and fecha is not NULL  order by fecha";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}
	public static function getByRange1T($start,$finish){
		
		$sql = "SELECT 
				SUM(CASE WHEN clasificacion = '01:00 A 05:00' THEN retardo ELSE 0 END) AS uno,
		   		COUNT(CASE WHEN clasificacion = '01:00 A 05:00' THEN 1  END) AS uno_a_4,
				SUM(CASE WHEN clasificacion = '05:01 A 15:00' THEN retardo ELSE 0 END) AS cinco,
		  		COUNT(CASE WHEN clasificacion = '05:01 A 15:00' THEN 1 END) AS cinco_a_14,
		  		SUM(CASE WHEN clasificacion = '15:01 A 30:00' THEN retardo ELSE 0 END) AS quince,
		  		COUNT(CASE WHEN clasificacion = '15:01 A 30:00' THEN 1 END) AS quince_a_29,
		   		SUM(CASE WHEN clasificacion = 'MAS DE 30:00' THEN retardo ELSE 0 END) AS mas,
		  		COUNT(CASE WHEN clasificacion = 'MAS DE 30:00' THEN 1 END) AS mas_de_30,
				count(evento) as T_eventos, sum(retardo) as T_retardos
				FROM person1 where fecha>=\"$start\" and fecha<=\"$finish\" and fecha is not NULL";

		//$sql = "select * from ".self::$tablename1." where fecha>=\"$start\" and fecha<=\"$finish\" and fecha is not NULL  order by fecha";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	public static function getRents(){
		$sql = "select * from ".self::$tablename." where returned_at is NULL";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	public static function getAllByItemId($id){
		$sql = "select * from ".self::$tablename." where item_id=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	public static function getAllByItemIdAndRange($id,$start,$finish){
		$sql = "select * from ".self::$tablename." where item_id=$id and ((returned_at>=\"$start\" and returned_at<=\"$finish\") or (start_at>=\"$start\" and start_at<=\"$finish\") or (finish_at>=\"$start\" and finish_at<=\"$finish\")) ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}
	public static function getAllByClientId($id){
		$sql = "select * from ".self::$tablename." where client_id=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	public static function getAllByClientIdAndRange($id,$start,$finish){
		$sql = "select * from ".self::$tablename." where client_id=$id and ((returned_at>=\"$start\" and returned_at<=\"$finish\") or (start_at>=\"$start\" and start_at<=\"$finish\") or (finish_at>=\"$start\" and finish_at<=\"$finish\")) ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}


}

?>