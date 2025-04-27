<?php
get_header();
$attr  = ['class' => "form-control"];
?>
<style>
    .select2 {
        width: 100% !important
    }
</style>

<form action="" method="post" onsubmit="if(items.length == 0){ alert('Maaf! Item order belum di isi'); return false }else{ return true }" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="card mb-2">
        <div class="card-body d-flex justify-content-between">
            <p class="h5 m-0">Pesanan</p>
            <p class="h6 m-0"><?= $code ?></p>
        </div>
    </div>

    <div class="accordion" id="accordionItem">
    </div>

    <div class="card card-body text-center" id="empty_item">
        Silahkan Tambah Item
    </div>

    <div class="btn-group fixed-bottom" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-light btn-lg rounded-0" data-bs-toggle="modal" data-bs-target="#itemModal">Tambah</button>
        <button type="button" class="btn btn-primary btn-lg rounded-0" data-bs-toggle="modal" data-bs-target="#saveModal">Simpan</button>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="saveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="saveModalLabel">Konfirmasi Pesanan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="row mb-3">
                                <label class="mb-2 col-4">No. Pesanan</label>
                                <div class="col-8">
                                    <input type="text" name="mc_orders[code]" class="form-control" value="<?= $code ?>" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="mb-2 col-4">No. Meja</label>
                                <div class="col-8">
                                    <input type="text" name="mc_orders[table_name]" class="form-control" value="1">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="mb-2 col-4">Catatan</label>
                                <div class="col-8">
                                    <textarea name="mc_orders[description]" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row mb-3">
                                <label class="mb-2 col-4">Pelanggan</label>
                                <div class="col-8">
                                    <input type="hidden" name="mc_orders[customer_id]" id="customer_id" value="">
                                    <div class="d-flex">
                                        <input type="text" name="customer_name" id="customer_name" class="form-control" value="Guest" required placeholder="Input Nama Pelanggan">
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#customerModal"><i class="fas fa-user"></i> Pilih Pelanggan</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="mb-2 col-4">No. Lantai</label>
                                <div class="col-8">
                                    <input type="text" name="mc_orders[floor_name]" class="form-control" value="1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</form>

<div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="customerModalLabel">Form Pelanggan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label class="mb-2 w-100">Pelanggan</label>
                    <select id="customerSelect" class="form-control select2insidemodal2">
                        <option value="">- Pilih -</option>
                        <?php foreach ($customers as $customer): ?>
                            <option value="<?= $customer->id ?>"><?= $customer->name ?> - (<?= $customer->phone ?>)</option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary use-walking-guest" data-bs-dismiss="modal">Gunakan Pelanggan Baru</button>
                <button type="button" class="btn btn-primary add-customer-button">Tambahkan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="itemModalLabel">Tambah Item</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label class="mb-2 w-100">Produk</label>
                    <select name="product" id="" class="form-control select2insidemodal">
                        <option value="">- Pilih -</option>
                        <?php foreach ($products as $product): ?>
                            <option value="<?= $product->id ?>" data-target="<?= $product->target_name ?>" data-targetid="<?= $product->target_id ?>"><?= $product->name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label class="mb-2 col-4">Jumlah</label>
                    <input type="number" name="qty" class="form-control" value="1">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add-item-button">Tambahkan</button>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>