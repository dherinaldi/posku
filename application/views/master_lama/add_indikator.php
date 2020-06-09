<script type="text/javascript">
	$(document).ready(function() {
		$("#id_sasaran").chosen({search_contains: true});

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
					<form action="<?=base_url('master/master/simpan_indikator');?>" method="POST" accept-charset="utf-8">
						<table class="table table-hover" id="tb_sasaran">
							<tbody>
								<tr>
									<td>Sasaran</td>
									<td>
										<select name="id_sasaran" id="id_sasaran" class="form-control" required="required">
											<option value="0">-Pilih-</option>
											<?php
											foreach ($q_s->result() as $key) {
												if($id_sasaran==$key->id_sasaran){
													echo "<option value=".$key->id_sasaran." selected='selected'>".$key->nama_sasaran."</option>";
												}else{
													echo "<option value=".$key->id_sasaran.">".$key->nama_sasaran."</option>";
												}
											}
											?>

										</select>
									</td>
								</tr>
								<tr>
									<td>Indikator</td>
									<td>
										<input type="hidden" name="act" id="act" class="form-control" value="<?=$act;?>" required="required">
										<input type="hidden" name="id_indikator" id="id_indikator" class="form-control" value="<?=$id_indikator;?>" >
										<input type="text" name="nama_indikator" id="nama_indikator" class="form-control" value="<?=$nama_indikator;?>" required="required">
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<button type="submit" class="btn btn-sm btn-success">Simpan</button>
										<a class="btn btn-sm btn-default" href="<?=base_url('master/master/indikator');?>" role="button">Back</a>
									</td>
								</tr>
							</tbody>

						</table>
					</form>
				</div>
			</div> <!-- /.box-body -->
		</div> <!-- /.box -->
	</div> <!-- /.col-xs-12 -->
<!-- </div> -->