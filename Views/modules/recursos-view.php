<?php
    require_once "./Controller/recursoController.php";
    $name = new recursoController();
    $recursos_ = $name->lista_recurso_p();
    //echo $_SESSION["tipo_user"];
    //echo var_dump($name_view); 
?>
<section class="content">
    <div class="container">
        <br>
        <div class="row">
            <nav class="navbar">
                    <form action="search" method="POST">
                        <div class="form-group box_search">
                            <select name="grado" id="" class="options">
                                <option value="0">Todos</option>
                                <option value="1">1er Grado</option>
                                <option value="2">2do Grado</option>
                                <option value="3">3er Grado</option>
                                <option value="4">4to Grado</option>
                                <option value="5">5to Grado</option>
                            </select>
                            <input type="text" name="texto" id="" class="text_search">
                            <button type="submit" class="btn_search"><span class="icon-search"></span></button>
                        </div>
                    </form>
            </nav>
        </div>
        <div class="row">
            <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php while($datos = $recursos_->fetch()){?>
                <div class="col">
                    <div class="card h-100">
                        <span class="card-img-top icon-file-pdf" style="font-size:200px; text-align:center;"></span>
                    <div class="card-body">
                            <form action="lectura" method="POST">
                            <input type="text" style="display:none;" name="tipe_user" value="<?php $_SESSION['tipo_user']; ?>">
                            <input type="text" style="display:none;" name="producto" value="<?php echo $datos[9];?>">
                                <button class="link" type="submit" style="border:none;background:transparent;" >
                                    <h5 class="card-title"><?php echo $datos[5]; ?></h5>
                                </button>
                            </form>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">publicado el: <?php echo $datos[6];?></small>
                    </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>