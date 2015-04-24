/**
 * Created by Laptop on 7.4.2015 г..

(function(){
    $('.sub_comment').hide();
})();
 */
$(document).ready(function(){
    $('.sub_comment').hide();
    /** category change */
    $('#categories li').on("click", function(){
        var idOfLi = $(this).attr('id');
        getPics(idOfLi);
    });

});
function getPics(category){
    $.post("php/getPics.php", {cat_id: category},function(pics){

    })
}

function show_send_button(item){
    $(item).click(function(){
        $('.sub_comment').show();
    });
}

$('#categories li').on("click",function(){
   var idOfLi = $(this).attr('id');

});
/*$(document).ready($('#categories li').on("click",function(){
    $(this).fadein({background-color: "#1cca13"},2500);

}).mouseleave(function(){
    $(this).animate({background: "#1cca13"},2500);
}));*/
