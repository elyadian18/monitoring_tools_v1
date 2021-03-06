<div class="row">
    <div class="col-lg-12"><br />
       
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('laporan/karyawan'); ?>">Laporan</a></li>
            <li class="active">Data Karyawan</li>
        </ol>

        <?php
            
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
            <form action="<?=base_url('laporan/cetak_barang')?>" method='post' id="form_cetak_barang">
                <button id="cetak_barang" type="submit" class="btn btn-info"><i class="glyphicon glyphicon-print"></i> Cetak</button>
            </form>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td>No.</td>
                                        <td>Foto</td>
                                        <td>NIP</td>
                                        <td>Nama</td>
                                        <td>Tanggal Lahir</td>
                                        <td>Bagian</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $no = 1;
                                foreach($karyawan->result() as $row) {
                                ?>
                                    <tr>
                                        <td><?php echo $no;?></td>
                                        <td><?php if($row->gambar != "") { ?>
                                            <img src="<?php echo base_url('assets/img/karyawan/'.$row->gambar);?>" width="100px" height="100px">
                                        <?php }else{ ?>
                                            <img src="<?php echo base_url('assets/img/karyawan/images.jpg');?>" width="100px" height="100px">
                                        <?php } ?> 
                                        </td>
                                        <td><?php echo $row->nik;?></td>
                                        <td><?php echo $row->nama;?></td>
                                        <td><?php echo $row->ttl;?></td>
                                        <td><?php echo $row->bagian;?></td>
                                    </tr>
                                <?php $no++; } ?>    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            
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

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>template/backend/sbadmin/vendor/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>template/backend/sbadmin/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>template/backend/sbadmin/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>template/backend/sbadmin/vendor/datatables-responsive/dataTables.responsive.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>template/backend/sbadmin/dist/js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {
    $('#dataTables-example').DataTable({
        responsive: true
    });
});
</script>



