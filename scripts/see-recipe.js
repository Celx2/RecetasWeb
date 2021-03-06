"use strict"

$(document).ready(function(){

    var like_btn = document.getElementById("heart-btn");
    var div_like = document.querySelector(".like-btn");
    var like_counter = document.querySelector(".like-counter");

    div_like.addEventListener("click", function(){
        if(like_btn.classList.contains("far")){

            // Cambio la clase del corazón
            like_btn.classList.remove("far");
            like_btn.classList.add("fas");
            like_counter.classList.remove("off");
            like_counter.classList.add("on");
            window.location.replace("http://localhost/RecetasWeb/see-recipe.php?liked=true&ID=");
            //window.location.replace("https://concussive-wish.000webhostapp.com/see-recipe.php?liked=true&ID=");


        }
        else{
            // Función inversa
            like_btn.classList.remove("fas");
            like_btn.classList.add("far");
            like_counter.classList.remove("on");
            like_counter.classList.add("off");
            window.location.replace("http://localhost/RecetasWeb/see-recipe.php?liked=true&ID=");
            //window.location.replace("https://concussive-wish.000webhostapp.com/see-recipe.php?liked=true&ID=");

        }
    });

    $("nav").hover(function(){
        $(".sub-nav").fadeToggle("slow");        
        $(".sub-nav").css("display", "flex");
    },
                   function(){
        $(".sub-nav").css("display", "none");
    });

});