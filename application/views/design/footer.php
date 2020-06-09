       </section>        <!-- /.content -->
     </div>     <!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs"><small>
          Halaman ini dimuat dalam {elapsed_time} detik, Penggunaan memory {memory_usage}
        </small></div>
        <?php $created = $this->config->item('created');?>
        <strong>Copyright &copy; <?=date('Y')?> <!-- <a href="http://almsaeedstudio.com"> -->
        <a href="<?=base_url();?>#"><?php echo $created;?></a></strong>
      </footer>
    </div><!-- ./wrapper -->     
  </body>
<!--   <script>
$(document).ready(function() {
    $('#profileForm')
        .formValidation({
            framework: 'bootstrap',
            excluded: [':disabled'],
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                kode: {
                    validators: {
                        notEmpty: {
                            message: 'The kode is required and cannot be empty'
                        }
                    }
                },
                nama: {
                    validators: {
                        notEmpty: {
                            message: 'The kode is required and cannot be empty'
                        }
                    }
                },
                keterangan: {
                    validators: {
                        notEmpty: {
                            message: 'The keterangan is required and cannot be empty'
                        },
                        callback: {
                            message: 'The keterangan must be less than 200 characters long',
                            callback: function(value, validator, $field) {
                                if (value === '') {
                                    return true;
                                }
                                // Get the plain text without HTML
                                var div  = $('<div/>').html(value).get(0),
                                    text = div.textContent || div.innerText;

                                return text.length <= 200;
                            }
                        }
                    }
                }
            }
        })
        .find('[name="keterangan"]')
            .ckeditor()
            .editor
                // To use the 'change' event, use CKEditor 4.2 or later
                .on('change', function() {
                    // Revalidate the bio field
                    $('#profileForm').formValidation('revalidateField', 'keterangan');
                });
});
</script> -->
</html>
