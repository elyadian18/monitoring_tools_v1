
<div class="row">
    <div class="col-lg-12"><br />

        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('perbandingan'); ?>">Perbandingan</a></li>
            <li class="active">Data Perbandingan</li>
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
            <?php echo anchor('perbandingan/create', 'Tambah', array('class' => 'btn btn-successy btn-sm')); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <td>No.</td>
                                        <td>Nama TFN</td>
                                        <td>Kriteria 1</td>
                                        <td>Kriteria 2</td>
                                        <td>Nilai</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $no = 1;
                                foreach($tfn->result() as $row) {
                                    $this->db->where('id_kriteria', $row->id_kriteria_1);
                                    $k1 = $this->db->get('kriteria')->row();
                                    $this->db->where('id_kriteria', $row->id_kriteria_2);
                                    $k2 = $this->db->get('kriteria')->row();
                                ?>
                                    <tr>
                                        <td><?php echo $no;?></td>
                                        <td><?php echo $row->nama_tfn;?></td>
                                        <td><?php echo $k1->kriteria;?></td>
                                        <td><?php echo $k2->kriteria;?></td>
                                        <td><?php echo $row->nilai;?></td>
                                        <td class="text-center">
                                <a href="<?php echo base_url('perbandingan/edit/'.$row->id) ?>"><input type="submit" class="btn btn-success btn-xs" name="edit" value="Ubah"></a>
                                <a href="#" name="<?php echo $row->nama_tfn;?>" class="hapus btn btn-danger btn-xs" kode="<?php echo $row->id;?>">Hapus</a>
                            </td>
                                    </tr>
                                <?php $no++; } ?>
                                </tbody>
                            </table>


                        </div>
                        <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- Modal Hapus-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Konfirmasi</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" name="idhapus" id="idhapus">
                <p>Apakah anda yakin ingin menghapus data Perbandingan <strong class="text-konfirmasi"> </strong> ?</p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-success btn-xs" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger btn-xs" id="konfirmasi">Hapus</button>
        </div>
    </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


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

<script type="text/javascript">


    $(function(){
        $(".hapus").click(function(){
            var kode=$(this).attr("kode");
            var name=$(this).attr("name");

            $(".text-konfirmasi").text(name)
            $("#idhapus").val(kode);
            $("#myModal").modal("show");
        });

        $("#konfirmasi").click(function(){
            var id = $("#idhapus").val();

            $.ajax({
                url:"<?php echo site_url('perbandingan/delete');?>",
                type:"POST",
                data:"id="+id,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('perbandingan/index/delete-success');?>";
                }
            });
        });
    });
</script>

