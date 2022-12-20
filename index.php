<?php
if (isset($_POST['pesannya'])) {
  require("./env.php");
  $env = new env;
  $con = $env->connectdb();
  $q = $con->prepare("INSERT INTO pesanku(nama,pesan,waktu,alamat,ip) VALUES (?,?,?,?,?);");
  $q->bind_param("sssss", $nama, $pesan, $waktu, $alamat, $ip);
  $nama = $_POST['nama'];
  if (empty($_POST['nama'])) {
    $nama = "Anonymous";
  }
  $pesan = $_POST['pesannya'];
  $waktu = date("Y-m-d H:i:s");
  $alamat = $_POST['geo'];
  $ip = $_SERVER['REMOTE_ADDR'];
  $q->execute();
  if ($q->affected_rows > 0) {
    $hasilq = array("success" => TRUE);
    // header("Location: .?success");
  } else {
    $hasilq = array("success" => false);
  }
  $json = json_encode($hasilq);
  header('Content-Type: application/json');
  echo $json;
  exit();
}
?>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style.css">
  <link rel="shortcut icon" href="./image/favicon.png" type="image/x-icon">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <title>Radja Herlangga Web</title>
  <style>
    #perkenalan-diri {
      width: 95%;
      height: 100%;
    }

    .kiri-diri {
      float: left;
      display: flex;
      justify-content: center;
      width: 40%;
      height: 100%;
      flex-direction: column;
      margin-left: 9px;
    }

    .kanan-diri {
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      float: right;
      width: 55%;
      height: 100%;
    }

    @media screen and (max-width: 800px) {
      .kiri-diri {
        width: 80%;
        height: fit-content;
      }

      .kanan-diri {
        width: 80%;
        height: 60%;
      }
    }
  </style>
</head>

