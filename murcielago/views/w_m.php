<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Datasets</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.css">
  <link id="css-preset" href="<?php echo base_url() ?>assets/dist/css/presets/preset1.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/dist/css/responsive.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/select2/dist/css/select2.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/pace/pace.css">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/plugins/sweetalert/sweetalert.css">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vegas/vegas.min.css">
<script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
   

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
</head>
<body class=" layout-top-nav skin-purple-light">
    
<!--header-->
<!--header-->
<!--header-->
<!--header-->
<!--header-->
<!--header-->
<!--header-->
<div class="wrapper" style="height: auto; min-height: 100%;">

      <div class="content-wrapper" style="min-height: 534px;">
        <div class="container-fluid">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              Data train
            </h1>
          </section>
          <section class="content">
            <div class="box box-primary collapsed-box">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Mencari Node</h3>

                                  <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                                      <i class="fa fa-minus"></i></button>
                                  </div>
                                </div>
                                <div class="box-body">
                                    <?php 
                                        $inf_gain_f = array();
                                        $nama_class = array();
                                    ?>
                                      <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th rowspan="2" colspan="2">Atribut</th>
                                            <th rowspan="2">Jumlah kasus</th>
                                            <th colspan="2">Class</th>
                                            <th rowspan="2">Entropy</th>
                                            <th rowspan="2">Inf. Gain</th>
                                          </tr>
                                            <tr>
                                                <th>Iris Setosa</th> 
                                                <th>Iris Virginica</th> 
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
                                                $iris1 = $this->m_data->where('train',array('class_values' => 'Iris-setosa'))->num_rows();    
                                            ?>
                                            <td><?php echo $iris1 ?></td>
                                          
                                                   <?php
                                                $iris3 = $this->m_data->where('train',array('class_values' => 'Iris-virginica'))->num_rows();    
                                            ?>
                                              <td><?php echo $iris3 ?></td>
                                                <td><?php 
                            $f1 = ($iris1 == 0) ? 0 : ( ($iris1/$jml_kasus) * (log(($iris1/$jml_kasus),2)) );
                            $f3 = ($iris3 == 0) ? 0 : ( ($iris3/$jml_kasus) * (log(($iris3/$jml_kasus),2)) );
                                            $en_start = -($f1+$f3);
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

                                                    $iris1 = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'class_values' => 'Iris-setosa'))->num_rows();
                                                      
                                                    $iris3 = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'class_values' => 'Iris-virginica'))->num_rows(); 
                                                    
                                                    $f1 = ($iris1 == 0) ? 0 : ( ($iris1/$jmlq) * (log(($iris1/$jmlq),2)) );
                                                    
                                                   
                                                    
                                                    $f3 = ($iris3 == 0) ? 0 : ( ($iris3/$jmlq) * (log(($iris3/$jmlq),2)) );
                                                    
                                                    $ttl = -($f1+$f3);
                                                    $inf_gain_buying += ($jmlq/$jml_kasus * $ttl) ;                           
                                                }
                                                ?>
                                            <td colspan="6" style="font-size:20px;font-weight:700;text-transform:uppercase;background-color:#1abc9c">atribut : <?php echo $g->atribut ?></td>
                                                 <?php 
                                                    array_push($nama_class,$g->atribut);
                                                ?>
                                                <td style="font-weight:700;background-color:#1abc9c;font-size:20px;"><?php echo round($en_start - ($inf_gain_buying),4); 
                                                array_push($inf_gain_f,($en_start - ($inf_gain_buying))); ?></td>

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
                                                $iris1 = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'class_values' => 'Iris-setosa'))->num_rows();    
                                                ?>
                                                <td><?php echo $iris1 ?></td>
                                                   <?php
                                                    $iris3 = $this->m_data->where('train',array($g->atribut => $b[''.$g->atribut.''],'class_values' => 'Iris-virginica'))->num_rows();    
                                                ?>
                                                <td><?php echo $iris3 ?></td>
                                                        <td><?php 
                                                $f1 = ($iris1 == 0) ? 0 : ( -($iris1/$jmlx) * (log(($iris1/$jmlx),2)) );
                                               
                                                $f3 = ($iris3 == 0) ? 0 : ( -($iris3/$jmlx) * (log(($iris3/$jmlx),2)) );
                                              
                                                $ttl = $f1+$f3;
                                                    echo round(
                                                 $ttl
                                                ,4); ?></td>
                                                <td></td>
                                            </tr>
                                            <?php } ?>
                                            <?php } ?>
                                          </tbody>
                                      </table>
                                        <h1>Inf Gain : 
                                    <?php 
                                       $k =array_search(max($inf_gain_f),$inf_gain_f);
            //                                    echo $k."<br>";
                                        echo round(max($inf_gain_f),4)."<br>";
                                            echo strtoupper($nama_class[$k]);
                                        ?></h1>
                                </div>
                              </div>
<!--        wates    -->
  
         </section>
        </div>
      </div>
      <footer class="main-footer">
        <div class="container">
          <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.13
          </div>
          <strong>Copyright © <?php echo date("Y") ?> <a href="javascript:void(0)">Angger Pangestu Ari</a>.</strong> All rights
          reserved.
        </div>
        <!-- /.container -->
      </footer>
    </div>
            
<!--footer-->
<!--footer-->
<!--footer-->
<!--footer-->
<!--footer-->
<!--footer-->
<!--footer-->
<!--footer-->
    <script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/vegas/vegas.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/PACE/pace.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url() ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>
</body>
</html>