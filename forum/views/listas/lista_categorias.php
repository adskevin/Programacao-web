<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Nome</th>
			<th>Fk Usuario</th>
			<th>Data de Criação</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($categorias as $categoria): ?>
			<tr>
				<td><?=$categoria->getIdCategoria()?></td>
				<td>
					<a href="categorias.php?req=update&id=<?=$categoria->getIdCategoria()?>">
						<?=$categoria->getNome()?>
					</a>
				</td>
				<td><?=$categoria->getFkIdUsuario()?></td>
				<td><?=$categoria->getDataDeCriacao()?></td>
				<td>
					<a href="categorias.php?req=delete&id=<?=$categoria->getIdCategoria()?>">
						excluir
					</a>
				</td>
			</tr>
		<? endforeach; ?>
	</tbody>
</table>
<a href="categorias.php?req=insert">Inserir novo</a> <br/>
<a href="index.php">Voltar</a>