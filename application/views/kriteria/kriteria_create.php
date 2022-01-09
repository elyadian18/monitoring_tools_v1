<div class="row">
    <div class="col-lg-12"><br />
       
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('users/create'); ?>">Kriteria</a></li>
            <li class="active">Tambah Kriteria</li>
        </ol>

        <?php
            echo validation_errors();
            //buat message nis
            if(!empty($message)) {
            echo $message;
            }
        ?>

    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">

            <div class="panel-heading">
                Tambah Kriteria
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
            <?php
                //validasi error upload
                if(!empty($error)) {
                    echo $error;
                }
            ?>
            <?php echo form_open('kriteria/insert', array('class' => 'form-horizontal', 'id' => 'jvalidate')) ?>

                <div class="form-group">
                    <p class="col-sm-2 text-left">Kriteria </p>

                    <div class="col-sm-10">
                        <input type="text" name="kriteria" class="form-control" placeholder="Kriteria" value="<?php echo set_value('kriteria'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <p class="col-sm-2 text-left">Atribut </p>

                    <div class="col-sm-10" style="width:20%;">
                        <?php
                        $jenis_atribut = array('biaya' => 'Biaya', 'keuntungan' => 'Keuntungan');
                        echo form_dropdown('atribut',$jenis_atribut,set_value('atribut'),"class='form-control'");
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <p class="col-sm-2 text-left">Kode </p>

                    <div class="col-sm-10">
                        <input type="text" name="kode" class="form-control" placeholder="Kode" value="<?php echo set_value('kode'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-6">
                        <div class="btn-group pull-left">
                            <?php echo anchor('kriteria', 'Batal', array('class' => 'btn btn-danger btn-sm')); ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="btn-group pull-right">
                            <input type="submit" name="save" value="Simpan" class="btn btn-success btn-sm">
                        </div>
                    </div>
                </div>
            <?php echo form_close(); ?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>



<!-- jQuery -->
<script src="<?php echo base_url(); ?>template/backend/sbadmin/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>template/backend/sbadmin/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Datepicker -->
<script src="<?php echo base_url(); ?>template/backend/sbadmin/js/bootstrap-datepicker.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>template/backend/sbadmin/vendor/metisMenu/metisMenu.min.js"></script>

<!-- Datepicker -->
<script src="<?php echo base_url(); ?>template/backend/sbadmin/js/tinymce/tinymce.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>template/backend/sbadmin/dist/js/sb-admin-2.js"></script>



<script type="text/javascript">

tinymce.init({selector:'textarea'});

$(document).ready(function() {
    $("#tanggal1").datepicker({
        format:'yyyy-mm-dd'
    });
    
    $("#tanggal2").datepicker({
        format:'yyyy-mm-dd'
    });
    
    $("#tanggal").datepicker({
        format:'yyyy-mm-dd'
    });
})



</script>