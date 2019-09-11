<?php get_template('template/header') ?>

<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-lg-9">
                <h1>
                    Karyawan
                    <small>Erporate</small>
                </h1>
            </div>
            <div class="col-lg-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item active"><a href="#">Karyawan</a></li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-success mb-2 ml-2" onclick="tambah()"><i class="fa fa-plus"></i> Tambah Karyawan</button>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th width="30px">No.</th>
                                        <th width="80px">Aksi</th>
                                        <th>Nama Karyawan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Jabatan</th>
                                        <th>No HP</th>
                                        <th>Alamat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019
                <a href="#" target="_blank">Mohammad Yusuf Noor Habibi</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with
                <i class="mdi mdi-heart text-danger"></i>
            </span>
        </div>
    </footer>
</div>

<?php get_template('template/footer') ?>

<script>
    $(document).ready(function() {
        loadTable("<?php echo base_url('karyawan/get_data_karyawan') ?>", "table");

        $("input").change(function() {
            // $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function() {
            // $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function() {
            // $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
    });
    var save_method;

    function tambah() {
        save_method = 'add';
        $('#form')[0].reset();
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah Karyawan');
    }

    function ubah(id) {
        save_method = 'update';
        $('#form')[0].reset();

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo base_url('karyawan/ubah/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id"]').val(data.id_karyawan);
                $('[name="nama"]').val(data.nama_karyawan);
                $('[name="jenis"]').val(data.jenis_kelamin);
                $('[name="jabatan"]').val(data.jabatan);
                $('[name="no_hp"]').val(data.no_hp);
                $('[name="alamat"]').val(data.alamat);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Ubah Karyawan'); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function save() {
        $('#btnSave').text('menyimpan...');
        $('#btnSave').attr('disabled', true);
        var url;

        if (save_method == 'add') {
            url = "<?php echo base_url('karyawan/tambah') ?>";
        } else {
            url = "<?php echo site_url('karyawan/update') ?>";
        }

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data) {

                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    $('#table').DataTable().ajax.reload(null, false);
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        // $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                    }
                }
                $('#btnSave').text('Simpan');
                $('#btnSave').attr('disabled', false);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('Simpan');
                $('#btnSave').attr('disabled', false);

            }
        });
    }

    function hapus(id) {
        if (confirm('Apakah anda yakin menghapus data ini?')) {

            $.ajax({
                url: "<?php echo base_url('karyawan/hapus') ?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    //if success reload ajax table
                    $('#modal_form').modal('hide');
                    $('#table').DataTable().ajax.reload(null, false);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });

        }
    }
</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id" />
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-form-label col-md-3">Nama</label>
                            <div class="col-md-9">
                                <input name="nama" placeholder="Ex: Danang" class="form-control" type="text">
                                <small class="text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3">Jenis Kelamin</label>
                            <div class="col-md-9">
                                <select name="jenis" class="form-control">
                                    <option value="">--Pilih--</option>
                                    <option value="pria">Pria</option>
                                    <option value="wanita">Wanita</option>
                                </select>
                                <small class="text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3">Jabatan</label>
                            <div class="col-md-9">
                                <input name="jabatan" placeholder="Ex: Programmer" class="form-control" type="text">
                                <small class="text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3">No HP</label>
                            <div class="col-md-9">
                                <input name="no_hp" placeholder="Ex: 083xxx" class="form-control" type="text">
                                <small class="text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3">Alamat</label>
                            <div class="col-md-9">
                                <textarea name="alamat" placeholder="Address" class="form-control"></textarea>
                                <small class="text-danger"></small>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->