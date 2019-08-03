<form method="post">
	<label for="nome">Titulo: </label>
	<input type="text" name="nome" id="nome" value="<? print($topico_atual->getNome()); ?>"/> <br/>
	<label for="conteudo">Conteudo: </label> <br>
	<textarea name="conteudo" rows="10" cols="100"><? print($topico_atual->getConteudo()); ?></textarea><br>
	<input type="submit" value="Atualizar"/>
</form>