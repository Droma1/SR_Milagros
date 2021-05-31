$(document).ready(function(){
    $('.formAjax2').submit(function(e){
        //alert("enviando formulario");
        e.preventDefault();
    
        var form=$(this);
    
        var tipo=form.attr('data-form');
        var accion=form.attr('action');
        var metodo=form.attr('method');
        var respuesta=form.children('.RespuestaAjax2');
    
        var msjError="<script>alert('Ocurrió un error inesperado','Por favor recargue la página','error');</script>";
        var formdata = new FormData(this);
    
    
        var textoAlerta;
        if(tipo==="save"){
            textoAlerta="Los datos que enviaras quedaran almacenados en el sistema";
        }else if(tipo==="delete"){
            textoAlerta="Los datos serán eliminados completamente del sistema";
        }else if(tipo==="update"){
            textoAlerta="Los datos del sistema serán actualizados";
        }else{
            textoAlerta="Quieres realizar la operación solicitada";
        }
    
        $.ajax({
                type: metodo,
                url: accion,
                data: formdata ? formdata : form.serialize(),
                cache: false,
                contentType: false,
                processData: false,
                xhr: function(){
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        if(percentComplete<100){
                            //sleep(200);
                            respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                        }else{
                            respuesta.html('<p class="text-center"></p>');
                        }
                      }
                    }, false);
                    return xhr;
                },
                success: function (data) {
                    respuesta.html(data);
                },
                error: function() {
                    respuesta.html(msjError);
                }
            });
        /*swal({
            title: "¿Estás seguro?",   
            text: textoAlerta,   
            type: "question",   
            showCancelButton: true,     
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar"
        }).then(function () {
            
            return false;
        });*/
    });
    $('.formAjax').submit(function(e){
        e.preventDefault();
    
        var form=$(this);
    
        var tipo=form.attr('data-form');
        var accion=form.attr('action');
        var metodo=form.attr('method');
        var respuesta=form.children('.RespuestaAjax');
    
        var msjError="<script>alert('Ocurrió un error inesperado','Por favor recargue la página','error');</script>";
        var formdata = new FormData(this);
    
    
        var textoAlerta;
        if(tipo==="save"){
            textoAlerta="Los datos que enviaras quedaran almacenados en el sistema";
        }else if(tipo==="delete"){
            textoAlerta="Los datos serán eliminados completamente del sistema";
        }else if(tipo==="update"){
            textoAlerta="Los datos del sistema serán actualizados";
        }else{
            textoAlerta="Quieres realizar la operación solicitada";
        }
    
        $.ajax({
                type: metodo,
                url: accion,
                data: formdata ? formdata : form.serialize(),
                cache: false,
                contentType: false,
                processData: false,
                xhr: function(){
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        if(percentComplete<100){
                            respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                        }else{
                            respuesta.html('<p class="text-center"></p>');
                        }
                      }
                    }, false);
                    return xhr;
                },
                success: function (data) {
                    respuesta.html(data);
                },
                error: function() {
                    respuesta.html(msjError);
                }
            });
    
            
    
    });
    function readPdf (input) {
        //console.log(input);
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#view_pdf').attr('src', e.target.result); // Renderizamos la imagen
              
          }
          reader.readAsDataURL(input.files[0]);
        }
      }
    
      $("#PdfInp").change(function () {
        // Código a ejecutar cuando se detecta un cambio de archivO
        //alert("changes pdf");
        readPdf(this);
      });
});
