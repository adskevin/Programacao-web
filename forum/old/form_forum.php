<form method="post">
	<label for="nome">Nome: </label>
	<input type="text" name="nome" id="nome" 
		value="<?=$forum->getNome()?>" /> <br/>
	<label for="categorias">Categoria: </label>
	<select name="categorias" id="categorias">
		<?$categorias = Categoria::findAll();?>
		<?foreach ($categorias as $categoria):?>
			<option value="<?=$categoria->getIdCategoria();?>"><?=$categoria->getNome();?></option>
		<?endforeach?>
	</select><br>
	<input type="submit" 
		value="<?=(isset($_GET['id']) ? 'Atualizar' : 'Criar')?>"/>
</form>

<a href="foruns.php">Voltar</a>