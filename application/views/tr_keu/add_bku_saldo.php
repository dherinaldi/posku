<?php 
error_reporting('E_ALL');
ini_set('display_errors', '1');

?>

<script type="text/javascript">

	var a = '500,200.00';
	var b = '12.33';
	var c = '123.34';
	var d = '1,434';
	var e = '165,33';
	var f = '250.00';
	var g = '259,00';


	$(document).ready(function() {

		$('#nominal,input[name="rupiah[]"]').maskMoney();
		//$('#nominal,input[name="rupiah[]"]').maskMoney({ thousands:'.', decimal:',', affixesStay: false});

		//var num = $('#demo8').maskMoney('unmasked')[0]

		$("#tb_anggaran").dataTable();
		$('#tgl').datepicker(
			{format:'dd-mm-yyyy',orientation:'bottom'});
		$('.chs', this).chosen({
			search_contains: true}).change(function(event){
				event.preventDefault();
				var mak = $(".chs").val();
				var data = $.post('<?php  echo base_url()?>tr_keu/tr_bku_saldo/ambil_data_mak',{mak:mak,load_data:'true'});
				data.done(function(data){
					newdata = data.split('#');
					$('#tipe').val(newdata[4]);
				});
			});


			$("#simpan").click(function(){
			//var bku = $("#bku").val();

			var act = $("#act").val();
			var sd = $("#sd").val();
			var bku = $("#bku").val();
			var mak = $("#mak").val();
			//var nominal = parseNumberCustom($("#nominal").val());
			var nominal = $("#nominal").maskMoney('unmasked')[0];
			var uraian = $("#uraian").val();
			var tipe = $("#tipe").val();
			var tgl = $("#tgl").val();
			var id_bku_saldo = $("#id_bku_saldo").val();

			var st_pajak =$('#st_pajak option:selected').val();
			var npwp = $('#st_npwp option:selected').val();
			if (st_pajak==1){
				var rupiah = $('input[name="rupiah[]"]').map(function(){return toNumber($(this).val());}).get();
				var persen = $('input[name="persen[]"]').map(function(){return $(this).val();}).get();
				var kd_akun = $('input[name="kd_akun[]"]').map(function(){return $(this).val();}).get();
				var kode_pajak = $('input[name="kode_pajak[]"]').map(function(){return $(this).val();}).get();
				var id_pajak = $('input[name="id_pajak[]"]').map(function(){return $(this).val();}).get();
				var id_bku_pajak = $('input[name="id_bku_pajak[]"]').map(function(){return $(this).val();}).get();

				//rupiah = parseNumberCustom(rupiah);
			}

			var data = {"act":act, 'bku':bku,'mak':mak,'nominal':nominal,'tgl':tgl,'st_pajak':st_pajak,'npwp':npwp,'tipe':tipe,'sd':sd,'uraian':uraian,'rupiah':rupiah,'id_bku_saldo':id_bku_saldo,'rupiah':rupiah,'persen':persen,'kd_akun':kd_akun,'kode_pajak':kode_pajak,'id_pajak':id_pajak,'id_bku_pajak':id_bku_pajak};
			console.log(data);


			$.ajax({
				url:"<?php  echo base_url('tr_keu/tr_bku_saldo/simpan_bku_saldo');?>",
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

$('#nominal').on('keyup', function() {
	//var nominal = toNumber(this.value);
	//var num = $('#demo8').maskMoney('unmasked')[0];
	var nominal = $("#nominal").maskMoney('unmasked')[0];
	var st_pajak = $("#st_pajak").val();
	var st_npwp = $("#st_npwp").val();
	kalkulasi(nominal,st_pajak,st_npwp);

});
$('#st_pajak').on('change', function() {
	var nominal = toNumber($("#nominal").val());
	var st_pajak = this.value;
	var st_npwp = $("#st_npwp").val();
	console.log( "st_pajak="+st_pajak+"&"+st_npwp);
	kalkulasi(nominal,st_pajak,st_npwp);


});
$('#st_npwp').on('change', function() {
	var nominal = toNumber($("#nominal").val());
	var st_pajak = $("#st_pajak").val();
	var st_npwp = this.value;
	if(st_npwp==1){
		$('#row_no_npwp').show();
	}else{
		$('#row_no_npwp').hide();
	}

	console.log( "st_pajak="+st_pajak+"&"+st_npwp);
	kalkulasi(nominal,st_pajak,st_npwp);


});

function kalkulasi(nominal,st_pajak,st_npwp){
	var nominal = toNumber($("#nominal").val());
	var ppn10,pph21,pph22,pph23,p4a2,pjl=0;
	ppn10 = nominal/11;
	pph21=p4a2=pjl=0;

	if(st_npwp==1){
		pph22= ppn10*0.15;
		pph23= ppn10*0.2;
	}else{
		pph22= ppn10*0.3;
		pph23= ppn10*0.4;
	}

	console.log('ppn10='+ppn10+'&pph21='+pph21+'&pph22='+pph22+'&pph23='+pph23+'&p4a2='+p4a2+'&pjl='+pjl+"&nominal="+nominal+"&pnominal="+toNumber($("#nominal").val()));

	$('#rupiahppn10').val(ppn10.formatMoney(2,'.',','));
	$('#rupiahpph21').val(pph21.formatMoney(2,'.',','));
	$('#rupiahpph22').val(pph22.formatMoney(2,'.',','));
	$('#rupiahpph23').val(pph23.formatMoney(2,'.',','));
	$('#rupiahp4a2').val(p4a2.formatMoney(2,'.',','));
	$('#rupiahpjl').val(pjl.formatMoney(2,'.',','));

}

$(function() {
	if($('#st_npwp').val()==1){$('#row_no_npwp').show(); }else{$('#row_no_npwp').hide()};
	if($('#st_pajak').val() == 1){
		$('#row_dim,#row_dim1').show();

	}else{
		$('#row_dim,#row_dim1,#row_no_npwp').hide();

	}
	$('#st_pajak').change(function(){
		if($('#st_pajak').val() == 1) {
			$('#row_dim,#row_dim1').show();

		} else {
			$('#row_dim,#row_dim1,#row_no_npwp').hide();
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
					<h3 class="box-title"><?php  echo $title;?></h3>
				</div><!-- /.box-header -->
				<div class="box-body">
					<table class="table table-hover">
						<tbody>
							<tr>
								<td>No BKU</td>
								<td>
									<input type="text" name="bku" id="bku" value="<?php  echo $bku;?>" required="required" class="form-control">
								</td>
							</tr>

							<tr>
								<td>
									MAK
								</td>
								<td>

									<select name="mak" id="mak" class="form-control chs" required="required">
										<option value="0">-- PILIH --</option>
										<?php 
										foreach ($dt_mak->result() as $key) {
											if($mak==$key->mak_fix){?>
											<option value="<?php  echo $key->mak_fix;?>" selected="selected"><?php  echo $key->mak_fix." ".$key->klasifikasi_akun_mak;?></option>
											<?php }else{?>
											<option value="<?php  echo $key->mak_fix;?>"><?php  echo $key->mak_fix." ".$key->klasifikasi_akun_mak;?></option>
											<?php }
										}
										?>
									</select>

									<input type="text" name="tipe" id="tipe" value="<?php  echo $tipe;?>" class="form-control wd100">
									<input type="text" name="id_bku_saldo" id="id_bku_saldo" value="<?php  echo $id_bku_saldo;?>" class="form-control wd100">
									<input type="text" name="sd" id="sd" class="form-control wd100" value="<?php  echo $sd;?>">
									<input type="text" name="act" id="act" class="form-control wd100" value="<?php  echo $act;?>">


								</td>
							</tr>

							<tr>
								<td>
									URAIAN
								</td>
								<td>
									<textarea name="uraian" id="uraian" class="form-control" rows="3" required="required">
										<?php  echo $uraian;?>
									</textarea>
								</td>
							</tr>

							<tr>
								<td>
									Nominal
								</td>
								<td>
									<input type="text" name="nominal" id="nominal" value="<?php  echo digit21($nominal);?>" required="required" class="form-control" data-thousands="," data-decimal=".">
								</td>
							</tr>

							<tr>
								<td>
									TANGGAL
								</td>
								<td>
									<?php 
									($tgl!="")?$tgl = date('d-m-Y',strtotime($tgl)):$tgl = date('d-m-Y');
									?>
									<input type="text" name="tgl" id="tgl" value="<?php  echo $tgl;?>" required="required" class="form-control wd100">
								</td>
							</tr>
							<tr>
								<td>
									ST Pajak
								</td>
								<td>
									<?php 
									$dt = array(
										0 => "Tidak",
										1 => "Ya"
										);
										?>
										<select name="st_pajak" id="st_pajak" class="form-control wd100" required="required">
											<?php  foreach ($dt as $key => $value) {
												if($st_pajak==$key){?>
												<option value="<?php  echo $key?>" selected="selected"><?php  echo $value;?></option>
												<?php  }else{ ?>
												<option value="<?php  echo $key?>"><?php  echo $value;?></option>

												<?php  }
											}?>


										</select>
									</td>
								</tr>


								<tr id="row_dim">
									<td>
										NPWP
									</td>
									<td>
										<?php 
										$dt = array(
											0 => "Tidak",
											1 => "Ya"
											);
											?>
											<select name="st_npwp" id="st_npwp" class="form-control wd100" required="required">
												<?php  foreach ($dt as $key => $value) {
													if($st_npwp==$key){?>
													<option value="<?php  echo $key?>" selected="selected"><?php  echo $value;?></option>
													<?php }else{?>
													<option value="<?php  echo $key?>"><?php  echo $value;?></option>

													<?php }
												}?>


											</select>

										</td>
									</tr>
									<tr id="row_no_npwp">
										<td>No NPWP</td>
										<td><input type="text" name="txt_npwp" id="txt_npwp" class="form-control wd300" title=""></td>
									</tr>


									<tr>

										<td colspan="3">
											<button type="button" class="btn btn-sm btn-success" id="simpan">
												<?php if($act=='add'){
													echo 'SIMPAN';
												}else{
													echo 'UBAH';
												}
												?>
											</button>
											<a class="btn btn-sm btn-default" href="<?php  echo base_url('tr_keu/tr_bku_saldo/')?>" role="button">Back</a>

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
	Load data process <img src="<?php  echo  base_url();?>assets/img/ajax-loader-2.gif"/>
</div>

<div id="hasil"></div>

<?php 
$id_bku = $this->uri->segment(4);
if($id_bku!=''){
	?>
	<div class="row" id="row_dim1" >
		<!--datagrid-->
		<div class="col-md-8">
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
									<th>Kd Akun</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no=1;
								$v_fk_ms_pajak=$v_kd_ms_pajak=$v_nominal=$v_persen=$v_kd_akun=0;
								foreach ($dt_pajak->result() as $key) {
									?>
									<tr>
										<td><?php  echo $no;?></td>
										<td>

											<?php  echo $key->kode;?></td>
											<td><?php  echo $key->nama;?></td>
											<?php 
											$s_cek = "select * from tr_bku_pajak where fk_bku_saldo =".$id_bku_saldo;

											?>

											<td>


												<?php 
												$s_cek = "select * from tr_bku_pajak where fk_bku_saldo =".$id_bku_saldo." and fk_ms_pajak=".$key->id_pajak;
											//$s_cek = "select * from tr_bku_pajak where fk_bku_saldo =".$id_bku_saldo;
												//echo $s_cek.";";
												$q_cek = $this->db->query($s_cek);
												if($q_cek->num_rows()>0){
													foreach ($q_cek->result() as $arr) {
														$c_fk_ms_pajak= $arr->fk_ms_pajak;
														$c_kd_ms_pajak= $arr->kd_ms_pajak;
														$c_nominal= $arr->nominal;
														$c_persen= $arr->persen;

														$c_id_bku_pajak= $arr->id_bku_pajak;

														?>
														<input type="text" name="id_pajak[]" id="id_pajak<?php  echo $key->kode;?>" class="form-control wd100" value="<?php  echo $c_fk_ms_pajak?>">
														<input type="text" name="kode_pajak[]" id="kode_pajak<?php  echo $key->kode;?>" class="form-control wd100" value="<?php  echo $c_kd_ms_pajak;?>">
														<input type="text" name="persen[]" id="persen<?php  echo $key->kode;?>" class="form-control wd100" value="<?php  echo $c_persen;?>">
														<input type="text" name="id_bku_pajak[]" id="id_bku_pajak<?php  echo $key->kode;?>" class="form-control wd100" value="<?php  echo $c_id_bku_pajak;?>">
														<?php 
													}
												}else{?>
												<input type="text" name="id_pajak[]" id="id_pajak<?php  echo $key->kode;?>" class="form-control wd100" value="<?php  echo $key->id_pajak;?>">
												<input type="text" name="kode_pajak[]" id="kode_pajak<?php  echo $key->kode;?>" class="form-control wd100" value="<?php  echo $key->kode;?>">
												<input type="text" name="persen[]" id="persen<?php  echo $key->kode;?>" class="form-control wd100" value="0">
												<input type="text" name="id_bku_pajak[]" id="id_bku_pajak<?php  echo $key->kode;?>" class="form-control wd100" value="">
												<?php }?>
											</td>
											<td>
												<?php 
												if($q_cek->num_rows()>0){
											//echo "ok";
													foreach ($q_cek->result() as $arr) {
														$c_nominal= $arr->nominal;?>
														<input type="text" name="rupiah[]" id="rupiah<?php  echo $key->kode;?>" class="form-control wd100" value="<?php  echo digit21($c_nominal);?>">
														<?php }
													}else{?>
													<input type="text" name="rupiah[]" id="rupiah<?php  echo $key->kode;?>" class="form-control wd100" value="0.00">
													<?php }
													?>

												</td>
												<td>
													<?php 
													if($q_cek->num_rows()>0){
											//echo "ok";
														foreach ($q_cek->result() as $arr) {
															$c_kd_akun= $arr->kd_akun;?>
															<input type="text" name="kd_akun[]" id="kd_akun<?php  echo $key->kode;?>" class="form-control wd100" value="<?php  echo $c_kd_akun;?>">
															<?php }
														}else{?>
														<input type="text" name="kd_akun[]" id="kd_akun<?php  echo $key->kode;?>" class="form-control wd100" value="<?php  echo $key->kd_akun?>">

														<?php }
														?>

													</td>
												</tr>
												<?php 
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
				<?php }?>











