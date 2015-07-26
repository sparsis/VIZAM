<!-- ARQUIVOS -->
<script type="text/javascript" src="<?php setHome();?>/js/jquery.js" /></script>
<script type="text/javascript" src="<?php setHome();?>/js/cycle.js" /></script>
<script type="text/javascript" src="<?php setHome();?>/js/shadowbox/shadowbox.js"></script>
<script type="text/javascript" src="<?php setHome();?>/js/maskinput.js" /></script>
	

<!-- ESTILOS -->
<link rel="stylesheet" type="text/css" href="<?php setHome();?>/js/shadowbox/shadowbox.css"/>

<!-- FUNÇÕES -->
<script type="text/javascript">

Shadowbox.init();
$(function(){
   $('.slide ul').cycle({
     fx: 'fade',
     speed: 1000,
     timeout: 3000,
	 pager: '.slidenav'
   })
});

jQuery(function($){
   $(".formDate").mask("99/99/9999 99:99:99");
   $(".formFone").mask("(99) 9999.9999");
    $(".formCep").mask("99.999-999");
 $(".formCpf").mask("999.999.999-99");
});
 
</script>