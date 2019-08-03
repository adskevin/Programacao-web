<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Nome</th>
			<th>Fk Usuario</th>
			<th>Fk Categoria</th>
			<th>Data de Criação</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($foruns as $forum): ?>
			<tr>
				<td><?=$forum->getIdForum()?></td>
				<td>
					<a href="foruns.php?req=update&id=<?=$forum->getIdForum()?>">
						<?=$forum->getNome()?>
					</a>
				</td>
				<td><?=$forum->getFkIdUsuario()?></td>
				<td><?=$forum->getFkIdCategoria()?></td>
				<td><?=$forum->getDataDeCriacao()?></td>
				<td>
					<a href="foruns.php?req=delete&id=<?=$forum->getIdForum()?>">
						excluir
					</a>
				</td>
			</tr>
		<? endforeach; ?>
	</tbody>
</table>
<a href="foruns.php?req=insert">Inserir novo</a> <br/>
<a href="index.php">Voltar</a>