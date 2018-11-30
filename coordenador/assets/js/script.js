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

$('#addEvento').bind('click', function(e){
	e.preventDefault();

	var evento = $('#evento').val();
	var data = $('#data').val();

	if (evento == "") {
		alert("Digite um evento!!!");
	} else if(data == "") {
		alert("Digite uma data!!!")
	} else {
		addEvento(evento, data);
	}
});


function addEvento(evento, data){
	alert("Function add evento!!!");

	var index = $('#cronograma tr').length;

	var novalinha = '<tr> <th scope="row">'+index+'</th> <td>'+evento+'</td> <td>'+data+'</td> <td> <button class="btn btn-danger" onclick="remove(this)">Excluir</button> </td>';
	novalinha += ' <input type="hidden" name="eventos[]" value="'+evento+'"> ';
	novalinha += ' <input type="hidden" name="datas[]" value="'+data+'"> </tr>';

	$('#cronograma').append(novalinha);

	$('#evento').val(''); //Limpa os campos após adicionar o evento na tabela
	$('#data').val('');
}


function addTema(tema){

	var index = $('#temas tr').length;

	var novalinha = '<tr> <th scope="row">'+index+'</th> <td>'+tema+'</td> <td> <button class="btn btn-danger" onclick="remove(this)">Excluir</button> </td> <input type="hidden" name="temas[]" value="'+tema+'"> </tr>'

	$('#temas').append(novalinha);

	$('#tema').val('');
}


function removerTema(id, botao){
	event.preventDefault();

	tr = $(botao).closest('tr');

	$.ajax({
		url:'http://projeto.pc/coordenador/ajax/excluirTema/',
		type:'POST',
		data:{id_tema:id},
		dataType:'json',
		complete:function(){

			tr.remove();
			
		}
		
	});
}

function excluirOrientador(id, botao){
	event.preventDefault();

	tr = $(botao).closest('tr');

	$.ajax({
		url:'http://projeto.pc/coordenador/ajax/excluirOrientador/',
		type:'POST',
		data:{id_orientador:id},
		dataType:'json',
		complete:function(){

			alert("Excluiu Orientador !!!");
			tr.remove();
			
		}
		
	});

}

remove = function(item){

	event.preventDefault();

	var tr = $(item).closest('tr');

	tr.remove();

	return false;
	
}

