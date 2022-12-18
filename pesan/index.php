<!DOCTYPE html>
<html>
<?php 
  $con = new mysqli("localhost","root","","portofolio");
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
            border: 2px solid #dedede;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 4px;
            margin: 10px 0;
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
    </style>
</head>

<body>

    <h2>Chat Messages</h2>
    <?php while($pesannya = $result->fetch_assoc()):?>
        <div class="container">
            <h3><?= $pesannya['nama'] ?></h3>
            <p><?= $pesannya['pesan'] ?></p>
            <span class="time-right"><?= $pesannya['waktu'] ?></span>
        </div>
    <?php endwhile; ?>
    </div>

</body>

</html>