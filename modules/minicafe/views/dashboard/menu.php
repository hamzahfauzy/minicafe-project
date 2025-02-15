<style>
.dashboard-menu {
    display: flex;
    gap:15px;
    flex-direction: row;
    flex-wrap: wrap;
    text-align: center;
    justify-content: space-evenly;
}
.dashboard-menu img {
    display: block;
    width: 100px;
    margin-bottom: 10px;
}
.dashboard-menu-item {
    padding: 15px;
    border-radius: 2rem;
}
.dashboard-menu-item a {
    color: #FFF;
    font-weight: bold;
}
.melon {
    background-color: #f8c291;
}
.livid {
    background-color: #6a89cc;
}
.spray {
    background-color: #82ccdd;
}
.cassandra {
    background-color: #feca57;
}
.pastel {
    background-color: #ff6b6b;
}
.megaman {
    background-color: #48dbfb;
}
.jigglypuff {
    background-color: #ff9ff3;
}
.dragon {
    background-color: #ff9f43;
}
.joust {
    background-color: #54a0ff;
}
</style>
<div class="dashboard-menu">
    <div class="dashboard-menu-item melon">
        <a href="<?=routeTo('crud/index', ['table' => 'mc_products'])?>">
            <img src="<?=asset('assets/minicafe/img/icons/food.png')?>">
            <span>Makanan</span>
        </a>
    </div>
    <div class="dashboard-menu-item livid">
        <a href="<?=routeTo('crud/index', ['table' => 'mc_products'])?>">
            <img src="<?=asset('assets/minicafe/img/icons/drink.png')?>">
            <span>Minuman</span>
        </a>
    </div>
    <div class="dashboard-menu-item spray">
        <a href="">
            <img src="<?=asset('assets/minicafe/img/icons/stock.png')?>">
            <span>Stok</span>
        </a>
    </div>
    <div class="dashboard-menu-item cassandra">
        <a href="<?=routeTo('crud/index', ['table' => 'mc_orders'])?>">
            <img src="<?=asset('assets/minicafe/img/icons/order.png')?>">
            <span>Pesanan</span>
        </a>
    </div>
    <div class="dashboard-menu-item pastel">
        <a href="">
            <img src="<?=asset('assets/minicafe/img/icons/discount.png')?>">
            <span>Diskon</span>
        </a>
    </div>
    <div class="dashboard-menu-item megaman">
        <a href="">
            <img src="<?=asset('assets/minicafe/img/icons/transaction.png')?>">
            <span>Transaksi</span>
        </a>
    </div>
    <div class="dashboard-menu-item jigglypuff">
        <a href="">
            <img src="<?=asset('assets/minicafe/img/icons/report.png')?>">
            <span>Laporan</span>
        </a>
    </div>
    <div class="dashboard-menu-item dragon">
        <a href="<?=routeTo('default/settings/index')?>">
            <img src="<?=asset('assets/minicafe/img/icons/setting.png')?>">
            <span>Pengaturan</span>
        </a>
    </div>
    <div class="dashboard-menu-item joust">
        <a href="<?=routeTo('default/profile')?>">
            <img src="<?=asset('assets/minicafe/img/icons/profile.png')?>">
            <span>Profil</span>
        </a>
    </div>
</div>