(function($){
  $(function(){

    $('.sidenav').sidenav();

  }); // end of document ready
})(jQuery); // end of jQuery name space

$('#slider').slick({
  infinite: true,
  dots : true,
  appendArrows: '#slider-arrows',
  appendDots: '#slider-dots',
  prevArrow:'<button type="button" class="slick-prev"><img src="img/fleche-gauche.png"></button>',
  nextArrow:'<button type="button" class="slick-next"><img src="img/fleche-droite.png"></button>'
});
