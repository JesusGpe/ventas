<?php 
/**
 * 
 */
class Categoria
{
	public  $id;
	public  $nombre;
	public  $descripcion;
	
	public function getId() 
	{
		return $this->id;
	}
	public function setId($id) 
	{
		$this->id = $id;
	}
	public function getNombre() 
	{
		return $this->nombre;
	}
	public function setNombre($nombre) 
	{
		$this->nombre = $nombre;
	}
	public function getDescripcion() 
	{
		return $this->descripcion;
	}
	public function setDescripcion($descripcion) 
	{
		$this->descripcion = $descripcion;
	}
	
	public function toString() 
	{
		return "Usuario [id=" . $this->id . ", nombre=" . $this->nombre . ", descripcion=" . $this->descripcion . "]";
	}
}
 ?>