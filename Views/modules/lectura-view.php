<?php 


if(isset($_SESSION['tipo_user'])){
    $descarga = 1;
}else{
    $descarga =0;
}
if(isset($_POST['producto'])){
            require_once "./Controller/recursoController.php";
            $recurso = new recursoController();
            $recurso_ = $recurso->view_recurso($_POST['producto']);
            $dato_recurso = (array) $recurso_->fetch();
            
            if($descarga==1){
                $descarga = "<a class='btn btn-success' target='_blank' href='".URL."scripts/doc/".$dato_recurso[3]."'>Descargar Archivo</a>";
                }else{
                    $descarga = "";
                }
 ?>
            <section class="content">
            <div id="pdf_lector" style="height:400px;">
                            <object width="100%" height="100%" type="application/pdf" data="./scripts/doc/<?php echo $dato_recurso[3];?>#toolbar=0" id="pdf_content"><p>Document load was not successful.</p></object>
                        </div>
                <div class="container">
                                <div class="form-group">
                                    <h4>Titulo: <?php echo $dato_recurso[5];?></h4>
                                    <?php echo $descarga;?>
                                    <h5>Publicado por: <?php echo $dato_recurso[0]."  ".$dato_recurso[1];?></h5>
                                    <p>Fecha: <?php echo $dato_recurso[6];?></p>
                                    <label for="">Grado: <?php echo $dato_recurso[4];?></label>
                                    <p>Para el curso de: <?php echo $dato_recurso[2];?></p>
                                </div>
                            </div>
            </section>            
<?php }?>
