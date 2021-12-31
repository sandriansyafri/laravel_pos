<?php

function format_idr($value)
{
      $result = "Rp " . number_format($value, 2, ',', '.');
      return $result;
}

function penyebut($nilai)
{
      $nilai = abs($nilai);
      $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
      $temp = "";
      if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
      } else if ($nilai < 20) {
            $temp = penyebut($nilai - 10) . " belas";
      } else if ($nilai < 100) {
            $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
      } else if ($nilai < 200) {
            $temp = " seratus" . penyebut($nilai - 100);
      } else if ($nilai < 1000) {
            $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
      } else if ($nilai < 2000) {
            $temp = " seribu" . penyebut($nilai - 1000);
      } else if ($nilai < 1000000) {
            $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
      } else if ($nilai < 1000000000) {
            $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
      } else if ($nilai < 1000000000000) {
            $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
      } else if ($nilai < 1000000000000000) {
            $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
      }
      return $temp;
}

function format_terbilang($nilai)
{
      if ($nilai < 0) {
            $hasil = "minus " . trim(penyebut($nilai));
      } else {
            $hasil = trim(penyebut($nilai));
      }
      return $hasil;
}

function format_tanggal_indo($tanggal, $cetak_hari = false)
{
      $hari = array(
            1 =>    'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
      );

      $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
      );
      $split         = explode('-', $tanggal);
      $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

      if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
      }
      return $tgl_indo;
}
