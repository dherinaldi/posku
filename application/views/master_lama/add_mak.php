<script type="text/javascript">
	$(document).ready(function() {
		$("#sd,#alok,#kbel,#kban,#kgdg").chosen({search_contains: true});

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
				<form action="<?=base_url('master/master/simpan_mak');?>" method="POST" accept-charset="utf-8">
					<table class="table table-hover" id="tb_sasaran">
						<tbody>
							<tr>
								<td>MAK</td>
								<td>
									<input type="hidden" name="act" id="act" class="form-control" value="<?=$act;?>" required="required">
									<input type="hidden" name="id_mak" id="id_mak" class="form-control" value="<?=$id_mak;?>" >
									<input type="text" name="mak" id="mak" class="form-control" value="<?=$mak;?>" required="required">
								</td>
							</tr>
							<tr>
								<td>Klasifikasi MAK</td>
								<td>
									<input type="text" name="kmak" id="kmak" class="form-control" value="<?=$kmak;?>" required="required">
								</td>
							</tr>

							<tr>
								<td>SD</td>
								<td>
									<select name="sd" id="sd" class="form-control wd100" required="required">	
										<option value="0">Pilih</option>
										<?
										foreach ($q_sd->result() as $key) {

											if(strcmp($sd,$key->kode_sd)==0){
												echo "<option value='".trim($key->kode_sd)."' selected='selected'>$key->kode_sd</option>";										
											}else{
												echo "<option value='".trim($key->kode_sd)."'>$key->kode_sd</option>";
											}
										}
										?>
									</select>
								</td>
							</tr>

							<tr>
								<td>Alokasi</td>
								<td>
									<select name="alok" id="alok" class="form-control wd200" required="required">
										<option value="0">Pilih</option>
										<?
										foreach ($q_alok->result() as $key) {
											if(strcmp($alok,$key->alokasi_belanja)==0){
												echo "<option value='".trim($key->alokasi_belanja)."' selected='selected'>$key->alokasi_belanja </option>";
											}else{
												echo "<option value='".trim($key->alokasi_belanja)."'>$key->alokasi_belanja</option>";
											}
										}
										?>
									</select>
								</td>
							</tr>

							<tr>
								<td>K.Belanja</td>
								<td>
									<select name="kbel" id="kbel" class="form-control wd200" required="required">
										<option value="0">Pilih</option>
										<?
										foreach ($q_kbel->result() as $key) {
											//if(trim($kbel)===trim($key->klasifikasi_belanja)){
											if(strcmp($kbel,$key->klasifikasi_belanja)==0){
												echo "<option value='".trim($key->klasifikasi_belanja)."' selected='selected'>$key->klasifikasi_belanja</option>";
											}else{
												echo "<option value='".trim($key->klasifikasi_belanja)."'>$key->klasifikasi_belanja</option>";
											}
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>K.Beban</td>
								<td>
									<select name="kban" id="kban" class="form-control wd200" required="required">
										<option value="0">Pilih</option>
										<?
										foreach ($q_kban->result() as $key) {
											//if(trim($kban)===trim($key->klasifikasi_beban)){
											if(strcmp($kban,$key->klasifikasi_beban)==0){
												echo "<option value='".trim($key->klasifikasi_beban)."' selected='selected'>$key->klasifikasi_beban</option>";
											}else{
												echo "<option value='".trim($key->klasifikasi_beban)."'>$key->klasifikasi_beban</option>";
											}
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>K.Gudang</td>
								<td>
									<select name="kgdg" id="kgdg" class="form-control wd200">
										<option value="0">Pilih</option>
										<?
										foreach ($q_kgdg->result() as $key) {
											if(strcmp($kgdg,$key->klasifikasi_gudang)==0){
												echo "<option value='".trim($key->klasifikasi_gudang)."' selected='selected'>$key->klasifikasi_gudang</option>";
											}else{
												echo "<option value='".trim($key->klasifikasi_gudang)."'>$key->klasifikasi_gudang</option>";
											}
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<button type="submit" class="btn btn-sm btn-success">Simpan</button>
									<a class="btn btn-sm btn-default" href="<?=base_url('master/master/mak');?>" role="button">Back</a>
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