<?php
error_reporting('E_ALL');
ini_set('display_errors', '1');
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#tampil").load("<?php echo base_url('data_source/list_pendapatan_simrs');?>", {
			tgl_awal:   $("#tgl_awal").val(),
			tgl_akhir:   $("#tgl_akhir").val()
		}, function(response, status, xhr) {
			console.log(status);
		})

		$('#tgl_awal,#tgl_akhir').datepicker({format:'dd-mm-yyyy',orientation:'bottom'});
		$('#unit').chosen({search_contains: true});


		$("#cari").click(function(){
			var tgl_awal = $("#tgl_awal").val();
			var tgl_akhir = $("#tgl_akhir").val();
			var dt = {'tgl_awal':tgl_awal,'tgl_akhir':tgl_akhir};

			$.ajax({
				url:"<?php echo base_url('data_source/list_pendapatan_simrs');?>",
				type:"POST",
				data:dt,
				cache:false,
				success:function(html){
					$("#tampil").html(html);
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
<div class="row">
	<div class="col-md-8">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"><?php echo $title;?></h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<form method="post" name="f_post" id="f_post">
					<table class="table table-hover">
						<tbody>
							
							<tr>
								<td>AKUN</td>
								<td>
									<input type="text" name="akun" id="akun" class="form-control" value="<?php 
									if($_POST['akun'] != ''): echo $_POST['akun']; else: echo " "; endif;

									?>">
								</td>
								<td>JENIS</td>
								<td>
									<select name="jenis" id="jenis" class="form-control" required="required">
										<option value=""></option>
									</select>
								</td>
							</tr>
							<tr>

								<td>Tanggal</td>
								<td>
									<input type="text" name="tgl_awal" id="tgl_awal" class="form-control wd100" value="<?php 
									if($_POST['tgl_awal'] != ''): echo $_POST['tgl_awal']; else: echo date('d-m-Y',strtotime(date('Y-m-d'))); endif;
									?>">
								</td>
								<td>Tanggal</td>
								<td>
									<input type="text" name="tgl_akhir" id="tgl_akhir" class="form-control wd100" value="<?php 
									if($_POST['tgl_akhir'] != ''): echo $_POST['tgl_akhir']; else: echo date('d-m-Y',strtotime(date('Y-m-d'))); endif;
									?>">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<button type="button" class="btn btn-sm btn-primary" id="cari">Cari & Refresh Data</button>
									<a class="btn btn-sm btn-warning" href="<?php echo base_url('data_source')?>" role="button">Data SIMRS</a>
								</td>

							</tr>

						</tbody>
					</table>
				</div>
			</form>

		</div> <!-- /.box-body -->
	</div> <!-- /.box -->
</div>

<div id='loading' style="display:none;">
	Load data process <img src="<?php  echo  base_url();?>assets/img/ajax-loader-2.gif"/>
</div>
<div id="hasil"></div>
<div id="hasil1"></div>

<div id="tampil">

</div>

