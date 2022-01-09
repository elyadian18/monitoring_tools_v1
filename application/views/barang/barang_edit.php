<div class="row">
    <div class="col-lg-12"><br />
       
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('barang/edit/'.$edit['kode_barang']); ?>">Tools</a></li>
            <li class="active">Ubah Tools</li>
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
                Ubah Tools
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
            <?php
                //validasi error upload
                if(!empty($error)) {
                    echo $error;
                }
            ?>
            <?php echo form_open_multipart('barang/update', array('class' => 'form-horizontal', 'id' => 'jvalidate')) ?>

                <div class="form-group">
                    <p class="col-sm-2 text-left">Kode Tools </p>

                    <div class="col-sm-10">
                        <input type="text" name="kode_barang" class="form-control" placeholder="Kode Barang" value="<?php echo $edit['kode_barang']; ?>" readonly="readonly">
                    </div>
                </div>

                <div class="form-group">
                    <p class="col-sm-2 text-left">Nama Tools </p>

                    <div class="col-sm-10">
                        <input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang" 
                        value="<?php echo $edit['nama_barang']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <p class="col-sm-2 text-left">Jenis Tools </p>
                        <div class="col-sm-10">
                            <?php
                            foreach($jenis as $row ){
                                $array[$row['nama_jenis']] = $row['nama_jenis'];
                            }
                            echo form_dropdown('jenis_barang', $array,  $edit['jenis_barang'],"class='form-control'");
                            ?>
                        </div>
                </div>

                <div class="form-group">
                    <p class="col-sm-2 text-left">Jumlah </p>

                    <div class="col-sm-10">
                        <input type="text" name="jumlah" class="form-control" placeholder="Jumlah" value="<?php echo $edit['jumlah']; ?>">
                    </div>
                </div>


                <div class="form-group">
                    <p class="col-sm-2 text-left">Harga </p>

                    <div class="col-sm-10">
                        <input type="text" name="harga" class="form-control" placeholder="Harga" value="<?php echo $edit['harga']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <p class="col-sm-2 text-left">Keterangan </p>

                    <div class="col-sm-10">
                        <textarea name="keterangan"><?php echo $edit['keterangan']; ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <p class="col-sm-2 text-left">Gambar</p>

                    <div class="col-sm-10">
                        <?php if($edit['gambar'] != '') { ?>
                            <img src="<?php echo base_url('assets/img/barang/'.$edit['gambar']);?>" width="100px" height="100px">
                        <?php }else{ ?>
                            <img src="<?php echo base_url('assets/img/barang/book-default.jpg');?>" width="100px" height="100px">
                        <?php } ?> <br /><br />
                        <input type="file" name="userfile" class="form-control btn-file"  value="<?php echo set_value('userfile'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-6">
                        <div class="btn-group pull-left">
                            <?php echo anchor('barang', 'Batal', array('class' => 'btn btn-danger btn-sm')); ?>
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