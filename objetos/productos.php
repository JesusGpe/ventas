<?php 
/**
 * 
 */
class Producto
{
	public  $id;
	public  $nombre;
	public  $descripcion;
	public  $precio;
	public  $precio_compra;
	public  $stock;
	public  $idcategoria;

	
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
	public function getPrecio() 
	{
		return $this->precio;
	}
	public function setPrecio($precio) 
	{
		$this->precio = $precio;
	}
	public function getPrecio_compra() 
	{
		return $this->precio_compra;
	}
	public function setPrecio_compra($precio_compra) 
	{
		$this->precio_compra = $precio_compra;
	}

	public function getStock() 
	{
		return $this->stock;
	}
	public function setStock($stock) 
	{
		$this->stock = $stock;
	}
	public function getIdcategoria() 
	{
		return $this->idcategoria;
	}
	public function setIdcategoria($idcategoria) 
	{
		$this->idcategoria = $idcategoria;
	}
	public function toString() 
	{
		return "Producto [id=" . $this->id . ", nombre=" . $this->nombre . ", descripcion=" . $this->descripcion. ", precio=" . $this->precio . ", precio_compra=" . $this->precio_compra . ", stock=" . $this->stock . ", idcategoria=" . $this->idcategoria ."]";
	}
}
 ?>