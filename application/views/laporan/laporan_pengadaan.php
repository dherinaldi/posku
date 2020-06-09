<script type="text/javascript">
$(document).ready(function() {
  $("#tb_barang_masuk").dataTable();
});
</script>
<div class="row">
<!--datagrid-->
<div class="col-xs-8">
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
            <th>Kode Pengadaan</th>
            <th>Jml</th>
            <th>Total Harga</th>
            <th>Tanggal</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $no=1;
        foreach ($pengadaan->result_array() as $dat ) {
        ?>
        <tr>
          <td><?php echo $no;?></td>
          <td><?php echo $dat['kd_pengadaan'];?></td>
          <td><?php echo $dat['jumlah'];?></td>
          <td align="right"><?php echo convertrp($dat['total_harga']);?></td>
          <td><?php echo converttgl($dat['tanggal_pengadaan']);?></td>
          <td>
          <div class="btn-group">
          <div class="btn-hover">
            <a href="<? echo base_url('laporan/laporan/detail_pengadaan/'.$dat['id_pengadaan']) ?>" class="btn btn-mini bg-maroon">
                        <i class="fa fa-tasks"></i> View</a>            
            </div>
            </div>
          </td>
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

