<section class="span8">            
            <?php 
            $tres = date('m/Y',strtotime('-3months'));
            $tresEx = explode('/', $tres);
            $readTres = read('views', "WHERE mes = '$tresEx[0]' AND ano = '$tresEx[1]'");
            if ($readTres) 
            {
              foreach ($readTres as $rtres); 
              $userT = $rtres['visitantes'];
              $viewsT = $rtres['visitas'];
              $pagesT = substr($rtres['pageviews'] / $rtres['visitas'],0,4);
            }else
            {
              $userT = '0';
              $viewsT = '0';
              $pagesT = '0';
            }
            $dois = date('m/Y',strtotime('-2months'));
            $doisEx = explode('/', $tres);
            $readTres = read('views', "WHERE mes = '$doisEx[0]' AND ano = '$doisEx[1]'");
            if ($readDois) 
            {
              foreach ($readDois as $rdois); 
              $userD = $rdois['visitantes'];
              $viewsD = $rdois['visitas'];
              $pagesD = substr($rdois['pageviews'] / $rdois['visitas'],0,4);
            }else
            {
              $userD = '0';
              $viewsD= '0';
              $pagesD = '0';
            }
            $um = date('m/Y',strtotime('-1months'));
            $umEx = explode('/', $um);
            $readUm = read('views', "WHERE mes = '$umEx[0]' AND ano = '$umEx[1]'");
            if ($readUm) 
            {
              foreach ($readUm as $rum); 
              $userU = $rum['visitantes'];
              $viewsU = $rum['visitas'];
              $pagesU = substr($rum['pageviews'] / $rum['visitas'],0,4);
            }else
            {
              $userU = '0';
              $viewsU = '0';
              $pagesU = '0';
            }
            $atual = date('m/Y');
            $atualEx = explode('/', $atual);
            $readAtual = read('views', "WHERE mes = '$atualEx[0]' AND ano = '$atualEx[1]'");
            if ($readAtual) 
            {
              foreach ($readAtual as $ratual); 
              $user = $ratual['visitantes'];
              $views = $ratual['visitas'];
              $pages = substr($ratual['pageviews'] / $ratual['visitas'],0,4);
            }else
            {
              $user = '0';
              $views = '0';
              $pages = '0';
            }            
            ?>
            <script type="text/javascript" src="js/libraries/jsapi.js"></script>
            <script type="text/javascript">
              google.load("visualization", "1", {packages:["corechart"]});
              google.setOnLoadCallback(drawChart);
              function drawChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Year');
                data.addColumn('number', 'Usuários');
                data.addColumn('number', 'Visitas');
                data.addColumn('number', 'PageViews');
                data.addRows([
                 ['<?php echo $tres;?>', <?php echo $userT;?>, <?php echo $viewsT;?>, <?php echo $pagesT;?>],
                 ['<?php echo $dois;?>', <?php echo $userD;?>, <?php echo $viewsD;?>, <?php echo $pagesD;?>],
                 ['<?php echo $um;?>', <?php echo $userU;?>, <?php echo $viewsU;?>, <?php echo $pagesU;?>],
                 ['<?php echo $atual;?>', <?php echo $user;?>, <?php echo $views;?>, <?php echo $pages;?>]
                ]);            
                var options = {            
                  title: 'Visitas em seu site:',
                  hAxis: {title: 'relátorio de 3 meses', titleTextStyle: {color: 'red'}},
            pointSize: 16,
            focusTarget: 'category'
                };            
                var chart = new google.visualization.LineChart(document.getElementById('chart_divDois'));
                chart.draw(data, options);
              }
            </script>
             <div style="text-align:center;">Estatísticas do site:</div>
<div class="row">
           <!--div responsável pelo gráfico na home-->
		<div class="span8" id="chart_divDois"></div>
