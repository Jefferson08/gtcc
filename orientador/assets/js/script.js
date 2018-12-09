$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

function adicionarComentario(id_trabalho, id_evento, botao){

	event.preventDefault();

	var text = $(botao).prev().prev();

	text = $(text).val();

	if (text == "") {
		alert("Escreva um comentário!!!");
	} else {

		$.ajax({
			url:'http://projeto.pc/orientador/ajax/adicionarComentario/',
			type:'POST',
			data:{
				id_trabalho:id_trabalho,
				id_evento:id_evento,
				comentario:text
			},
			dataType:'json',
			success:function(json){

				var card = $(botao).prev().prev().prev();

				var comment = '<div class="card"><div class="card-header">'+json.nome+', em '+json.data_envio+'</div><div class="card-body">'+json.comentario+'</div></div><hr>';

				card.prepend(comment);
				
			}
			
		});
	}

}