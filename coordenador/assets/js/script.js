$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

$('#addTema').bind('click', function(e){
	e.preventDefault();

	var tema = $('#tema').val();

	if (tema == "") {
		alert("Digite um tema!!!");
	} else {
		addTema(tema);
	}
});

function addTema(tema){

	var index = $('#temas tr').length;

	var novalinha = '<tr> <th scope="row">'+index+'</th> <td>'+tema+'</td> <td> <button class="btn btn-danger" onclick="remove(this)">Excluir</button> </td> <input type="hidden" name="temas[]" value="'+tema+'"> </tr>'

	$('#temas').append(novalinha);

	$('#tema').val('');
}

remove = function(item){

	event.preventDefault();
	

	tr = $(item).closest('tr');

	var id = tr.find('th');

	id = id.text();
	
	$.ajax({
		url:'http://projeto.pc/coordenador/ajax/excluirTema/',
		type:'POST',
		data:{id_tema:id},
		dataType:'json',
		success:function(json){


			tr.remove();
			
		},
		error:function(erro){
			console.log(erro);
		}
	});


	return false;
}
