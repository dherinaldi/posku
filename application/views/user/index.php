<script type="text/javascript">
  $(function () {
    $("#table_user").dataTable();
  });
</script>

<style type="text/css">
    .modal-dialog  {width:75%;}
    .btn-hover {
    visibility:hidden;
    }
  table tr:hover .btn-hover {
    visibility:visible;
    }
}
</style>

<div class="row">
    <!-- <div class="col-md-8"> -->
  <div class="col-md-8">
  <!-- TABLE: LATEST ORDERS -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar <?=$title;?></h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
      <div class="table-responsive">
        <table class="table no-margin table-hover table-bordered table-condensed" id="table_penyedia">
          <thead>
            <tr>
              <th>User</th>
              <th>Group</th>
            </tr>
          </thead>
          <tbody>
          <?php
           $pengguna = $this->app_model->userlogin();
          foreach($pengguna->result_array() as $dt)
          { ?>
            <tr>
              <td><?=$dt['username'];?></td>
              <td><?=$dt['login_hash'];?></td>
            </tr>
            <?php
            //$no++;
            } ?>
          </tbody>
        </table>
      </div><!-- /.table-responsive -->
    </div><!-- /.box-body -->
    
  </div><!-- /.box -->
</div><!-- /.col -->

      </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
