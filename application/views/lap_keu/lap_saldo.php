<?php
error_reporting('E_ALL');
ini_set('display_errors', '1');
?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#tb_anggaran").dataTable();
		$('#tgl_awal,#tgl_akhir').datepicker({format:'dd-mm-yyyy',orientation:' auto bottom'});
		$('#sel_unit').chosen({search_contains: true});

		$("#cari").click(function(){
			var tgl_awal = $("#tgl_awal").val();
			var tgl_akhir = $("#tgl_akhir").val();

			var data = {'tgl_awal':tgl_awal,'tgl_akhir':tgl_akhir};
			$.ajax({
				url:"<?php echo base_url('laporan/lap_print/lap_saldo');?>",
				type:"POST",
				data:data,
				cache:false,
				success:function(html){
					$("#tampildata").html(html);
				},
				error: function(e){
					alert('Error: ' + e);  
				}
			});
		});


	});
</script>
<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"><?=$title;?></h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-hover">
						<tbody>
							<tr>
								<td>BKU</td>
								<td>
									<input type="text" name="bku" id="bku" class="form-control" value="<?php 
									if($_POST['bku'] != ''): echo $_POST['bku']; else: echo " "; endif;

									?>">
								</td>
								<td>Program</td>
								<td><input type="text" name="program" id="program" class="form-control" value="<?php 
									if($_POST['program'] != ''): echo $_POST['program']; else: echo " "; endif;

									?>">
								</td>

							</tr>
							<tr>
								<td>Kegiatan</td>

								<td width="300px">
									<input type="text" name="kegiatan" id="kegiatan" class="form-control" value="<?php 
									if($_POST['kegiatan'] != ''): echo $_POST['kegiatan']; else: echo " "; endif;

									?>">
								</td>

								<td>Sub Kegiatan</td>

								<td width="300px">
									<input type="text" name="sub_kegiatan" id="sub_kegiatan" class="form-control" value="<?php 
									if($_POST['sub_kegiatan'] != ''): echo $_POST['sub_kegiatan']; else: echo " "; endif;

									?>">
								</td>
							</tr>
							<tr>
								<td>Tgl</td>
								<td>
									<input type="text" name="tgl_awal" id="tgl_awal" class="form-control" value="<?php 
									if($_POST['tgl_awal'] != ''): echo $_POST['tgl_awal']; else: echo date('d-m-Y'); endif;
									?>">
								</td>
								<td>Tgl</td>
								<td>
									<input type="text" name="tgl_akhir" id="tgl_akhir" class="form-control" value="<?php 
									if($_POST['tgl_akhir'] != ''): echo $_POST['tgl_akhir']; else: echo date('d-m-Y'); endif;
									?>">
								</td>

							</tr>
							<tr>
								<td colspan="2">
									<button type="button" class="btn btn-sm btn-primary" id="cari">Cari</button>
								</td>

							</tr>

						</tbody>
					</table>
				</div>

			</div> <!-- /.box-body -->

			<div id="tampildata" style="height:650px;padding:10px;overflow:auto"></div>
		</div> <!-- /.box -->
	</div>
</div>
