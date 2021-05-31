<label>la grabedad de su delito es:".$gravedad."</label>
<br>
<label>Las recomendaciones son: ".$recomendacion."</label>
<br>
<?php
	if($peticionAjax){
		require_once "../Config/configDB.php";
	}else{
		require_once "./Config/configDB.php";
	}
	
class mainModel{
		protected function conectar(){
			try{
				$link = new PDO(SGBD,USER,PASS);
			}catch (Exeption $e){
                echo "Error al conectar a la base de datos error: ".$e;
                //sleep(10000);
			}
			return $link;
		}
		protected function consulta_simple($consulta){
			$respuesta = self::conectar()->prepare($consulta);
            $respuesta->execute();
            //echo var_dump($respuesta);
            //sleep(50);   
			return $respuesta;
		}
		protected function encryption($string){
			$pass = password_hash($string,PASSWORD_DEFAULT,['cost'=>12]);
			return $pass;
		}
		protected function verify($string,$data){
			$pass = password_verify($string,$data);
			return $pass;
		}
		protected function clear_string($cadena){
			$cadena = trim($cadena);
            $cadena = stripcslashes($cadena);
            $cadena = str_ireplace("<script>","",$cadena);
            $cadena = str_ireplace("</script>","",$cadena);
            $cadena = str_ireplace("<script src","",$cadena);
            $cadena = str_ireplace("<script type=","",$cadena);
            $cadena = str_ireplace("SELECT * FROM","",$cadena);
            $cadena = str_ireplace("DELETE FROM","",$cadena);
            $cadena = str_ireplace("INSERT INTO","",$cadena);
            $cadena = str_ireplace("--","",$cadena);
            $cadena = str_ireplace("^","",$cadena);
            $cadena = str_ireplace("[","",$cadena);
            $cadena = str_ireplace("]","",$cadena);
			$cadena = str_ireplace("==","",$cadena);
			$cadena = str_ireplace("=","",$cadena);

            return $cadena;
		}
		/*protected function agregar_producto($datos){
			$sql = self::conectar()->prepare("");
			$sql->bindParam(":Codigo",$datos['Codigo']);
			$sql->bindParam(":Privilegio",$datos['Privilegio']);
			$sql->bindParam(":Usuario",$datos['Usuario']);
			$sql->bindParam(":Clave",$datos['Clave']);
			$sql->bindParam(":Email",$datos['Email']);
			$sql->bindParam(":Estado",$datos['Estado']);
			$sql->bindParam(":Tipo",$datos['Tipo']);
			$sql->bindParam(":Genero",$datos['Genero']);
			$sql->bindParam(":Foto",$datos['Foto']);

			$sql->execute();

			return $sql;

		}*/
		protected function alerts($datos){
			if($datos['Alerta']=="simple"){
				$alerta = "
				<div class='alert alert-".$datos['clase']." alert-dismissible'>
						<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
					<strong>".$datos['tipo']."</strong> <h6>".$datos['titulo']."</h6><p>".$datos['texto']."</p>
				</div>
				<script>console.log('".$datos['tipo']."-".$datos['titulo']."-".$datos['texto']."');</script>
				";
			}/*elseif ($datos['Alerta']=="recargar") {
				
				$alerta = "
					<script>
						alert({
							title'".$datos['titulo']."',
							text:'".$datos['texto']."',
							type:'".$datos['tipo']."',
							confirmButtonText:'Aceptar'
						}).then(function(){
							location.reload();
							});
					</script>
				";
			}elseif ($datos['Alerta']=="limpiar") {
				$alerta = "
					<script>
						swal({
							title'".$datos['titulo']."',
							text:'".$datos['texto']."',
							type:'".$datos['tipo']."',
							confirmButtonText:'Aceptar'
						}).then(function(){
							$('.formAjax')[0].reset();
							});
					</script>
				";
			}*/
			return $alerta;
		}

    }
    //echo "documento main";
?>