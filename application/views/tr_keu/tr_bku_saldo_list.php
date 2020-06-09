
<div class="row">
	<!--datagrid-->
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"><?php echo $title;?></h3>

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
								<th>SEBELUMNYA</th>
								<th>IN</th>
								<th>OUT</th>
								<th>SALDO</th>
								<th>PPN10</th>
								<th>PPH21</th>
								<th>PPH22</th>
								<th>PPH23</th>
								<th>P4A2</th>
								<th>PJL</th>
								<th>TGL</th>
								<th>OPSI</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no=1;
							$masuk=0;
							$keluar=0;
							$sisa =0;
							$insertPajak="";
							$arrs = array();
							foreach ($s_data->result() as $key) {									
								if($no == 1){
									$sb = $sa->saldo_awal;
								}
								echo "sb=".$sb."&sisa=".$sisa."<br>";
								$sisa = $sb+$key->masuk-$key->keluar;

								?>
								<tr>
									<td><?php echo $no;?></td>
									<td><?php echo $key->no_bku;?></td>
									<td><?php echo $key->mak;?></td>
									<td><div class="wrap wd300"><?php echo $key->uraian;?></div></td>
									<td><?php echo $key->sd;?></td>
									<td align="right"><?php echo digit21($sb);?></td>
									<td align="right"><?php echo digit21($key->masuk);?></td>
									<td align="right"><?php echo digit21($key->keluar);?></td>
									<td align="right"><?php echo digit21($sisa);?></td>
									<?php
									if($key->st_pajak==1){
										$pajak = $key->pajak;
										$st = '<i class="fa fa-fw fa-check"></i>';
										$arrs=explode(",",$pajak);
										if(in_array("ppn10",$arrs)){
											echo "<td>".$st."</td>";
										}else{
											echo "<td></td>";
										}
										if(in_array("pph21",$arrs)){
											echo "<td>".$st."</td>";
										}else{
											echo "<td></td>";
										}
										if(in_array("pph22",$arrs)){
											echo "<td>".$st."</td>";
										}else{
											echo "<td></td>";
										}
										if(in_array("pph23",$arrs)){
											echo "<td>".$st."</td>";
										}else{
											echo "<td></td>";
										}
										if(in_array("p4a2",$arrs)){
											echo "<td>".$st."</td>";
										}else{
											echo "<td></td>";
										}
										if(in_array("pjl",$arrs)){
											echo "<td>".$st."</td>";
										}else{
											echo "<td></td>";
										}
									}else{
										echo "<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>";
									}
									?>									
									<td><div class="wrap" style="width:50px;"><?php echo converttgl1($key->tgl);?></div></td>
									<td><div class="wd300">
										<div class="btn-group">
										<a class="btn btn-sm btn-info" href="<?=base_url('tr_keu/tr_bku_saldo/edit_bku_saldo/'.$key->id_bku_saldo);?>" role="button" title="Set"><i class="fa fa-fw fa-edit"></i></a>
										<a class="btn btn-sm btn-info" href="<?=base_url('tr_keu/tr_bku_saldo/hapus_bku_saldo/'.$key->id_bku_saldo);?>" role="button" title="Hapus"><i class="fa fa-fw fa-trash-o"></i></a>

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
								<?php
								$masuk +=$key->masuk;
								$keluar +=$key->keluar;
								$sb =$sisa;
								$no++;
							}?>
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
