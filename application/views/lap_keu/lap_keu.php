<?php
error_reporting('E_ALL');
ini_set('display_errors', '1');
?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#tb_anggaran").dataTable();
		$('#tahun').datepicker({
			 format: " yyyy", // Notice the Extra space at the beginning
			 viewMode: "years",
			 orientation: "auto bottom", 
			 minViewMode: "years",
			 //endDate: new Date()

			});
		$('#sel_unit').chosen({search_contains: true});

		$("#cari").click(function(){
			var bku = $("#bku").val();
			console.log("bku="+bku);
			$.ajax({
				url:"<?php echo base_url('laporan/lap_print');?>",
				type:"POST",
				data:"bku="+bku,
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
				<h3 class="box-title"><?php echo $title;?></h3>
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
								<td>Unit</td>
								<td>
									<input type="text" name="unit" id="unit" class="form-control" value="<?php 
									if($_POST['unit'] != ''): echo $_POST['unit']; else: echo " "; endif;

									?>">
								</td>
								<td>Tahun</td>
								<td>
									<input type="text" name="tahun" id="tahun" class="form-control" value="<?php 
									if($_POST['tahun'] != ''): echo $_POST['tahun']; else: echo date('Y'); endif;
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
