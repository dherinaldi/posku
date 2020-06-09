<style>
	.number {
		text-align: right;
	}
</style>
<div class="row">
	<div class="col-md-8">
		<div class="box box-success">
			<div class="box-header">
				<h3 class="box-title"><?php echo $title;?></h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-hover">
						<input type="text" id="jenis_penerimaan" value="1">
						<tbody>
							<tr>
								<td>Kode</td>
								<td><input type="text" id="kode" class="form-control">
								</td>
								<td>Nama</td>
								<td><input type="text" id="nama" class="form-control">
								</td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td><input type="text" id="alamat" class="form-control">
								</td>
								<td>Kota</td>
								<td><input type="text" id="kota" class="form-control">
								</td>
							</tr>
							<tr>
								<td>Tanggal</td>
								<td><input type="text" id="start" class="form-control"></td>
								<td>s/d</td>
								<td><input type="text" id="end" class="form-control"></td>
							</tr>
							<tr>
								<td colspan="2">
									<button type="submit" class="btn btn-sm btn-primary" id="cari">Cari</button>
									<a class="btn btn-info btn-sm" href="<?php echo base_url('beli/add')?>" role="button">Tambah</a>
								</td>

							</tr>

						</tbody>
					</table>
				</div>

			</div> <!-- /.box-body -->
		</div> <!-- /.box -->
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-6">
		<div class="box box-success">
			<div class="box-header">
				<h3 class="box-title">List Data </h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<div id="hasil"></div>

			</div>
		</div>
	</div>
</div>


<script>
	$(document).ready(function () {
		var date = new Date();
		var lastMonth = (date.getDate())+'/'+(date.getMonth())+'/'+(date.getFullYear());
		$("#start").datepicker({
			format:"dd-mm-yyyy",
		}).datepicker("setDate", lastMonth);

		$("#end").datepicker({
			format:"dd-mm-yyyy"
		}).datepicker("setDate", new Date());
		var param = {
			start: $('#start').val(),
			end: $('#end').val(),
			jenis_penerimaan:$("#jenis_penerimaan").val(),
			limit:100
		};

		$.ajax({
			url:"<?php echo site_url('beli/list_beli');?>",
			type:"POST",
			data:param,
			cache:false,
			success:function(html){
				$('#hasil').html(html);
  				//window.location = "<?php echo base_url('beli')?>";
  			},
  			error: function(e){
  				swal(e);
  			}
  		});
		/*axios.post("<?php echo base_url('beli/list_beli')?>",param)
		.then(function (response) {
			$('#hasil').html(response.data);
		})
		.catch(function (error) {
			swal(error);
		});*/
});
</script>