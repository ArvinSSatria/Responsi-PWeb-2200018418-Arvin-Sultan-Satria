<?php
  if(isset($_POST['submit'])) {
    $jenis_bbm = $_POST['jenis_bbm'];
    $harga = $_POST['harga'];
    $jumlah_liter = 0;

    // echo $jenis_bbm;

    if ($jenis_bbm === 'Pertalite') {
      $hargaperliter = 10000;
    } elseif ($jenis_bbm === 'Pertamax Turbo') {
      $hargaperliter = 14000;
    } elseif ($jenis_bbm === 'Pertamax') {
      $hargaperliter = 12500;
    } elseif ($jenis_bbm === 'Dexlite') {
      $hargaperliter = 13150;
    } elseif ($jenis_bbm === 'Pertamina Dex') {
      $hargaperliter = 13550;
    } elseif ($jenis_bbm === 'Solar') {
      $hargaperliter = 6800;
    } else {
      $hargaperliter = 0;
    }

    switch($jenis_bbm) {
      case 'Pertalite':
        $jumlah_liter = number_format($harga / 10000, 1);
        break;
      case 'Pertamax Turbo':
        $jumlah_liter = number_format($harga / 14000, 1);
        break;
      case 'Pertamax':
        $jumlah_liter = number_format($harga / 12500, 1);
        break;
      case 'Dexlite':
        $jumlah_liter = number_format($harga / 13150, 1);
        break;
      case 'Pertamina Dex':
        $jumlah_liter = number_format($harga / 13550, 1);
        break;
      case 'Solar':
        $jumlah_liter = number_format($harga / 6800, 1);
        break;
    }

      //simpan ke file transactions.txt
      $file = fopen('transactions.txt', 'a');
    
      date_default_timezone_set('Asia/Jakarta');
      fwrite($file, "\n" . date('Y-m-d H:i:s') . '|' . $jenis_bbm . '|' . $hargaperliter . '|' . $jumlah_liter . "|" . $harga);
      fclose($file);

    }    
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pertamini - Pom Bang Tono</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
          <img src="spbu.png" alt="Logo Pertamini">
        </div>
        <h1>PERTAMINI</h1>
        <p>Selamat datang di stasiun pengisian bahan bakar Pertamini - Pom Arvin</p>
      </header>
      
  <div class="container">
  <h2>Data Pembelian</h2>
    <form id="transaction-form" method="post" autocomplete="off">
      <label for="jenis-bbm">Jenis BBM:</label>
      <select id="jenis-bbm" name="jenis_bbm">
        <option value="Pertalite">Pertalite</option>
        <option value="Pertamax Turbo">Pertamax Turbo</option>
        <option value="Pertamax">Pertamax</option>
        <option value="Dexlite">Dexlite</option>
        <option value="Pertamina Dex">Pertamina Dex</option>
        <option value="Solar">Solar</option>
      </select>

      <label for="harga">Harga (Rp):</label>
      <input type="number" id="harga" name="harga">

      <button type="input" name="submit">Simpan Transaksi</button>
    </form>

    <h2>Daftar Transaksi</h2>
    <table id="transaction-table">


      <tr>
        <th>No.</th>
        <th>Waktu</th>
        <th>Jenis BBM</th>
        <th>Harga/liter</th>
        <th>Jumlah liter</th>
        <th>Jumlah beli</th>
      </tr>
      <?php

      //tampilkan isi file transactions.txt
      $file = fopen('transactions.txt', 'r');
      
      //jika file kosong
      if(filesize('transactions.txt') == 0) {
        echo "<tr><td colspan='6'>Belum ada transaksi</td></tr>";
      }
      //jika file tidak kosong, baca baris per baris
      if(filesize('transactions.txt') > 0) {
        $transactions = explode("\n", fread($file, filesize('transactions.txt')));
        $no = 1;
        foreach($transactions as $transaction) {
          $data = explode('|', $transaction);
          echo "<tr>";
          echo "<td>" . $no . "</td>";
          echo "<td>" . $data[0] . "</td>";
          echo "<td>" . $data[1] . "</td>";
          echo "<td>" . $data[2] . "</td>";
          echo "<td>" . $data[3] . "</td>";
          echo "<td>" . $data[4] . "</td>";
          echo "</tr>";
          $no++;
        }
      }
      fclose($file);

  ?>
    </table>
    <div class="contact-section">
      <h2>Kontak Kami</h2>
      <div class="contact-icons">
        <a href="tel:123456789"><img src="phone.svg" alt="Phone Icon">Arvin Sultan Satria</a>
        <a href="mailto:info@example.com"><img src="mail.svg" alt="Email Icon">arvinsultansatria@gmail.com</a>
        <a href="https://www.instagram.com/pertamini"><img src="instagram-line.png" alt="Instagram Icon">@arvinssatria</a>
      </div>
    </div>
  </div>

  <footer>
    <p>&copy; 2023 Pertamini - Pom Bang Tono. All rights reserved.</p>
  </footer>
</body>
</html>
