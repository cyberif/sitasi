<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=" . $filename . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Verdana';
    }

    .table-data {
        width: 96%;
        border-collapse: collapse;
    }

    .table-data tr th,
    .table-data tr td {
        border: 1px solid black;
        font-size: 11pt;
        font-family: Verdana;
        text-align: center;
        padding: 10px 10px 10px 10px;
    }

    h3 {
        font-family: Verdana;
    }
</style>
<h3>
    <center>Laporan Data Tabungan</center>
</h3>
<br />
<table class="table-data">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">NIS</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelas</th>
            <th scope="col">No Telepon</th>
            <th scope="col">Saldo</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($tabungan as $tab) : ?>
            <tr>
                <th scope="row"><?= $i++; ?></a></th>
                <td><?= $tab['nis']; ?></td>
                <td><?= $tab['nama']; ?></td>
                <td><?= $tab['kelas']; ?></td>
                <td><?= $tab['no_telepon']; ?></td>
                <td><?= 'Rp. ' . $tab['saldo']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>