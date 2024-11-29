<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>

    <!-- Menyertakan jQuery -->
    <script src="<?= base_url('asset\jquery-3.7.1.min.js') ?>"></script>

    <!-- Menyertakan CSS Bootstrap -->
    <link rel="stylesheet" href="<?= base_url('asset/bootstrap-5.0.2-dist/css/bootstrap.min.css') ?>">

    <!-- Menyertakan CSS Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('asset\fontawesome-free-6.6.0-web\css\all.min.css') ?>">
</head>

<body>
<div class="container mt-5">
    <div class="row mt-3">
        <div class="col-12">
            <h3 class="text-center">Data Pelanggan</h3>
            <!-- Tombol untuk membuka modal tambah pelanggan -->
            <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalTambahPelanggan">
                <i class="fa-solid fa-user-plus"></i> Tambah Data Pelanggan
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="container mt-5">
                <!-- Tabel untuk menampilkan data pelanggan -->
                <table class="table table-bordered" id="pelangganTabel">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Alamat</th>
                            <th>N0.Telepon</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data pelanggan akan dimasukkan melalui AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal untuk tambah pelanggan -->
    <div class="modal fade" id="modalTambahPelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambahPelangganLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5" id="modalTambahPelangganLabel">Tambah Pelanggan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk input data pelanggan -->
                    <form id="formPelanggan">
                        <input type="hidden" id="pelangganId" name="pelangganId"> <!-- Hidden input untuk ID pelanggan -->
                        <div class="row mb-3">
                            <label for="namaPelanggan" class="col-sm-4 col-form-label">Nama Pelanggan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="namaPelanggan" name="namaPelanggan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="alamatPelanggan" class="col-sm-4 col-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="alamatPelanggan" name="alamatPelanggan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="teleponPelanggan" class="col-sm-4 col-form-label">Telepon</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="teleponPelanggan" name="teleponPelanggan">
                            </div>
                        </div>
                        <button type="button" id="simpanPelanggan" class="btn btn-primary float-end">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk edit pelanggan -->
    <div class="modal fade" id="modalEditPelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditPelangganLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5" id="modalEditPelangganLabel">Edit Pelanggan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk input data pelanggan -->
                    <form id="formEditPelanggan">
                        <input type="hidden" id="pelangganIdEdit" name="pelangganIdEdit"> <!-- Hidden input untuk ID pelanggan -->
                        <div class="row mb-3">
                            <label for="namaPelangganEdit" class="col-sm-4 col-form-label">Nama Pelanggan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="namaPelangganEdit" name="namaPelangganEdit">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="alamatPelangganEdit" class="col-sm-4 col-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="alamatPelangganEdit">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="teleponPelangganEdit" class="col-sm-4 col-form-label">No.Telepon</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="teleponPelangganEdit">
                            </div>
                        </div>
                        <button type="button" id="editPelanggan" class="btn btn-primary float-end">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Menyertakan JS Bootstrap dan Font Awesome -->
    <script src="<?= base_url('asset\jquery-3.7.1.min.js') ?>"></script>
    <script src="<?= base_url('asset/bootstrap-5.0.2-dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('asset\fontawesome-free-6.6.0-web\js\all.min.js') ?>"></script>

    <script>
        $(document).ready(function() {
            // Panggil fungsi tampilPelanggan saat halaman dimuat
            tampilPelanggan();

            // Reset modal saat membuka modal untuk tambah pelanggan
            $('#modalTambahPelanggan').on('show.bs.modal', function() {
                $('#modalTambahPelangganLabel').text('Tambah Pelanggan');
                $('#pelangganId').val('');
                $('#namaPelanggan').val('');
                $('#alamatPelanggan').val('');
                $('#teleponPelanggan').val('');
            });

            // Simpan data pelanggan
            $("#simpanPelanggan").on("click", function() {
              
                
                var formData = {
                    nama_pelanggan: $("#namaPelanggan").val(),
                    alamat: $('#alamatPelanggan').val(),
                    nomor_telepon: $('#teleponPelanggan').val()
                }
                console.log(formData);

                $.ajax({
                    url: '<?= base_url('pelanggan/simpan'); ?>',
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            $('#modalTambahPelanggan').modal("hide");
                            $('#formPelanggan')[0].reset();
                            tampilPelanggan();
                        } else {
                            alert('Gagal menyimpan data: ' + JSON.stringify(hasil.errors));
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("Terjadi kesalahan: " + error);
                    }
                });
            });

            // Hapus pelanggan
            $('#pelangganTabel').on('click', '.hapusPelanggan', function() {
                var pelangganId = $(this).data('id');
                var konfirmasi = confirm("Apakah Anda yakin ingin menghapus pelanggan ini?");
                
                if (konfirmasi) {
                    $.ajax({
                        url: '<?= base_url('pelanggan/hapus'); ?>/' + pelangganId,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(hasil) {
                            if (hasil.status === 'success') {
                                tampilPelanggan();
                            } else {
                                alert('Gagal menghapus data.');
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Terjadi kesalahan: ' + error);
                        }
                    });
                }
            });

            // Edit pelanggan
            $(document).on('click', '.btn-edit', function() {
                var id = $(this).data('id');
                
                // Ambil data pelanggan berdasarkan ID
                $.ajax({
                    url: '<?= base_url('pelanggan/detail/') ?>' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (data.status === 'success') {
                            // Isi form dengan data pelanggan
                            $('#pelangganIdEdit').val(data.pelanggan.pelanggan_id);
                            $('#namaPelangganEdit').val(data.pelanggan.nama_pelanggan);
                            $('#emailPelangganEdit').val(data.pelanggan.alamat);
                            $('#teleponPelangganEdit').val(data.pelanggan.nomor_telepon);

                            // Ubah label modal menjadi "Edit Pelanggan"
                            $('#modalEditPelangganLabel').text('Edit Pelanggan');
                            $('#modalEditPelanggan').modal('show');
                        } else {
                            alert('Gagal mengambil data pelanggan.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            });

            // Update pelanggan
            $("#editPelanggan").on("click", function() {
                var formData = {
                    pelangganId: $("#pelangganIdEdit").val(),
                    nama_pelanggan: $("#namaPelangganEdit").val(),
                    alamat: $('#alamatPelangganEdit').val(),
                    nomor_telepon: $('#teleponPelangganEdit').val()
                };

                $.ajax({
                    url: '<?= base_url('pelanggan/update'); ?>',  
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            $('#modalEditPelanggan').modal("hide");
                            tampilPelanggan();
                        } else {
                            alert('Gagal mengedit data: ' + JSON.stringify(hasil.errors));
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("Terjadi kesalahan: " + error);
                    }
                });
            });

        });

        // Fungsi untuk menampilkan data pelanggan
        function tampilPelanggan() {
            $.ajax({
                url: '<?= base_url('pelanggan/tampil'); ?>',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var pelangganList = '';
                    $.each(data.pelanggan, function(index, pelanggan) {
                        pelangganList += '<tr>';
                        pelangganList += '<td>' + (index + 1) + '</td>';
                        pelangganList += '<td>' + pelanggan.nama_pelanggan + '</td>';
                        pelangganList += '<td>' + pelanggan.alamat + '</td>';
                        pelangganList += '<td>' + pelanggan.nomor_telepon + '</td>';
                        pelangganList += '<td><button type="button" class="btn btn-warning btn-edit" data-id="' + pelanggan.pelanggan_id + '"><i class="fa fa-pencil-alt"></i>Edit</button> ';
                        pelangganList += '<button type="button" class="btn btn-danger hapusPelanggan" data-id="' + pelanggan.pelanggan_id + '"><i class="fa fa-trash-alt"></i>Hapus</button></td>';
                        pelangganList += '</tr>';
                    });
                    $('#pelangganTabel tbody').html(pelangganList);
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan: ' + error);
                }
            });
        }
    </script>
</div>
</body>
</html>
