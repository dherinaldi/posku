<script type="text/javascript">
	$(document).ready(function() {
		$("#id_program").chosen({search_contains: true});

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
					<form action="<?=base_url('master/master/simpan_kegiatan');?>" method="POST" accept-charset="utf-8">
						<table class="table table-hover" id="tb_sasaran">
							<tbody>
								<tr>
									<td>Program</td>
									<td>
										<select name="id_program" id="id_program" class="form-control" required="required">
											<option value="0">-Pilih-</option>
											<?php
											foreach ($q_program->result() as $key) {
												if($id_program==$key->id_program){
													echo "<option value=".$key->id_program." selected='selected'>".$key->nama_program."</option>";
												}else{
													echo "<option value=".$key->id_program.">".$key->nama_program."</option>";
												}
												
											}
											?>

										</select>
									</td>
								</tr>
								<tr>
									<td>Kegiatan</td>
									<td>
										<input type="hidden" name="act" id="act" class="form-control" value="<?=$act;?>" required="required">
										<input type="hidden" name="id_kegiatan" id="id_kegiatan" class="form-control" value="<?=$id_kegiatan;?>" >
										<input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" value="<?=$nama_kegiatan;?>" required="required">
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<button type="submit" class="btn btn-sm btn-success">Simpan</button>
										<a class="btn btn-sm btn-default" href="<?=base_url('master/master/kegiatan');?>" role="button">Back</a>
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