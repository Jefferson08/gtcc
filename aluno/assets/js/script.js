$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});


$('#adicionarAluno').bind('click', function(e){
	e.preventDefault();
	var ra = $('#ra').val();
	
	if (ra == "") {
		alert("Digite o RA do aluno para adicionar!!!");
	} else {
		$.ajax({
			url:'http://projeto.pc/aluno/ajax/verificaAluno/',
			type:'POST',
			data:{ra:ra},
			dataType:'json',
			success:function(json){

				if (json.length == 0) {
					alert("Aluno não encontrado!!!");
					$('#ra').val('');
				}else{
					addAluno(json.id, json.nome, json.qtdMax);
					$('#ra').val('');
				}
				
			},
			error:function(erro){
				alert("ERRO");
				console.log(erro);
			}
		});
	}

});


function addAluno(id, nome, qtdMax){

	var tr = $('#alunos tr').length;

	if (tr > qtdMax) {
		alert("Quantidade máxima de alunos atingida!!!");
	} else {
		
		var novalinha = '<tr> <th scope="row">'+id+'</th> <td>'+nome+'</td> <td> <button class="btn btn-danger" onclick="remove(this)">Excluir</button> </td> <input type="hidden" name="autores[]" value="'+id+'"> </tr>'

		$('#alunos').append(novalinha);
	}
	
}

remove = function(item){

	tr = $(item).closest('tr');
	tr.remove();

	return false;
}

function lerNotificacao(id_notificacao){
	$.ajax({
		url:'http://projeto.pc/aluno/ajax/lerNotificacao/',
		type:'POST',
		data:{id_notificacao:id_notificacao},
		dataType:'json'
	});
}

$(function(){

	$.ajax({
		url:'http://projeto.pc/aluno/ajax/getNotificacoes/',
		type:'POST',
		dataType:'json',
		success:function(json){

			var dropdown = $('#notificacoes_aluno').parent();

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