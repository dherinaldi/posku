<div class="row">
<!--datagrid-->
<div class="col-xs-8">
  <div class="box box-warning box-solid">
    <div class="box-header">
      <h3 class="box-title"><?php echo $title;?></h3>
    </div><!-- /.box-header -->
      <div class="box-body">
      <table class="table table-hover" id="tb_amprah">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Kode Amprah</th>
            <th>Nama Divisi</th>
            <th>Jumlah</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        $no=1;
        foreach ($data_amprah->result() as $dat) {
         
        ?>
        
        <tr>
          <td><?php echo $no;?></td>
          <td><?php echo converttgl($dat->tanggal_amprah);?></td>
          <td><?php echo $dat->kd_amprah;?></td>
          <td><?php echo $dat->kode_divisi;?></td>
          <td><?php echo $dat->jumlah. "/".$dat->jumlah_barang;?></td>
          <td>
            <div class="btn-group">
            <a href="<?php echo base_url('laporan/laporan/detail_amprah/'.$dat->id_amprah)?>" class="btn btn-mini bg-maroon">
                        <i class="fa fa-tasks"></i> View</a>
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
  </div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function (){
  $("#tb_amprah").dataTable();
  });
</script>
