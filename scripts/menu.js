$(document).ready(function () {
    $('.wrapper-menu').click(function () {
    $('nav').fadeToggle(600);

});
    $('.wrapper-menu').click(function(){
        $(this).toggleClass('open');
    });
    $('img.avatar').click(function(){
        $('div.connexion').fadeIn(400).css('visibility','visible');
    });
    $('img.close').click(function(){
        $('div.connexion').fadeOut(400).toggleClass('display');
    });

});


