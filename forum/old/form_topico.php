<form method="post">
	<label for="nome">Nome: </label>
	<input type="text" name="nome" id="nome" 
		value="<?=$topico->getNome()?>" /> <br/>
	<label for="conteudo">Conteudo: </label> <br>
	<textarea name="conteudo" rows="10" cols="30"><?=$topico->getConteudo()?></textarea><br>
	<label for="foruns">Forum: </label>
	<select name="foruns" id="foruns">
		<?$foruns = Forum::findAll();?>
		<?foreach ($foruns as $forum):?>
			<option value="<?=$forum->getIdForum();?>"><?=$forum->getNome();?></option>
		<?endforeach?>
	</select><br>
	<input type="submit" 
		value="<?=(isset($_GET['id']) ? 'Atualizar' : 'Criar')?>"/>
</form>

<a href="topicos.php">Voltar</a>