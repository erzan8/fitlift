$(document).ready(function () {
    $('#profils').click(function () {
    $(this).addClass('actif');
    $('#commandes').removeClass('actif');
    $('div.profils').slideToggle(600);
    $('div.commandes').css('display', 'none');
});
    $('#commandes').click(function () {
        $(this).addClass('actif');
        $('#profils').removeClass('actif');
    $('div.commandes').slideToggle(600);
    $('div.profils').css('display', 'none');
});
$('.modif').click(function () {
    $(this).siblings('div.modifications').slideToggle(300);
});
});