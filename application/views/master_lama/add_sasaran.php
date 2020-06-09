<script type="text/javascript">
	$(document).ready(function() {
		$("#id_perspektif").chosen({search_contains: true});

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
					<form action="<?=base_url('master/master/simpan_sasaran');?>" method="POST" accept-charset="utf-8">
						<table class="table table-hover" id="tb_sasaran">
							<tbody>
								<tr>
									<td>Perspektif</td>
									<td>
										<select name="id_perspektif" id="id_perspektif" class="form-control" required="required" style="width: 350px;">
											<option value="0">-Pilih-</option>
											<?
											$s_p = "select * from m_perspektif";
											$q_p =$this->db->query($s_p);
											foreach ($q_p->result() as $key) {
												if($key->id_perspektif==$id_perspektif){?>
												<option value="<?=$key->id_perspektif;?>" selected="selected"><?=$key->nama_perspektif;?></option>

												<?}else{
													?>
													<option value="<?=$key->id_perspektif;?>"><?=$key->nama_perspektif;?></option>
													<?}
												}?>
											</select>
										</td>
									</tr>
									<tr>
										<td>Urut</td>
										<td>
											<input type="text" name="urut" id="urut" class="form-control wd100" value="<?=$urut;?>" required="required">
										</td>
									</tr>
									<tr>
										<td>Nama</td>
										<td>
											<input type="hidden" name="act" id="act" class="form-control" value="<?=$act;?>" required="required">
											<input type="hidden" name="id_sasaran" id="id_sasaran" class="form-control" value="<?=$id_sasaran;?>" >
											<input type="text" name="nama_sasaran" id="nama_sasaran" class="form-control" value="<?=$nama_sasaran;?>" required="required">
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<button type="submit" class="btn btn-sm btn-success">Simpan</button>
											<a class="btn btn-sm btn-default" href="<?=base_url('master/master');?>" role="button">Back</a>
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