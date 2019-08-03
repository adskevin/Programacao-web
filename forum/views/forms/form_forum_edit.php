<form method="post">
	<label for="nome">Titulo: </label>
	<input type="text" name="nome" id="nome" value="<? print($forum_atual->getNome()); ?>"/> <br/>
	<input type="submit" value="Atualizar"/>
</form>