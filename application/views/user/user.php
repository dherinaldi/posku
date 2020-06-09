<script type="text/javascript">
  $(function () {
    $("#sample1").dataTable();
    $("sample2").dataTable({
      "bPaginate": true,
      "bLengthChange": false,
      "bFilter": false,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false
    });
  });
</script>

<div class="row">
    <!-- <div class="col-md-8"> -->
  <div class="col-md-8">
  <!-- TABLE: LATEST ORDERS -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Sub Barang</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
      <div class="table-responsive">
        <table class="table no-margin" id="sample1">
          <thead>
            <tr>
              <th>Kode Jenis</th>
              <th>Jenis Barang</th>
              <th>Aktif</th>
            </tr>
          </thead>
          <tbody>
          <?php
           $userlogin = $this->m_barang->userlogin();
          foreach($userlogin->result_array() as $dt)
          { ?>
            <tr>
              <td><?=$dt['username'];?></td>
              <td><?=$dt['password'];?></td>
              <td><?=$dt['login_hash'];?></td>
            </tr>
            <?php
            //$no++;
            } ?>
          </tbody>
        </table>
      </div><!-- /.table-responsive -->
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
      <a href="<?=base_url()?>barang" class="btn btn-sm btn-info btn-flat pull-left">Tambah Barang</a>
      <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">Lihat Semua Barang</a>
    </div><!-- /.box-footer -->
    <div class="pagination"> <?php //echo $paginator;?></div>
  </div><!-- /.box -->
</div><!-- /.col -->

      </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
<?php

