// let button = document.querySelector(".btnRecycle");
// let bookingbox = document.querySelector(".booking-popup");
// let close = document.querySelector(".close-popup");

// button.onclick = function () {
//   bookingbox.fadeIn().css("display","flex");
// }

// close.onclick = function(){
//   bookingbox.fadeOut();
// };
    
$(document).ready(function(){
    $(".btnRecycle").click(function(){
        $(".booking-popup").fadeIn().css("display","flex");
    });

    $(".close-popup").click(function(){
        $(".booking-popup").fadeOut();
    });
});