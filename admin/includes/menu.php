<div class="row"> 
<section class="span3 offset1">
    <ul class="unstyled">
        <li><span>Conte&uacute;do do Site</span>
            <ul>
                <li><a href="index2.php?exe=posts/posts-cat" title="Cadastrar">Cadastrar</a></li>                 
                <li><a href="index2.php?exe=posts/posts" title="Editar Cadastros">Editar cadastros</a></li>            
                <li><a href="index2.php?exe=posts/car-menu" title="Editar Imagens">Carroussel Menu</a></li>
                <li><a href="index2.php?exe=posts/posts-carroussel" title="Editar Imagens">Carroussel Menu Dopdwon</a></li>
                <?php if ($_SESSION['autUser']['nivel'] == '1') { ?>
                <li><a href="index2.php?exe=posts/categorias" title="Categorias">Gerenciar Menus</a></li>
            </ul>
        </li>
  <!--    EM DESENVOLVIMENTO AINDA
     <li><span>Páginas</span>
            <ul>
                <li><a href="index2.php?exe=paginas/paginas-create" title="Criar Página">Criar Página</a></li>
                <li><a href="index2.php?exe=paginas/paginas" title="Editar Páginas">Editar páginas</a></li>
            </ul>
        </li> -->
         <li><span>System</span>
            <ul>
                <li><a href="index2.php?exe=system/cores" title="Cadastrar Cores">Cores</a></li>             
            </ul>
        </li>
        <li ><span>Usuários</span>
            <ul>
                <?php  } ?>
                <li><a href="index2.php?exe=usuarios/usuarios-edit&userid=<?php echo $_SESSION['autUser']['id']; ?>" title="Perfil">Meu perfil</a></li>
                <?php if ($_SESSION['autUser']['nivel'] == '1') { ?>
                <li><a href="index2.php?exe=usuarios/usuarios-create" title="Criar Usuário">Criar usuário</a></li>
                <li><a href="index2.php?exe=usuarios/usuarios" title="Gerenciar Usuário">Gerenciar usuários</a></li>
           		<?php  } ?>
            </ul>
        </li>
    </ul><!-- /nav -->
</section><!--/span3 offset1-->