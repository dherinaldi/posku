<?php
error_reporting('E_ALL');
ini_set('display_errors', '1');
?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#tb_anggaran").dataTable();
		$('#tgl').datepicker({format:'dd-mm-yyyy',orientation:'bottom'});
		$('#unit').chosen({search_contains: true});

	});
</script>
<div class="row">
	<div class="col-md-8">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"><?php echo $title;?></h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<form method="post" name="f_post" id="f_post">
					<table class="table table-hover">
						<tbody>
							<tr>
								<td>BKU</td>
								<td>
									<input type="text" name="bku" id="bku" class="form-control" value="<?php 
									if($_POST['bku'] != ''): echo $_POST['bku']; else: echo " "; endif;

									?>">
								</td>
								<td>MAK</td>
								<td>
									<input type="text" name="mak" id="mak" class="form-control" value="<?php 
									if($_POST['mak'] != ''): echo $_POST['mak']; else: echo " "; endif;

									?>">
								</td>
							</tr>
							<tr>
								<td>AKUN</td>
								<td>
									<input type="text" name="akun" id="akun" class="form-control" value="<?php 
									if($_POST['akun'] != ''): echo $_POST['akun']; else: echo " "; endif;

									?>">
								</td>
								<td>JENIS</td>
								<td>
									<select name="jenis" id="jenis" class="form-control" required="required">
										<option value=""></option>
									</select>
								</td>
							</tr>
							<tr>

								<td>Tanggal</td>
								<td>
									<input type="text" name="tgl" id="tgl" class="form-control wd100" value="<?php 
									if($_POST['tgl'] != ''): echo $_POST['tgl']; else: echo date('d-m-Y',strtotime(date('Y-m-d'))); endif;
									?>">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<button type="submit" class="btn btn-sm btn-primary" id="cari">Cari</button>
									<a href="#" class="btn btn-sm btn-success">
										<span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Tambah </a>
									</td>

								</tr>

							</tbody>
						</table>
					</div>
				</form>

			</div> <!-- /.box-body -->
		</div> <!-- /.box -->
	</div>
	<?php
		/*if(!isset($_POST['f_post'])){
			$s_where =$s_sjbr=$s_jenis=$s_unit="";

			$sjbr = trim($_POST['sjbr']);
			$jenis = trim($_POST['jenis']);
			$tahun = trim($_POST['tahun']);

			if (!empty($sjbr) and trim($sjbr)!= '') {
				$s_sjbr = " and nama_sjb_rka like '%".$sjbr."%' ";
			}else{  
				$s_sjbr = "";
			}

			if (!empty($jenis) and trim($jenis)!= '') {
				if(trim($jenis==2)){
					$s_jenis = " and bobot =0";
				}elseif(trim($jenis==999)){
					$s_jenis =" and bobot in (select DISTINCT(ts.bobot) from t_sjb_rka ts) ";
				}
				else{
					$s_jenis = " and bobot =".$jenis;
				}
			}
			else{  
				$s_jenis = "";
			}

			if (!empty($tahun) and trim($tahun)!= '') {
				$s_tahun = $tahun;
			}else{  
				$s_tahun = date('Y',strtotime("+1 year".date('Y-m-d')));
			}

			$s_where = $s_sjbr.$s_jenis;

		}*/

		$s ="select * from vw_tr_keu order by tgl desc limit 100";
		$q_s = $this->db->query($s);
		?>

		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
				
			</div><!-- /.col -->
		</div>
		<p></p>
		<div class="row">
			<!--datagrid-->
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title"><?php echo $title;?></h3>

					</div><!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
							<table class="table table-hover" id="tb_anggaran">
								<thead>
									<tr>
										<th>No</th>
										<th>BKU</th>
										<th>MAK</th>
										<th>URAIAN</th>
										<th>AKUN</th>
										<th>JUM</th>
										<th>JNS</th>
										<th>TUJ</th>
										<th>SD</th>
										<th>TGL</th>
										<th>OPSI</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no=1;
									foreach ($q_s->result() as $key) {
										?>
										<tr>
											<td><?php echo $no;?></td>
											<td><?php echo $key->no_bku;?></td>
											<td><?php echo $key->mak;?></td>
											<td><?php echo $key->uraian;?></td>
											<td><?php echo $key->nama_akun;?></td>
											<td align="right"><?php echo digit2($key->nominal);?></td>
											<td><?php echo $key->nama_jenis;?></td>
											<td><?php echo $key->nama_tuj;?></td>
											<td><?php echo $key->nama_sd;?></td>
											<td><?php echo converttgl1($key->tgl);?></td>
											<td></td>
										</tr>
										<?php
										$no++;
									}?>
								</tbody>

								<tfoot>

								</tfoot>

							</table>
						</div>
					</div> <!-- /.box-body -->
				</div> <!-- /.box -->
			</div> <!-- /.col-xs-12 -->
		</div> <!-- /.row -->
