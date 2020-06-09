
<script type="text/javascript">
	$(document).ready(function(){
		//$("#tb_data").dataTable();
		$("#simpan").click(function(){
			var tgl_awal = $("#tgl_awal").val();
			var chk = $('.chk:checked').map(function(){
				return this.value;
			}).get();
			var kode_tindakan = chk;
		/*	var receiptNos2 = $("#result input:checkbox:checked").map(function () {
    return $(this).data('id')
}).get();*/
var tarifrs = $(".chk:checked").map(function () {
	return $(this).data('tarifrs')
}).get();
var kode_klinik = $(".chk:checked").map(function () {
	return $(this).data('kode_klinik')
}).get();
var umum = $(".chk:checked").map(function () {
	return $(this).data('umum')
}).get();
var tumum = $(".chk:checked").map(function () {
	return $(this).data('tumum')
}).get();
var jamin = $(".chk:checked").map(function () {
	return $(this).data('jamin')
}).get();
var tjamin = $(".chk:checked").map(function () {
	return $(this).data('tjamin')
}).get();
var jum = $(".chk:checked").map(function () {
	return $(this).data('jum')
}).get();
var tot = $(".chk:checked").map(function () {
	return $(this).data('tot')
}).get();
			/*var tarifrs = $('input[name="tarifrs[]"]').map(function(){return $(this).val();}).get();
			*/
			if(chk.length<=0){
				alert('Belum ada data yang dipilih!!!');
				return false;
			}


			var dt = {'chk':chk,'tarifrs':tarifrs,'umum':umum,'tumum':tumum,'jamin':jamin,'tjamin':tjamin,'jum':jum,'tot':tot,'tgl_awal':tgl_awal,'kode_tindakan':kode_tindakan,'kode_klinik':kode_klinik};
		//console.log(dt);
		$.ajax({
			url:"<?php echo base_url('data_source/simpan_data_simrs');?>",
			type:"POST",
			data:dt,
			cache:false,
			success:function(data){
				/*console.log(data);
				$("#tampil").html(data);*/
				$( "#hasil" ).html(data);
			},
			error: function(e){
				alert('Error: ' + e);  
			}
		});
	});
$("#sd").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$("#tb_data tr").filter(function() {
		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		console.log($(this).text().toLowerCase().indexOf(value));
	});
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
					<button type="button" class="btn btn-success btn-sm" id="simpan"><i class="fa fa-save"></i></button>
					<button type="button" class="btn btn-sm btn-info" id="check" title="check all">
						<i class="fa fa-check"></i>
					</button>
					<button type="button" class="btn btn-sm btn-primary" id="uncheck" title="un-check all"><i class="fa fa-ban"></i></button>
					<button type="button" class="btn btn-sm btn-warning" id="toggle" title="custom"><i class="fa fa-random"></i></button>
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
								<th>No</th>
								<th>Kode</th>
								<th>Kode Pdpt</th>
								<th>No Bukti</th>
								<th>No Akun</th>
								<th>Nama/BA</th>
								<th>Debet</th>
								<th>Kredit</th>
								<th>Periode</th>
								<th>Aksi</th>

							</tr>
						</thead>
						<tbody>
							<?php
							$no=1;
							if($data->num_rows()>0){
								foreach ($data->result() as $key) {
									$id_jurnal = $key->id;
									$kode_jurnal = $key->kode_jurnal;
									$kode_pendapatan = $key->kode_pendapatan;
									$no_bukti = $key->no_bukti;
									$no_akun = $key->no_akun;
									$nama_rekening = $key->nama_rekening;
									$debet = $key->debet;
									$kredit = $key->kredit;
									$qty_in = $key->qty_in;
									$qty_out = $key->qty_out;
									$tarifrs = $key->tarifrs;
									$periode = $key->periode;
									?>
									<tr>
									<td><?php echo $no;?></td>
									<td><?php echo $kode_jurnal;?></td>
									<td><?php echo $kode_pendapatan;?></td>
									<td><?php echo $no_bukti;?></td>
									<td><?php echo $no_akun;?></td>
									<td><?php echo $nama_rekening;?></td>
									<td><?php echo $debet;?></td>
									<td><?php echo $kredit;?></td>
									<td><?php echo $periode;?></td>
									<td><?php echo $no;?></td>
									</tr>
									<?php
									$no++;
								}
							}
							?>
						</tbody>


					</table>
				</div>
			</div> <!-- /.box-body -->
		</div> <!-- /.box -->
	</div> <!-- /.col-xs-12 -->
</div> <!-- /.row -->


