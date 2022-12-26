<!DOCTYPE html>
<html>
<?php
require("../env.php");
$env = new env;
$con = $env->connectdb();
$q = $con->prepare("SELECT * FROM pesanku;");
$q->execute();
$result = $q->get_result();
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0 auto;
            max-width: 800px;
            padding: 0 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            position: relative;
            border: 2px solid #dedede;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 4px;
            margin: 10px 0;
            overflow-wrap: break-word;
        }

        .darker {
            border-color: #ccc;
            background-color: #ddd;
        }

        .container::after {
            content: "";
            clear: both;
            display: table;
        }

        .container h3 {
            display: block;
            margin: 0px;
        }

        .container p {
            margin: 0;
        }

        .container img.right {
            float: right;
            margin-left: 20px;
            margin-right: 0;
        }

        .time-right {
            float: right;
            font-size: small;
            color: #aaa;
        }

        .time-left {
            float: left;
            color: #999;
            font-size: small;
        }

        .lengkap {
            visibility: hidden;
            overflow-wrap: break-word;
            position: absolute;
            right: 0;
            top: 0;
            z-index: 999;
            background-color: white;
            border-radius: 4px;
            max-width: 500px;
            font-size: smaller;
            overflow-wrap: break-word;
            padding: 4px;
            border: #aaa 1px solid;
        }
    </style>
</head>

<body>
<?php
include('../layouts/header.html')
?>

    <h2>Chat Messages</h2>
    <?php $i = 0;
    while ($pesannya = $result->fetch_assoc()):
        $i++ ?>
    <div class="container" id="pesanke-<?= $i ?>">
        <h3>
            <?= $pesannya['nama'] ?>
        </h3>
        <p>
            <?= htmlentities($pesannya['pesan']) ?>
        </p>
        <span class="time-right">
            <?= $pesannya['waktu'] ?>
        </span>
        <div class="lengkap" id="lengkapke-<?= $i ?>">
            <span>IP : <?= $pesannya['ip'] ?></span><br />
            <span>ALAMAT : <?= $pesannya['alamat'] ?></span><br />
        </div>
    </div>
    <?php endwhile; ?>
    <script>
        var n = <?= $i ?>;
        for (let i = 1; i <= n; i++) {
            const pesanke = document.getElementById(`pesanke-${i}`);
            const lengkapke = document.getElementById(`lengkapke-${i}`);
            pesanke.addEventListener('mouseenter', () => {
                lengkapke.style.visibility = 'visible';
            });

            pesanke.addEventListener('mouseleave', () => {
                lengkapke.style.visibility = 'hidden';
            });
        }
    </script>
    </div>
</body>

</html>