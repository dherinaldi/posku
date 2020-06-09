<?php
error_reporting('E_ALL');
ini_set('display_errors', '1');
$u_id = $this->session->userdata('u_id');
$nama = $this->session->userdata('nama');
$u_name = $this->session->userdata('u_name');
$id_role = $this->session->userdata('id_role');


$tgl_awal_def = date('Y-m-d',strtotime("-7 day",strtotime(date('Y-m-d'))));
$tgl_akhir_def = date('Y-m-d',strtotime(date('Y-m-d')));

$tgl_awal =$_POST['tgl_awal'];
$tgl_akhir =$_POST['tgl_akhir'];

$s_where = " where 0=0 ";
if($tgl_awal !=''){
  $tgl_awal = date('Y-m-d ',strtotime($tgl_awal));
}else{
  $tgl_awal = $tgl_awal_def;
}

if($tgl_akhir !=''){
  $tgl_akhir = date('Y-m-d ',strtotime($tgl_akhir));
}else{
  $tgl_akhir = $tgl_akhir_def;
}

//total pendapatan harian untuk


$tgl_awal1 = new DateTime($tgl_awal);
$tgl_akhir1 = new DateTime($tgl_akhir);
$interval = $tgl_awal1->diff($tgl_akhir1);

echo $interval->days."days";
$int_day = $interval->days;

$m= date("m",strtotime($tgl_awal));
$de= date("d",strtotime($tgl_awal));
$y= date("Y",strtotime($tgl_awal));
echo $m."-".$de."-".$y;
$tot_umum=0;
$tot_jamin=0;

//untuk cek data tumum
for($i=0; $i<=$int_day; $i++){
  $tgl_banding = date('Y-m-d',mktime(0,0,0,$m,($de+$i),$y));
  $s_where_umum =" select sum(tumum) as tot_umum from tr_data_simrs where DATE_FORMAT(periode,'%Y-%m-%d')='".$tgl_banding."'";
  $q_where_umum1 = $this->db->query($s_where_umum);
  if($q_where_umum1->num_rows()>0){
    foreach ($q_where_umum1->result() as $key) {
      $tot_umum = $key->tot_umum;
    }
  }
  if(is_null($tot_umum)){
    $tot_umum=0;
  }
  $c_tot_umum[] = array('tot_umum'=>$tot_umum);
}

$umum1 = json_encode(array_column($c_tot_umum, 'tot_umum'),JSON_NUMERIC_CHECK);

//print_r($umum1);

//tjamin
for($i=0; $i<=$int_day; $i++){
  $tgl_banding = date('Y-m-d',mktime(0,0,0,$m,($de+$i),$y));
  $s_where_jamin =" select sum(tjamin) as tot_jamin from tr_data_simrs where DATE_FORMAT(periode,'%Y-%m-%d')='".$tgl_banding."'";
  $q_where_jamin1 = $this->db->query($s_where_jamin);
  if($q_where_jamin1->num_rows()>0){
    foreach ($q_where_jamin1->result() as $key) {
      $tot_jamin = $key->tot_jamin;
    }
  }
  if(is_null($tot_jamin)){
    $tot_jamin=0;
  }
  $c_tot_jamin[] = array('tot_jamin'=>$tot_jamin);
}
$jamin1 = json_encode(array_column($c_tot_jamin, 'tot_jamin'),JSON_NUMERIC_CHECK);

//periode x axis
for($i=0; $i<=$int_day; $i++){
  $tgl_banding = date('ymd',mktime(0,0,0,$m,($de+$i),$y));
  $c_tanggal[] = array('periode'=>$tgl_banding);
}
$periode1 = json_encode(array_column($c_tanggal, 'periode'),JSON_NUMERIC_CHECK);

?>
<script type="text/javascript">
  $(document).ready(function(){
    var todayDate = new Date().getDate();

    /*$('#tgl_awal').datepicker({
      format:'dd-mm-yyyy',orientation:'bottom',
      startDate: new Date(new Date().setDate(new Date().getDate() - 30)),
      endDate: new Date(new Date().setDate(new Date().getDate() + 30))
    });*/


    $('#tgl_awal').datepicker({
      format:'dd-mm-yyyy',orientation:'bottom',
      startDate: '-2m',
      endDate: '+2w'
    });
    $('#tgl_akhir').datepicker({
      format:'dd-mm-yyyy',orientation:'bottom',
      startDate: '-2m',
      endDate: '+2w'
    });

    var data_umum = <?php echo $umum1; ?>;
    var data_jamin = <?php echo $jamin1; ?>;
    var periode = <?php echo $periode1?>;
    var length_periode = <?php echo $int_day?>;

    $('#container').highcharts({
      chart: {
        type: 'column'
      },
      title: {
        text: 'Pendapatan Harian SIAKU - SIMRS '+length_periode+' hari terakhir'
      },
      xAxis: {
        categories: periode
      },
      yAxis: {
        labels: {
         formatter: function(){
           return this.value/1000000 + "jt";
         }
       },
       title: {
        text: 'Total'
      }
    },
    credits: {
      enabled: false
    },
    series: [{
      name: 'Umum',
      data: data_umum
    },{
      name : 'Jamin',
      data:data_jamin
    }
    ]
  });    
  });

</script>


