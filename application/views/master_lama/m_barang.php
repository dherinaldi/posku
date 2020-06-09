<?
error_reporting('E_ALL');
ini_set('display_errors', '1');
?>

<script type="text/javascript">
	$(document).ready(function() {
		
		$("#tb").dataTable({
			"lengthMenu": [[25, 50,100, -1], [25, 50, 100,"All"]]
		});

	});
	$(document).ajaxStart(function(){
		$('#loading').show();
	}).ajaxStop(function(){
		$('#loading').hide();
	});
</script>

<div class="row">
	<div class="col-md-8">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"><?=$title;?></h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<form method="GET" name="f_post" id="f_post" >       
					<div class="table-responsive">
						<table class="table table-hover">
							<tbody>
								<tr>
									<td>Kode</td>
									<td><input type="text" name="kode" id="kode" class="form-control" value="<?php 
										if($_GET['kode'] != ''): echo $_GET['kode']; else: echo " "; endif;

										?>">
									</td>

									<td>Nama</td>
									<td>
										<input type="text" name="nama" id="nama" value="<?php 
										if($_GET['nama'] != ''): echo $_GET['nama']; else: echo " "; endif;

										?>" placeholder="" class="form-control">
									</td>

									
								</tr>
								<tr>
									<td>Aktif</td>
									<td>
										<select name="aktif" id="aktif" class="form-control" required="required">
											<option value="0">- PILIH -</option>
											<?$arr = array(1=>'aktif',2=>"non aktif",3=>'all');
											foreach($arr as $x => $x_value) {
												if($_GET['aktif'] != '' and $_GET['aktif']==$x){
													echo "<option value=".$x." selected='selected'>".$x_value."</option>";

												}else{
													echo "<option value=".$x.">".$x_value."</option>";
												}
											}

											?>
										</select>

									</td>
									<td>Show </td>

									<td width="300px">
										<?$arr = array(50,100,250,500, 1000,'all');
										?>
										<select name="show" id="show" class="form-control" required="required">
											<option value="0">- PILIH -</option>
											<?
											foreach ($arr as &$val) {
												if($_GET['show'] != '' and $_GET['show']==$val){?>
												<option value="<?=$val;?>" selected="selected"><?=$val;?> data </option>
												<?}else{?>
												<option value="<?=$val;?>"><?=$val;?> data </option>
												<?}
											}?>
										</select>
									</td>
								</tr>

								<tr>
									<td colspan="2">
										<button type="submit" class="btn btn-sm btn-primary" id="cari">Cari</button>
										<button type="button" class="btn btn-sm btn-warning" id="resetbtn">Reset</button>
										<a href="<?=base_url('master/master/add_barang')?>" class="btn btn-sm btn-success">
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
	</div>
	<?
	$s_where =$s_nama=$s_kode=$s_show=$s_aktif= "";

	$kode = $_GET['kode'];
	$nama = $_GET['nama'];
	$show = $_GET['show'];
	$aktif = $_GET['aktif'];

	if (!empty($kode) and trim($kode)!= '') {
		$s_kode = " and kode_barang like '%".trim($kode)."%'";
	}else{  
		$s_kode = " ";
	}

	if (!empty($nama) and trim($nama)!= '') {
		$s_nama = " and nama_barang like '%".trim($nama)."%'";
	}else{  
		$s_nama = " ";
	}

	if (trim($show)!= '' and !empty($nama) and trim($show)!= 0){
		$show=" limit ".$show."";
	}elseif(trim($show)=='all'){
		$show="";
	}
	else{
		$show=" limit 100";
	}
	

	if (!empty($aktif) and trim($aktif)!= '' ) {
		if($aktif==3){
			$aktif="0,1";
		}elseif($aktif==2){
			$aktif="0";
		}
		else{
			$aktif=$aktif;
		}
		$s_aktif = " where aktif in (".trim($aktif).")";

	}elseif(trim($aktif)== 0){
		$s_aktif = " where aktif in (0,1)";
	}
	else{
		$s_aktif = " where aktif in (0,1) ";
	}

	//echo $s_aktif;
	$s_where = $s_nama.$s_kode;

	$s_barang = "select * from m_barang ".$s_aktif." ".$s_where." order by tanggal desc ".$show."";
	echo $s_barang;

	$q_barang =$this->db->query($s_barang);
	?>

	<p></p>
	<div class="row">
		<!--datagrid-->
		<div class="col-md-10">
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title"><?=$title;?></h3>

				</div><!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover" id="tb">
							<thead>
								<tr>
									<th width="50px">No</th>
									<th>Kode</th>
									<th>Nama</th>
									<th>Sat</th>
									<th>Harga</th>
									<th>St</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?
								$no=1;
								foreach ($q_barang->result() as $key) {
									$id_barang = $key->id_barang;
									$kode_barang = $key->kode_barang;
									$nama_barang = $key->nama_barang;
									$satuan = $key->satuan;
									$harga = $key->harga;
									$st = $key->aktif;
									if($st==1){
										$icon = "<span class='badge bg-green'>OK</span>";
									}else{
										$icon = "<span class='badge bg-red'>NO</span>";
									}
									?>
									<tr>
										<td><?=$no;?></td>
										<td><?=$kode_barang;?></td>
										<td><?=$nama_barang;?></td>
										<td><?=$satuan;?></td>
										<td><?=$harga;?></td>
										<td><?=$icon;?></td>
										<td>
											<div class="btn-group">
												<a class="btn btn-sm bg-maroon" href="<?=base_url('master/master/edit_barang/'.$id_barang)?>" role="button">Edit</a>
												<button type="button" class="btn btn-sm bg-maroon dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
												</button>
												<ul class="dropdown-menu" role="menu">
													<li><a href="#">View</a></li>
													<li><a href="#">Hapus</a></li>
												</ul>
											</div>
										</td>
									</tr>
									<?$no++;
								}?>
							</tbody>

						</table>
					</div>
				</div> <!-- /.box-body -->
			</div> <!-- /.box -->
		</div> <!-- /.col-xs-12 -->
</div> <!-- /.row -->