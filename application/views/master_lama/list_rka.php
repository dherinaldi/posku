<?
error_reporting('E_ALL');
ini_set('display_errors', '1');
?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#tb_anggaran").dataTable({
			"lengthMenu": [[100,200, -1], [100,200,"All"]]
		});
		$('#tahun').datepicker({
			 format: " yyyy", // Notice the Extra space at the beginning
			 viewMode: "years",
			 orientation: "auto bottom",
			 minViewMode: "years",
			 //endDate: new Date()

			});
		$('#sel_unit').chosen({search_contains: true});

	});
</script>
<div class="row">
	<div class="col-md-8">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"><?=$title;?></h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<form method="post" name="f_post" id="f_post">
					<div class="table-responsive">
						<table class="table table-hover">
							<tbody>
								<tr>
									<td>SJB</td>
									<td>
										<input type="text" name="sjb" id="sjb" class="form-control" value="<?php
										if($_POST['sjb'] != ''): echo $_POST['sjb']; else: echo " "; endif;

										?>">
									</td>
									<td>JB</td>
									<td><input type="text" name="jb" id="jb" class="form-control" value="<?php
										if($_POST['jb'] != ''): echo $_POST['jb']; else: echo " "; endif;

										?>">
									</td>

								</tr>
								<tr>
									<td>MAK</td>

									<td width="300px">
										<input type="text" name="mak" id="mak" class="form-control" value="<?php
										if($_POST['mak'] != ''): echo $_POST['mak']; else: echo " "; endif;

										?>">
									</td>

									<td>KMAK</td>

									<td width="300px">
										<input type="text" name="kmak" id="kmak" class="form-control" value="<?php
										if($_POST['kmak'] != ''): echo $_POST['kmak']; else: echo " "; endif;

										?>">
									</td>
								</tr>
								<tr>
									<td>BB</td>

									<td width="300px">
										<input type="text" name="bb" id="bb" class="form-control" value="<?php
										if($_POST['bb'] != ''): echo $_POST['bb']; else: echo " "; endif;

										?>">
									</td>

									<td>BOP</td>

									<td width="300px">
										<input type="text" name="bop" id="bop" class="form-control" value="<?php
										if($_POST['bop'] != ''): echo $_POST['bop']; else: echo " "; endif;

										?>">
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<button type="submit" class="btn btn-sm btn-primary" id="cari">Cari</button>
										<button type="button" class="btn btn-sm btn-warning" id="resetbtn">Reset</button>
									</td>

								</tr>

							</tbody>
						</table>
					</div>
				</form>

			</div> <!-- /.box-body -->
		</div> <!-- /.box -->
	</div>
</div>
<?
if(!isset($_POST['f_post'])){
	//$s_where =$s_program=$s_kegiatan=$s_indikator=$s_sub_kegiatan=$s_tahun=$s_unit= "";
	$s_where=$s_sjb= $s_jb =$s_mak=$s_kmak=$s_bb=$s_bop="";

	$sjb = trim($_POST['sjb']);
	$jb = trim($_POST['jb']);
	$mak = trim($_POST['mak']);
	$kmak = trim($_POST['kmak']);
	$bb = trim($_POST['bb']);
	$bop = trim($_POST['bop']);

	if (!empty($sjb) and trim($sjb)!= '') {
		$s_sjb = " and sjbr.nama_sjb_rka like '%".trim($sjb)."%'";
	}else{
		$s_sjb = " ";
	}

	if (!empty($jb) and trim($jb)!= '') {
		$s_jb = " and sjbr.nama_jb_rka like '%".trim($jb)."%'";
	}else{
		$s_jb = " ";
	}

	if (!empty($mak) and trim($mak)!= '') {
		$s_mak = " and sjbr.kode_mak like '%".trim($mak)."%'";
	}else{
		$s_mak = " ";
	}

	if (!empty($kmak) and trim($kmak)!= '') {
		$s_kmak = " and sjbr.klasifikasi_akun_mak like '%".trim($kmak)."%'";
	}else{
		$s_kmak = " ";
	}

	if (!empty($bb) and trim($bb)!= '') {
		$s_bb = " and sjbr.nama_bb like '%".trim($bb)."%'";
	}else{
		$s_bb = " ";
	}

	if (!empty($bop) and trim($bop)!= '') {
		$s_bop = " and sjbr.nama_bop like '%".trim($bop)."%'";
	}else{
		$s_bop = " ";
	}


	//$s_where = $s_program.$s_indikator.$s_kegiatan.$s_sub_kegiatan;
	$s_where = $s_sjb.$s_jb.$s_mak.$s_kmak.$s_bb.$s_bop;
			//echo 'sip'.$program;
}


	$s_sjb = "SELECT
	sjbr.id_sjb_rka ,
	sjbr.nama_sjb_rka,
	sjbr.id_jb_rka,
	sjbr.nama_jb_rka,
	sjbr.tanggal,
	sjbr.upd,
	sjbr.urut,
	sjbr.id_mak,
	sjbr.kode_mak mak,
	sjbr.klasifikasi_akun_mak kmak,
	sjbr.id_bb,
	sjbr.nama_bb bb,
	sjbr.id_bop,
	sjbr.nama_bop bop,
	sjbr.aktif
	FROM
	vw_sjb_rka sjbr
	where aktif in (1,0) ".$s_where."
	ORDER BY
	sjbr.id_sjb_rka,
	sjbr.id_jb_rka,
	sjbr.id_mak";
	$q_sjb = $this->db->query($s_sjb);

	//echo $s_sjb;
	?>

	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
			<!--<div class="info-box"> -->
		<!-- <a href="#" class="btn btn-sm btn-success">
		<span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Tambah </a> -->
		<!--</div><!-- /.info-box -->
	</div><!-- /.col -->
</div>
<p></p>
<div class="row">
	<!--datagrid-->
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"><?=$title;?></h3>

			</div><!-- /.box-header -->
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-hover" id="tb_anggaran">
						<thead>
							<tr>
								<th>SJB</th>
								<th>JB</th>
								<th>MAK</th>
								<th>KMAK</th>
								<th>BB</th>
								<th>BOP</th>
							</tr>
						</thead>
						<tbody>
							<?foreach ($q_sjb->result() as $key) {

								?>
								<tr>
									<td><?=$key->nama_sjb_rka;?></td>
									<td><?=$key->nama_jb_rka;?></td>
									<td><?=$key->mak;?></td>
									<td><?=$key->kmak;?></td>
									<td><?=$key->bb;?></td>
									<td><?=$key->bop;?></td>
								</tr>
								<?}?>
							</tbody>
						</table>
					</div>
				</div> <!-- /.box-body -->
			</div> <!-- /.box -->
		</div> <!-- /.col-xs-12 -->
	</div> <!-- /.row -->



