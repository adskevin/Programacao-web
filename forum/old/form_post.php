<form method="post">
	<label for="nome">Nome: </label>
	<input type="text" name="nome" id="nome" 
		value="<?=$post->getNome()?>" /> <br/>
	<label for="conteudo">Conteudo: </label> <br>
	<textarea name="conteudo" rows="10" cols="30"><?=$post->getConteudo()?></textarea><br>
	<label for="topicos">Topico: </label>
	<select name="topicos" id="topicos">
		<?$topicos = Topico::findAll();?>
		<?foreach ($topicos as $topico):?>
			<option value="<?=$topico->getIdTopico();?>"><?=$topico->getIdTopico()?> - <?=$topico->getNome();?></option>
		<?endforeach?>
	</select><br>
	<input type="submit" 
		value="<?=(isset($_GET['id']) ? 'Atualizar' : 'Criar')?>"/>
</form>

<a href="topicos.php">Voltar</a>