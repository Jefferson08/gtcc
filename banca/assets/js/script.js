$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});


$('#adicionarAluno').bind('click', function(e){
	e.preventDefault();
	var ra = $('#ra').val();
	
	$.ajax({
		url:'http://projeto.pc/aluno/ajax/verificaAluno/',
		type:'POST',
		data:{ra:ra},
		dataType:'json',
		success:function(json){

			if (json.length == 0) {
				alert("Aluno não encontrado!!!");
			}else{
				addAluno(json.id, json.nome);
				$('#ra').val('');
			}
			
		},
		error:function(erro){
			console.log(erro);
		}
	});

});




function addAluno(id, nome){

	console.log("entrou na função");

	var index = $('#alunos tr').length;

	var novalinha = '<tr> <th scope="row">'+index+'</th> <td>'+nome+'</td> <td> <button class="btn btn-danger" onclick="remove(this)">Excluir</button> </td> <input type="hidden" name="nome[]" value="'+id+'"> </tr>'

	$('#alunos').append(novalinha);
}

remove = function(item){

	tr = $(item).closest('tr');
	tr.remove();

	return false;
}
