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
	<div class="col-md-3 col-sm-6 col-xs-12">
		<!--<div class="info-box"> -->
		<a href="<?=base_url('master/master/add_perspektif');?>" class="btn btn-sm btn-success">
			<span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Tambah </a>
			<!--</div><!-- /.info-box -->
		</div><!-- /.col -->
	</div>
	
	<p></p>
	<?php
	if ($this->session->flashdata('result')) {
		?>
		<div class="col-sm-6">
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Success!!!</strong>
				<?php echo validation_errors(); ?>
				<?php echo $this->session->flashdata('result'); ?>
			</div>
		</div>
		<?php } ?>
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
										<th>Perspektif</th>
										<th>Opsi</th>
									</tr>
								</thead>

								<tbody>
									<?php 
									$no=1;
									foreach ($q_p->result() as $key) {
										$id_p =$key->id_perspektif;
										$nama_p =$key->nama_perspektif;
										?>
										<tr>
											<td><?=$no;?></td>
											<td><?=$nama_p;?></td>
											<td>
												<div class="btn-group">
													<a class="btn btn-sm bg-maroon" href="<?=base_url('master/master/edit_perspektif/'.$id_p);?>" role="button">Edit</a>
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
										<?
										$no++;
									}?>
								</tbody>

							</table>
						</div>
					</div> <!-- /.box-body -->
				</div> <!-- /.box -->
			</div> <!-- /.col-xs-12 -->
</div> <!-- /.row -->