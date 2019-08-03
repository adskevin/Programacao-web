<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Nome</th>
			<th>Conteudo</th>
			<th>Fk Usuario</th>
			<th>Fk Forum</th>
			<th>Data de Criação</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($topicos as $topico): ?>
			<tr>
				<td><?=$topico->getIdTopico()?></td>
				<td>
					<a href="topicos.php?req=update&id=<?=$topico->getIdTopico()?>">
						<?=$topico->getNome()?>
					</a>
				</td>
				<td><?=$topico->getConteudo()?></td>
				<td><?=$topico->getFkIdUsuario()?></td>
				<td><?=$topico->getFkIdForum()?></td>
				<td><?=$topico->getDataDeCriacao()?></td>
				<td>
					<a href="topicos.php?req=delete&id=<?=$topico->getIdTopico()?>">
						excluir
					</a>
				</td>
			</tr>
		<? endforeach; ?>
	</tbody>
</table>
<a href="topicos.php?req=insert">Inserir novo</a> <br/>
<a href="index.php">Voltar</a>