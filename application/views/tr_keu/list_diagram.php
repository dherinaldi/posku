<?
$this->load->model('app_model');
$this->model = $this->app_model;

//echo $this->model->cek_tipe(11,1);
?>
<div class="row">
	<!--datagrid-->
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"><?=$title;?></h3>

			</div><!-- /.box-header -->
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-hover" id="tb_data">
						<thead>
							<tr>
								<th>No</th>
								<th>KODE</th>
								<th>JENIS</th>
								<th>GROUP</th>
								<th>D.SUMBER</th>
								<th class="wd100">ST</th>
								<?
								foreach ($s_bp->result() as $key) {?>
								<th><?=$key->nama;?></th>
								<?
							}
							?>

						</tr>
					</thead>
					<tbody>
						<?
						$no=1;
						foreach ($s_data->result() as $key) {
							$kode_diagram =$key->kode;
							?>
							<tr>
								<td><?=$no;?></td>
								<td><?=$key->kode;?></td>
								<td><?=$key->jenis_transaksi;?></td>
								<td><?=$key->group_transaksi;?></td>
								<td><?=$key->dokumen_sumber?></td>
								<td><?=$key->aktif?></td>
								<?
								foreach ($s_bp->result() as $key) {
									$id_bp = $key->id;									
									?>
									<td>
										<? 
										$tipe =$this->model->cek_tipe($kode_diagram,$id_bp);
										//$arrs=explode(",",$tipe);
										//echo $tipe;
										if($tipe=='1'){
											echo "Db";
										}else if($tipe=='2'){
											echo "Cr";
										}else if($tipe=='1,2'){
											echo "Db,Cr";
										}
										else{
											echo "";
										}
										
										?>
									</td>
									<?
								}
								?>
							</tr>
							<?
							$no++;
						}
						?>
					</tbody>

					<tfoot>

					</tfoot>

				</table>
			</div>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->
</div> <!-- /.col-xs-12 -->
</div> <!-- /.row -->

<script type="text/javascript">
	$(document).ready(function(){
		//$("#tb_data").dataTable();
	});
</script>
