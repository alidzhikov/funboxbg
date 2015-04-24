/**
 * Created by Laptop on 5.4.2015 г..
 */
$(document).ready(function(){
$.each( $('.comment-votes-buttons'),function() {
    var unique_id = $(this).attr('id');
    var post_data = {'unique_id':unique_id,'vote':'fetch'};
    $.post('php/point_process.php', post_data,function(response){
        var classSelect;
        if(response.point >= 0){
            classSelect = "positive";
        }else{
            classSelect = "negative";
        }

        $('#'+unique_id+' .show_points').text(response.point);
        $('#'+unique_id+' .show_points').addClass(classSelect);
    },'json')
})
});


$('.comment-votes-buttons li').click(function(e){

    var clicked_button = $(this).attr('class');
    var unique_id = $(this).parent().attr('id');

    if(clicked_button == "point_up"){
        var post_data = {'unique_id':unique_id,'vote':'up'};
        $.post('php/point_process.php',post_data,function(data){
            $('#'+unique_id+' .show_points').text(data);
        })

    }else if(clicked_button == "point_down"){
        var post_data = {'unique_id':unique_id,'vote':'down' };
        $.post('php/point_process.php',post_data,function(data){
            $('#'+unique_id+' .show_points').text(data);

        })
    }


});
