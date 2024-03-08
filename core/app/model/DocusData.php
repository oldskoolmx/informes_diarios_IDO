<?php
class DocusData
{
	public static $tablename = "documentos";

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



		$sql = "insert into " . self::$tablename . " (r_n_oficio,r_f_e_oficio,r_f_r_oficio,r_f_atencion,r_solicitud,r_filename,r_short_name,d_n_registro,d_n_folio,d_f_compromiso,d_instrucciones,filename,short_name,id_usuario,id_estado,created_at,activo) ";
		$sql .= "value (\"$this->r_n_oficio\",\"$this->r_f_e_oficio\",\"$this->r_f_r_oficio	\",\"$this->r_f_atencion\",\"$this->r_solicitud\",\"$this->r_filename\",\"$this->r_short_name\",\"$this->d_n_registro\",\"$this->d_n_folio\",\"$this->d_f_compromiso\",\"$this->d_instrucciones\",\"$this->filename\",\"$this->short_name\",1,1,$this->created_at,1)";
		Executor::doit($sql);
	}

	public function del()
	{
		//$sql = "delete from " . self::$tablename . " where id=$this->id";
		//$status = 0;
		//$sql = "update " . self::$tablename . " set activo=\"$status\" where id=$this->id";
		$sql = "update " . self::$tablename . " set activo=0 where id=$this->id";
		Executor::doit($sql);
	}

	public static function delBy($k, $v)
	{
		$sql = "delete from " . self::$tablename . " where $k=\"$v\"";
		Executor::doit($sql);
	}

	public function update()
	{
		//$sql = "update " . self::$tablename . " set r_n_oficio=\"$this->r_n_oficio\",r_f_e_oficio=\"$this->r_f_e_oficio\",r_f_r_oficio=\"$this->r_f_r_oficio\",r_f_atencion=\"$this->r_f_atencion\",r_solicitud=\"$this->r_solicitud\",r_filename=\"$this->r_filename\",r_short_name=\"$this->r_short_name\",$this->updated_at where id=$this->id";
		$update = date("Y-m-d H:i:s");
		$sql = "update " . self::$tablename . " set r_n_oficio=\"$this->r_n_oficio\",r_f_e_oficio=\"$this->r_f_e_oficio\",r_f_r_oficio=\"$this->r_f_r_oficio\",r_f_atencion=\"$this->r_f_atencion\",r_solicitud=\"$this->r_solicitud\",r_filename=\"$this->r_filename\",r_short_name=\"$this->r_short_name\",d_n_registro=\"$this->d_n_registro\",d_n_folio=\"$this->d_n_folio\",d_f_compromiso=\"$this->d_f_compromiso\",d_instrucciones=\"$this->d_instrucciones\",id_estado=\"$this->id_estado\",filename=\"$this->filename\",short_name=\"$this->short_name\",updated_at=\"$update\" where id=$this->id";
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
		return Model::one($query[0], new DocusData());
	}

	public static function getBy($k, $v)
	{
		$sql = "select * from " . self::$tablename . " where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::one($query[0], new DocusData());
	}

	public static function getByDate($date)
	{
		$sql = "select count(*) as cnt from " . self::$tablename . " where id_estado = 2 and date(created_at)= \"$date\"";
		$query = Executor::doit($sql);
		return Model::one($query[0], new DocusData());
	}





	public static function getAll()
	{
		$sql = "select * from " . self::$tablename . " where activo = 1";
		$query = Executor::doit($sql);
		return Model::many($query[0], new DocusData());
	}

	/* public static function getAllToDay()
	{
		$fecha_hoy = date("Y-m-d");
		$sql = "select * from " . self::$tablename . "where DATE(created_at) = '$fecha_hoy'";
		$query = Executor::doit($sql);
		return Model::many($query[0], new DocusData());
	} */


	public static function getAllToDay()
	{
		//date(created_at)= \"$date\"
		$fecha_hoy = date("Y-m-d");
		//$fecha_hoy = "2024-02-09";

		$sql = "SELECT * FROM " . self::$tablename . " WHERE date(created_at) = \"$fecha_hoy\"";
		$query = Executor::doit($sql);
		return Model::many($query[0], new DocusData());
	}

	// funcion para mostrar todos los pendientes 
	public static function getAllP()
	{
		$sql = "select * from " . self::$tablename . " where id_estado = 1 and activo = 1";
		//$sql = "select a.id as id,a.fecha,b.name as id_linea,a.tren,a.modelo,a.motriz,d.name as evento,a.retardo,a.clasificacion,c.name as id_area from person1 a, category b, areas c, eventos d where a.id_linea=b.id and a.id_area=c.id and a.evento=d.id";
		$query = Executor::doit($sql);
		return Model::many($query[0], new DocusData());
	}
	public static function getAllC()
	{
		$sql = "select * from " . self::$tablename . " where id_estado = 4";
		//$sql = "select a.id as id,a.fecha,b.name as id_linea,a.tren,a.modelo,a.motriz,d.name as evento,a.retardo,a.clasificacion,c.name as id_area from person1 a, category b, areas c, eventos d where a.id_linea=b.id and a.id_area=c.id and a.evento=d.id";
		$query = Executor::doit($sql);
		return Model::many($query[0], new DocusData());
	}
	public static function getAllPre()
	{
		$sql = "select * from " . self::$tablename . " where id_estado = 5 and activo = 1";
		//$sql = "select a.id as id,a.fecha,b.name as id_linea,a.tren,a.modelo,a.motriz,d.name as evento,a.retardo,a.clasificacion,c.name as id_area from person1 a, category b, areas c, eventos d where a.id_linea=b.id and a.id_area=c.id and a.evento=d.id";
		$query = Executor::doit($sql);
		return Model::many($query[0], new DocusData());
	}
	// funcion para mostrar todos los atendidos 
	public static function getAllA()
	{
		$sql = "select * from " . self::$tablename . " where id_estado = 2 and activo = 1";
		//$sql = "select a.id as id,a.fecha,b.name as id_linea,a.tren,a.modelo,a.motriz,d.name as evento,a.retardo,a.clasificacion,c.name as id_area from person1 a, category b, areas c, eventos d where a.id_linea=b.id and a.id_area=c.id and a.evento=d.id";
		$query = Executor::doit($sql);
		return Model::many($query[0], new DocusData());
	}
	// funcion para mostrar todos los sin atender 
	public static function getAllS()
	{
		$sql = "select * from " . self::$tablename . " where id_estado = 3";
		//$sql = "select a.id as id,a.fecha,b.name as id_linea,a.tren,a.modelo,a.motriz,d.name as evento,a.retardo,a.clasificacion,c.name as id_area from person1 a, category b, areas c, eventos d where a.id_linea=b.id and a.id_area=c.id and a.evento=d.id";
		$query = Executor::doit($sql);
		return Model::many($query[0], new DocusData());
	}

	public static function getAllF()
	{

		$fecha = date('Y-m-d');
		$sql = "select * from " . self::$tablename . " where status = 'Active' and fecha='$fecha'";
		//$sql = "select a.id as id,a.fecha,b.name as id_linea,a.tren,a.modelo,a.motriz,d.name as evento,a.retardo,a.clasificacion,c.name as id_area from person1 a, category b, areas c, eventos d where   a.id_linea=b.id and a.id_area=c.id and a.evento=d.id";
		$query = Executor::doit($sql);
		return Model::many($query[0], new DocusData());
	}



	public static function getAllBy($k, $v)
	{
		$sql = "select * from " . self::$tablename . " where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::many($query[0], new DocusData());
	}


	public static function getLike($q)
	{
		$sql = "select * from " . self::$tablename . " where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0], new DocusData());
	}
}
