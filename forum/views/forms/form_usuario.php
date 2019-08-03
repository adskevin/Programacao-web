<form method="post">
	<label for="nome">Nome:</label>
	<input type="text" name="nome" id="nome" 
		value="<?=$usuario->getNome()?>" /> <br/>
	<label for="nivel">Nivel:</label>
	<input type="text" name="nivel" id="nivel"
		value="<?=$usuario->getNivel()?>"/> <br/>
	<label for="email">Email:</label>
	<input type="text" name="email" id="email" 
		value="<?=$usuario->getEmail()?>"
		<?=(isset($_GET['id']) ? 'disabled' : 'Criar')?>/><br/>
	<? if (!isset($_GET['id'])): ?>
		<label for="senha">Senha:</label>
		<input type="text" name="senha" id="senha"/>
		<br>
	<?endif;?>
	<? if (isset($_GET['id'])): ?>
		<label for="dataDeCriacao">Data de Criação:</label>
		<input type="text" name="dataDeCriacao" id="dataDeCriacao" value="<?=$usuario->getDataDeCriacao()?>" disabled />
		<br>
	<?endif;?>
	<input type="submit" 
		value="<?=(isset($_GET['id']) ? 'Atualizar' : 'Criar')?>"/>
</form>
<a href="usuarios.php">Voltar</a>