<style>
    div#loader {
        text-align: center;
        z-index: 9999;
    }
</style>
<div class="row">
    <div class="col-lg-12"><br />
       
        <ol class="breadcrumb">
            <li><a  href="<?php echo base_url('perhitungan/hasil'); ?>">Perhitungan</a></li>
            <li class="active">Hasil</li>
        </ol>

    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                Hasil Akhir
            </div>
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <td>No.</td>
                        <td>Nama Barang</td>
                        <td>Harga</td>
                        <td>Tipe Tools</td>
                        <td>Jumlah</td>
                        <td>Kebutuhan</td>
                        <td>Skor Akhir</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    foreach($databarang_hasil as $row) {
                        ?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $row->nama_barang;?></td>
                            <td><?php echo $row->harga;?></td>
                            <td><?php echo $row->tipe_tools;?></td>
                            <td><?php echo $row->jumlah;?></td>
                            <td><?php echo $row->kebutuhan;?></td>
                            <td><?php echo $row->skor_akhir;?></td>
                        </tr>
                        <?php $no++; } ?>
                    </tbody>
                </table>
            </div> <!-- end panel body -->
        
        </div><!-- end panel -->

    </div> <!-- end lg -->
</div> <!-- end row -->
<!-- jQuery -->
<script src="<?php echo base_url(); ?>template/backend/sbadmin/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>template/backend/sbadmin/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Datepicker -->
<script src="<?php echo base_url(); ?>template/backend/sbadmin/js/bootstrap-datepicker.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>template/backend/sbadmin/vendor/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>template/backend/sbadmin/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>template/backend/sbadmin/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>template/backend/sbadmin/vendor/datatables-responsive/dataTables.responsive.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>template/backend/sbadmin/dist/js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->



