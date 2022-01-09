<div class="row">
    <div class="col-lg-12"><br />
       
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('perbandingan/edit/'.$edit['id']); ?>">Perbandingan</a></li>
            <li class="active">Ubah Perbandingan</li>
        </ol>

        <?php
            echo validation_errors();
            //buat message nik
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
                Ubah perbandingan
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
            <?php
                //validasi error upload
                if(!empty($error)) {
                    echo $error;
                }
            ?>
            <?php echo form_open_multipart('perbandingan/update', array('class' => 'form-horizontal', 'id' => 'jvalidate')) ?>

                <div class="form-group">
                    <p class="col-sm-2 text-left">ID</p>

                    <div class="col-sm-10">
                        <input type="text" name="id" class="form-control" placeholder="ID" value="<?php echo $edit['id']; ?>" readonly="readonly">
                    </div>
                </div>

                <div class="form-group">
                    <p class="col-sm-2 text-left">Nama Perbandingan </p>

                    <div class="col-sm-10">
                        <input type="text" name="nama_tfn" class="form-control" placeholder="Nama Perbandingan"
                        value="<?php echo $edit['nama_tfn']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <p class="col-sm-2 text-left">Kriteria 1 </p>

                    <div class="col-sm-10">
                        <?php
                        foreach($kriteria as $row ){
                            $array[$row['id_kriteria']] = $row['kriteria'];
                        }
                        echo form_dropdown('id_kriteria_1', $array,  $edit['id_kriteria_1'],"class='form-control'");
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <p class="col-sm-2 text-left">Kriteria 2 </p>

                    <div class="col-sm-10">
                        <?php
                        foreach($kriteria as $row ){
                            $array[$row['id_kriteria']] = $row['kriteria'];
                        }
                        echo form_dropdown('id_kriteria_2', $array,  $edit['id_kriteria_2'],"class='form-control'");
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <p class="col-sm-2 text-left">Nilai </p>

                    <div class="col-sm-10">
                        <?php
                        $nilai = array(8=>8,
                            6=>6,
                            5=>5,
                            4=>4,
                            3=>3,
                            2=>2,
                            1=>1,
                            0=>0,
                            -1=>-1,
                            -2=>-2,
                            -3=>-3,
                            -4=>-4,
                            -5=>-5,
                            -6=>-6,
                            -7=>-7,
                            -8=>-8
                        );
                        echo form_dropdown('nilai',$nilai,$edit['nilai'],"class='form-control'");
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-6">
                        <div class="btn-group pull-left">
                            <?php echo anchor('perbandingan', 'Batal', array('class' => 'btn btn-danger btn-sm')); ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="btn-group pull-right">
                            <input type="submit" name="update" value="Ubah" class="btn btn-success btn-sm">
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

<!-- Theme JavaScript -->
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