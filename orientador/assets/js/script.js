$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

function adicionarComentario(id_trabalho, id_evento, botao){

	event.preventDefault();

	var text = $(botao).prev().prev();

	var card = $(botao).prev().prev().prev();

	card.prepend('<h1>novo comentario</h1>');

}