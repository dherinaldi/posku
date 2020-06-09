<?
error_reporting('E_ALL');
ini_set('display_errors', '1');
?>

<script type="text/javascript">
	$(document).ready(function() {
		
		$("#tb_sasaran").dataTable();

	});
	$(document).ajaxStart(function(){
		$('#loading').show();
	}).ajaxStop(function(){
		$('#loading').hide();
	});
</script>
<div class="row">
	<div class="col-md-3 col-sm-6 col-xs-8">
		<!--<div class="info-box"> -->
		<a href="<?=base_url('master/master/add_jenis_belanja')?>" class="btn btn-sm btn-success">
			<span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Tambah </a>
			<!--</div><!-- /.info-box -->
		</div><!-- /.col -->
	</div>
	<p></p>
	<div class="row">
		<!--datagrid-->
		<div class="col-md-8">
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title"><?=$title;?></h3>

				</div><!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover" id="tb_sasaran">
							<thead>
								<tr>
									<th width="50px">No</th>
									<th>Jenis Belanja</th>
									<th>
										Opsi
									</th>
								</tr>
							</thead>
							<tbody>
								<?
								$no=1;
								foreach ($q_jb->result() as $key) {
									$id_jb = $key->id_jenis_belanja;
									$nama_jb = $key->nama_jenis_belanja;
									?>
									<tr>
										<td><?=$no;?></td>
										<td><?=$nama_jb;?></td>
										
										<td>
											<div class="btn-group">
											<a class="btn btn-sm bg-maroon" href="<?=base_url('master/master/edit_jenis_belanja/'.$id_jb)?>" role="button">Edit</a>
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