<!-- Main row -->
<form method="POST">
  <div class="row">
    <div class="col-xs-3">
      <input type="text" name="tgl_awal" id="tgl_awal" class="form-control" value="<?php 
      if($_POST['tgl_awal'] != ''): echo $_POST['tgl_awal']; else: echo date('d-m-Y',strtotime("-7 day",strtotime(date('Y-m-d')))); endif;
      ?>">

    </div>
    <div class="col-xs-3">
      <input type="text" name="tgl_akhir" id="tgl_akhir" class="form-control" value="<?php 
      if($_POST['tgl_akhir'] != ''): echo $_POST['tgl_akhir']; else: echo date('d-m-Y',strtotime(date('Y-m-d'))); endif;
      ?>">
    </div>
    <div class="col-xs-3">
      <button type="submit" class="btn btn-primary btn-sm">Cek</button>
      <button type="button" class="btn btn-info btn-sm" id="cek">Cek1</button>
    </div>
  </div>
</form>
<div class="row">
  <h2 class="text-center">Data Pendapatan Harian SIMRS</h2>

  <div class="row">
    <div class=" col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>
        <div class="panel-body">
          <div id="container"  style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?php
        //$saldo_kppn = 400000000;
        //$sawal = ($sa->saldo_awal)-$saldo_kppn;
          $sawal = ($sa->saldo_awal);
          echo digit21($sawal);?></h3>
          <p>Saldo Efektif <?=$sd;?></p>
        </div>
        <div class="icon">
          <i class="ion ion-briefcase"></i>
        </div>
        <?php if($id_role!=3){?>
        <a href="#" class="small-box-footer">
          Lebih Lanjut <i class="fa fa-arrow-circle-right"></i>
        </a>
        <?php } ?>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?=digit21($sa_blu);?></h3>
          <p>Saldo Efektif <?=$sd_blu;?></p>
        </div>
        <div class="icon">
          <i class="ion ion-android-wifi"></i>
        </div>
        <?php if($id_role!=3){?>
        <a href="<?=base_url('master/master')?>" class="small-box-footer">
          Lebih Lanjut <i class="fa fa-arrow-circle-right"></i>
        </a>
        <?php } ?>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>dt</h3>
          <p>Indikator</p>
        </div>
        <div class="icon">
          <i class="ion ion-nuclear"></i>
        </div>
        <?php if($id_role!=3){?>
        <a href="<?=base_url('master/master/indikator')?>" class="small-box-footer">
          Lebih Lanjut <i class="fa fa-arrow-circle-right"></i>
        </a>
        <?php } ?>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-purple">
        <div class="inner">
          <h3> dt</h3>
          <p>Program</p>
        </div>
        <div class="icon">
          <i class="fa fa-desktop"></i>
        </div>
        <?php if($id_role!=3){?>
        <a href="<?=base_url('master/master/program')?>" class="small-box-footer">
          Lebih Lanjut <i class="fa fa-arrow-circle-right"></i>
        </a>
        <?php } ?>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-orange">
        <div class="inner">
          <h3> dt</h3>
          <p>Kegiatan</p>
        </div>
        <div class="icon">
          <i class="fa fa-puzzle-piece"></i>
        </div>
        <?php if($id_role!=3){?>
        <a href="<?=base_url('master/master/kegiatan')?>" class="small-box-footer">
          Lebih Lanjut <i class="fa fa-arrow-circle-right"></i>
        </a>
        <?php } ?>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3> dt</h3>
          <p>Sub Kegiatan</p>
        </div>
        <div class="icon">
          <i class="fa fa-exchange"></i>
        </div>
        <?php if($id_role!=3){?>
        <a href="<?=base_url('master/master/sub_kegiatan')?>" class="small-box-footer">
          Lebih Lanjut <i class="fa fa-arrow-circle-right"></i>
        </a>
        <?php } ?>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-teal-gradient">
        <div class="inner">
          <h3> dt</h3>
          <p>Jenis Belanja</p>
        </div>
        <div class="icon">
          <i class="fa fa-briefcase"></i>
        </div>
        <?php if($id_role!=3){?>
        <a href="<?=base_url('master/master/jenis_belanja')?>" class="small-box-footer">
          Lebih Lanjut <i class="fa fa-arrow-circle-right"></i>
        </a>
        <?php } ?>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green-gradient">
        <div class="inner">
          <h3> dt</h3>
          <p>Sub Jenis Belanja</p>
        </div>
        <div class="icon">
          <i class="fa  fa-asterisk"></i>
        </div>
        <?php if($id_role!=3){?>
        <a href="<?=base_url('master/master/sub_jenis_belanja')?>" class="small-box-footer">
          Lebih Lanjut <i class="fa fa-arrow-circle-right"></i>
        </a>
        <?php } ?>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-light-blue-gradient">
        <div class="inner">
          <h3> dt</h3>
          <p>Jenis Biaya</p>
        </div>
        <div class="icon">
          <i class="fa fa-bookmark"></i>
        </div>
        <?php if($id_role!=3){?>
        <a href="<?=base_url('master/master/jenis_biaya')?>" class="small-box-footer">
          Lebih Lanjut <i class="fa fa-arrow-circle-right"></i>
        </a>
        <?php } ?>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-maroon">
        <div class="inner">
          <h3> dt</h3>
          <p>Barang</p>
        </div>
        <div class="icon">
          <i class="fa fa-adjust"></i>
        </div>
        <?php if($id_role!=3){?>
        <a href="<?=base_url('master/master/barang')?>" class="small-box-footer">
          Lebih Lanjut <i class="fa fa-arrow-circle-right"></i>
        </a>
        <?php } ?>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3> dt</h3>
          <p>Unit</p>
        </div>
        <div class="icon">
          <i class="fa fa-list"></i>
        </div>
        <?php if($id_role!=3){?>
        <a href="<?=base_url('master/master/unit')?>" class="small-box-footer">
          Lebih Lanjut <i class="fa fa-arrow-circle-right"></i>
        </a>
        <?php } ?>
      </div>
    </div>

    </div><!-- ./row -->