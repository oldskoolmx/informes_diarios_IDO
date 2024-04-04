<?php
class IdoAllData
{
	public static $tablename = "idos";

	public function __construct()
	{
		$this->name = "";
		$this->lastname = "";
		$this->username = "";
		$this->email = "";
		$this->password = "";
		$this->created_at = "NOW()";
	}

	public function add()
	{
		$clasi = "SC";
		$estado = 1;
		$activo = 1;
		$prueba = Core::$user->id;
		$sql = "insert into " . self::$tablename . " (linea,hora,descripcion,retardo,fecha,clasificacion,created_at,id_usuario,id_estado,activo) ";
		$sql .= "value (\"$this->linea\",\"$this->hora\",\"$this->descripcion\",\"$this->retardo\",\"$this->fecha\",\"$clasi\",$this->created_at,\"$prueba\",\"$estado\",\"$activo\")";
		Executor::doit($sql);
	}

	public function del()
	{
		$sql = "delete from " . self::$tablename . " where id=$this->id";
		Executor::doit($sql);
	}

	public static function delBy($k, $v)
	{
		$sql = "delete from " . self::$tablename . " where $k=\"$v\"";
		Executor::doit($sql);
	}

	public function update()
	{
		$sql = "update " . self::$tablename . " set clasificacion=\"$this->clasificacion\" where id=$this->id";
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
		$sql = "select * from " . self::$tablename . " where id='$id'";
		$query = Executor::doit($sql);
		return Model::one($query[0], new IdoAllData());
	}

	public static function getBy($k, $v)
	{
		$sql = "select * from " . self::$tablename . " where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::one($query[0], new IdoAllData());
	}

	public static function getAll()
	{
		$sql = "select * from " . self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0], new IdoAllData());
	}

	public static function getByFecha($fecha)
	{
		$sql = "select * from " . self::$tablename . " where fecha='$fecha'";
		$query = Executor::doit($sql);
		//return Model::one($query[0], new IdoAllData());
		return Model::many($query[0], new IdoAllData());
	}
	public static function getAllBy($k, $v)
	{
		$sql = "select * from " . self::$tablename . " where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::many($query[0], new IdoAllData());
	}


	public static function getLike($q)
	{
		$sql = "select * from " . self::$tablename . " where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0], new IdoAllData());
	}
}
