<?
error_reporting('E_ALL');
ini_set('display_errors', '1');

?>

<script type="text/javascript">

	$(document).ready(function() {
		


		$("#simpan").click(function(){

			var act = $("#act").val();
			var id_bku_saldo = $("#id_bku_saldo").val();

			var ntpn = $('input[name="ntpn[]"]').map(function(){return $(this).val();}).get();
			var id_bku_pajak = $('input[name="id_bku_pajak[]"]').map(function(){return $(this).val();}).get();

			var data = {"act":act, 'id_bku_saldo':id_bku_saldo,'id_bku_pajak':id_bku_pajak,'ntpn':ntpn};
			console.log(data);


			$.ajax({
				url:"<?php echo base_url('tr_keu/validasi/simpan_validasi_pajak');?>",
				type:"POST",
				data:data,
				cache:false,
				success:function(html){
					$("#hasil").html(html);
					//console.log('ok');
				},
				error: function(e){
					alert('Error: ' + e);
				}
			});
		});


});


$(document).ajaxStart(function(){
	$('#loading').show();
}).ajaxStop(function(){
	$('#loading').hide();
});
</script>
<form method="POST" accept-charset="utf-8">
	<div class="row">
		<div class="col-sm-6">
			<div class="box box-info box-solid">
				<div class="box-header with-border">
					<h3 class="box-title"><?=$title;?></h3>
				</div><!-- /.box-header -->
				<div class="box-body">
					<table class="table table-hover">
						<tbody>
							<tr>
								<td>No BKU</td>
								<td>
									<label><?=$bku;?></label>
								</td>
							</tr>

							<tr>
								<td>
									MAK
								</td>
								<td>
									<label><?=$mak." ".$nama_mak;?></label>
									<input type="hidden" name="act" id="act" class="form-control wd100" value="<?=$act;?>" >
									<input type="hidden" name="id_bku_saldo" id="id_bku_saldo" class="form-control wd100" value="<?=$id_bku_saldo;?>" >
								</td>
							</tr>

							<tr>
								<td>
									URAIAN
								</td>
								<td>
									<label><?=$uraian;?></label>
									
								</td>
							</tr>

							<tr>
								<td>
									Nominal
								</td>
								<td>
									<label><?=digit21($nominal);?></label>
									
								</td>
							</tr>

							<tr>
								<td>
									TANGGAL
								</td>
								<td>
									<?
									($tgl!="")?$tgl = date('d-m-Y',strtotime($tgl)):$tgl = date('d-m-Y');
									?>
									<label><?=$tgl;?></label>
									
								</td>
							</tr>
							<tr>
								<td> SD	</td>
								<td>
									<?
									$dt = array(
										0 => "-",
										1 => "RM",
										2 => "BLU",
										);
										?>
										<? foreach ($dt as $key => $value) {
											if($sd==$key){?>
											<label><?=$value;?></label>
											<?}
										}?>
										
									</td>
								</tr>
								<tr>
									<td>
										ST Pajak
									</td>
									<td>
										<?
										$dt = array(
											0 => "Tidak",
											1 => "Ya"
											);
											?>
											<? foreach ($dt as $key => $value) {
												if($st_pajak==$key){?>
												<label><?=$value;?></label>
												<?}
											}?>

										</td>
									</tr>


									<tr >
										<td>
											NPWP
										</td>
										<td>
											<?
											$dt = array(
												0 => "Tidak",
												1 => "Ya"
												);
												?>

												<? foreach ($dt as $key => $value) {
													if($st_npwp==$key){?>
													<label><?=$value;?></label>
													<?}
												}?>




											</td>
										</tr>
										<tr id="row_no_npwp">
											<td>No NPWP</td>

											<td><label><?=$npwp;?></label></td>
										</tr>


										<tr>

											<td colspan="3">
												<button type="button" class="btn btn-sm btn-success" id="simpan">
													<?if($act=='add'){
														echo 'SIMPAN';
													}else{
														echo 'UBAH';
													}
													?>
												</button>
												<a class="btn btn-sm btn-default" href="<?=base_url('tr_keu/validasi/')?>" role="button">Back</a>

								<!-- <a href="#modal-indikator" class="btn btn-sm btn-primary" role="button" data-toggle="modal">
								<span class="fa fa-plus"></span></a> -->
							</td>
						</tr>
					</tbody>
				</table>
			</div> <!-- .box-body -->
		</div> <!-- .box -->
	</div>
</div>

</form>

<div id='loading' style="display:none;">
	Load data process <img src="<?= base_url();?>assets/img/ajax-loader-2.gif"/>
</div>

<div id="hasil"></div>

<?
$id_bku = $this->uri->segment(4);
if($id_bku!=''){
	?>
	<div class="row" id="row_dim1" >
		<!--datagrid-->
		<div class="col-md-10">
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title">Pajak</h3>

				</div><!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover" >
							<thead>
								<tr>
									<th>No</th>
									<th>Kode</th>
									<th>Nama</th>
									<th>%</th>
									<th>Rp</th>
									<th>NTB</th>
									<th>NTPN</th>
									<th>Kd Akun</th>
								</tr>
							</thead>
							<tbody>
								<?
								$no=1;
								foreach ($dt_pajak->result() as $key) {?>
								<tr>
									<td><?=$no;?></td>
									<td><?=$key->kode_pajak;?></td>
									<td><?=$key->nama_pajak;?></td>
									<td><?=$key->persen;?></td>
									<td align="right"><?=digit21($key->nominal);?></td>
									<td><?=$key->ntb;?></td>
									<td>
										<input type="text" name="id_bku_pajak[]" id="id_bku_pajak<?=$key->kode_pajak;?>" class="form-control wd100" value="<?=$key->id_bku_pajak?>">
										<input type="text" name="ntpn[]" id="nptn<?=$key->kode_pajak;?>" class="form-control wd200" value="<?=$key->ntpn?>">
									</td>
									<td><?=$key->kd_akun;?></td>
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
<?}?>











