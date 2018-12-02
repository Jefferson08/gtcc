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
