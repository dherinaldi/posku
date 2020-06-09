
<div class="row">
	<!--datagrid-->
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"><?=$title;?></h3>

			</div><!-- /.box-header -->
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-hover" id="tb_data">
						<thead>
							<tr>
								<th>No</th>
								<th>BKU</th>
								<th>MAK</th>
								<th class="wd100">URAIAN</th>
								<th>SD</th>
								<th>PAJAK</th>
								<th>RP</th>
								<th>NTB</th>
								<th>NTPN</th>
								<th>AKUN</th>
								<th>TGL</th>
								<th>OPSI</th>
							</tr>
						</thead>
						<tbody>
							<? 
							$no=1;
							foreach ($q_dt->result() as $key) {

								?>
								<tr>
									<td><?=$no;?></td>
									<td><?=$key->no_bku;?></td>
									<td><?=$key->mak;?></td>
									<td><div class="wrap wd300"><?=$key->uraian;?></div></td>
									<td><?=$key->nama_sd;?></td>
									<td><?=strtoupper($key->kd_ms_pajak);?></td>
									<td align="right"><?=digit21($key->nominal);?></td>
									<td><?=$key->ntb;?></td>
									<td><?=$key->ntpn;?></td>
									<td><?=$key->kd_akun;?></td>
									<td><?=date('d-m-Y', strtotime($key->tgl));?></td>
									<td>
										<div>
											<div class="btn-group">
												<a class="btn btn-sm btn-info" href="<?=base_url('tr_keu/validasi/validasi_pajak/'.$key->fk_bku_saldo);?>" role="button" title="Set"><i class="fa fa-fw fa-edit"></i></a>
												<div class="btn-group">
													<button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
														<span class="caret"></span>
													</button>
													<ul class="dropdown-menu">
														<li><a href="#">Dropdown link</a></li>
														<li><a href="#">Dropdown link</a></li>
													</ul>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<?
								$no++;
							}
							?>
						</tbody>

						<tfoot>

						</tfoot>

					</table>
				</div>
			</div> <!-- /.box-body -->
		</div> <!-- /.box -->
	</div> <!-- /.col-xs-12 -->
</div> <!-- /.row -->

<script type="text/javascript">
	$(document).ready(function(){
		$("#tb_data").dataTable();
	});
</script>
