<?php
foreach ($dt_amprah->result() as $dat) {
	$id_amprah = $dat->id_amprah;
	$kd_amprah = $dat->kd_amprah;
    $kode_divisi = $dat->kode_divisi;
    $nama_divisi = $dat->nama_divisi;
    $tanggal_amprah = $dat->tanggal_amprah;
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
                			<td><input type="text" name="" id="input"  required="required" class="form-control" readonly="readonly" value="<?php echo $kd_amprah;?>"></td>
                			<td>Tanggal</td>
                			<td><input type="text" name="" id="input" required="required" class="form-control" readonly="readonly" value="<?php echo converttgl($tanggal_amprah);?>"></td>
                		</tr>
                        <tr>
                            <td>Divisi</td>
                            <td><input type="text" name="" id="input"  required="required" class="form-control" readonly="readonly" value="<?php echo $nama_divisi;?>"></td>
                            
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
                  </div> /.box-tools -->
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
					</tr>
				</thead>
					<tbody>
                    <?php 
                    $no=1;
                    foreach ($detail_amprah->result() as $det) {
                        ?>
                    <tr>
                        <td width="20px"><?php echo $no;?></td>
                        <td><?php echo $det->kd_barang;?></td>
                        <td><?php echo $det->nama_barang;?></td>
                        <td><?php echo $det->qty;?></td>
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

<div class="row">
	<div class="col-md-6 col-sm-4">
	<div class="box box-warning ">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo "Total Harga";;?></h3>
                  <!-- <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div> --><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                <div class="table-responsive">
                	<table class="table table-hover">
                    <?php 
                    foreach ($total_barang->result() as $tot) {
                        $total = $tot->total_barang;
                    }
                    ?>
                		<tbody>
                			<tr>
                				<td>Total Barang</td>
                				<td><input type="text" name="" id="input" class="form-control" required="required" readonly="readonly" value ="<?php echo $total;?>"></td>
                			</tr>
                			<tr>
                				<td>Terbilang</td>
                				<td><?php echo terbilang($total);?>&nbsp;barang</td>
                			</tr>
                			<tr>
                				<td colspan="2"><a href="<?php echo base_url('laporan/laporan/laporan_distribusi_detail');?>" class="btn btn-warning">Kembali</a></td>
                				
                			</tr>
                		</tbody>
                	</table>
                </div>
	</div>
</div>

</div>
</div>