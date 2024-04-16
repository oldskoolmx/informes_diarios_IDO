<?php
class ClasificacionesData
{
	public static $tablename = "clasificaciones";

	public function __construct()
	{
		$this->name = "";
		$this->lastname = "";
		$this->username = "";
		$this->email = "";
		$this->password = "";
		$this->created_at = "NOW()";
	}

	public function getItem()
	{
		return AreasturData::getById($this->client_id);
	}
	public function add()
	{

		$prueba = Core::$user->id;
		$sql = "insert into " . self::$tablename . " (name,client_id,id_username,created_at) ";
		$sql .= "value (\"$this->name\",\"$this->client_id\",\"$prueba\",$this->created_at)";
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
		$sql = "update " . self::$tablename . " set name=\"$this->name\" where id=$this->id";
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
		return Model::one($query[0], new ClasificacionesData());
	}

	public static function getBy($k, $v)
	{
		$sql = "select * from " . self::$tablename . " where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::one($query[0], new ClasificacionesData());
	}

	public static function getAll()
	{
		$sql = "select * from " . self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0], new ClasificacionesData());
	}


	public static function getAllByClient($id)
	{
		$sql = "select * from " . self::$tablename . " where client_id=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0], new ClasificacionesData());
	}

	public static function getAllBy($k, $v)
	{
		$sql = "select * from " . self::$tablename . " where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::many($query[0], new ClasificacionesData());
	}


	public static function getLike($q)
	{
		$sql = "select * from " . self::$tablename . " where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0], new ClasificacionesData());
	}
}
