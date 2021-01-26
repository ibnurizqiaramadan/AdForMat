<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    table {
        width: 100%;

    }

    .center-text {
        text-align: center;
    }

    table .bordered {
        border-collapse: collapse;
    }

    table .bordered td {
        border: 1px black solid;
    }

    table .bordered tr {
        border: 1px black solid;
    }

    table .bordered th {
        border: 1px black solid;
    }

    .header1 {
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 10px;
        font-size: 35px;
        font-weight: bold;
    }

    .header2 {
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 10px;
        font-size: 14px;
        font-weight: bold;
    }

    .heading {
        padding: 0;
    }

    .container {
        padding-left: 50px;
        padding-right: 50px;
    }

    .header-right {
        font-weight: bold;
        font-size: 10px;
        text-align: right;
    }

    .header-right p {
        margin: 0;
    }

    .box-header {
        font-size: 20px;
    }
</style>

<body onload="window.print()">

    <table>
        <tr>
            <td style="width: 120px;">
                <img src="<?= base_url('assets/img/logoStmikBandung.png') ?>" style="width: 120px;" alt="">
            </td>
            <td class="heading">
                <h1 class="header1">STMIK BANDUNG</h1>
                <h1 class="header2">SEKOLAH TINGGI MANAJEMEN INFORMATIKA & KOMPUTER BANDUNG</h1>
            </td>
            <td class="header-right">
                <p>Jl. Cikutra No. 113 A</p>
                <p>Bandung - 40124</p>
                <p>(022) 7207777</p>
                <p>www.stmik-bandung.ac.id</p>
            </td>
        </tr>
    </table>

    <?= $html ?>

</body>

</html>