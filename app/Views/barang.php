<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kelontongs Store</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <style>
            .card{
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }
            .table-outer{
                box-shadow: 0 2px 4px 0 rgb(0 0 0 / 20%), 0 3px 5px 0 rgb(0 0 0 / 19%);
            }
        </style>
    </head>
    <body style="background-color: #f0f0f0;">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Kelontongs Store</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>
                        <!--                        <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
                                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                                        <li><hr class="dropdown-divider" /></li>
                                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                    </ul>
                                                </li> -->
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row justify-content-center my-5">
                <div class="col-md-8">
                    <div class="card px-1 py-4">
                        <div class="card-body">
                            <h3 class="card-title text-center my-3">Daftar Barang di Toko Kelontongs</h3>

                            <div class="d-grid gap-2 mx-auto my-3">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModifyModal">Tambah Barang</button>
                            </div>
                            <div class="table-outer">
                                <table id="table-barang" class="table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Barang</th>
                                            <th scope="col">Jenis Barang</th>
                                            <th scope="col">Jumlah Stok</th>
                                            <th scope="col">Action</th>
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

        <div class="modal fade" id="ModifyModal" tabindex="-1" aria-labelledby="ModifyModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModifyModalLabel">Tambah Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="modify-form">
                            <input type="hidden" id="id-hidden" name="id" value="0">
                            <div class="mb-3">
                                <label class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" id="ModifyInputBarang" name="barang">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis Barang</label>
                                <select class="form-select" id="ModifyInputJBarang" aria-label="Pilih Jenis Barang" name="jenis_barang">
                                    <option selected disabled>Pilih Jenis Barang</option>
                                    <?php foreach ($jbarang as $b): ?>
                                        <option value="<?= $b['id']; ?>"><?= $b['jenis_barang']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>


                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" onclick="SaveBarang()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="DeleteModalLabel">Hapus Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Anda yakin akan menghapus barang ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <button type="button" class="btn btn-primary" id="DeleteItemBtn" onclick="DeleteItem()">Ya</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script>
                            var table = $('#table-barang tbody');
                            $(document).ready(function () {
                                GetBarang();

                            });

                            const ModifyModal = document.getElementById('ModifyModal');
                            ModifyModal.addEventListener('show.bs.modal', event => {
                                const button = event.relatedTarget;
                                const idbrg = button.getAttribute('data-bs-idbrg');
                                const namabrg = button.getAttribute('data-bs-namabrg');
                                if (idbrg !== null) {
                                    $("#id-hidden").val(idbrg);
                                    $("#ModifyModalLabel").html("Edit " + namabrg);
                                    $.get("<?= base_url('api/barang/read'); ?>/" + idbrg, function (data) {
                                        var penjualan = data.data;
                                        $("#ModifyInputBarang").val(penjualan['nama_barang']);
                                        $("#ModifyInputJBarang").val(penjualan['id_jenis_barang']);
                                        console.log(penjualan['id_jenis_barang']);
                                    });
                                } else {
                                    $("#ModifyModalLabel").html("Tambah Barang");
                                    $("#ModifyInputBarang").val('');
                                    $("#ModifyInputJBarang").val('');

                                }

                            });

                            const DeleteModal = document.getElementById('DeleteModal');
                            DeleteModal.addEventListener('show.bs.modal', event => {
                                const button = event.relatedTarget;
                                const idbrg = button.getAttribute('data-bs-idbrg');
                                const namabrg = button.getAttribute('data-bs-namabrg');

                                $("#DeleteItemBtn").data('idbrg', idbrg);
                                $("#DeleteModalLabel").html("Hapus " + namabrg + "?");
                            });

                            function DeleteItem() {
                                const id = $("#DeleteItemBtn").data('idbrg');
                                $.ajax({
                                    type: "DELETE",
                                    url: "<?= base_url('api/barang/delete'); ?>/" + id,
                                    success: function (data) { 
                                        if (data.data['status'] == 1) {
                                            alert('Barang berhasil dihapus');
                                            GetBarang();
                                            $("#DeleteModal").modal('hide');
                                        } else {
                                            alert(data.data['errors']);
                                        }
                                    }, error: function (e) {
                                        console.log(e);
                                        alert('Terjadi kesalahan!');
                                    }
                                });
                            }

                            function SaveBarang() {
                                const formData = new FormData(document.getElementById('modify-form'));
                                $.ajax({
                                    type: "POST",
                                    enctype: 'multipart/form-data',
                                    url: "<?= base_url('api/barang/save'); ?>",
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function (data) {
                                        if (data.data['status'] == 1) {
                                            //save OK
                                            alert('Perubahan berhasil tersimpan');
                                            GetBarang();
                                            $("#ModifyModal").modal('hide');
                                        } else {
                                            alert(data.data['errors']);
                                        }
                                    },
                                    error: function (e) {
                                        console.log(e);
                                        alert('Terjadi Kesalahan!');
                                    }
                                });
                            }

                            function GetBarang() {
                                $.get("<?= base_url('api/barang/read'); ?>", function (data) {
                                    TableDOMModifier(data.data);
                                });
                            }

                            function TableDOMModifier(arr) {

                                table.empty();

                                let i = 1;
                                for (let a of arr) {
                                    var stok = (a.total_stok === null) ? 0 : a.total_stok;
                                    table.append('<tr><th scope="row">' + i++ + '</th><td>' + a.nama_barang + '</td><td>' + a.jenis_barang + '</td><td>' + stok
                                            + '</td><td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModifyModal" data-bs-idbrg="' + a.id_brg + '" data-bs-namabrg="' + a.nama_barang + '"><i class="bi bi-pencil-square"></i></button>'
                                            + '<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteModal" data-bs-idbrg="' + a.id_brg + '" data-bs-namabrg="' + a.nama_barang + '"><i class="bi bi-trash"></i></button></td></tr>');
                                }
                            }
        </script>

</html>
<!--
"nama_barang": "Kopi",
            "jenis_barang": "Konsumsi",
            "total_stok": "190"
-->