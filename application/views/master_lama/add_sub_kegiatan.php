<script type="text/javascript">
	$(document).ready(function() {
		$("#id_kegiatan").chosen({search_contains: true});

	});
	
</script>
<div class="row">
	<!--datagrid-->
	<div class="col-md-8">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"><?=$title;?></h3>

			</div><!-- /.box-header -->
			<div class="box-body">
				<!-- <div class="table-responsive"> -->
					<form action="<?=base_url('master/master/simpan_sub_kegiatan');?>" method="POST" accept-charset="utf-8">
						<table class="table table-hover" id="tb_sasaran">
							<tbody>
								<tr>
									<td>Kegiatan</td>
									<td>
										<select name="id_kegiatan" id="id_kegiatan" class="form-control" required="required">
											<option value="0">-Pilih-</option>
											<?php
											foreach ($q_kegiatan->result() as $key) {
												if($id_kegiatan==$key->id_kegiatan){
													echo "<option value=".$key->id_kegiatan." selected='selected'>".$key->nama_kegiatan."</option>";
												}else{
													echo "<option value=".$key->id_kegiatan.">".$key->nama_kegiatan."</option>";
												}
												
											}
											?>

										</select>
									</td>
								</tr>
								<tr>
									<td>Sub Kegiatan</td>
									<td>
										<input type="hidden" name="act" id="act" class="form-control" value="<?=$act;?>" required="required">
										<input type="hidden" name="id_sub_kegiatan" id="id_sub_kegiatan" class="form-control" value="<?=$id_sub_kegiatan;?>" >
										<input type="text" name="nama_sub_kegiatan" id="nama_sub_kegiatan" class="form-control" value="<?=$nama_sub_kegiatan;?>" required="required">
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<button type="submit" class="btn btn-sm btn-success">Simpan</button>
										<a class="btn btn-sm btn-default" href="<?=base_url('master/master/sub_kegiatan');?>" role="button">Back</a>
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