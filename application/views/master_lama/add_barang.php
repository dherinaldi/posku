<div class="row">
	<!--datagrid-->
	<div class="col-md-8">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"><?=$title;?></h3>

			</div><!-- /.box-header -->
			<div class="box-body">
				<div class="table-responsive">
					<form action="<?=base_url('master/master/simpan_barang');?>" method="POST" accept-charset="utf-8">
						<table class="table table-hover" id="tb_sasaran">
							<tbody>
								<tr>
									<td>Kode</td>
									<td>
										<input type="hidden" name="act" id="act" class="form-control" value="<?=$act;?>" required="required">
										<input type="hidden" name="id_barang" id="id_barang" class="form-control" value="<?=$id_barang;?>" >
										<input type="text" name="kode_barang" id="kode_barang" class="form-control" value="<?=$kode_barang;?>" required="required" >
									</td>
								</tr>
								<tr>
									<td>Nama</td>
									<td>
										<input type="text" name="nama_barang" id="nama_barang" class="form-control" value="<?=$nama_barang;?>"  required="required">
									</td>
								</tr>
								<tr>
									<td>Harga</td>
									<td>
										<input type="text" name="harga" id="harga" class="form-control" value="<?=$harga;?>"  required="required">
									</td>
								</tr>
								<tr>
									<td>Satuan</td>
									<td>
										<input type="text" name="satuan" id="satuan" class="form-control" value="<?=$satuan;?>"   required="required">
									</td>
								</tr>
								<tr>
									<td>Aktif</td>
									<td>
										<select name="aktif" id="aktif" class="form-control" required="required">				
											<?$arr = array(0=>"non aktif",1=>'aktif');
											foreach($arr as $x => $x_value) {
												if($aktif != '' and $aktif==$x){
													echo "<option value=".$x." selected='selected'>".$x_value."</option>";

												}else{
													echo "<option value=".$x.">".$x_value."</option>";
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
										<a class="btn btn-sm btn-default" href="<?=base_url('master/master/barang');?>" role="button">Back</a>
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