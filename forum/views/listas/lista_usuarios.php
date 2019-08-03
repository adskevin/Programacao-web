<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Nome</th>
			<th>Nivel</th>
			<th>Email</th>
			<th>Data de Criação</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($usuarios as $usuario): ?>
			<tr>
				<td><?=$usuario->getIdUsuario()?></td>
				<td>
					<a href="usuarios.php?req=update&id=<?=$usuario->getIdUsuario()?>">
						<?=$usuario->getNome()?>
					</a>
				</td>
				<td><?=$usuario->getNivel()?></td>
				<td><?=$usuario->getEmail()?></td>
				<td><?=$usuario->getDataDeCriacao()?></td>
				<td>
					<a href="usuarios.php?req=delete&id=<?=$usuario->getIdUsuario()?>">
						excluir
					</a>
				</td>
			</tr>
		<? endforeach; ?>
	</tbody>
</table>
<a href="usuarios.php?req=insert">Inserir novo</a> <br/>
<a href="index.php">Voltar</a>