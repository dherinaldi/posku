<script type="text/javascript">
	$(document).ready(function() {
		$("#bb,#mak").chosen({search_contains: true});

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
					<form action="<?=base_url('master/master/simpan_jbr');?>" method="POST" accept-charset="utf-8">
						<table class="table table-hover" id="tb_sasaran">
							<tbody>
								<tr>
									<td>Kategori</td>
									<td>
										<select name="bb" id="bb" class="form-control wd350" required="required">
											<option value="0">-Pilih-</option>
											<?
											foreach ($q_bb->result() as $key) {
												if($id_bb==$key->id_bb){
													echo "<option value='".$key->id_bb."' selected='selected'>".$key->nama_bb." - ".$key->nama_bop."</option>";
												}else{
													echo "<option value='".$key->id_bb."'>".$key->nama_bb." - ".$key->nama_bop."</option>";
												}
											}
											?>
										</select>

									</td>
								</tr>

								<tr>
									<td>MAK</td>
									<td>
										<select name="mak" id="mak" class="form-control wd350" required="required">
											<option value="0">-Pilih-</option>
											<?
											foreach ($q_mak->result() as $key) {
												if($mak==$key->mak){
													echo "<option value='".$key->mak."' selected='selected'>".$key->mak." - ".$key->klasifikasi_akun_mak."</option>";
												}else{
													echo "<option value='".$key->mak."'>".$key->mak." - ".$key->klasifikasi_akun_mak."</option>";
												}
											}
											?>
										</select>
									</td>
								</tr>

								<tr>
									<td>Jenis Belanja</td>
									<td>
										<input type="hidden" name="act" id="act" class="form-control" value="<?=$act;?>" required="required">
										<input type="hidden" name="id_jb" id="id_jb" class="form-control" value="<?=$id_jb;?>" >
										<input type="text" name="nama_jb" id="nama_jb" class="form-control" value="<?=$nama_jb;?>" required="required">
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<button type="submit" class="btn btn-sm btn-success">Simpan</button>
										<a class="btn btn-sm btn-default" href="<?=base_url('master/master/jb_rka');?>" role="button">Back</a>
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