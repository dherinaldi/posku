<script type="text/javascript">
	$(document).ready(function() {
		//$("#id_jb").chosen({search_contains: true});

		$('#id_jb', this).chosen({
			search_contains: true}).change(function(event){
				event.preventDefault();
				var id_jb = $("#id_jb").val();
				var data = $.post('<?=base_url()?>master/master/ambil_data_jbr',{id_jb:id_jb,load_data:'true'});
				data.done(function(data){
					newdata = data.split('#');
					$('#mak').val(newdata[6]);
					$('#kmak').val(newdata[7]);
					$('#bb').val(newdata[4]);
				});
			});

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
				<div class="table-responsive">
					<form action="<?=base_url('master/master/simpan_sjbr');?>" method="POST" accept-charset="utf-8">
						<table class="table table-hover" id="tb_sasaran">
							<tbody>
								<tr>
									<td>Jenis Belanja</td>
									<td>
										<input type="hidden" name="act" id="act" class="form-control" value="<?=$act;?>" required="required">
										<select name="id_jb" id="id_jb" class="form-control" required="required">
											<option value="0">--Pilih--</option>
											<?
											foreach ($q_jb->result() as $key) {
												if($id_jb==$key->id_jb_rka){
													echo "<option value=".$key->id_jb_rka." selected='selected'>".$key->kode_mak." - ".$key->nama_jb_rka."</option>";
												}else{
													echo "<option value=".$key->id_jb_rka.">".$key->kode_mak." - ".$key->nama_jb_rka."</option>";
												}
											}
											?>
										</select>
										
									</td>
								</tr>
								<tr>
									<td>Mak</td>
									<td>
										<input type="text" name="mak" id="mak" class="form-control wd100" value="<?=$mak;?>" required="required" readonly="readonly">
									</td>
								</tr>

								<tr>
									<td>K.MAK</td>
									<td>
										<input type="text" name="kmak" id="kmak" class="form-control wd350" value="<?=$kmak;?>" required="required" readonly="readonly">
									</td>
								</tr>

								<tr>
									<td>Kategori</td>
									<td>
										<input type="text" name="bb" id="bb" class="form-control wd350" value="<?=$bb;?>" required="required" readonly="readonly">
									</td>
								</tr>

								

								<tr>
									<td>Sub Jenis Belanja</td>
									<td>
										<input type="hidden" name="id_sjb" id="id_sjb" class="form-control" value="<?=$id_sjb;?>" >
										<input type="text" name="nama_sjb" id="nama_sjb" class="form-control" value="<?=$nama_sjb;?>" required="required">
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<button type="submit" class="btn btn-sm btn-success">Simpan</button>
										<a class="btn btn-sm btn-default" href="<?=base_url('master/master/sjb_rka');?>" role="button">Back</a>
									</td>
								</tr>
							</tbody>

						</table>
					</form>
				</div>
			</div> <!-- /.box-body -->
		</div> <!-- /.box -->
	</div> <!-- /.col-xs-12 -->
</div>