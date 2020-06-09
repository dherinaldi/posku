<script type="text/javascript" >
$(document).ready(function() {
	$('#lap_data_stok').dataTable();
});
	
</script>

<div class="row">
	<div class="col-md-8">
	<div class="box box-warning box-solid">
		<div class="box-header with-border">
            <h3 class="box-title"><?php echo $title;?></h3>
        	    <!-- <div class="box-tools pull-right">
        	                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        	                	</div> --><!-- /.box-tools -->
         </div><!-- /.box-header -->
     <div class="box-body">
		<div class="table-responsive">
			<table class="table table-hover" id="lap_data_stok">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Masuk</th>
						<th>Keluar</th>
						<th>Tersedia</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				$no=1;
				foreach ($dt_persediaan->result() as $dt) {
					
				?>
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $dt->kode_barang;?></td>
						<td><?php echo $dt->nama_barang;?></td>
						<td align="right"><?php echo $dt->masuk;?></td>
						<td align="right"><?php echo $dt->keluar;?></td>
						<td align="right"><?php echo $dt->stok_akhir;?></td>
						
					</tr>
				<?
				$no++;
			}
				?>

				
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
</div>