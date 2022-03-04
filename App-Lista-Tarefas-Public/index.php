<?php

	$acao = 'tarefas-pendentes';
	require 'tarefa_controller.php';


?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

		<script>
			function editar(id, txt_tarefa)
			{
				//Criando um form de edição
				let form = document.createElement('form')
				form.action = 'tarefa_controller.php?pag=index&acao=atualizar'
				form.method = 'POST'
				form.className = 'row'

				//Criando um input para a entrada do texto
				let inputTarefa = document.createElement('input')
				inputTarefa.type = 'text'
				inputTarefa.name = 'tarefa'
				inputTarefa.className = ' col-sm-7 col-md-8 col-lg-9 form-control'
				inputTarefa.value = txt_tarefa

				//Criar um input hidden para guardar o id da tarefa
				let inputId = document.createElement('input')
				inputId.type = 'hidden'
				inputId.name = 'id'
				inputId.value = id

				//Criando um button para o envio do form
				let button = document.createElement('button')
				button.type = 'submit'
				button.className = 'col-sm-4 col-md-3 col-lg-2 ml-0 ml-sm-1 mt-1 mt-sm-0 btn btn-info '
				button.innerHTML = 'Atualizar'

				//Incluindo inputTarefa no form
				form.appendChild(inputTarefa)

				//Incluindo inputId no form
				form.appendChild(inputId)

				//Incluindo button no form
				form.appendChild(button)

				//Selecionando a div tarefa
				let tarefa = document.getElementById('tarefa_'+id)

				//Limpando o texto da tarefa para a inclusao do form
				tarefa.innerHTML = ''

				//Incluir form na pagina
				tarefa.insertBefore(form, tarefa[0])
			}

			function remover(id)
			{
				location.href = 'todas_tarefas.php?pag=index&acao=remover&id='+id;
			}

			function marcarRealizada(id)
			{
				location.href = 'todas_tarefas.php?pag=index&acao=marcarRealizada&id='+id;
			}

		</script>



	</head>

	<body>
		<!-- Navbar -->
		<nav class="navbar navbar-dark bg-dark">
			<div class="container">
				<a class="navbar-brand" href="index.php">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav> <!-- Fim NavBar -->

		<!-- Menu Tarefas -->
		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group ">
						<li class="list-group-item active"><a href="#">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item"><a href="todas_tarefas.php">Todas tarefas</a></li>
					</ul>
				</div><!-- Fim Menu Tarefas -->

				<div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Tarefas pendentes</h4>
								<hr />

								
								<?php foreach($tarefasArray as $key => $value){  ?>
									<?php if($value->status == 'pendente'){?>
								
								<!-- Tarefas Pendentes -->
								<div class="row mb-3 d-flex align-items-center tarefa">

									<div class="col-sm-9" id="tarefa_<?= $value->id ?>"> 
										<?= $value->tarefa ?> (<?= $value->status?>)
									 </div>

									<div class="col-sm-3 mt-2 d-flex justify-content-between">
										<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $value->id ?>)"></i>
										<i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $value->id ?>, '<?= $value->tarefa ?>')"></i>
										<i class="fas fa-check-square fa-lg text-success" onclick="marcarRealizada(<?= $value->id ?>)"></i>
									</div>
								</div>

								<?php } ?>
							<?php } ?>
									

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>