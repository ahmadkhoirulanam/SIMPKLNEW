<?php
$cek    = $user->row();
$nama   = $cek->nama_lengkap;

$menu 		= strtolower($this->uri->segment(1));
$sub_menu = strtolower($this->uri->segment(2));
$sub_menu3 = strtolower($this->uri->segment(3));
?>
<!DOCTYPE html>
<html lang="en"><head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title_pdf;?></title>
        <style type="text/css">
		table {
			border-style: double;
			border-width: 3px;
			border-color: white;
		}
		table tr .text2 {
			text-align: right;
			font-size: 15px;
		}
		table tr .text {
			text-align: left;
			font-size: 15px;
		}
		table tr td {
			font-size: 13px;
            line-height:20px;
		}

	</style>
    </head><body>
    <center>
		<table>
			<tr>
				<td><img src="foto/upgris.jpg" width="70" height="90"></td>
				<td>
				<p>
					<font size="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>PROGRAM STUDI INFORMATIKA</font><br>
					<font size="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>FAKULTAS TEKNIK & INFORMATIKA</b></font><br>
                    <font size="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>UNIVERSITAS PGRI SEMARANG</b></font><br>
					<font size="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Kampus : </b>Jl. Sidodadi Timur No. 24 (Gedung Pusat Lantai. 3) – Semarang Indonesia</font><br>
					<font size="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Telp. </b>(024)8316377 <b>Fax. </b>x. 8448217 <b>Web. </b>informatika.upgris.ac.id <b>E-mail. </b>informatika@upgris.ac.id</font>
                   
                </p>
              
				</td>
                <td><hr/></td>
               
			</tr>
            <hr>
            
		
		</table>
        <table width="525">
			<tr>
				<td class="text2"><font size="3">Semarang, 16 mei 2022</font></td>
			</tr>
		</table>
		<table>
			<tr class="text2">
				<td><font size="3">No</td>
				<td width="572"> <font size="3">: /INF/FTI/UPGRIS/PKL/2022 </font></td>
			</tr>
            <tr class="text2">
				<td><font size="3">Lamp</font></td>
				<td width="564"><font size="3">: -</font></td>
			</tr>
			<tr class="text2">
				<td><font size="3">Hal</font></td>
				<td width="564"><font size="3">: Permohonan Surat Ijin PKL</font></td>
			</tr>
		</table>
		<br><br>
		<table width="625">
			<tr>
		       <td>
			       <font size="3">Kepada Yth.<br>Dekan Fakultas Teknik & Informatika<br>Universitas PGRI Semarang<br>Di tempat</font>
		       </td>
		    </tr>
		</table>
		<br>
		<table width="625">
			<tr>
		       <td>
			       <font size="3">Dengan Hormat,<br><br>Berkenaan dengan kegiatan Praktek Kerja Lapangan (PKL) semester Gasal Tahun 
Akademik 2022/ 2023<br> Program Studi Informatika, kami bermaksud mengajukan Surat 
Permohonan Ijin PKL untuk mahasiswa <br> sebagai berikut:</font>
		       </td>
		    </tr>
		</table>
		<br>
		</table>
		<table>
			<tr class="text2">
				<td> <font size="3">Nama</font></td>
				<td width="641"><font size="3">: Ahmad KHoirul Anam</font></td>
			</tr>
			<tr>
				<td width="100"> <font size="3">Tempat PKL</font></td>
				<td width="625"><font size="3">: Kominfo</font></td>
			</tr>
			<tr>
				<td> <font size="3">Alamat</font></td>
				<td width="625"><font size="3">: Kabupaten Semarang</font></td>
			</tr>
		</table>
		<br>
		<table width="625">
			<tr>
		       <td>
			       <font size="3">Kegiatan Praktek Kerja Lapangan (PKL) pada tempat tersebut rencananya akan 
dilaksanakan pada tanggal <br> 01 Agustus 2022 s.d 31 Agustus 2022.
</font>
		       </td>
		    </tr>
		</table>
        <table width="625">
			<tr>
		       <td>
			       <font size="3">Demikian surat permohonan ini kami sampaikan. Atas Perhatian Bapak Dekan kami 
ucapkan terima kasih. 
</font>
		       </td>
		    </tr>
		</table>
		<br><br><br><br>
		<table width="625">
			<tr>
				<td width="300"><br><br><br><br></td>
				<td class="text" ><font size="3">Ka.Prodi Informatika,<br><br><br><br><br><br>Bambang Agus Herlambang, S.Kom., M.Kom</font></td>
			</tr>
	     </table>
	</center>

      <!-- /basic datatable -->
    </div>
        
        
    </body></html>