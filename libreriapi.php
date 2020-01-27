<?php
    include('Conexion.php');
    class Crud extends Conexion
    {
        public function Select()
        {
            $consulta = $this->prepare('SELECT nombre, descripcion FROM ' . self::TABLA . ' WHERE id = :id');
            $consulta->bindParam(':id', $id);
            $consulta->execute();
            $registro = $consulta->fetch();
            if($registro){
                return new self($registro['nombre'], $registro['descripcion'], $id);
            }else{
                return false;
            }
        }
    }
    
?>