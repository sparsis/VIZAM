    <section class="container">
    <header>   
        <nav class="navbar navbar-static-top">
            <div class="navbar-inner">                           
                <!-- .btn-nabvar esta classe é usada como alternador para o conteúdo colapsável -->
                <button class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse" >
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                         <span class="icon-bar"></span>                      
                 </button>
                 <a class="brand" href="../includes/index.php" title="Foto Vizam"><img src="<?php setHome();?>/tpl/images/logo.png" border="0" alt="Logo" title="Foto Vizam" /></a>         
                 <!-- Tudo que fica escondido abaixo de 940px --> 
                     <div class="nav-collapse collapse">
                     	 <ul class="nav">
                      <li><a title="<?php echo SITENAME; ?> | Home" href="<?php setHome();?>"><span class="icon-home"></span>Home</a></li>
 <?php 	$readCatMen = read('cat', "WHERE id_pai IS NULL AND tipo = 'menu' AND url != 'home' ORDER BY nome ASC"); 		
		if(!empty($readCatMen)){ foreach ($readCatMen as $catMen):
		echo '<li><a title="'.$catMen['nome'].' | '.SITENAME.'" href="'.BASE.'/categoria/'.$catMen['url'].'">'.$catMen['nome'].'</a>'; 						        endforeach;  }		      
		$readCatMenu = read('cat', "WHERE id_pai IS NULL AND tipo != 'menu' ORDER BY nome ASC"); 	
		foreach ($readCatMenu as $catMenu):						
        echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" title="'.$catMenu['nome'].' | '.SITENAME.'" href="'.BASE.'/categoria/'.$catMenu['url'].'">'.$catMenu['nome'].'<span class="caret"></span></a>'; 
			$readSubCAtMenu = read('cat', "WHERE id_pai = '$catMenu[id]' ORDER BY nome ASC"); 
			if($readSubCAtMenu): echo '<ul class="dropdown-menu">'; 
				foreach ($readSubCAtMenu as $catSubMenu):
				echo '<li><a title="'.$catSubMenu['nome'].' | '.SITENAME.'" href="'.BASE.'/produtos/'.$catSubMenu['url'].'">'.$catSubMenu['nome'].'</a></li><li class="divider"></li>';
				endforeach;		 echo '</ul>';
            endif;	echo '</li>';
	   endforeach; ?>                                  
                           <li><a href="#" title="Contato">Contato</a></li>       
                         </ul>
                         <form action="" class="navbar-form pull-right">
                         <input title="text" class="span2">
                         <button class="btn">Buscar</button>
                         </form>
                     </div>
                  </div>
              </nav>
        </header>