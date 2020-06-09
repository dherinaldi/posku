<div class="row">
	<!--datagrid-->
	<div class="col-md-8">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"><?=$title;?></h3>

			</div><!-- /.box-header -->
			<div class="box-body">
				<!-- <div class="table-responsive"> -->
				<form action="<?=base_url('master/master/simpan_perspektif');?>" method="POST" accept-charset="utf-8">
						<table class="table table-hover" id="tb_sasaran">
							<tbody>
								<tr>
									<td>Nama</td>
									<td>
										<input type="hidden" name="act" id="act" class="form-control" value="<?=$act;?>" required="required">
										<input type="hidden" name="id_perspektif" id="id_perspektif" class="form-control" value="<?=$id_perspektif;?>" >
										<input type="text" name="nama_perspektif" id="nama_perspektif" class="form-control" value="<?=$nama_perspektif;?>" required="required">
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<button type="submit" class="btn btn-sm btn-success">Simpan</button>
										<a class="btn btn-sm btn-default" href="<?=base_url('master/master/perspektif');?>" role="button">Back</a>
									</td>
								</tr>
							</tbody>

						</table>
					</form>
				<!-- </div> -->
			</div> <!-- /.box-body -->
		</div> <!-- /.box -->
	</div> <!-- /.col-xs-12 -->
</div>