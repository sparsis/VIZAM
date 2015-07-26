<ul class="unstyled">
	<li>
    	<h3>Top acessados</h3>
        <ul class="unstyled">
        	<?php 
            $readTop = read('posts', "WHERE tipo = 'post' AND status = '1' ORDER BY visitas DESC LIMIT 10");
            foreach ($readTop as $top):
                $topNum++;
                echo '<li>';
                 echo '<a href="'.BASE.'/produto/'.$top['url'].'" title="Ver mais sobre '.$top['titulo'].'">';
                 echo '<span><?php echo $topNum;?></span> ';
                 echo '<span class="btn btn-small btn-block btn-primary">'.$top['titulo'].'</span>';
                 echo ' </a>';
               echo ' </li>';
            endforeach;?>
        </ul>
    </li>

	<li><iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3657.602321939004!2d-46.62801243107604!3d-23.546801583093576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sMAPAS!5e0!3m2!1spt-BR!2sbr!4v1437080124419" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    	
    </li>
</ul>