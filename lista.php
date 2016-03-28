<?php 

require_once("classes/paginacao.class.php");
//Define o GET
@$pagina = intval($_GET['pagina']);
//Chama a classe
$paginacao = new Paginacao();
//Define os dados da paginação
$paginacao->setTable("livros");
$paginacao->setPagina($pagina);
$paginacao->setItensPagina(30);
//Consulta o BD
$sql = $paginacao->sql();
$execute = DB::prepare($sql);
$execute->execute();
$livros = $execute->fetch(PDO::FETCH_ASSOC);
?>


<fieldset>
	<legend>Lista de Livros</legend>
	<div class="row-fluid">
		<div class="col-md-10 col-md-offset-1">
			<table class="table table-hover" border="1" ">
				<thead>
					<tr>
						<th>ID</th>
						<th>Autor</th>
						<th>Livro</th>
						<th>Ação</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					//inicio do loop de dados
					do {
						?>
						<tr>
							<td><?php echo $livros['id']; ?> </td>
							<td><?php echo $livros['autor']; ?></td>
							<td><?php echo $livros['livro']; ?></td>
							<td>
								<a href="livros/<?php echo $livros['autor']; ?>/<?php echo $livros['livro']; ?>"  target="_blank" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-circle-arrow-down" title="Baixar Livro"></span> </a>

								
							</td>
						</tr>
						<?php 
					}
					while ($livros = $execute->fetch(PDO::FETCH_ASSOC));
					?>
				</tbody>
			</table>
			<nav>
				<ul class="pagination">
					<li>
						<a href="?pagina=0" arial-label="previous">
							<span aria-hidden="true">&laquo;</span>
						</a>
					</li>
					<?php 
						//Executa paginação
					$offset = 5;
					$pagina_atual = $paginacao->setPagina($pagina);
					$num_paginas = $paginacao->totalPaginas();
					for ($i=($pagina_atual); $i<($num_paginas) + $offset; $i++) { 
						$estilo = "";
						if ($pagina == $i)
							$estilo = "class=\"active\"";
						?>
						<li <?php echo $estilo; ?> >
							<a href="?pagina=<?php echo $i; ?>">
								<?php echo $i+1; ?>
							</a>				
						</li>
						<?php } ?>
						<li>
							<a href="?pagina=<?php echo $num_paginas-1; ?>" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</fieldset>