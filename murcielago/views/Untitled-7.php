<!DOCTYPE html>
<html lang="en">
<head>
  <title>Datasets</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
  <h2>Data Training</h2>
    <?php 
        $inf_gain_f = array();
    ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th rowspan="2" colspan="2">Atribut</th>
            <th rowspan="2">Jumlah kasus</th>
            <th colspan="4">Class</th>
            <th rowspan="2">Entropy</th>
            <th rowspan="2">Inf. Gain</th>
          </tr>
            <tr>
                <th>unacc</th> 
                <th>acc</th> 
                <th>good</th> 
                <th>vgood</th> 
            </tr>
        </thead>
        <tbody>
            <tr>
            <?php
                $jml_kasus = $this->m_data->semua('train')->num_rows();    
            ?>
            <td colspan="2">Keseluruhan</td>
            <td><?php echo $jml_kasus ?></td>
            <?php
                $unacc = $this->m_data->where('train',array('class_values' => 'unacc'))->num_rows();    
            ?>
            <td><?php echo $unacc ?></td>
              <?php
                $acc = $this->m_data->where('train',array('class_values' => 'acc'))->num_rows();    
            ?>
            <td><?php echo $acc ?></td>
               <?php
                $good = $this->m_data->where('train',array('class_values' => 'good'))->num_rows();    
            ?>
            <td><?php echo $good ?></td>
              <?php
                $vgood = $this->m_data->where('train',array('class_values' => 'vgood'))->num_rows();    
            ?>
            <td><?php echo $vgood ?></td>

                <td><?php 
            $f1 = ($unacc == 0) ? 0 : ( ($unacc/$jml_kasus) * (log(($unacc/$jml_kasus),2)) );
            $f2 = ($acc == 0) ? 0 : ( ($acc/$jml_kasus) * (log(($acc/$jml_kasus),2)) );
            $f3 = ($good == 0) ? 0 : ( ($good/$jml_kasus) * (log(($good/$jml_kasus),2)) );
            $f4 = ($vgood == 0) ? 0 : ( ($vgood/$jml_kasus) * (log(($vgood/$jml_kasus),2)) );
            $en_start = -($f1+$f2+$f3+$f4);
                echo round(
             $en_start
            ,4);
                  ?></td>
            <td></td>
          </tr>
          <?php
            $get_atribut = $this->m_data->semua('atribut')->result();
            $noy =0;
            foreach($get_atribut as $g){
            $noy++;
            ?>
            <tr>
            <?php
                    $atributw = $this->m_data->semua($g->atribut)->result_array();
                $inf_gain_buying=0;
                foreach($atributw as $b){
                    $jmlq = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.'']))->num_rows();    
                    $unacc = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'class_values' => 'unacc'))->num_rows();
                    $acc = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'class_values' => 'acc'))->num_rows();  
                    $good = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'class_values' => 'good'))->num_rows(); 
                    $vgood = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'class_values' => 'vgood'))->num_rows(); 
                    $f1 = ($unacc == 0) ? 0 : ( ($unacc/$jmlq) * (log(($unacc/$jmlq),2)) );
                    $f2 = ($acc == 0) ? 0 : ( ($acc/$jmlq) * (log(($acc/$jmlq),2)) );
                    $f3 = ($good == 0) ? 0 : ( ($good/$jmlq) * (log(($good/$jmlq),2)) );
                    $f4 = ($vgood == 0) ? 0 : ( ($vgood/$jmlq) * (log(($vgood/$jmlq),2)) );
                    $ttl = -($f1+$f2+$f3+$f4);
                    $inf_gain_buying+= ( round($en_start,4) - ( $jmlq/$jml_kasus * round($ttl,4) ) );
                }
                ?>
            <td colspan="8" style="font-size:20px;font-weight:700;text-transform:uppercase;background-color:#1abc9c">atribut : <?php echo $g->atribut ?></td>
          <td style="font-weight:700;background-color:#1abc9c;font-size:20px;"><?php echo round($inf_gain_buying,4); array_push($inf_gain_f,round($inf_gain_buying,4)); ?></td>
          </tr> 
             <?php
                foreach($atributw as $b){
            ?>
            <tr>
                <td colspan="2"><b><?php echo $b[''.$g->atribut.''] ?></b></td>
                <?php
                $jmlx = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.'']))->num_rows();    
                ?>
                <td><?php echo $jmlx ?></td>
                <?php
                $unacc = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'class_values' => 'unacc'))->num_rows();    
                ?>
                <td><?php echo $unacc ?></td>
                  <?php
                    $acc = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'class_values' => 'acc'))->num_rows();    
                ?>
                <td><?php echo $acc ?></td>
                   <?php
                    $good = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'class_values' => 'good'))->num_rows();    
                ?>
                <td><?php echo $good ?></td>
                  <?php
                    $vgood = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'class_values' => 'vgood'))->num_rows();    
                ?>
                <td><?php echo $vgood ?></td>
                        <td><?php 
                $f1 = ($unacc == 0) ? 0 : ( -($unacc/$jmlx) * (log(($unacc/$jmlx),2)) );
                $f2 = ($acc == 0) ? 0 : ( -($acc/$jmlx) * (log(($acc/$jmlx),2)) );
                $f3 = ($good == 0) ? 0 : ( -($good/$jmlx) * (log(($good/$jmlx),2)) );
                $f4 = ($vgood == 0) ? 0 : ( -($vgood/$jmlx) * (log(($vgood/$jmlx),2)) );
                $ttl = $f1+$f2+$f3+$f4;
                    echo round(
                 $ttl
                ,4); ?></td>
                <td></td>
            </tr>
            <?php } ?>
            <?php } ?>
          </tbody>
      </table>
        <h1>Inf Gain : <?php 
        echo max($inf_gain_f);
        ?></h1>
    <hr>
    <div class="panel panel-success">
            <div class="panel-heading"><h1>NODE</h1></div>
            <div class="panel-body">
                <p>Node <b>maint</b></p>
                <?php
                    $maint_node = $this->m_data->semua('maint')->result();
                    $nos = 0;
                    foreach($maint_node as $m){
                    $nos++;
                ?>
                <div class="col-md-6">
                    <h3>Tree maint[<?php echo $m->maint ?>]</h3>
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>no</th>
                            <th>buying</th>
                            <th>maint</th>
                            <th>doors</th>
                            <th>persons</th>
                            <th>lug_boot</th>
                            <th>safety</th>
                            <th>class_values</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $cari_maint = $this->m_data->where('train',array('maint' => $m->maint))->result();
                                $no = 0;
                                $class = array();
                                foreach($cari_maint as $c){
                                $no++;
                            ?>
                          <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $c->buying ?></td>
                            <td><b style="font-size:18px;"><?php echo $c->maint ?></b></td>
                            <td><?php echo $c->doors ?></td>
                            <td><?php echo $c->persons ?></td>
                            <td><?php echo $c->lug_boot ?></td>
                            <td><?php echo $c->safety ?></td>
                            <td><?php echo $c->class_values;
//                                if(array_search($c->class_values, $class)){}else{
                                array_push($class,$c->class_values);
//                                }
                                ?></td>
                          </tr>
                            <?php } ?>
                            <tr>
                               <td colspan="4">Apakah Class 1 jenis : </td>
                                <td colspan="4"><?php echo (count(array_unique($class)) != '1') ? '<b>Tidak</b> Total class yang ada di tabel ini ada '.count( array_unique($class)).'' : 'Ya' ?></td>
                            </tr>
                        <?php 
                                if(count(array_unique($class)) == '1'){
                                    $stat = 1;
                                }else{
                                    $stat = 2;
                                }
                            ?>
                        </tbody>
                      </table>
                </div>
                <?php } ?>
                <h2>Maint Sebagai Node / Root Dan Masih Berakar</h2>
            </div>
            <div class="panel-footer">End List Node</div>
        </div>
