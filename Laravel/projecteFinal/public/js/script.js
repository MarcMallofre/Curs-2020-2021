

//Evento click que muestra el formulario de saludo
$('#showSaluda').click(function() {
    $('#saluda').show();
    $('#fons').show();
});

//Evento click en el boton de cerrar que esconde el formulario de saludo
$('#hideSaluda').click(function() {
    $('#saluda').hide();
    $('#fons').hide();
});

//Evento click en el fondo que esconde el formulario de saludo
$('#fons').click(function() {
    $('#saluda').hide();
    $('#fons').hide();
});

//Carrusel
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}

//Evento click para abrir el proyecto y esconder los demas.
$('.abrirProyecto').click(function() {
  $id=$(this).attr('id');
  for(i=0; i<$('.infoProyecto').length; i++){
    $('.infoProyecto').hide();
  }

  $('#info'+$id).toggle();
 
});

