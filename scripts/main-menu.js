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
});