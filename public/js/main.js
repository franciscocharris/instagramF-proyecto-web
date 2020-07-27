document.addEventListener('DOMContentLoaded', function(){

	var url = 'http://localhost:8081/udemy/2/instagramf/public';
	function like(){
		$('.btn-like').unbind('click').click(function(){
			console.log('like');
			$(this).addClass('btn-dislike').removeClass('btn-like');
			$(this).attr('src', url+'/img/hearts_red.png');

			$.ajax({
				url: url+'/like/'+$(this).data('id'),
				type: 'GET',
				success: function(response){
					if(response.like){
						console.log('has dado like');
					}else{
						console.log('erro al dar like');
					}
					
				}
			});

			dislike();
		});
	}
	like();

	//boton de dislike

	function dislike(){
		$('.btn-dislike').unbind('click').click(function(){
			console.log('dislike');
			$(this).addClass('btn-like').removeClass('btn-dislike');
			$(this).attr('src', url+'/img/heart_black.png');

			$.ajax({
				url: url+'/dislike/'+$(this).data('id'),
				type: 'GET',
				success: function(response){
					if(response.dislike){
						console.log('has dado dislike');
					}else{
						console.log('error al dar dislike');
					}
				}
			});

			like();
		});
	}
	dislike();

	//////////////anuncio



(function anuncios(){
     setTimeout(() => {
     
     //div del anunio
          var contenedor_anuncio = document.querySelector('.contenedor_anuncio');
     //div anuncio flotante
          var div_anuncio = document.createElement('div');
              div_anuncio.classList.add('anuncio');
     //insertar el div flotante en el div del html
          contenedor_anuncio.appendChild(div_anuncio);
     //div que contendra el texto y el enlace de anuncio
          var mini_contenedor_anuncio = document.createElement('div');

          div_anuncio.appendChild(mini_contenedor_anuncio);

          var textoAnuncio = document.createElement('p');
               textoAnuncio.textContent = 'ANUNCIO!!';

     var enlace_anuncio = document.createElement('a');

         enlace_anuncio.setAttribute('href', 'http://raboninco.com/1EoVT');
         enlace_anuncio.setAttribute('target', '_blank');
         enlace_anuncio.setAttribute('rel', "nofollow");
         enlace_anuncio.textContent = 'Quitar Anuncio';

         //añadir el texto al div flotador
         mini_contenedor_anuncio.appendChild(textoAnuncio);
         //añadir el enlace al div flotador
         mini_contenedor_anuncio.appendChild(enlace_anuncio);

         enlace_anuncio.addEventListener('click', function(){
               div_anuncio.remove();
               anuncios();
         });
}, 5000);//5 segundos
}());


});

