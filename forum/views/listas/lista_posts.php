<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Nome</th>
			<th>Conteudo</th>
			<th>Fk Usuario</th>
			<th>Fk Topico</th>
			<th>Data de Criação</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($posts as $post): ?>
			<tr>
				<td><?=$post->getIdPost()?></td>
				<td>
					<a href="posts.php?req=update&id=<?=$post->getIdPost()?>">
						<?=$post->getNome()?>
					</a>
				</td>
				<td><?=$post->getConteudo()?></td>
				<td><?=$post->getFkIdUsuario()?></td>
				<td><?=$post->getFkIdTopico()?></td>
				<td><?=$post->getDataDeCriacao()?></td>
				<td>
					<a href="posts.php?req=delete&id=<?=$post->getIdPost()?>">
						excluir
					</a>
				</td>
			</tr>
		<? endforeach; ?>
	</tbody>
</table>
<a href="posts.php?req=insert">Inserir novo</a> <br/>
<a href="index.php">Voltar</a>