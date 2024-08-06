<!DOCTYPE html>
<html>

<head>
    <title>Kartu Rencana Studi (KRS)</title>
    <style>
        /* Tambahkan styling sesuai kebutuhan */
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #fff;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            text-align: center;
        }

        th,
        td {
            height: 20px;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background-color: #d3d3d3;
        }

        .gray-background {
            background-color: #d3d3d3;
        }

        .ttd {
            text-align: right;
            margin-top: 50px;
        }

        .left-align {
            text-align: left;
            margin-left: 20%;
        }
    </style>
</head>

<body>

    <h2>Kartu Hasil Studi (KHS)</h2>
    <p class="left-align">Nama: <?= $nama; ?></p>
    <p class="left-align">Jurusan: <?= $jurusan; ?></p>
    <p></p>

    <table>
        <thead>
            <tr>
                <th class="gray-background" style="width: 30px;">No.</th>
                <th class="gray-background" style="width: 200px;">Mata Kuliah</th>
                <th class="gray-background" style="width: 40px;">SKS</th>
                <th class="gray-background" style="width: 60px;">Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mata_kuliah as $key => $mk) : ?>
                <tr>
                    <td style="width: 30px;"><?= $key + 1; ?></td>
                    <td style="width: 200px;"><?= $mk['matakuliah']; ?></td>
                    <td style="width: 40px;"><?= $mk['sks']; ?></td>
                    <td style="width: 60px;"><?= $mk['nilai']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="ttd">
        <p>Tanda Tangan Akademik</p>
    </div>

</body>

</html>