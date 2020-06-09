
<script type="text/javascript">
	$(document).ready(function(){
		$("#hapus").click(function(){
			var chk = $('.chk:checked').map(function(){
				return this.value;
			}).get();
			var kode_tr = $(".chk:checked").map(function () {
				return $(this).data('kode_tr')
			}).get();
			var dt = {'chk':chk,'kode_tr':kode_tr};

			if(confirm(`Yakin akan menghapus ${chk.length} data !!!!`)){
				$.ajax({
					url:"<?php echo base_url('data_source/hapus_pendapatan');?>",
					type:"POST",
					data:dt,
					cache:false,
					success:function(data){
				//console.log(data);
				$("#tampil").load("<?php echo base_url('data_source/list_pendapatan_simrs');?>", {
					tgl_awal:   $("#tgl_awal").val(),
					tgl_akhir:   $("#tgl_akhir").val()
				}, function(response, status, xhr) {
					console.log(response);
				})
			},
			error: function(e){
				alert('Error: ' + e);  
			}
		});
			}

		});
		$("#sd").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#tb_data tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				console.log($(this).text().toLowerCase().indexOf(value));
			});
		});

		$("#myModal").on("show.bs.modal", function (event) {
			var button = $(event.relatedTarget);
			var kode_tr = button.data("kode_tr");
			var nama_klinik = button.data("nama_klinik");
			var modal = $(this);
			modal.find("#kode_tr").val(kode_tr);
			modal.find("#nama_klinik").val(nama_klinik);
			/*modal.find("#company").val(company);*/
		});

	});
(function( $ ) {
	$.fn.checked = function(value) {
		if(value === true || value === false) {
            // Set the value of the checkbox
            $(this).each(function(){ this.checked = value; });
        } else if(value === undefined || value === 'toggle') {
            // Toggle the checkbox
            $(this).each(function(){ this.checked = !this.checked; });
        }
    };
    
})( jQuery );

$(function() {
	$('#check').click(function() {
		$(':checkbox').checked(true);
	});
	$('#uncheck').click(function() {
		$(':checkbox').checked(false);
	});
	$('#toggle').click(function() {
		$(':checkbox').checked('toggle');
	});


});