</div><!--//row-->                      
<div class="row">
            <div class="span4">
                <table class="table table-bordered table-hover table-condensed">
                    <caption> Usu&aacute;rios:</caption>
                    <thead>
                        <tr>
                            <th>Usuários cadastrados:</th>
                            <th><?php $readUserCad = read('users'); echo count($readUserCad);?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Visitantes Online:</td>
                            <td><?php $readVisitantes = read('views_online'); echo count($readVisitantes);?></td>
                        </tr>
                        <tr>
                            <th>Sessões:</th>
                        </tr>
                        <tr>
                            <td>Categorias:</td>
                            <td><?php $readCategogorias = read('cat'); echo count($readCategogorias);?></td>
                        </tr>
                        <tr>
                            <td>Páginas:</td>
                            <td><?php $readPaginas = read('posts',"WHERE tipo = 'post'"); echo count($readPaginas);?></td>
                        </tr>      
                    </tbody>
                </table>
          </div><!--span4-->                          
                                
                                
                                <?php 
                                  $countViews = "SELECT SUM(visitas) AS views FROM posts";
                                  $exeViews = mysql_query($countViews) or die ('Erro ao contar visitas');
                                  $views = 0;
                                  $visitas = mysql_result($exeViews,$views,"views");
                                  if ($visitas >= 1) 
                                  {
                                    $visitas = $visitas;
                                  }else
                                  {
                                    $visitas = 0;
                                  }
                                  $artigosCount = read('posts',"WHERE tipo = 'post'");
                                  $countArtigos = count($artigosCount);
                                ?>
                                <script type="text/javascript" src="js/libraries/jsapi.js"></script>
                                <script type="text/javascript">
                                  google.load("visualization", "1", {packages:["corechart"]});
                                  google.setOnLoadCallback(drawChart);
                                  function drawChart() {
                                    var data = new google.visualization.DataTable();
                                    data.addColumn('string', 'Task');
                                    data.addColumn('number', 'Visitas totais');
                                    data.addRows([
                                      ['Artigos', <?php echo $countArtigos;?>],
                                      ['Visitas em artigos', <?php echo $visitas;?>],
                                      ['Média por artigo', <?php echo substr($visitas/$countArtigos,0,5);?>]
                                    ]);
                                
                                    var options = {
                                      title: 'Visitas em seus artigos:'
                                    };
                                
                                    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                                    chart.draw(data, options);
                                  }
                                </script>
                                
        <div class="span4">
        				 <!--div responsável pelo gráfico na home-->
                       <div id="chart_div">                                
        </div><!--span4-->              
</div><!--row-->
<div class="row">
      <div class="span4">                                                
            <table class="table table-bordered table-hover table-condensed">
                <caption>Artigos:</caption>
                <thead>
                    <tr>
                        <th>&uacute;ltimas atualiza&ccedil;&otilde;es</th>
                        <th>data</th>
                    </tr>
                </thead>
                <tbody>
					<?php 
                    $readArtUtm = read('posts', "WHERE tipo = 'post' ORDER BY data DESC LIMIT 5");
                    if (!$readArtUtm) 
                    {
                    echo '<td>Não existe artigos registrados!</td>';
                    }else
                    {
                    foreach ($readArtUtm as $utm ): 
                    echo '<tr>';
						echo '<td><a href="'.BASE.'/artigo/'.$utm['url'].'" target="_blank" title="ver">'.lmWord($utm['titulo'],22). '</a></td>';
						echo '<td>'.date('d/m/y H:i',strtotime($utm['data'])).'</td>';
                    echo '</tr>';
                    endforeach;
                    }
                    ?>
                </tbody>
            </table>
       </div><!--span4-->
           <div class="span4">                     
            <table class="table table-bordered table-hover table-condensed">
                <caption>Artigos:</caption>
                    <thead>
                        <tr>
                            <th>artigos + vistos</th>
                            <th>visitas</th>
                        </tr>
                    </thead>
                        <tbody>   
						<?php 
                        $readArtUtm = read('posts', "WHERE tipo = 'post' ORDER BY visitas DESC, data DESC LIMIT 5");
                        if (!$readArtUtm) 
                        {
                        echo '<td>Não existe artigos registrados!</td>';
                        }else
                        {
                        foreach ($readArtUtm as $utm ): 
                        $views = ($utm['visitas']  != '' ? $utm['visitas'] : '0');
                        echo '<tr>';
                            echo '<td><a href="'.BASE.'/artigo/'.$utm['url'].'" target="_blank" title="ver">'.lmWord($utm['titulo'],22).'</a></td>';
                            echo '<td align="center">'.$views.'</td>';
                        echo '</tr>';
                        endforeach;
                        }
                        ?>
                        </tbody>
            </table>
             </div><!--span4--> 
</div><!--//row-->                             
</section><!--span8-->

