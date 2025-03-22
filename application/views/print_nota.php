<?php

$x = $data[0];
$t = explode(' ',$x['waktu']);
$tgl = implode('-',array_reverse(explode('-',$t[0])));
$tot = 0;
$tmpdir = sys_get_temp_dir();   # ambil direktori temporary untuk simpan file.
$file = tempnam($tmpdir, 'ctk');  # nama file temporary yang akan dicetak
$handle = fopen($file, 'w');
$condensed = Chr(27) . Chr(33) . Chr(4);
$bold1 = Chr(27) . Chr(69);
$bold0 = Chr(27) . Chr(70);
$initialized = chr(27) . chr(64);
$condensed1 = chr(15);
$condensed0 = chr(18);
$Data = $initialized;
$Data .= $condensed1;
$Data .= "                    CV. ARDHANA INDO PUTRA\n";
$Data .= "              Ds. Bligo No. 18 Kec. Buaran Kab. Pekalongan\n";
$Data .= "             ===========================================\n";
$Data .= "             NOTA PEMBAYARAN\n\n";
$Data .= "             Waktu : " . $tgl . "/".$t[1]."\n";
$Data .= "             Kasir : " . $x['user'] . "\n\n";
foreach ($data as $r) {
    $tot += $r['total'];
    $titik = "";
    if(strlen($r['nama'])>18){
        $titik = "... ";
        $r['nama'] = sprintf('%18s',substr($r['nama'],0,18)).$titik;
    }else{
        $p = 22-strlen($r['nama']);
        for($y=0; $y<$p; $y++){
            $titik .= " ";
        }
        $r['nama'] .= $titik;
    }
    $Data .= "             ".sprintf('%3s',$r['qty']) . " x " . $r['nama']." Rp. ".sprintf('%10s',number_format($r['total'], 0, ',', '.')) . "\n";
}
$Data .= "             -------------------------------------------\n";
$Data .= "             Total   :                    Rp. " . sprintf('%10s',number_format($tot, 0, ',', '.')) . "\n";
$Data .= "             Bayar   :                    Rp. " . sprintf('%10s',number_format($x['bayar'], 0, ',', '.')) . "\n";
$Data .= "             Kembali :                    Rp. " . sprintf('%10s',number_format($x['kembali'], 0, ',', '.')) . "\n";
$Data .= "             -------------------------------------------\n";
for($n=0; $n<=10; $n++){
    $Data .= "\n";
}
echo "<pre>" . $Data . "</pre>";
fwrite($handle, $Data);
fclose($handle);
//copy($file, "//localhost/printer");  # Lakukan cetak
unlink($file);
//redirect('penjualan');
?>
<a href="<?= site_url() ?>/penjualan/pesan"><button><< Kembali</button></a>
