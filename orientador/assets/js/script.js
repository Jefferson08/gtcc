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

function lerNotificacao(id_notificacao){  //Requisição para atualizar a notificação para lida
	$.ajax({
		url:'http://projeto.pc/orientador/ajax/lerNotificacao/',
		type:'POST',
		data:{id_notificacao:id_notificacao},
		dataType:'json'
	});
}

$(function(){ 

	//Requisição pra pegar e mostrar as notificações

	$.ajax({
		url:'http://projeto.pc/orientador/ajax/getNotificacoes/',
		type:'POST',
		dataType:'json',
		success:function(json){

			var dropdown = $('#notificacoes_orientador').parent();

			var badge = $('#badge');

			var lista = "";

			$(badge).html(json.qtd);

			if (json.qtd > 0) {
				lista = '<div class="dropdown-menu dropdown-menu-right"><hr style="margin-top: 0; margin-bottom: 0">';

				$.each( json.notificacoes, function( key, notificacao ) {
				  	lista += '<a href="'+notificacao.link+'" class="dropdown-item h5" onclick="lerNotificacao('+notificacao.id+')">'+notificacao.texto+'</a>';
				});

				lista += '</div>';

				$(dropdown).append(lista);

			} 
	
		}
	});

});