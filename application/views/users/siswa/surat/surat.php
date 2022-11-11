<?php
$sub_menu3 = strtolower($this->uri->segment(3)); ?>
<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">
    <!-- Dashboard content -->
    <div class="row">
      <!-- Basic datatable -->
      <div class="">
       

       
        <?php if ($cek_penempatan->num_rows() == 0){?>
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible" role="alert">
          <strong>Anda belum memilih industri.</strong><br>
          CATATAN :
          <ol>
            <li>
              Jika Anda sudah memperoleh persetujuan dari industri silahkan mendaftar dengan memilih tombol daftar.
            </li>
            <li>
              Jika belum, silahkan unduh from permohonan prakerin dan kesediaan prakerin untuk industri dan mengisinya.
            </li>
            <li>
              Anda hanya bisa mendaftar 1 kali. Pilihlah industri yang benar-benar Anda inginkan.
            </li>
            <li>
              Jika ingin mengganti tempat industri, silahkan hubungi koordinator prakerin.
            </li>
          </ol>
          <hr>
          <a href="users/status_prakerin/t" class="btn btn-primary"><i class="icon-plus22"></i> Daftar</a>
          <a href="users/surat" class="btn btn-success" target="_blank"><i class="icon-cloud-download"></i> Surat Permohonan</a>
          <a href="lampiran/surat/kesediaan/kesediaan.pdf" class="btn btn-danger" target="_blank"><i class="icon-cloud-download"></i> Surat Kesediaan</a>
        </div>
      </div>
      <?php }else{?>
    <div class="row">
      <div class="col-md-12">
        <?php
    
        error_reporting(0);
        $user = $query;
        $nama_siswa = $this->db->get_where('tbl_siswa', "nis='$user->nis'")->row()->nama_lengkap;
        if ($nama_siswa == '') {
            $nama_siswa = '-';
        }
        $nama_pembimbing = $this->db->get_where('tbl_pemb', "kdpemb='$user->kdpemb'")->row()->nama_lengkap;
        if ($nama_pembimbing == '') {
            $nama_pembimbing = '-';
        }
        $nama_industri = $this->db->get_where('tbl_industri', "kdind='$user->kdind'")->row()->nama_industri;
        if ($nama_industri == '') {
            $nama_industri = '-';
        }?>

        <!-- <a class="btn btn-danger" href=" <?php echo base_url('users/print')?>"><i class="fa fa-print">Cetak</a>
         -->

      </div>
    </div>

   
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
               
               
			</tr>
            <td colspan="45"><hr color="black"></td>
         
            <tr>
            
        </tr>
		
		</table>
        <table width="525">
			<tr>
				<td class="text2"><font size="3">Semarang, 16 mei 2022</font></td>
			</tr>
		</table>
		<table>
			<tr class="text2">
				<td><font size="3">No</td>
				<td width="625"> <font size="3">: /INF/FTI/UPGRIS/PKL/2022 </font></td>
			</tr>
            <tr class="text2">
				<td><font size="3">Lamp</font></td>
				<td width="625"><font size="3">: -</font></td>
			</tr>
			<tr class="text2">
				<td><font size="3">Hal</font></td>
				<td width="625"><font size="3">: Permohonan Surat Ijin PKL</font></td>
			</tr>
		</table>
		<br>
		<table width="667">
			<tr>
		       <td>
			       <font size="3">Kepada Yth.<br>Dekan Fakultas Teknik & Informatika<br>Universitas PGRI Semarang<br>Di tempat</font>
		       </td>
		    </tr>
		</table>
		<br>
		<table width="667">
			<tr>
		       <td>
			       <font size="3">Dengan Hormat,<br>Berkenaan dengan kegiatan Praktek Kerja Lapangan (PKL) semester Gasal Tahun 
Akademik 2022/ 2023 Program Studi Informatika, kami bermaksud mengajukan Surat 
Permohonan Ijin PKL untuk mahasiswa sebagai berikut:</font>
		       </td>
		    </tr>
		</table>
		<br>
		</table>
   
		<table width="667">
        <tr>
            <td><font size="3">NPM</td>
            <td><font size="3">:</td>
            <td><font size="3"><?php echo $user->nis; ?></td>
        </tr>
      
        <tr>
            <td><font size="3">Nama</td>
            <td><font size="3">:</td>
            <td><font size="3"> <?php echo ucwords($nama_siswa); ?></td>
        </tr>
        <tr>
            <td><font size="3">Nama Industri</td>
            <td><font size="3">:</td>
            <td> <font size="3"><?php echo ucwords($nama_industri); ?></td>
        </tr>
        
      
     
    </table>
		<br>
		<table width="667">
			<tr>
		       <td>
			       <font size="3">Kegiatan Praktek Kerja Lapangan (PKL) pada tempat tersebut rencananya akan 
dilaksanakan pada tanggal  01 Agustus 2022 s.d 31 Agustus 2022. Demikian surat permohonan ini kami sampaikan. Atas Perhatian Bapak Dekan kami 
ucapkan terima kasih. 
</font>
		       </td>
		    </tr>
		</table>
      
		<br>
		<table width="625">
			<tr>
				<td width="300"><br><br><br><br></td>
				<td class="text" ><font size="3">Ka.Prodi Informatika,<br><br><br><br><br><br>Bambang Agus Herlambang, S.Kom., M.Kom</font></td>
			</tr>
	     </table>
	</center>

      <!-- /basic datatable -->
    </div>

      <!-- /basic datatable -->
    </div>
    <!-- /dashboard content -->
    <?php } ?>
    <script type="text/javascript">
        window.print();
    </script>