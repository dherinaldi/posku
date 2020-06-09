<script type="text/javascript">
	$(document).ready(function() {
		$("#id_indikator").chosen({search_contains: true});

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
					<form action="<?=base_url('master/master/simpan_program');?>" method="POST" accept-charset="utf-8">
						<table class="table table-hover" id="tb_sasaran">
							<tbody>
								<tr>
									<td>Indikator</td>
									<td>
										<select name="id_indikator" id="id_indikator" class="form-control" required="required">
											<option value="0">-Pilih-</option>
											<?php
											foreach ($q_indikator->result() as $key) {
												if($id_indikator==$key->id_indikator){
													echo "<option value=".$key->id_indikator." selected='selected'>".$key->nama_indikator."</option>";
												}else{
													echo "<option value=".$key->id_indikator.">".$key->nama_indikator."</option>";
												}
												
											}
											?>

										</select>
									</td>
								</tr>
								<tr>
									<td>Program</td>
									<td>
										<input type="hidden" name="act" id="act" class="form-control" value="<?=$act;?>" required="required">
										<input type="hidden" name="id_program" id="id_program" class="form-control" value="<?=$id_program;?>" >
										<input type="text" name="nama_program" id="nama_program" class="form-control" value="<?=$nama_program;?>" required="required">
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<button type="submit" class="btn btn-sm btn-success">Simpan</button>
										<a class="btn btn-sm btn-default" href="<?=base_url('master/master/program');?>" role="button">Back</a>
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