<body>
  <style>
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-direction: row;
      height: 70px;
      box-shadow: 0 4px 8px 0 rgba(250, 250, 250, 0.2),
        0 6px 20px 0 rgba(255, 255, 255, 0.19);
      border-radius: 0px 0px 8px 8px;
    }

    header ul {
      list-style-type: none;
    }

    header ul li {
      float: left;
      margin-right: 20px;
    }

    header img {
      height: 50px;
      width: fit-content;
    }

    .menu {
      height: 60px;
    }

    .link-menu {
      text-decoration: none;
      font-weight: bold;
      color: #969595;
    }

    .link-menu:hover {
      color: rgb(49, 49, 228);
    }

    .link-active {
      color: rgb(224, 221, 221);
      border-bottom: #3282b8 3px solid;
      padding-bottom: 3px;
    }

    #kirim {
      margin-top: 5px;
      float: right;
      font-family: inherit;
      font-size: 18px;
      background: royalblue;
      color: white;
      padding: 5px;
      display: flex;
      align-items: center;
      border: none;
      border-radius: 8px;
      overflow: hidden;
      transition: all 0.2s;
      font-weight: lighter;
    }

    #kirim:hover {
      cursor: pointer;
    }

    #kirim span {
      display: block;
      margin-left: 0.3em;
      transition: all 0.3s ease-in-out;
    }

    #kirim svg {
      display: block;
      transform-origin: center center;
      transition: transform 0.3s ease-in-out;
    }

    #kirim:hover .svg-wrapper {
      animation: fly-1 0.6s ease-in-out infinite alternate;
    }

    #kirim:hover svg {
      transform: translateX(1.2em) rotate(45deg) scale(1.1);
    }

    #kirim:hover span {
      transform: translateX(5em);
    }

    #kirim:active {
      transform: scale(0.95);
    }

    @keyframes fly-1 {
      from {
        transform: translateY(0.1em);
      }

      to {
        transform: translateY(-0.1em);
      }
    }

    .link-active:hover {
      color: rgb(224, 221, 221);
    }
  </style>
  <header>
    <img src="./image/favicon.png" alt="logo rhcom">
    <div class="menu">
      <ul>
        <li><a class="link-menu link-active" href="http://localhost/portofolio/">Home</a></li>
        <!-- <li><a class="link-menu" href=".">Alamat</a></li> -->
      </ul>
    </div>
  </header>
  <main>
    <div id="Perkenalan-diri">
      <div class="kanan-diri">
        <div class="container">
          <div class="liquid"></div>
          <div class="liquid"></div>
          <div class="liquid"></div>
          <div class="liquid"></div>
        </div>
        <svg>
          <filter id="gooey">
            <fegaussianblur in="SourceGraphic" stdDeviation="10"></fegaussianblur>
            <fecolormatrix values="
                1 0 0 0 0
                0 1 0 0 0
                0 0 1 0 0
                0 0 0 20 -10
                "></fecolormatrix>
          </filter>
        </svg>
        <img src="./image/bg1.png" alt="gambar-diri-ku" id="diriku">
      </div>
      <div class="kiri-diri">
        <h2 id="my-name">M. Radja Herlangga</h2>
        <p>
          Fullstack Website Developer, Saya Remaja M. Radja Herlangga 16
          Tahun, Sekolah di SMKN 2 Kota Jambi Pasir Putih. saya mempunyai
          skill coding
        </p>
      </div>
    </div>
    <div>
      <a id="btn-download-cv" href="http://localhost/portofolio/storage/CV%20M.%20Radja%20Herlangga.pdf">Download CV</a>
    </div>
    <div class="project-ku">
      <h2>Project saya</h2>
      <div class="datanya">
        <div class="card-ahli">
          <img src="./image/ppdb-app.png" alt="gambar project RHcom">
          <h4>PPDB Sekolah</h4>
          <p>Aplikasi PPDB sekolah yang menggunakan Laravel, untuk memudahkan sekolah menerima murid baru jalur online
            dan mempercepat pengelolaan data</p>
        </div>
        <div class="card-ahli">
          <img src="./image/gambar-project.jpg" alt="gambar project RHcom">
          <h4>Aplikasi Chat</h4>
          <p>Aplikasi chat RHcom untuk mengchat biasa</p>
        </div>
        <div class="card-ahli">
          <img src="./image/rhcom-rf-gd.png" alt="gambar project RHcom">
          <h4>Website Blog Mengoding</h4>
          <p>Website pertama yang saya buat untuk mempelajari CRUP pure PHP dengan kemanan yang sedang</p>
          <a href="http://rhcom.rf.gd/" target="_blank" rel="noopener noreferrer" class="btn">Buka Websitenya -&gt;</a>
        </div>
      </div>
      <a href="https://github.com/RHcom007" style="float: right;color:white;">Lihat Selengkapnya disini &gt;&gt;</a>
    </div>
    <h2 align="center">Kumpulan Keahlian</h2>
    <hr>
    <div class="kumpulan-bhs">
      <div class="progressbar">
        <svg class="progressbar__svg">
          <circle cx="80" cy="80" r="70" class="progressbar__svg-circle circle-html shadow-html"></circle>
        </svg>
        <span class="progressbar__text shadow-html">HTML</span>
      </div>

      <div class="progressbar">
        <svg class="progressbar__svg">
          <circle cx="80" cy="80" r="70" class="progressbar__svg-circle circle-css shadow-css"></circle>
        </svg>
        <span class="progressbar__text shadow-css">CSS</span>
      </div>

      <div class="progressbar">
        <svg class="progressbar__svg">
          <circle cx="80" cy="80" r="70" class="progressbar__svg-circle circle-scss shadow-scss"></circle>
        </svg>
        <span class="progressbar__text shadow-scss">SCSS</span>
      </div>

      <div class="progressbar">
        <svg class="progressbar__svg">
          <circle cx="80" cy="80" r="70" class="progressbar__svg-circle circle-js shadow-js"></circle>
        </svg>
        <span class="progressbar__text shadow-js">JavaScript</span>
      </div>

      <div class="progressbar">
        <svg class="progressbar__svg">
          <circle cx="80" cy="80" r="70" class="progressbar__svg-circle circle-ts shadow-ts"></circle>
        </svg>
        <span class="progressbar__text shadow-ts">php</span>
      </div>

      <div class="progressbar">
        <svg class="progressbar__svg">
          <circle cx="80" cy="80" r="70" class="progressbar__svg-circle circle-angular shadow-angular"></circle>
        </svg>
        <span class="progressbar__text shadow-angular">Laravel</span>
      </div>

      <div class="progressbar">
        <svg class="progressbar__svg">
          <circle cx="80" cy="80" r="70" class="progressbar__svg-circle circle-node shadow-node"></circle>
        </svg>
        <span class="progressbar__text shadow-node">Node.js</span>
      </div>

      <div class="progressbar">
        <svg class="progressbar__svg">
          <circle cx="80" cy="80" r="70" class="progressbar__svg-circle circle-react shadow-react"></circle>
        </svg>
        <span class="progressbar__text shadow-react">Django</span>
      </div>
      <div class="progressbar">
        <svg class="progressbar__svg">
          <circle cx="80" cy="80" r="70" class="progressbar__svg-circle circle-vue shadow-vue"></circle>
        </svg>
        <span class="progressbar__text shadow-vue">Python</span>
      </div>
      <div class="progressbar">
        <svg class="progressbar__svg">
          <circle cx="80" cy="80" r="70" class="progressbar__svg-circle circle-net shadow-net"></circle>
        </svg>
        <span class="progressbar__text shadow-net">.NET</span>
      </div>
    </div>
    <div class="anonym-chat">
      <form action="" method="post" id="pesan-form">
        <h3>Kirim pesan secara Anonymous</h3>
        <div class="input-area">
          <span>Nama mu</span>
          <input type="text" name="nama" id="nama" placeholder="Anonymous">
        </div>
        <div class="input-area">
          <span>Pesan yang ingin kamu sampaikan</span>
          <textarea name="pesannya" id="pesan" cols="30" rows="10" placeholder="Isi pesan" required></textarea>
        </div>
        <input type="hidden" name="geo" id="geo">
        <button id="kirim" type="button">
          <div class="svg-wrapper-1">
            <div class="svg-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20px" height="20px">
                <path fill="none" d="M0 0h24v24H0z"></path>
                <path fill="currentColor"
                  d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z">
                </path>
              </svg>
            </div>
          </div>
          <span>Send</span>
        </button>
      </form>
    </div>
    <script>
      $.getJSON('https://api.ipgeolocation.io/ipgeo?apiKey=c4a04090455746f2bcbaadf5a6ad7590&fields=geo')
      .done(function (getgeo) {
        var datanya = ($.param(getgeo));
        var bersih = datanya.replace(/&/g, ",");
        $('#geo').val(bersih);
      });
      $(document).ready(function () {
        $('#kirim').click(runFunction);
      });
      function runFunction() {
        $.ajax({
          type: 'POST',
          url: '.',
          data: $('#pesan-form').serialize(), // serialize the form data
          contentType: 'application/x-www-form-urlencoded',
          processData: false,
          success: function (response) {
            console.log(response);
            if(response.success === true){
              alert("Pesan berhasil terkirim");
            }
          }
        });
      }
    </script>
    <div class="social" id="social-media">
      <h4>Hubungiku dengan cara</h4>
      <div class="gambar-sosmed">
        <a href="https://twitter.com/@RHcom007"><img src="./image/twitter.png" alt="icon twitter"></a>
        <a href="https://facebook.com/RHcom007"><img src="./image/facebook.png" alt="icon facebook"></a>
        <a href="https://instagram.com/RHcom007"><img src="./image/instagram.png" alt="icon twitter"></a>
        <a href="https://tiktok.com/RHcom007"><img src="./image/tik-tok.png" alt="icon tiktok"></a>
        <a href="https://github.com/RHcom007"><img src="./image/github.png" alt="icon github"></a>
      </div>
    </div>
  </main>
  <?php
  if (isset($_GET['success'])) {
    echo "<script>alert('Berhasil mengirim data')</script>";
  }
  ?>

</body>

</html>