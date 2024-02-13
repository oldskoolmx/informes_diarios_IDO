<?php
class DocumentosData
{
	public static $tablename = "tablero";

	public function __construct()
	{
		$this->name = "";
		$this->lastname = "";
		$this->username = "";
		$this->email = "";
		$this->password = "";
		$this->created_at = "NOW()";
		//$this->filename = "";
		//$this->short_name = "";
		$this->updated_at = "NOW()";
	}


	public function getClasificaciones()
	{
		return ClasificacionesData::getById($this->id_estado);
	}
	public function getRegistro()
	{
		return UserData::getById($this->id_usuario);
	}
	public function add()
	{

		//$status = 'Active';
		//$usuario = Core::$user->id;
		/* $sql = "insert into " . self::$tablename . " (n_turno,f_e_turno,f_e_oficio,asunto,id_area,instrucciones,f_respuesta,n_oficio,id_usuario,observaciones,id_estado,filename,short_name,created_at,updated_at,activo) ";
		$sql .= "value (\"$this->n_turno\",\"$this->f_e_turno\",\"$this->f_e_oficio\",\"$this->asunto\",\"$this->id_area\",\"$this->instrucciones\",\"$this->f_respuesta\",\"$this->n_oficio\",\"$this->id_usuario\",\"$this->observaciones\",\"$this->id_estado\",\"$this->filename\",\"$this->short_name\",\"$this->created_at\",\"$this->created_at\",1)";
		 */
		/* 
		$sql = "insert into " . self::$tablename . " (n_turno,f_e_turno,f_e_oficio,asunto,id_area,instrucciones,f_respuesta,n_oficio,id_usuario,observaciones,id_estado,created_at) ";
		$sql .= "value (\"$this->n_turno\",\"$this->f_e_turno\",\"$this->f_e_oficio\",\"$this->asunto\",\"$this->id_area\",\"$this->instrucciones\",\"$this->f_respuesta\",\"$this->n_oficio\",\"$this->id_usuario\",\"$this->observaciones\",\"$this->id_estado\",\"$this->created_at\")";
		Executor::doit($sql); */

		$sql = "insert into " . self::$tablename . " (n_turno,f_e_turno,f_e_oficio,asunto,id_area,instrucciones,f_respuesta,n_oficio,id_usuario,observaciones,id_estado,filename,short_name,created_at,activo) ";
		$sql .= "value (\"$this->n_turno\",\"$this->f_e_turno\",\"$this->f_e_oficio\",\"$this->asunto\",\"$this->id_area\",\"$this->instrucciones\",\"$this->f_respuesta\",\"$this->n_oficio\",\"$this->id_usuario\",\"$this->observaciones\",\"$this->id_estado\",\"$this->filename\",\"$this->short_name\",$this->created_at,1)";
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
		return Model::one($query[0], new DocumentosData());
	}

	public static function getBy($k, $v)
	{
		$sql = "select * from " . self::$tablename . " where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::one($query[0], new DocumentosData());
	}

	public static function getByDate($date)
	{
		$sql = "select count(*) as cnt from " . self::$tablename . " where id_estado = 2 and date(created_at)= \"$date\"";
		$query = Executor::doit($sql);
		return Model::one($query[0], new DocumentosData());
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
		return Model::many($query[0], new DocumentosData());
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
		return Model::many($query[0], new DocumentosData());
	}

	public static function getAll()
	{
		$sql = "select * from " . self::$tablename;
		//$sql = "select a.id as id,a.fecha,b.name as id_linea,a.tren,a.modelo,a.motriz,d.name as evento,a.retardo,a.clasificacion,c.name as id_area from person1 a, category b, areas c, eventos d where a.id_linea=b.id and a.id_area=c.id and a.evento=d.id";
		$query = Executor::doit($sql);
		return Model::many($query[0], new DocumentosData());
	}

	// funcion para mostrar todos los pendientes 
	public static function getAllP()
	{
		$sql = "select * from " . self::$tablename . " where id_estado = 1";
		//$sql = "select a.id as id,a.fecha,b.name as id_linea,a.tren,a.modelo,a.motriz,d.name as evento,a.retardo,a.clasificacion,c.name as id_area from person1 a, category b, areas c, eventos d where a.id_linea=b.id and a.id_area=c.id and a.evento=d.id";
		$query = Executor::doit($sql);
		return Model::many($query[0], new DocumentosData());
	}
	// funcion para mostrar todos los atendidos 
	public static function getAllA()
	{
		$sql = "select * from " . self::$tablename . " where id_estado = 2";
		//$sql = "select a.id as id,a.fecha,b.name as id_linea,a.tren,a.modelo,a.motriz,d.name as evento,a.retardo,a.clasificacion,c.name as id_area from person1 a, category b, areas c, eventos d where a.id_linea=b.id and a.id_area=c.id and a.evento=d.id";
		$query = Executor::doit($sql);
		return Model::many($query[0], new DocumentosData());
	}
	// funcion para mostrar todos los sin atender 
	public static function getAllS()
	{
		$sql = "select * from " . self::$tablename . " where id_estado = 3";
		//$sql = "select a.id as id,a.fecha,b.name as id_linea,a.tren,a.modelo,a.motriz,d.name as evento,a.retardo,a.clasificacion,c.name as id_area from person1 a, category b, areas c, eventos d where a.id_linea=b.id and a.id_area=c.id and a.evento=d.id";
		$query = Executor::doit($sql);
		return Model::many($query[0], new DocumentosData());
	}

	public static function getAllF()
	{

		$fecha = date('Y-m-d');
		$sql = "select * from " . self::$tablename . " where status = 'Active' and fecha='$fecha'";
		//$sql = "select a.id as id,a.fecha,b.name as id_linea,a.tren,a.modelo,a.motriz,d.name as evento,a.retardo,a.clasificacion,c.name as id_area from person1 a, category b, areas c, eventos d where   a.id_linea=b.id and a.id_area=c.id and a.evento=d.id";
		$query = Executor::doit($sql);
		return Model::many($query[0], new DocumentosData());
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
		return Model::many($query[0], new DocumentosData());
	}

	public static function getAllBy($k, $v)
	{
		$sql = "select * from " . self::$tablename . " where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::many($query[0], new DocumentosData());
	}


	public static function getLike($q)
	{
		$sql = "select * from " . self::$tablename . " where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0], new DocumentosData());
	}
}
