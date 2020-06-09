
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
								<th>NO</th>
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
									$umum = $dt->jumlah_umum;
									$tumum = $dt->total_umum;
									$jamin = $dt->jumlah_jamin;
									$tjamin = $dt->total_jamin;
									$jum = $dt->jumlah;
									$tot = $dt->total;

									$jumum +=$umum;
									$jtumum +=$tumum;
									$jjamin +=$jamin;
									$jtjamin +=$tjamin;
									$jjum +=$jum;
									$jtot +=$tot;
									?>
									<tr>
										<td><?php echo $no;?></td>
										<td><?php echo $dt->klinik;?></td>
										<td><?php echo $dt->nama_tindakan;?></td>
										<td>
											<label>
												<input type="checkbox" value="<?php echo $kode_tindakan;?>" name="chk[]" class="chk" data-tarifrs="<?php echo $dt->tarifrs;?>" data-kode_klinik="<?php echo $dt->kode;?>" data-umum ="<?php echo $umum?>" data-tumum="<?php echo $tumum?>" data-jamin="<?php echo $jamin?>" data-tjamin="<?php echo $tjamin?>" data-jum="<?php echo $jum?>" data-tot="<?php echo $tot?>">

											</label>
											<?php echo $dt->kode_tindakan;?></td>
											<td align="right"><?php echo digit21($dt->tarifrs);?></td>
											<td align="right"><?php echo $umum;?></td>
											<td align="right"><?php echo digit21($tumum);?></td>
											<td align="right"><?php echo $jamin;?></td>
											<td align="right"><?php echo digit21($tjamin);?></td>
											<td align="right"><?php echo $jum;?></td>
											<td align="right"><?php echo digit21($tot);?></td>
										</tr>
										<?php 
										$no++;
									}
								}?>
								<tfoot>
									<tr>
										<td></td>
										<td></td>
										<td>TOTAL</td>
										<td></td>
										<td></td>
										<td align="right"><?php echo $jumum;?></td>
										<td align="right"><?php echo digit21($jtumum);?></td>
										<td align="right"><?php echo $jjamin;?></td>
										<td align="right"><?php echo digit21($jtjamin);?></td>
										<td align="right"><?php echo $jjum;?></td>
										<td align="right"><?php echo digit21($jtot);?></td>
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


