<?
error_reporting('E_ALL');
ini_set('display_errors', '1');
?>
<style>
	table, th, td {
		border: 1px solid black;
	}
</style>
<script type="text/javascript">
	$(document).ready(function() {
		$("#tb_anggaran").dataTable();
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
									<td>Indikator</td>
									<td>
										<input type="text" name="indikator" id="indikator" class="form-control" value="<?php 
										if($_POST['indikator'] != ''): echo $_POST['indikator']; else: echo " "; endif;

										?>">
									</td>
									<td>Program</td>
									<td><input type="text" name="program" id="program" class="form-control" value="<?php 
										if($_POST['program'] != ''): echo $_POST['program']; else: echo " "; endif;

										?>">
									</td>
									
								</tr>
								<tr>
									<td>Kegiatan</td>

									<td width="300px">
										<input type="text" name="kegiatan" id="kegiatan" class="form-control" value="<?php 
										if($_POST['kegiatan'] != ''): echo $_POST['kegiatan']; else: echo " "; endif;

										?>">
									</td>

									<td>Sub Kegiatan</td>

									<td width="300px">
										<input type="text" name="sub_kegiatan" id="sub_kegiatan" class="form-control" value="<?php 
										if($_POST['sub_kegiatan'] != ''): echo $_POST['sub_kegiatan']; else: echo " "; endif;

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
	$s_where =$s_program=$s_kegiatan=$s_indikator=$s_sub_kegiatan=$s_tahun=$s_unit= "";

	$program = trim($_POST['program']);
	$indikator = trim($_POST['indikator']);
	$kegiatan = trim($_POST['kegiatan']);
	$sub_kegiatan = trim($_POST['sub_kegiatan']);		

	if (!empty($program) and trim($program)!= '') {
		$s_program = " and nama_program like '%".trim($program)."%'";
	}else{  
		$s_program = " ";
	}
	if (!empty($indikator) and trim($indikator)!= '') {
		$s_indikator = " and nama_indikator like '%".trim($indikator)."%'";
	}else{  
		$s_indikator = " ";
	}
	if (!empty($kegiatan) and trim($kegiatan)!= '') {
		$s_kegiatan = " and nama_kegiatan like '%".trim($kegiatan)."%'";
	}else{  
		$s_kegiatan = " ";
	}

	if (!empty($sub_kegiatan) and trim($sub_kegiatan)!= '') {
		$s_sub_kegiatan = " and nama_sub_kegiatan like '%".trim($sub_kegiatan)."%'";
	}else{  
		$s_sub_kegiatan = " ";
	}

	$s_where = $s_program.$s_indikator.$s_kegiatan.$s_sub_kegiatan;
			//echo 'sip'.$program;
}

	/*$s_anggaran = "select * from vw_anggaran_belanja where DATE_FORMAT(tahun,'%Y')='".$s_tahun."' ".$s_where." order by tanggal desc";
	
	echo $s_anggaran;
	$q_anggaran = $this->db->query($s_anggaran);*/
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
					<?php
        # connect to mysql server
        # and select the database, on which
        # we will work.
					$conn = mysql_connect('localhost', 'root', '');
					$db   = mysql_select_db('db_rba');

        # Query the data from database.
        //$query  = 'SELECT * FROM test_work ORDER BY ename, sal';
					/*$query = "SELECT
					vab.id_perspektif id_perspektif,
					vab.nama_perspektif perspektif,
					vab.id_sasaran,
					vab.nama_sasaran sasaran,
					vab.id_indikator,
					vab.nama_indikator indikator,
					vab.id_program ,
					vab.nama_program program,
					vab.id_kegiatan as ename,
					vab.nama_kegiatan kegiatan,
					vab.id_sub_kegiatan as sal,
					vab.nama_sub_kegiatan sub_kegiatan
					FROM
					`vw_sub_kegiatan` vab
					where vab.id_sub_kegiatan is not null ".$s_where."
					ORDER BY
					vab.id_perspektif,vab.id_sasaran, vab.id_indikator,vab.id_kegiatan,vab.id_sub_kegiatan";
					echo $query;*/

					$query ="SELECT
					sjbr.id_sjb_rka as sal,
					sjbr.nama_sjb_rka,
					sjbr.id_jb_rka as ename,
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
					sjbr.nama_bop bop
					FROM
					vw_sjb_rka sjbr
					ORDER BY
					sjbr.id_sjb_rka,
					sjbr.id_jb_rka,
					sjbr.id_mak";

					$result = mysql_query($query);

        # $arr is array which will be help ful during 
        # printing
					$arr =$arr_mak =$arr_bb=$arr_bop=array();

        # Intialize the array, which will 
        # store the fetched data.
					$sal =$mak = $bb=$bop= array();
					$emp = array();
					$total=0;

        #%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%#
        #     data saving and rowspan calculation        #
        #%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%#

        # Loop over all the fetched data, and save the
        # data.
					while($row = mysql_fetch_assoc($result)) {
						array_push($emp, $row['ename']."|".$row['nama_jb_rka']);
						array_push($sal, $row['sal']."|".$row['nama_sjb_rka']);
						array_push($mak, $row['id_mak']."|".$row['mak']."|".$row['kmak']);
						array_push($bb, $row['id_bb']."|".$row['bb']);
						array_push($bop, $row['id_bop']."|".$row['bop']);

						if (!isset($arr[$row['ename']."|".$row['nama_jb_rka']])) {
							$arr[$row['ename']."|".$row['nama_jb_rka']]['rowspan'] = 0;
						}
						$arr[$row['ename']."|".$row['nama_jb_rka']]['printed'] = 'no';
						$arr[$row['ename']."|".$row['nama_jb_rka']]['rowspan'] += 1;

						if (!isset($arr_mak[$row['id_mak']."|".$row['mak']."|".$row['kmak']])) {
							$arr_mak[$row['id_mak']."|".$row['mak']."|".$row['kmak']]['rowspan'] = 0;
						}
						$arr_mak[$row['id_mak']."|".$row['mak']."|".$row['kmak']]['printed'] = 'no';
						$arr_mak[$row['id_mak']."|".$row['mak']."|".$row['kmak']]['rowspan'] += 1;

						if (!isset($arr_bb[$row['id_bb']."|".$row['bb']])) {
							$arr_bb[$row['id_bb']."|".$row['bb']]['rowspan'] = 0;
						}
						$arr_bb[$row['id_bb']."|".$row['bb']]['printed'] = 'no';
						$arr_bb[$row['id_bb']."|".$row['bb']]['rowspan'] += 1;

						if (!isset($arr_bop[$row['id_bop']."|".$row['bop']])) {
							$arr_bop[$row['id_bop']."|".$row['bop']]['rowspan'] = 0;
						}
						$arr_bop[$row['id_bop']."|".$row['bop']]['printed'] = 'no';
						$arr_bop[$row['id_bop']."|".$row['bop']]['rowspan'] += 1;
					}


        #%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
        #        DATA PRINTING             #
        #%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%#
					echo "<table cellspacing='1' cellpadding='10' class='table table-hover'>
					<tr>
						<th>SJBR</th>
						<th>JBR</th>
						<th>MAK</th>
						<th>KMAK</th>
						<th>BB</th>
						<th>BOP</th>
					</tr>";


					for($i=0; $i < sizeof($sal); $i++) {
						$empName = $emp[$i];		
						$emp_split = explode("|",$emp[$i]);

						$salName = $sal[$i];
						$sal_split = explode("|",$sal[$i]);

						$makName = $mak[$i];
						$mak_split = explode("|",$mak[$i]);

						$bbName = $bb[$i];
						$bb_split = explode("|",$bb[$i]);


						$bopName = $bop[$i];
						$bop_split = explode("|",$bop[$i]);

						echo "<tr>";
            # If this row is not printed then print.
            # and make the printed value to "yes", so that
            # next time it will not printed.
						
						echo "<td class='wd200 wrap'>".$sal_split[0]." - ".$sal_split[1]."</td>";
						if ($arr[$empName]['printed'] == 'no') {
							echo "<td rowspan='".$arr[$empName]['rowspan']."' class='wd100'>".$emp_split[1]."</td>";
							$arr[$empName]['printed'] = 'yes';
						}

						if ($arr_mak[$makName]['printed'] == 'no') {
							echo "<td rowspan='".$arr_mak[$makName]['rowspan']."' class='wd100'>".$mak_split[1]."</td>";
							echo "<td rowspan='".$arr_mak[$makName]['rowspan']."' class='wd100'>".$mak_split[2]."</td>";
							$arr_mak[$makName]['printed'] = 'yes';
						}

						if ($arr_bb[$bbName]['printed'] == 'no') {
							echo "<td rowspan='".$arr_bb[$bbName]['rowspan']."' class='wd100'>".$bb_split[1]."</td>";	
							$arr_bb[$bbName]['printed'] = 'yes';
						}
						if ($arr_bop[$bopName]['printed'] == 'no') {
							echo "<td rowspan='".$arr_bop[$bopName]['rowspan']."' class='wd100'>".$bop_split[1]."</td>";	
							$arr_bop[$bopName]['printed'] = 'yes';
						}
					}
					echo "</table>";
					?>
				</div>
			</div> <!-- /.box-body -->
		</div> <!-- /.box -->
	</div> <!-- /.col-xs-12 -->
</div> <!-- /.row -->



