
$(function(){


	$('#adicionarData').bind('click', function(e){
		e.preventDefault();

		var	evento = $('#evento').val();
		var	data = $('#datepicker').val();
		var index = $('#datas tr').length;
		
		var novalinha = '<tr> <th scope="row">'+index+'</th> <td>'+evento+'</td> <td>'+data+'</td> <td> <button class="btn btn-danger" onclick="remove(this)">Excluir</button> </td> </tr>'

		$('#datas').append(novalinha);
	})

	$('#adicionarTema').bind('click', function(e){
		e.preventDefault();

		var	tema = $('#tema').val();
		var index = $('#temas tr').length;
		
		var novalinha = '<tr> <th scope="row">'+index+'</th> <td>'+tema+'</td> <td><button class="btn btn-danger" onclick="remove(this)">Excluir</button></td> </tr>'

		$('#temas').append(novalinha);
	})

	remove = function(item){

		tr = $(item).closest('tr');
		tr.remove();

		return false;
	}

});