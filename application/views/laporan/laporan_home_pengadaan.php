<script>
$(document).ready(function () { 
  $("#start").datepicker({
    format:"dd-mm-yyyy"
  });

  $("#end").datepicker({
    format:"dd-mm-yyyy"
  });
  /*
        $("#end").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#start").datepicker({ dateFormat: 'dd-mm-yy' }).bind("change",function(){
            var minValue = $(this).val();
            minValue = $.datepicker.parseDate("dd-mm-yy", minValue);
            minValue.setDate(minValue.getDate()+1);
            $("#to").datepicker( "option", "minDate", minValue );
        });
   */

  $("#tampilkan").click(function(){
            var start=$("#start").val();
            var end=$("#end").val();
            var bulan = $("#bulan").val();
            var tahun = $("#tahun").val();
            /*alert (start + "-"+end +" - "+bulan+"-"+tahun);*/

            $.ajax({
                url:"<?php echo site_url('laporan/laporan/cari_laporan_pengadaan');?>",
                type:"POST",
                data:"start="+start+"&end="+end+"&bulan="+bulan+"&tahun="+tahun,
                cache:false,
                success:function(html){
                    $("#tampildata").html(html);
                },
                error: function(e){
                  alert('Error: ' + e);  
              }
            });
        });

});
</script>
<div class="row">
<!--datagrid-->
<div class="col-md-6">
  <div class="box box-warning box-solid">
    <div class="box-header">
      <h3 class="box-title"><?echo $title;?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <div class="table-responsive">
      <table class="table table-hover">
      <tbody>
        <tr>
          <td>Dari</td>
          <td><input type="text" name="start" id="start" class="form-control" value="" required="required" placeholder="dd-mm-yyyy" ></td>
          <td>Ke</td>
          <td><input type="text" name="end" id="end" class="form-control" value="" required="required" placeholder="dd-mm-yyyy"></td>
          <td><button type="button" class="btn btn-danger" id="tampilkan">Cari</button></td>
        </tr>
        <tr>
        <td>By</td>
          <td>
            <? $bulan = array(0=>"--Pilih--",1=>"Januari",2=>"Februari",3=>"Maret",4=>"April",5=>"Mei",6=>"Juni",7=>"Juli",8=>"Agustus",9=>"September",10=>"Oktober",11=>"November",12=>"Desember");
            /*echo count($bulan);            */
            ?>
            <select name="bulan" id="bulan" class="form-control">
            <?php
            for ($i=0; $i < count($bulan) ; $i++) {
            ?>
              <option value="<? echo $i;?>"><? echo $bulan[$i];?></option>
            <?}
            ?>
            </select>
          </td>
          <td>
            <?
            $tahun_skg = date("Y");
            ?>
            <select name="tahun" id="tahun" class="form-control">
              <option value="">-- Pilih --</option>
             <?for ($i=$tahun_skg; $i>=$tahun_skg-10 ; $i--) {

              ?>
              <option value="<? echo $i;?>"><? echo $i;?></option>
              <?}?>
            </select>
          </td>
        </tr>
      </tbody>
      </table>      
    </div>
   
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->
  </div> <!-- /.col-xs-12 -->
</div> <!-- /.row -->

 <div id="tampildata"></div>