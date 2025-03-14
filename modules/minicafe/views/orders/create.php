<?php 
get_header() ;
$attr  = ['class'=>"form-control"];
?>
<style>.select2 {width:100% !important}</style>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0"><?php get_title() ?></p>
    </div>
    <div class="card-body">
        <?php if($error_msg): ?>
        <div class="alert alert-danger"><?=$error_msg?></div>
        <?php endif ?>
        <form action="" method="post" onsubmit="if(items.length == 0){ alert('Maaf! Item order belum di isi'); return false }else{ return true }" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="row mb-3">
                        <label class="mb-2 col-4">No. Pesanan</label>
                        <div class="col-8">
                            <input type="text" name="mc_orders[code]" class="form-control" value="<?=$code?>" readonly>
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
                                <input type="text" name="customer_name" id="customer_name" class="form-control" value="" required placeholder="Input Nama Pelanggan">
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
            <div class="form-group mb-3 table-responsive">
                <table class="table table-bordered table-item">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Tujuan</th>
                            <th>Qty</th>
                            <th><button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#itemModal">Tambah Item</button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="empty_item">
                            <td colspan="7" class="text-center"><i>Belum ada item</i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Simpan Order</button>
            </div>
        </form>
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
        <div class="form-group mb-3">
            <label class="mb-2 w-100">Produk</label>
            <select name="product" id="" class="form-control select2insidemodal">
                <option value="">- Pilih -</option>
                <?php foreach($products as $product): ?>
                <option value="<?=$product->id?>" data-target="<?=$product->target_name?>" data-targetid="<?=$product->target_id?>"><?=$product->name?></option>
                <?php endforeach ?>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add-item-button">Tambahkan</button>
      </div>
    </div>
  </div>
</div>

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
                <?php foreach($customers as $customer): ?>
                <option value="<?=$customer->id?>"><?=$customer->name?> - (<?=$customer->phone?>)</option>
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
<?php get_footer() ?>
