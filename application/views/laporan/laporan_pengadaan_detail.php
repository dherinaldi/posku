<script type="text/javascript">
$(document).ready(function() {
  $("#tb_barang_masuk").dataTable();
});
</script>

<div class="row">
<!--datagrid-->
<div class="col-md-10">
  <div class="box box-warning box-solid">
    <div class="box-header">
      <h3 class="box-title"><?echo $title;?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <div class="table-responsive">
      <table class="table table-hover" id="tb_barang_masuk">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Kode Pengadaan</th>
            <th>Penyedia</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $no=1;
        foreach ($dt_pengadaan->result_array() as $dat ) {
        ?>
        <tr>
          <td><?php echo $no;?></td>
          <td><?php echo converttgl($dat['tanggal_pengadaan']);?></td>
          <td><?php echo $dat['kd_pengadaan'];?></td>
          <td><?php echo $dat['kode_penyedia'];?></td>
          <td><?php echo $dat['kd_barang'];?></td>
          <td><?php echo $dat['nama_barang'];?></td>
          <td><?php echo $dat['qty'];?></td>
          <td align="right"><?php echo convertrp($dat['harga']);?></td>
          <td align="right"><?php echo convertrp($dat['subtotal']);?></td>
          
      </tr>
        <?
        $no++;
      }
        ?>
        </tbody>
      </table>
    </div>
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->
  </div> <!-- /.col-xs-12 -->
</div> <!-- /.row -->

