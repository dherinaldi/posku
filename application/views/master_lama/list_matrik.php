<?
error_reporting('E_ALL');
ini_set('display_errors', '1');
?>
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
					$query = "SELECT
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
					//echo $query;

					$result = mysql_query($query);

        # $arr is array which will be help ful during 
        # printing
					$arr=$arr1=$arr_s=$arr_u = $arr_p = $arr_per = array();

        # Intialize the array, which will 
        # store the fetched data.
					$indikator =$sasaran=$program=$unit=$perspektif= array();
					$sal = array();
					$emp = array();
					$total=0;

        #%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%#
        #     data saving and rowspan calculation        #
        #%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%#

        # Loop over all the fetched data, and save the
        # data.
					while($row = mysql_fetch_assoc($result)) {
						array_push($perspektif, $row['id_perspektif']."|".$row['perspektif']);
						array_push($indikator, $row['indikator']);
						array_push($sasaran, $row['sasaran']);
						array_push($program, $row['program']);
						array_push($emp, $row['ename']."|".$row['kegiatan']);
						array_push($sal, $row['sal']."|".$row['sub_kegiatan']);

						if (!isset($arr[$row['ename']."|".$row['kegiatan']])) {
							$arr[$row['ename']."|".$row['kegiatan']]['rowspan'] = 0;
						}
						$arr[$row['ename']."|".$row['kegiatan']]['printed'] = 'no';
						$arr[$row['ename']."|".$row['kegiatan']]['rowspan'] += 1;

						if (!isset($arr1[$row['indikator']])) {
							$arr1[$row['indikator']]['rowspan'] = 0;
						}
						$arr1[$row['indikator']]['printed'] = 'no';
						$arr1[$row['indikator']]['rowspan'] += 1;

						if (!isset($arr_s[$row['sasaran']])) {
							$arr_s[$row['sasaran']]['rowspan'] = 0;
						}
						$arr_s[$row['sasaran']]['printed'] = 'no';
						$arr_s[$row['sasaran']]['rowspan'] += 1;

						if (!isset($arr_p[$row['program']])) {
							$arr_p[$row['program']]['rowspan'] = 0;
						}
						$arr_p[$row['program']]['printed'] = 'no';
						$arr_p[$row['program']]['rowspan'] += 1;
						

						if (!isset($arr_per[$row['id_perspektif']."|".$row['perspektif']])) {
							$arr_per[$row['id_perspektif']."|".$row['perspektif']]['rowspan'] = 0;
						}
						$arr_per[$row['id_perspektif']."|".$row['perspektif']]['printed'] = 'no';
						$arr_per[$row['id_perspektif']."|".$row['perspektif']]['rowspan'] += 1;
					}


        #%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
        #        DATA PRINTING             #
        #%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%#
					echo "<table cellspacing='1' cellpadding='10' class='table table-hover'>
					<tr>
						<th>Perspektif</th>
						<th>Sasaran</th>
						<th>Indikator</th>
						<th>Program</th>
						<th>Kegiatan</th>
						<th>Sub Keg</th>
					</tr>";


					for($i=0; $i < sizeof($sal); $i++) {
						$empName = $emp[$i];		
						$emp_split = explode("|",$emp[$i]);
						$indikatorName = $indikator[$i];
						$sasaranName = $sasaran[$i];
						$programName = $program[$i];
						$unitName = $unit[$i];
						$perspektifName = $perspektif[$i];
						$per_split = explode("|",$perspektif[$i]);

						$salName = $sal[$i];
						$sal_split = explode("|",$sal[$i]);
		//echo ($empName[0]);

						echo "<tr>";
            # If this row is not printed then print.
            # and make the printed value to "yes", so that
            # next time it will not printed.
						if ($arr_per[$perspektifName]['printed'] == 'no') {
							echo "<td rowspan='".$arr_per[$perspektifName]['rowspan']."' class='wd100'>".$per_split[1]."</td>";
							$arr_per[$perspektifName]['printed'] = 'yes';
						}

						if ($arr_s[$sasaranName]['printed'] == 'no') {
							echo "<td rowspan='".$arr_s[$sasaranName]['rowspan']."' class='wd100'>".$sasaranName."</td>";
							$arr_s[$sasaranName]['printed'] = 'yes';
						}
						if ($arr1[$indikatorName]['printed'] == 'no') {
							echo "<td rowspan='".$arr1[$indikatorName]['rowspan']."' class='wd100'>".$indikatorName."</td>";
							$arr1[$indikatorName]['printed'] = 'yes';
						}
						if ($arr_p[$programName]['printed'] == 'no') {
							echo "<td rowspan='".$arr_p[$programName]['rowspan']."' class='wd100'>".$programName."</td>";
							$arr_p[$programName]['printed'] = 'yes';
						}
						if ($arr[$empName]['printed'] == 'no') {
							echo "<td rowspan='".$arr[$empName]['rowspan']."'><div class='wd200'>".$emp_split[0]." - ".$emp_split[1]."</div></td>";
							$arr[$empName]['printed'] = 'yes';
						}

						echo "<td>".$sal_split[0]."-".$sal_split[1]."</td>";
					}
					echo "</table>";
					?>
				</div>
			</div> <!-- /.box-body -->
		</div> <!-- /.box -->
	</div> <!-- /.col-xs-12 -->
</div> <!-- /.row -->

