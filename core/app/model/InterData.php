<?php
class InterData
{
	public static $tablename = "person1";

	public function __construct()
	{
		$this->name = "";
		$this->lastname = "";
		$this->username = "";
		$this->email = "";
		$this->password = "";
		$this->created_at = "NOW()";
	}

	public function getItem(){ return CategoryData::getById($this->id_linea); }
	public function getEvento(){ return EventosData::getById($this->evento); }
	public function getArea(){ return AreasData::getById($this->id_area); }

	public function getLinea()
	{
		return CategoryData::getById($this->id_linea);
	}
	public function add()
	{


		$prueba = $this->retardo;

		if ($prueba < 5) {
			$clasificacion = "01:00 A 05:00";
		} elseif ($prueba > 4 && $prueba < 15) {
			$clasificacion = "05:01 A 15:00";
		} elseif ($prueba > 15 && $prueba < 30) {
			$clasificacion = "15:01 A 30:00";
		} elseif ($prueba >= 30) {
			$clasificacion = "MAS DE 30:00";
		}

		$linea = $this->id_linea;
		if ($linea == 1 || $linea == 3 || $linea == 4 || $linea == 12) {
			$gerencia = 1;
		} elseif ($linea == 2 || $linea == 5 || $linea == 6 || $linea == 11) {
			$gerencia = 2;
		} elseif ($linea == 7 || $linea == 8 || $linea == 9 || $linea == 10) {
			$gerencia = 3;
		}

		$status = 'Active';
		$usuario = Core::$user->id;
		$sql = "insert into " . self::$tablename . " (fecha,id_linea,id_gerencia,tren,modelo,motriz,evento,retardo,clasificacion,id_area,id_usuario,status,created_at) ";
		$sql .= "value (\"$this->fecha\",\"$linea\",\"$gerencia\",\"$this->tren\",\"$this->modelo\",\"$this->motriz\",\"$this->evento\",\"$prueba\",\"$clasificacion\",\"$this->id_area\",\"$usuario\",\"$status\",$this->created_at)";
		Executor::doit($sql);
	}

	public function del()
	{
		//$sql = "delete from " . self::$tablename . " where id=$this->id";
		$status = 'Deleted';
		$sql = "update " . self::$tablename . " set status=\"$status\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function delBy($k, $v)
	{
		$sql = "delete from " . self::$tablename . " where $k=\"$v\"";
		Executor::doit($sql);
	}

	public function update()
	{
		$sql = "update " . self::$tablename . " set name=\"$this->name\",lastname=\"$this->lastname\",address=\"$this->address\",phone=\"$this->phone\",email=\"$this->email\" where id=$this->id";
		Executor::doit($sql);
	}

	public function update_passwd()
	{
		$sql = "update " . self::$tablename . " set password=\"$this->password\" where id=$this->id";
		Executor::doit($sql);
	}

	public function updateById($k, $v)
	{
		$sql = "update " . self::$tablename . " set $k=\"$v\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id)
	{
		$sql = "select * from " . self::$tablename . " where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0], new InterData());
	}

	public static function getBy($k, $v)
	{
		$sql = "select * from " . self::$tablename . " where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::one($query[0], new InterData());
	}

	public static function getByDate($date)
	{
		$sql = "select count(*) as cnt from " . self::$tablename . " where date(created_at)= \"$date\"";
		$query = Executor::doit($sql);
		return Model::one($query[0], new InterData());
	}


	public static function getAllRep()
	{
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
				FROM person1
				GROUP BY id_linea";
		//$sql = "select * from " . self::$tablename;
		//$sql = "select a.id as id,a.fecha,b.name as id_linea,a.tren,a.modelo,a.motriz,d.name as evento,a.retardo,a.clasificacion,c.name as id_area from person1 a, category b, areas c, eventos d where a.id_linea=b.id and a.id_area=c.id and a.evento=d.id";
		$query = Executor::doit($sql);
		return Model::many($query[0], new InterData());
	}
	public static function getAllRepT()
	{
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
				FROM person1";
		//$sql = "select * from " . self::$tablename;
		//$sql = "select a.id as id,a.fecha,b.name as id_linea,a.tren,a.modelo,a.motriz,d.name as evento,a.retardo,a.clasificacion,c.name as id_area from person1 a, category b, areas c, eventos d where a.id_linea=b.id and a.id_area=c.id and a.evento=d.id";
		$query = Executor::doit($sql);
		return Model::many($query[0], new InterData());
	}

	public static function getAll()
	{
		//$sql = "select * from ".self::$tablename;
		$sql = "select a.id as id,a.fecha,b.name as id_linea,a.tren,a.modelo,a.motriz,d.name as evento,a.retardo,a.clasificacion,c.name as id_area from person1 a, category b, areas c, eventos d where a.id_linea=b.id and a.id_area=c.id and a.evento=d.id";
		$query = Executor::doit($sql);
		return Model::many($query[0], new InterData());
	}
	public static function getAllF()
	{
		
		$fecha = date('Y-m-d');
		$sql = "select * from ".self::$tablename . " where status = 'Active' and fecha='$fecha'";
		//$sql = "select a.id as id,a.fecha,b.name as id_linea,a.tren,a.modelo,a.motriz,d.name as evento,a.retardo,a.clasificacion,c.name as id_area from person1 a, category b, areas c, eventos d where   a.id_linea=b.id and a.id_area=c.id and a.evento=d.id";
		$query = Executor::doit($sql);
		return Model::many($query[0], new InterData());
	}

	public static function getAllg1($grupo)
	{
		//$sql = "select * from ".self::$tablename;
		if ($grupo == "g1") {

			$sql = "select a.id as id,a.fecha,b.name as id_linea,a.tren,a.modelo,a.motriz,d.name as evento,a.retardo,a.clasificacion,c.name as id_area from person1 a, category b, areas c, eventos d where a.status = 'Active' and a.id_linea=b.id and a.id_area=c.id and a.evento=d.id and a.id_gerencia=1";
		} elseif ($grupo == "g2") {

			$sql = "select a.id as id,a.fecha,b.name as id_linea,a.tren,a.modelo,a.motriz,d.name as evento,a.retardo,a.clasificacion,c.name as id_area from person1 a, category b, areas c, eventos d where a.status = 'Active' and a.id_linea=b.id and a.id_area=c.id and a.evento=d.id and a.id_gerencia=2";
		} elseif ($grupo == "g3") {

			$sql = "select a.id as id,a.fecha,b.name as id_linea,a.tren,a.modelo,a.motriz,d.name as evento,a.retardo,a.clasificacion,c.name as id_area from person1 a, category b, areas c, eventos d where a.status = 'Active' and a.id_linea=b.id and a.id_area=c.id and a.evento=d.id and a.id_gerencia=3";
		} else {

			$sql = "select a.id as id,a.fecha,b.name as id_linea,a.tren,a.modelo,a.motriz,d.name as evento,a.retardo,a.clasificacion,c.name as id_area from person1 a, category b, areas c, eventos d where a.status = 'Active' and a.id_linea=b.id and a.id_area=c.id and a.evento=d.id";
		}

		$query = Executor::doit($sql);
		return Model::many($query[0], new InterData());
	}

	public static function getAllBy($k, $v)
	{
		$sql = "select * from " . self::$tablename . " where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::many($query[0], new InterData());
	}


	public static function getLike($q)
	{
		$sql = "select * from " . self::$tablename . " where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0], new InterData());
	}
}
