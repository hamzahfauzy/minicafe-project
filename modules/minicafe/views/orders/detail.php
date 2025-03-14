<?php get_header() ?>
<style>label{font-weight: bold;}</style>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0"><?php get_title() ?></p>

        <div class="right-button ms-auto">
            <button class="btn btn-warning btn-sm" onclick="printToThermal()"><i class="fas fa-print"></i> Cetak</button>
        </div>
    </div>
    <div class="card-body">
        <?php if($error_msg): ?>
        <div class="alert alert-danger"><?=$error_msg?></div>
        <?php endif ?>
        <?php if($success_msg): ?>
        <div class="alert alert-success"><?=$success_msg?></div>
        <?php endif ?>
        
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="row mb-3">
                    <label class="mb-2 col-4">No. Pesanan</label>
                    <div class="col-8">
                        <?=$order->code?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">No. Meja</label>
                    <div class="col-8">
                    <?=$order->table_name?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">Status Pesanan</label>
                    <div class="col-8">
                    <?=$order->status?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="row mb-3">
                    <label class="mb-2 col-4">Pelanggan</label>
                    <div class="col-8">
                        <?=$order->customer_name?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">No. Lantai</label>
                    <div class="col-8">
                        <?=$order->floor_name?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4">Catatan</label>
                    <div class="col-8">
                        <?=$order->description?>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-item">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Tujuan</th>
                        <th>Qty</th>
                        <th>Status</th>
                        <th><button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#itemModal">Tambah Item</button></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($order->items as $key => $item): ?>
                    <tr>
                        <td><?=$key+1?></td>
                        <td><?=$item->category_name .' - ' . $item->product_name?></td>
                        <td><?=$item->target_name?></td>
                        <td><?=$item->qty?></td>
                        <td><?=$item->status?></td>
                        <td>-</td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="itemModalLabel">Form Item</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="form-item">
            <?= csrf_field() ?>
            <div class="form-group mb-3">
                <label class="mb-2 w-100">Produk</label>
                <select name="product" id="" class="form-control select2insidemodal">
                    <option value="">- Pilih -</option>
                    <?php foreach($products as $product): ?>
                    <option value="<?=$product->id?>" data-target="<?=$product->target_name?>" data-targetid="<?=$product->target_id?>"><?=$product->name?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label class="mb-2 w-100">Jumlah</label>
                <input type="number" name="qty" id="" class="form-control">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="$('#form-item').submit()">Tambah Item</button>
      </div>
    </div>
  </div>
</div>

<?php get_footer() ?>
