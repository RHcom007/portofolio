<?php
require("../env.php");
$env = new env;
$con = $env->connectdb();
if (isset($_POST['hapus'])) {
    $q = $con->prepare("DELETE FROM pesanku;");
    $q->execute();
}
$q = $con->prepare("SELECT * FROM pesanku;");
$q->execute();
$result = $q->get_result();
if (isset($_GET['backup'])) {
    include("./backup.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            position: relative;
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
        .menu{
            position:absolute;
            right: 0;
            z-index: 999;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
        .titik-tiga {
            width: 30px;
        }
        .dropdown-child{
            visibility: hidden;
            background-color: white;
            border: 1px solid #aaa;
            padding: 10px;
            border-radius: 4px;
        }
        .menu:hover .dropdown-child{
            visibility: visible;
        }
        form {
            display: block;
            height: 20px;
            padding: none;
        }
        form button {
            float:right;
            cursor:pointer;
            border: none;
            background-color: transparent;
            padding: 0;
        }
        .menu a{
            color: black;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="menu">
        <svg class="titik-tiga" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M120 256c0 30.9-25.1 56-56 56s-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56zm160 0c0 30.9-25.1 56-56 56s-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56zm104 56c-30.9 0-56-25.1-56-56s25.1-56 56-56s56 25.1 56 56s-25.1 56-56 56z"/></svg>
        <div class="dropdown-child">
        <form action="" method="post">
            <button type="submit" name="hapus" onclick="return confirm('apakah anda yakin menghapus pesan ini?')">Hapus Semua Pesan</button>
        </form>
        <a href=".?backup">Backup pesan</a>
        </div>
    </div>
    <h2>Chat Messages</h2>
    <?php $i = 0;
    while ($pesannya = $result->fetch_assoc()):
        $i++ ?>
    <div class="container" id="pesanke-<?= $i ?>">
        <h3>
            <?= $pesannya['nama'] ?>
        </h3>
        <p>
            <?= $pesannya['pesan'] ?>
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