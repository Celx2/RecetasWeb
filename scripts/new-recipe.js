"use strict"

$(document).ready(function(){

    var save_btn = $("#new-recipe-submit");
    var name = $(".new-recipe-name input");
    var ingredients = $(".new-recipe-ingredients input");
    var preparation = $(".new-recipe-preparation textarea");

    save_btn.hide();

    var interval = setInterval(function(){

        var name_content = document.forms["form1"]["recipe-name"].value;
        var ingredients_content = document.forms["form1"]["recipe-ingredients"].value;
        var preparation_content = document.forms["form1"]["recipe-preparation"].value;

        if (name_content == "" || ingredients_content == "" || preparation_content == ""){
            save_btn.fadeOut("slow");
        }
        else{
            save_btn.fadeIn("slow");
        }  
          
    }, 400);

    $("nav").hover(function(){
        $(".sub-nav").fadeToggle("slow");        
        $(".sub-nav").css("display", "flex");
    },
                   function(){
        $(".sub-nav").css("display", "none");
    });

});