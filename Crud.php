<?php
    include('Conexion.php');
    class Crud extends DB
    {
        private $_TablaPrincipal="";
        public function R($tabla,$nomb,$where)
        {
            $nombre="";
            foreach ($nomb as $key => $value) {
                if($nombre!=""){
                    $nombre.=",".$key." AS '".$value."'";
                }else{
                    $nombre.=$key." AS '".$value."'";
                }
            }

            $tablaToltal="";
            $keyfix="";
            $valuefix="";
            if(is_array($tabla)){
                foreach ($tabla as $key => $value) {
                    $valuefix=explode("/", $value);
                    if($tablaToltal==""){
                        $keyfix=explode("/", $key);
                        $this->_TablaPrincipal=$keyfix;
                        $tablaToltal.=$keyfix[0]." INNER JOIN".$valuefix[0]." ON ".$keyfix[0].".".$keyfix[1]."=".$valuefix[0].".".$valuefix[1];
                    }else{
                        $tablaToltal.=" INNER JOIN".$valuefix[0]." ON ".$this->_TablaPrincipal[0].".".$key."=".$valuefix[0].".".$valuefix[1];
                    }
                }
            }else{
                $tablaToltal=$tabla;
            }

            $consulta = $this->prepare("SELECT $nombre FROM $tablaToltal WHERE $where");            
            $consulta->execute();
            return $registro = $consulta->fetch();

        }
    }
    
?>