</script>
<div class="row">
	<!--datagrid-->
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"><?php echo $title;?></h3>
				<div class="box-title">
					
					<button type="button" class="btn btn-sm btn-info" id="check" title="check all">
						<i class="fa fa-check"></i>
					</button>
					<button type="button" class="btn btn-sm btn-primary" id="uncheck" title="un-check all"><i class="fa fa-ban"></i></button>
					<button type="button" class="btn btn-sm btn-warning" id="toggle" title="custom"><i class="fa fa-random"></i></button>
					<button type="button" class="btn btn-sm btn-danger" id="hapus" title="hapus"><i class="fa fa-trash"></i></button>
				</div>
				<div class="box-title">
					Cari <input type="text" name="sd" id="sd" class="form-control">
				</div>

			</div><!-- /.box-header -->
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-hover" id="tb_data">
						<thead>
							<tr>
								<th>NO</th>
								<th>KODE</th>
								<th>KLINIK</th>
								<th>TINDAKAN</th>
								<th>KODE</th>
								<th>TARIF</th>
								<th>UMUM</th>
								<th>TUMUM</th>
								<th>JAMIN</th>
								<th>TJAMIN</th>
								<th>JUM</th>
								<th>TOTAL</th>
								<th>PERIODE</th>

							</tr>
						</thead>
						<tbody>
							<?php 

							$no=1;
							$umum=$tumum=$jamin=$tjamin=$jum=$tot="";
							$jumum=$jtumum=$jjamin=$jtjamin=$jjum=$jtot=0;
							if($data->num_rows()>0){
								foreach ($data->result() as $dt) {
									$kode_tindakan = $dt->kode_tindakan;
									$umum = $dt->umum;
									$tumum = $dt->tumum;
									$jamin = $dt->jamin;
									$tjamin = $dt->tjamin;
									$jum = $dt->jumlah;
									$tot = $dt->total;
									$kode_tr = $dt->kode_tr;

									$flag= $dt->flag;
									if($flag==0){
										$bg_color = 'style="background-color: #FF5151"';
									}else{
										$bg_color = "";
									}

									$jumum +=$umum;
									$jtumum +=$tumum;
									$jjamin +=$jamin;
									$jtjamin +=$tjamin;
									$jjum +=$jum;
									$jtot +=$tot;
									?>
									<tr >
										<td><?php echo $no;?></td>
										<td>
											<div class="wrap wd100"><?php echo $kode_tr;?></div>
										</td>
										<td>
											<div class="wrap wd100"><?php echo $dt->nama_klinik;?>
											</div>
										</td>
										<td>
											<div class="wrap wd200"><?php echo $dt->nama_tindakan;?></div>
										</td>
										<td <?php echo $bg_color;?>>
											<label>
												<input type="checkbox" value="<?php echo $kode_tindakan;?>" name="chk[]" class="chk" data-tarifrs="<?php echo $dt->tarifrs;?>" data-kode_klinik="<?php echo $dt->kode_klinik;?>" data-umum ="<?php echo $umum?>" data-tumum="<?php echo $tumum?>" data-jamin="<?php echo $jamin?>" data-tjamin="<?php echo $tjamin?>" data-jum="<?php echo $jum?>" data-tot="<?php echo $tot?>" data-kode_tr="<?php echo $kode_tr;?>">
											</label>
											<a class="btn btn-sm btn-warning" href="#myModal" role="button" data-toggle="modal" data-kode_tr="<?php echo $kode_tr ?>" data-nama_klinik="<?php echo $dt->nama_klinik; ?>"
												><i class="fa fa-pencil"></i></a>
												<?php echo $dt->kode_tindakan;?></td>
												<td align="right"><?php echo digit21($dt->tarifrs);?></td>
												<td align="right"><?php echo $umum;?></td>
												<td align="right"><?php echo digit21($tumum);?></td>
												<td align="right"><?php echo $jamin;?></td>
												<td align="right"><?php echo digit21($tjamin);?></td>
												<td align="right"><?php echo $jum;?></td>
												<td align="right"><?php echo digit21($tot);?></td>
												<td><?php echo $dt->periode;?></td>
											</tr>
											<?php 
											$no++;
										}
									}?>
									<tfoot>
										<?php 
										$msg_success= 'style="font-size: 16px;color:green;font-weight: bold;"';
										$msg_danger= 'style="font-size: 16px;color:red;font-weight: bold;"';

										if($j_umum_simrs==$jumum){
											$msg = $msg_success;
										}else{
											$msg = $msg_danger;
										}

										if($t_umum_simrs==$tumum){
											$msg =$msg_success;
										}else{
											$msg = $msg_danger;
										}

										if($j_jamin_simrs==$jjamin){
											$msg =$msg_success;
										}else{
											$msg = $msg_danger;
										}
										if($t_jamin_simrs==$tjamin){
											$msg =$msg_success;
										}else{
											$msg = $msg_danger;
										}

										if($jum_simrs==$jjum){
											$msg =$msg_success;
										}else{
											$msg = $msg_danger;
										}

										if($tot_simrs==$jtot){
											$msg =$msg_success;
										}else{
											$msg = $msg_danger;
										}
										?>
										<tr>
											<td></td>
											<td></td>
											<td>TOTAL</td>
											<td></td>
											<td></td>
											<td></td>
											<td align="right"><div <?php echo $msg;?>><?php echo $jumum;?></div></td>
											<td align="right"><div <?php echo $msg;?>><?php echo digit21($jtumum);?></div></td>
											<td align="right"><div <?php echo $msg;?>><?php echo $jjamin;?></div></td>
											<td align="right"><div <?php echo $msg;?>><?php echo digit21($jtjamin);?></div></td>
											<td align="right"><div <?php echo $msg;?>><?php echo $jjum;?></div></td>
											<td align="right"><div <?php echo $msg;?>><?php echo digit21($jtot);?></div></td>
											<td></td>
										</tr>
									</tfoot>
								</tbody>


							</table>
						</div>
					</div> <!-- /.box-body -->
				</div> <!-- /.box -->
			</div> <!-- /.col-xs-12 -->
		</div> <!-- /.row -->

		<a href="#myModal" class="btn btn-info btn-lg" data-toggle="modal" data-code="code" data-company="company name">
			Show Modal
		</a>

		<div class="modal" tabindex="-1" id="myModal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="mySmallModalLabel">Codes & Company</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Kode</label>
							<input type="text" name="kode_tr" id="kode_tr" class="form-control">      
						</div>

						<div class="form-group">
							<label>Klinik</label>
							<input type="text" id="kode_klinik" class="form-control">
							<input type="text" id="nama_klinik" class="form-control">
						</div>

						<div class="modal-footer">  
							<button type="submit" class="btn btn-success">Update</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>

					</div>
				</div>
			</div>
		</div>

