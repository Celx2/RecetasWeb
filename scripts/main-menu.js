"use strict"

$(document).ready(function(){

    var like_btn = document.getElementById("heart-btn");
    var div_like = document.querySelector(".like-btn");
    var like_counter = document.querySelector(".like-counter");


    $("nav").hover(function(){
        $(".sub-nav").fadeToggle("slow");        
        $(".sub-nav").css("display", "flex");
    },
                   function(){
        $(".sub-nav").css("display", "none");
    });
    
    div_like.addEventListener("click", function(){
        if(like_btn.classList.contains("far")){

            // Cambio la clase del corazón
            like_btn.classList.remove("far");
            like_btn.classList.add("fas");

            // Sumo un like al contador y cambio de color el número
            var like_number = Number(like_counter.textContent);
            like_counter.textContent = like_number + 1;
            like_counter.classList.remove("off");
            like_counter.classList.add("on");
           


        }
        else{
            // Función inversa

            like_btn.classList.remove("fas");
            like_btn.classList.add("far");

            var like_number = Number(like_counter.textContent);
            like_counter.textContent = like_number - 1; 
            like_counter.classList.remove("on");
            like_counter.classList.add("off");

            
        }
    });

});