<?php
foreach ($dt_pengadaan->result_array() as $row) {
	$total = $row['total_harga'];
	$kode = $row['kd_pengadaan'];
	$tanggal = $row['tanggal_pengadaan'];
}
?>
<div class="row">
	<div class="col-md-8">
	<div class="box box-warning box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $title;?></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                <table class="table table-hover">
                	<tbody>
                		<tr>
                			<td>Kode</td>
                			<td><input type="text" name="" id="input"  required="required" class="form-control" readonly="readonly" value ="<?php echo $kode;?>"></td>
                			<td>Tanggal</td>
                			<td><input type="text" name="" id="input" required="required" class="form-control" readonly="readonly" value ="<?php echo converttgl($tanggal);?>"></td>
                		</tr>
                	</tbody>
                </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
	</div>
</div>
<div class="row">
	<div class="col-md-8">
	<div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo "Detail Barang";;?></h3>
                  <!-- <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div> --><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Qty</th>
						<th>Harga</th>
						<th>Subtotal</th>
					</tr>
				</thead>
					<tbody><?php 
					$no=1;
					foreach ($barang_pengadaan ->result_array() as $row) { ?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $row['kd_barang'];?></td>
							<td><?php echo $row['nama_barang'];?></td>
							<td><?php echo $row['qty'];?></td>
							<td align="right"><?php echo convertrp($row['harga']);?></td>
							<td align="right"><?php echo convertrp($row['subtotal']);?></td>
						</tr>
						<?
						$no++;
						}?>
					</tbody>
				</table>
			</div>
	 	</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6 col-sm-4">
	<div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo "Total Harga";;?></h3>
                  <!-- <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div> --><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                <div class="table-responsive">
                	<table class="table table-hover">
                		<tbody>
                			<tr>
                				<td>Total</td>
                				<td><input type="text" name="" id="input" class="form-control" required="required" readonly="readonly" value ="<?php echo convertrp($total);?>"></td>
                			</tr>
                			<tr>
                				<td>Terbilang</td>
                				<td><?php echo strtoupper(terbilang($total));?> RUPIAH</td>
                			</tr>
                			<tr>
                				<td colspan="2"><a href="<?php echo base_url('laporan/laporan/laporan_pengadaan_detail');?>" class="btn btn-warning">Kembali</a></td>
                				
                			</tr>
                		</tbody>
                	</table>
                </div>
	</div>
</div>

</div>
</div>