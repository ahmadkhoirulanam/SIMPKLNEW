<?php
error_reporting(0);
$sub_menu3 = strtolower($this->uri->segment(3));
$user = $v_nilai->row();

$cek_pembimbing = $this->db->get_where('tbl_pemb', "kdpemb='$user->kdpemb'")->row();
if ($cek_pembimbing->kdpemb == '') {
    $nama_pembimbing = '-';
}else{
  $nama_pembimbing = $cek_pembimbing->nama_lengkap;
}
$cek_industri = $this->db->get_where('tbl_industri', "kdind='$user->kdind'")->row();
if ($cek_industri->kdind == '') {
    $nama_industri = '-';
    $bidang_kerja  = '-';
}else{
    $nama_industri = $cek_industri->nama_industri;
    $bidang_kerja  = $cek_industri->bidang_kerja;
}
?>
<!-- Main content -->
<style>
        .kartu-peserta-seleksi {
            padding: 16px;
            width: 100%;
            border: 1px solid black;
        }

        .kartu-peserta-seleksi p {
            font-size: 8pt;
        }

        .kartu-peserta-seleksi td,
        .kartu-peserta-seleksi .footer-wrapper p {
            font-size: 9.5pt;
        }

        .kartu-peserta-seleksi .head-wrapper {
            display: flex;
            padding: 8pt;
            flex-direction: row;
            margin: -16px -16px 0;
            align-items: center;
            justify-content: center;
            border-bottom: 2px solid black;
            background-color: #2ea2cc;
        }

        .kartu-peserta-seleksi .isi {
            display: flex;
            padding: 8pt;
            flex-direction: row;
            margin: -16px -16px 0;
            align-items: center;
            justify-content: center;
            border-bottom: 2px;
            background-color: #2ea2cc;
        }

        .kartu-peserta-seleksi .head-wrapper .sec {
            width: 60px;
            text-align: left;
        }
        .kartu-peserta-seleksi .isi .sec {
            width: 60px;
            text-align: left;
        }

        .kartu-peserta-seleksi .head-wrapper .sec:nth-child(2) {
            flex: 1;
        }
        .kartu-peserta-seleksi .isi .sec:nth-child(2) {
            flex: 1;
        }

        .kartu-peserta-seleksi .head-wrapper img {
            height: 50px;
        }
        .kartu-peserta-seleksi .isi img {
            height: 80px;
            width: 10000px;
        }

        .kartu-peserta-seleksi .head-wrapper .sec:last-child {
            font-weight: 900;
        }

        .kartu-peserta-seleksi .head-wrapper .sec:nth-child(-1n+3) p {
            margin-bottom: 0;
        }

        .kartu-peserta-seleksi .head-wrapper .sec:nth-child(2) p:nth-child(-n+3) {
            font-weight: bold
        }

        .kartu-peserta-seleksi .content-wrapper {
            padding: 20px 60px 10px 10px;
        }
        .container{
    display: flex;
   grid-template-columns: 1fr;
}


        .kartu-peserta-seleksi .content-wrapper tr:nth-last-child(-n+2) td:last-child {
            color: blue;
        }

        .kartu-peserta-seleksi .content-wrapper tr td:nth-child(2) {
            width: 15px;
            text-align: center;
        }

        .kartu-peserta-seleksi .footer-wrapper {
            text-align: left;
        }

        .kartu-peserta-seleksi .footer-wrapper p {
            margin-bottom: 0
        }
        .box1{
            width:100px;
            height:100px;
            background:green;
            border:solid 3px black;
            margin-right: 100px;
            }
    </style>
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="panel panel-flat">

            <div class="panel-body">

              <fieldset class="content-group">
                <legend class="text-bold"><i class="icon-user"></i> Detail Nilai <?php echo $user->nama_lengkap; ?></legend>
                <?php
                echo $this->session->flashdata('msg');
                ?>
                <center>
                  <img src="foto/<?php if ($user->foto == '') { echo'default.png'; }else{echo "siswa/$user->foto";}?>" alt="<?php echo $user->nama_lengkap; ?>" class="img-circle" width="176" height="176">
                  <br>
                  <b>
                    <?php echo $user->nis; ?> <br>
                    <?php echo $user->nama_lengkap; ?>
                  </b>
                </center>
                <hr>

                  <table width="100%" border=0>
                      <tr>
                        <th width="30%"><b>Telp</b></th>
                        <td width="2%"><b>:</b></td>
                        <td>&nbsp; <?php echo $user->telp; ?></td>
                      </tr>
                      <tr>
                        <th><b>Kelas</b></th>
                        <td><b>:</b></td>
                        <td>&nbsp;
                          <?php $kelas = $this->db->get_where('tbl_kelas', "kdkelas='$user->kdkelas'")->row();
                          echo $kelas->nama; ?>
                        </td>
                      </tr>
                      <tr>
                        <th><b>Jurusan</b></th>
                        <td><b>:</b></td>
                        <td>&nbsp;
                          <?php $jurusan = $this->db->get_where('tbl_jurusan', "kdjurusan='$kelas->kdjurusan'")->row();
                          echo $jurusan->nama; ?>
                        </td>
                      </tr>
                      <tr>
                        <th><b>NIP Pembimbing</b></th>
                        <td><b>:</b></td>
                        <td>&nbsp; <b><?php echo $cek_pembimbing->nip; ?></b></td>
                      </tr>
                      <tr>
                        <th><b>Nama Pembimbing</b></th>
                        <td><b>:</b></td>
                        <td>&nbsp; <b><?php echo ucwords($nama_pembimbing); ?></b></td>
                      </tr>
                  </table>

                <hr>

                  <h3 align="center">Penempatan Prakerin</h3>
                  <hr>
                  <table width="100%" border=0>
                      <tr>
                        <th width="30%"><b>Nama Industri</b></th>
                        <td width="2%"><b>:</b>&nbsp; </td>
                        <td> <b><?php echo $nama_industri; ?></b></td>
                      </tr>
                      <tr>
                        <th><b>Bidang Kerja</b></th>
                        <td><b>:</b>&nbsp; </td>
                        <td> <?php echo ucwords($bidang_kerja); ?></td>
                      </tr>
                  </table>

                <hr>

                  <h3 align="center">Penilai Prakerin</h3>
                  <hr>
                  <table width="100%" border=0>
                      <tr>
                        <th width="30%"><b>Keterangan</b></th>
                        <td width="2%"><b>:</b>&nbsp; </td>
                        <td> <b><?php echo ucwords($user->keterangan); ?></b></td>
                      </tr>
                      <tr>
                        <th><b>Nilai</b></th>
                        <td><b>:</b>&nbsp; </td>
                        <td> <?php echo $user->nilai; ?></td>
                      </tr>
                  </table>

                <hr>
                  <a href="javascript:history.back()" class="btn btn-default"><< Kembali</a>

              </fieldset>


            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
    <!-- <div class="kartu-peserta-seleksi-wrapper">
        <div class="kartu-peserta-seleksi">
            <div class="head-wrapper">
                <div class="sec"><img src="foto/upgris.jpg" alt="MA KHAS KEMPEK"></div>
                <div class="sec">
                    <p>PROGRAM STUDI INFORMATIKA</p>
                    <p>FAKULTAS TEKNIK & INFORMATIKA</p>
                    <p>UNIVERSITAS PGRI SEMARANG</p>
                </div>
            </div>
            <div class="content-wrapper">
              <div class="isi">
                <div class="sec"><img class="img-thumbnail" src="foto/anam.jpg" alt="MA KHAS KEMPEK"></div>
                <div class="sec">
                <table>
                    <tbody>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp NOM</td>
                            <td>:</td>
                            <td><strong>16670007</strong></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp Nama  Mahasiswa</td>
                            <td>:</td>
                            <td><strong>Ahmad Khoirul Anam</strong></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp Nilai Dosen Pembimbing</td>
                            <td>:</td>
                            <td><strong>100</strong></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp Nilai Pembimbing Lapangan</td>
                            <td>:</td>
                            <td><strong>100</strong></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp Nilai Angka</td>
                            <td>:</td>
                            <td><strong>100</strong></td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <div class="sec">
                <div class="box1">
                <center><h1>A</h1></center>
                </div>
                </div>
            </div>
                
            </div>
           
            <div class="container">
            <div class="footer-wrapper">
                <p>Kaprodi Informatika</p>
                <br><br><br>
                <p><strong>Bambang Agus Herlambang</strong></p>
            </div>
            <div class="footer-wrapper">
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp Dosen pembimbing</p>
                <br><br><br>
                <p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp Bambang Agus Herlambang</strong></p>
            </div>
            </div>
                  </div>
              </div>


                    
                



          </div>
        </div>
      </div> -->
