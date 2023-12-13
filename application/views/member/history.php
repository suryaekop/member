<?php
    include APPPATH . 'views/fragment/header.php'; 
    include APPPATH . 'views/fragment/sidebar.php' ;
    include APPPATH . 'views/fragment/topbar.php' ;
?>
<h1 align="center">Riwayat Transaksi Member</h1>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow-sm mb-4 border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Riwayat Transaksi
                        </h4>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
        <table class="table table-striped dt-responsive nowrap" id="dataTable">
            <thead>
                <tr>
                    <th width="30">No.</th>
                    <th>Kode Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Nama Cabang</th>
                    <th>Total Pembelian</th>
                    <th>Konversi Poin</th>
                    <th>Total Poin</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                    foreach ($trans as $tr => $tran) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $tran->kodetransaksi ?></td>
                            <td><?= $tran->tanggaltransaksi ?></td>
                            <td><?= $tran->namacabang ?></td>
                            <td><?= $tran->total ?></td>
                            <td><?= isset($tran->konversipoin) ? $tran->konversipoin : ''; ?></td>
                            <td><?= isset($tran->totalpoin) ? $tran->totalpoin : ''; ?></td>
                        </tr>
                        <?php
                    }?>
            </tbody>
        </table>
    </div>
        </div>
    </div>
</div>
<?php
    include APPPATH . 'views/fragment/footer.php'; 
?>