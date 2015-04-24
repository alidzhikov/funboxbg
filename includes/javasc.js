/**
 * Created by Laptop on 17.3.2015 г..
 */
$(document).ready(function () {
    var url = document.location.href.match(/[^\/]+$/)[0];
    $('ol a[href="'+url+'"]').addClass('selected');
});

function selectedMenu() {
    $('.selected').removeClass('selected');
    $(this).addClass('selected');

}
$('#menu-selected').on('click','li',selectedMenu);