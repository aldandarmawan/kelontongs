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
                            <h3 class="card-title text-center my-3">Laporan Penjualan Tahun 2021</h3>
                            <div class="input-group">
                                <input class="form-control" type="text" id="input-search" name="search" onchange="GetPenjualan()">
                                <button class="btn btn-primary">
                                    <i class="bi bi-search"></i>
<!--                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="18px" height="18px">
                                        <path style="fill: white" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"/>
                                        </svg>
                                    </span>-->
                                </button>

                            </div>
                            <div class="d-grid gap-2 col-6 mx-auto my-3">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModifyModal">Tambah Item</button>
                            </div>
                            <div class="table-outer">
                                <table id="table-penjualan" class="table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col"><a href="javascript:;" style="color: inherit" onclick="sort(0)">Nama Barang</a></th>
                                            <th scope="col"><a href="javascript:;" style="color: inherit" onclick="sort(1)">Stok</a></th>
                                            <th scope="col"><a href="javascript:;" style="color: inherit" onclick="sort(2)">Jumlah Terjual</a></th>
                                            <th scope="col"><a href="javascript:;" style="color: inherit" onclick="sort(3)">Tanggal Transaksi</a></th>
                                            <th scope="col"><a href="javascript:;" style="color: inherit" onclick="sort(4)">Jenis Barang</a></th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card px-1 py-4 mt-3">
                        <div class="card-body">
                            <h3 class="card-title mb-3">Overview Hasil Penjualan</h3>
                            <div class="input-group mb-3">
                                <label class="form-label">Rentang Waktu</label>
                                <input type="date" id="overview-from" class="form-control" aria-label="from" onchange="GetOverview()">
                                <span class="input-group-text">-</span>
                                <input type="date" id="overview-to" class="form-control" aria-label="to" onchange="GetOverview()">
                            </div>
                            <div id="overview-content">
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
                                <label class="form-label">Barang</label>
                                <select class="form-select" id="ModifyInputBarang" aria-label="Pilih Barang" name="barang">
                                    <option selected disabled>Pilih Barang</option>
                                    <?php foreach ($barang as $b): ?>
                                        <option value="<?= $b['id']; ?>"><?= $b['nama_barang']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stok</label>
                                <input type="number" class="form-control" id="ModifyInputStok" name="stok">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jumlah Terjual</label>
                                <input type="number" class="form-control" id="ModifyInputTerjual" name="terjual">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Transaksi</label>
                                <input type="date" class="form-control" id="ModifyInputTanggal" name="tgl_trans">
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" onclick="SaveItem()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="DeleteModalLabel">Hapus Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Anda yakin akan menghapus item ini?</p>
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
                            var table = $('#table-penjualan tbody');
                            $(document).ready(function () {
                                table.data('sort', {by: 3, order: false});
                                GetPenjualan();
                                GetOverview();
                            });

                            const ModifyModal = document.getElementById('ModifyModal');
                            ModifyModal.addEventListener('show.bs.modal', event => {
                                const button = event.relatedTarget;
                                const idjual = button.getAttribute('data-bs-idjual');
                                const namabrg = button.getAttribute('data-bs-namabrg');
                                if (idjual !== null) {
                                    $("#id-hidden").val(idjual);
                                    $("#ModifyModalLabel").html("Edit " + namabrg);
                                    $.get("<?= base_url('api/penjualan/read'); ?>/" + idjual, function (data) {
                                        var penjualan = data.data;
                                        $("#ModifyInputBarang").val(penjualan['id_barang']);
                                        $("#ModifyInputStok").val(penjualan['stok']);
                                        $("#ModifyInputTerjual").val(penjualan['terjual']);
                                        $("#ModifyInputTanggal").val(penjualan['tgl_transaksi']);
                                    });
                                } else {
                                    $("#ModifyModalLabel").html("Tambah Item");
                                    $("#ModifyInputBarang").val('');
                                    $("#ModifyInputStok").val('');
                                    $("#ModifyInputTerjual").val('');
                                    $("#ModifyInputTanggal").val('');
                                }
//                                const modalTitle = exampleModal.querySelector('.modal-title')
//                                const modalBodyInput = exampleModal.querySelector('.modal-body input')
//
//                                modalTitle.textContent = `New message to ${recipient}`
//                                modalBodyInput.value = recipient
                            });

                            const DeleteModal = document.getElementById('DeleteModal');
                            DeleteModal.addEventListener('show.bs.modal', event => {
                                const button = event.relatedTarget;
                                const idjual = button.getAttribute('data-bs-idjual');
                                const namabrg = button.getAttribute('data-bs-namabrg');

                                $("#DeleteItemBtn").data('idjual', idjual);
                                $("#DeleteModalLabel").html("Hapus " + namabrg + "?");
                            });

                            function SaveItem() {
                                const formData = new FormData(document.getElementById('modify-form'));
                                $.ajax({
                                    type: "POST",
                                    enctype: 'multipart/form-data',
                                    url: "<?= base_url('api/penjualan/save'); ?>",
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function (data) {
                                        if (data.data['status'] == 1) {
                                            //save OK
                                            alert('Perubahan berhasil tersimpan');
                                            GetPenjualan();
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

                            function DeleteItem() {
                                const id = $("#DeleteItemBtn").data('idjual');
                                $.ajax({
                                    type: "DELETE",
                                    url: "<?= base_url('api/penjualan/delete'); ?>/" + id,
                                    success: function (data) {
                                        if (data.data['status'] == 1) {
                                            alert('Item berhasil dihapus');
                                            GetPenjualan();
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

                            function sort(by) {
                                var data = table.data('sort');

                                table.data('sort', {by: by, order: !data.order});
                                GetPenjualan();
                            }

                            function GetPenjualan() {
                                filter = {
                                    search: $('#input-search').val(),
                                    sort: table.data('sort')
                                }
                                $.post("<?= base_url('api/penjualan/read'); ?>", filter, function (data) {
                                    TableDOMModifier(data.data);
                                });
                            }

                            function TableDOMModifier(arr) {

                                table.empty();

                                let i = 1;
                                for (let a of arr) {
                                    table.append('<tr><th scope="row">' + i++ + '</th><td>' + a.nama_barang + '</td><td>' + a.stok + '</td><td>' + a.terjual + '</td><td>' + a.tgl_disp + '</td><td>' + a.jenis_barang
                                            + '</td><td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModifyModal" data-bs-idjual="' + a.id_penjualan + '" data-bs-namabrg="' + a.nama_barang + '"><i class="bi bi-pencil-square"></i></button>'
                                            + '<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteModal" data-bs-idjual="' + a.id_penjualan + '" data-bs-namabrg="' + a.nama_barang + '"><i class="bi bi-trash"></i></button></td></tr>');
                                }
                            }

                            function GetOverview() {
                            var data = {
                                from: $("#overview-from").val(),
                                to: $("#overview-to").val()
                            }
                                $.post("<?= base_url('api/penjualan/total'); ?>", data, function (data) {
                                    var over = data.data;
                                    $("#overview-content").empty();
                                    for (let o of over['total_terjual']) {
                                        $("#overview-content").append('<p><strong>Barang ' + o.jenis_barang + ' Terjual</strong>: ' + o.total_terjual + ' item</p>');
                                    }
                                    for (let p of over['max_terjual']) {
                                        $("#overview-content").append('<p><strong>' + p.jenis_barang + ' Terjual Paling Banyak</strong>: ' + p.total_terjual + ' item</p>');
                                    }

                                    for (let q of over['min_terjual']) {
                                        $("#overview-content").append('<p><strong>' + q.jenis_barang + ' Terjual Paling Sedikit</strong>: ' + q.total_terjual + ' item</p>');
                                    }
                                });
                            }
                            
        </script>
    </body>
</html>