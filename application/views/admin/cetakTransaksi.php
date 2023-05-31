<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman', Times, serif;
        }

        .frame {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .judul {
            margin-top: 2;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .sub-judul {
            margin-top: 0;
            padding-top: 0;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .alamat {
            margin-top: 0;
            padding-top: 0;
            margin-bottom: 1px;

        }

        .hr1 {
            margin-top: 0;
            padding-top: 0;
            margin-bottom: 0;
            padding-bottom: 0;
            width: 90%;
            height: 0.8px;
            background-color: black;
            border: 1px solid black;
        }

        .hr2 {
            margin-top: 2px;
            width: 90%;
            height: 0.3px;
            background-color: black;
            border: 1px solid black;
        }

        .bold {
            font-weight: bold;
        }

        table {
            border: 0;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <div class="frame">
        <h3 class="judul">Sistem Informasi Tabungan Siswa</h3>
        <h4 class="sub-judul">SD Negeri 1 Brebes</h4>
        <h5 class="alamat">Jl. Jendral Sudirman RT. 06/RW. 19, Brebes, Kec. Brebes, Kab. Brebes, Prov. Jawa Tengah</h5>
        <hr class="hr1">
        <hr class="hr2">
        <h4>Bukti Setoran</h4>
        <table border="1">
            <tr>
                <td class="bold">Tanggal</td>
                <td>:</td>
                <td>hasil</td>
            </tr>
            <tr>
                <td class="bold">Nama</td>
                <td>: </td>
                <td>hasil</td>
            </tr>
            <tr>
                <td class="bold">Metode Pembayaran</td>
                <td>: </td>
                <td>hasil</td>
            </tr>
            <tr>
                <td class="bold">Nominal</td>
                <td>: </td>
                <td>hasil</td>
            </tr>
            <tr>
                <td class="bold">Bukti</td>
                <td>: </td>
                <td>hasil</td>
            </tr>
            <tr>
                <td class="bold">Status</td>
                <td>: </td>
                <td>hasil</td>
            </tr>
        </table>
    </div>
    <script>
        window.print()
    </script>
</body>

</html>