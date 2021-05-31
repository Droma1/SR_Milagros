$(document).ready(function(){
    if($(".head_home").width()>768){
        $(".enlaces").slideDown(200);
    }else{
        $(".enlaces").slideUp(200);
    }
    var temp = 0;
    $('.btn-menu').click(function(){
        temp ++;
        if($(".head_home").width()>768){
            $(".enlaces").slideDown(200);
        }else{
            if(temp%2 ==0){
                $(".enlaces").slideUp(200);
            }else{
                $(".enlaces").slideDown(200);
            }
        }
    });
    $("#eye2").hide();
    $("#text_eye2").hide();

    $("#eye").click(function(){
        $("#pass").prop("type","text");
        $(this).hide();
        $("#text_eye").hide();
        $("#eye2").show();
        $("#text_eye2").show();
    });
    $("#eye2").click(function(){
        $("#pass").prop("type","password");
        $(this).hide();
        $("#text_eye2").hide();
        $("#eye").show();
        $("#text_eye").show();
    });
});