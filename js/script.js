"use strict";

$(document.ready(function(){
    $("input[name$='pav1']").click(function(){
        var radio_value = $(this).is(':checked');
        if(radio_value) {
            $("#naujas").show("slow");
        }
    });
}));

// $("[value='naujas']").click(function() {
//     $(".naujas").show()
//   });