<!--  Pertama  -->
    <hr>
    <?php
        $maint_node = $this->m_data->semua('maint')->result();
        $nos = 0;
        foreach($maint_node as $m){
        $nos++;
    ?>
    <div class="well">
    <h1>Tree maint[<?php echo $m->maint ?>] </h1>
        <?php 
        $inf_gain_f[$nos] = array();
    ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th rowspan="2" colspan="2">Atribut</th>
            <th rowspan="2">Jumlah kasus</th>
            <th colspan="4">Class</th>
            <th rowspan="2">Entropy</th>
            <th rowspan="2">Inf. Gain</th>
          </tr>
            <tr>
                <th>unacc</th> 
                <th>acc</th> 
                <th>good</th> 
                <th>vgood</th> 
            </tr>
        </thead>
        <tbody>
            <tr>
            <?php
                $jml_kasus = $this->m_data->where('train',array('maint' => $m->maint))->num_rows();    
            ?>
            <td colspan="2">Keseluruhan</td>
            <td><?php echo $jml_kasus ?></td>
            <?php
                $unacc = $this->m_data->where('train',array('maint' => $m->maint,'class_values' => 'unacc'))->num_rows();    
            ?>
            <td><?php echo $unacc ?></td>
              <?php
                $acc = $this->m_data->where('train',array('maint' => $m->maint,'class_values' => 'acc'))->num_rows();    
            ?>
            <td><?php echo $acc ?></td>
               <?php
                $good = $this->m_data->where('train',array('maint' => $m->maint,'class_values' => 'good'))->num_rows();    
            ?>
            <td><?php echo $good ?></td>
              <?php
                $vgood = $this->m_data->where('train',array('maint' => $m->maint,'class_values' => 'vgood'))->num_rows();    
            ?>
            <td><?php echo $vgood ?></td>

                <td><?php 
            $f1 = ($unacc == 0) ? 0 : ( ($unacc/$jml_kasus) * (log(($unacc/$jml_kasus),2)) );
            $f2 = ($acc == 0) ? 0 : ( ($acc/$jml_kasus) * (log(($acc/$jml_kasus),2)) );
            $f3 = ($good == 0) ? 0 : ( ($good/$jml_kasus) * (log(($good/$jml_kasus),2)) );
            $f4 = ($vgood == 0) ? 0 : ( ($vgood/$jml_kasus) * (log(($vgood/$jml_kasus),2)) );
            $en_start = -($f1+$f2+$f3+$f4);
                echo round(
             $en_start
            ,4);
                  ?></td>
            <td></td>
          </tr>
          <?php
            $get_atribut = $this->m_data->where('atribut',array('atribut !=' => 'maint'))->result();
            $noy =0;
            foreach($get_atribut as $g){
            $noy++;
            ?>
            <tr>
            <?php
                    $atributw = $this->m_data->semua($g->atribut)->result_array();
                $inf_gain_buying=0;
                foreach($atributw as $b){
                    $jmlq = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'maint' => $m->maint))->num_rows();    
                    $unacc = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'class_values' => 'unacc','maint' => $m->maint))->num_rows();
                    $acc = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'class_values' => 'acc','maint' => $m->maint))->num_rows();  
                    $good = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'class_values' => 'good','maint' => $m->maint))->num_rows(); 
                    $vgood = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'class_values' => 'vgood','maint' => $m->maint))->num_rows(); 
                    $f1 = ($unacc == 0) ? 0 : ( ($unacc/$jmlq) * (log(($unacc/$jmlq),2)) );
                    $f2 = ($acc == 0) ? 0 : ( ($acc/$jmlq) * (log(($acc/$jmlq),2)) );
                    $f3 = ($good == 0) ? 0 : ( ($good/$jmlq) * (log(($good/$jmlq),2)) );
                    $f4 = ($vgood == 0) ? 0 : ( ($vgood/$jmlq) * (log(($vgood/$jmlq),2)) );
                    $ttl = -($f1+$f2+$f3+$f4);
                    $inf_gain_buying+= ( round($en_start,4) - ( $jmlq/$jml_kasus * round($ttl,4) ) );
                }
                ?>
            <td colspan="8" style="font-size:20px;font-weight:700;text-transform:uppercase;background-color:#1abc9c">atribut : <?php echo $g->atribut ?></td>
          <td style="font-weight:700;background-color:#1abc9c;font-size:20px;"><?php echo round($inf_gain_buying,4); array_push($inf_gain_f[$nos],round($inf_gain_buying,4)); ?></td>
          </tr> 
             <?php
                foreach($atributw as $b){
            ?>
            <tr>
                <td colspan="2"><b><?php echo $b[''.$g->atribut.''] ?></b></td>
                <?php
                $jmlx = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'maint' => $m->maint))->num_rows();    
                ?>
                <td><?php echo $jmlx ?></td>
                <?php
                $unacc = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'class_values' => 'unacc','maint' => $m->maint))->num_rows();    
                ?>
                <td><?php echo $unacc ?></td>
                  <?php
                    $acc = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'class_values' => 'acc','maint' => $m->maint))->num_rows();    
                ?>
                <td><?php echo $acc ?></td>
                   <?php
                    $good = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'class_values' => 'good','maint' => $m->maint))->num_rows();    
                ?>
                <td><?php echo $good ?></td>
                  <?php
                    $vgood = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'class_values' => 'vgood','maint' => $m->maint))->num_rows();    
                ?>
                <td><?php echo $vgood ?></td>
                        <td><?php 
                $f1 = ($unacc == 0) ? 0 : ( -($unacc/$jmlx) * (log(($unacc/$jmlx),2)) );
                $f2 = ($acc == 0) ? 0 : ( -($acc/$jmlx) * (log(($acc/$jmlx),2)) );
                $f3 = ($good == 0) ? 0 : ( -($good/$jmlx) * (log(($good/$jmlx),2)) );
                $f4 = ($vgood == 0) ? 0 : ( -($vgood/$jmlx) * (log(($vgood/$jmlx),2)) );
                $ttl = $f1+$f2+$f3+$f4;
                    echo round(
                 $ttl
                ,4); ?></td>
                <td></td>
            </tr>
            <?php } ?>
            <?php } ?>
          </tbody>
      </table>
        <h1>Inf Gain : <?php 
        echo max($inf_gain_f[$nos]);
        ?></h1>
    </div>
    <?php } ?>
    <hr>
    <h2>Atribut [doors] menjadi tree selanjutnya di setiap atribut dari maint</h2>
    <?php
        $maint_nodeq = $this->m_data->semua('maint')->result();
        $nosw = 0;
        foreach($maint_nodeq as $q){
        $nosw++;
    ?>
    <div class="panel panel-success">
            <div class="panel-heading"><h1>Tree maint[<?php echo $q->maint ?>] -> doors</h1></div>
            <div class="panel-body">
                <p>Tree <b>doors</b></p>
                <?php
                    $maint_node = $this->m_data->semua('doors')->result();
                    $nos = 0;
                    foreach($maint_node as $m){
                    $nos++;
                ?>
                <div class="col-md-6">
                    <h3>Tree maint[<?php echo $q->maint ?>] -> doors[<?php echo $m->doors ?>]</h3>
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>no</th>
                            <th>buying</th>
                            <th>maint</th>
                            <th>doors</th>
                            <th>persons</th>
                            <th>lug_boot</th>
                            <th>safety</th>
                            <th>class_values</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $cari_maint = $this->m_data->where('train',array('maint' => $q->maint,'doors' => $m->doors))->result();
                                $no = 0;
                                $class[$nos] = array();
                                foreach($cari_maint as $c){
                                $no++;
                            ?>
                          <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $c->buying ?></td>
                            <td><b style="font-size:18px;"><?php echo $c->maint ?></b></td>
                            <td><b style="font-size:18px;"><?php echo $c->doors ?></b></td>
                            <td><?php echo $c->persons ?></td>
                            <td><?php echo $c->lug_boot ?></td>
                            <td><?php echo $c->safety ?></td>
                            <td><?php echo $c->class_values;
//                                if(array_search($c->class_values, $class)){}else{
                                array_push($class[$nos],$c->class_values);
//                                }
                                ?></td>
                          </tr>
                            <?php } ?>
                            <tr>
                               <td colspan="4">Apakah Class 1 jenis : </td>
                                <td colspan="4"><?php echo (count(array_unique($class[$nos])) != '1') ? '<b>Tidak</b> Total class yang ada di tabel ini ada '.count( array_unique($class[$nos])).'' : 'Ya' ?></td>
                            </tr>
                        <?php 
                                if(count(array_unique($class[$nos])) == '1'){
                                    $stat = 1;
                                }else{
                                    $stat = 2;
                                }
                            ?>
                        </tbody>
                      </table>
                </div>
                <?php } ?>
                
            </div>
            <div class="panel-footer">End List Tree</div>
        </div>
    <?php } ?>
    <hr>
    <h2>Hitung Lagi mulai dari atribut maint -> doors.</h2>
        <?php
        $maint_node = $this->m_data->treesss()->result();
        $nosq = 0;
        foreach($maint_node as $m){
        $nosq++;
    ?>
    <div class="well">
    <h1>Tree maint[<?php echo $m->maint ?>] -> doors[] </h1>
        <?php 
//        $inf_gain_f[$nosq] = array();
    ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th rowspan="2" colspan="2">Atribut</th>
            <th rowspan="2">Jumlah kasus</th>
            <th colspan="4">Class</th>
            <th rowspan="2">Entropy</th>
            <th rowspan="2">Inf. Gain</th>
          </tr>
            <tr>
                <th>unacc</th> 
                <th>acc</th> 
                <th>good</th> 
                <th>vgood</th> 
            </tr>
        </thead>
        <tbody>
            
        
          </tbody>
      </table>
        <h1>Inf Gain : <?php 
//        echo max($inf_gain_f[$nosq]);
        ?></h1>
    </div>
    <?php } ?>
</div>
</body>
</html>