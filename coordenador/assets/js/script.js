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
		alert("Insira uma data!!!")
	} else {
		addEvento(evento, data);
	}
});


function addEvento(evento, data){
	
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


function excluirTema(id, botao){
	event.preventDefault();

	var r = confirm("Tem certeza que deseja excluir este tema ?");

	if (r == true) {
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
}

function excluirOrientador(id, botao){
	event.preventDefault();

	var r = confirm("Tem certeza que deseja excluir este orientador ?");
    if (r == true) {
        tr = $(botao).closest('tr');

		$.ajax({
			url:'http://projeto.pc/coordenador/ajax/excluirOrientador/',
			type:'POST',
			data:{id_orientador:id},
			dataType:'json',
			complete:function(){

				alert("Orientador excluído !!!");
				tr.remove();
				
			}
			
		});
    }
}

function excluirAvaliador(id, botao){
	event.preventDefault();

	var r = confirm("Tem certeza que deseja excluir este avaliador?");
    if (r == true) {
        tr = $(botao).closest('tr');

		$.ajax({
			url:'http://projeto.pc/coordenador/ajax/excluirAvaliador/',
			type:'POST',
			data:{id_avaliador:id},
			dataType:'json',
			complete:function(){

				alert("Avaliador excluído !!!");
				tr.remove();
				
			}
			
		});
    }
}

function excluirEvento(id, botao){
	event.preventDefault();

	var r = confirm("Tem certeza que deseja excluir este evento ?");
    if (r == true) {
        tr = $(botao).closest('tr');

		$.ajax({
			url:'http://projeto.pc/coordenador/ajax/excluirEvento/',
			type:'POST',
			data:{id_evento:id},
			dataType:'json',
			complete:function(){

				alert("Evento excluído !!!");
				tr.remove();
				
			}
			
		});
    } 
}

remove = function(item){

	event.preventDefault();

	var tr = $(item).closest('tr');

	tr.remove();

	return false;
	
}

