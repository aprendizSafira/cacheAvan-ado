<?php
/////////////////---Função pra Validar o tempo de cache--\\\\\\\\\\\\\\\\\\
function is_valido($cache) {
	$ultima_modificacao = filemtime($cache);//filectime() não funcionou!!
	$segundos = time() - $ultima_modificacao;

	//Setando limite para ver se ele é valido ou não
	if($segundos > 10) {//No caso o cache terá 10 segundos de duração
		//Se meu cache tiver mais que 10 segundos de vida:
		return false;
	} else {
		return true;
	}
}
/////////////////----PAGINA A SER CARREGADA---\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
	//Tenho nesse projeto 2 paginas a ser carrega. 'paginas/pagina.php' e 'paginas/pagina2.php'
$p = 'pagina';//por padrão.
//SE o parametro p foi definido e se não tiver vazio. E vê se essa pagina realmente existe
if(isset($_GET['p']) && !empty($_GET['p']) && file_exists('paginas/'.$_GET['p'].'.php')) {
	$p = $_GET['p'];//pagina2- por exemplo
}
//////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
		//////////-- Criando Caches por paginas e Tempo de expiração --\\\\\\\\\\
if(file_exists('caches/'.$p.'.cache') && is_valido('caches/'.$p.'.cache')) {//-'caches/'.$p.'cache'->para separar os caches por paginas
	require 'caches/'.$p.'.cache';//-->'caches/pagina2.cache'
} else {
	ob_start();
	require 'paginas/'.$p.'.php';
	$html = ob_get_contents();
	ob_end_clean();

	file_put_contents('caches/'.$p.'.cache', $html);
	echo $html;
}

?>