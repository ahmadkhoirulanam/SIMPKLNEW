<?php
$thn = date('Y'); ?>
<style>
    .circle-chart {
      width: 100px;
      position: relative;
      display: inline-block;
      margin-right: 2em;

    }
    .circle-chart__text {
      position: absolute;
      width: 100%;
      height: 100%;
      text-align: center;
      left: 0;
      top: 0;
      line-height: 4;
      font-family: sans-serif;
      /*font-size: 12px;*/
      font-weight: bold;
    }
  </style>

  <script type="text/javascript">
    var chart1; // globally available
  $(document).ready(function() {
        chart1 = new Highcharts.Chart({
           chart: {
              renderTo: 'grafik',
              type: 'column'
           },
           title: {
              text: 'Grafik Nilai PKL - Total Nilai'
           },
           
           xAxis: {
              categories: ['Jurusan']
           },
           yAxis: {
              title: {
                 text: ''
              }
           },
                series:
              [
              <?php
              foreach ($v_jurusan->result() as $baris) {

                $nilai = $this->db->query("SELECT AVG(tbl_nilai.nilai) AS total FROM tbl_siswa
                                            INNER JOIN tbl_kelas ON tbl_kelas.kdkelas=tbl_siswa.kdkelas
                                            INNER JOIN tbl_jurusan ON tbl_jurusan.kdjurusan=tbl_kelas.kdjurusan
                                            INNER JOIN tbl_penempatan ON tbl_penempatan.nis=tbl_siswa.nis
                                            INNER JOIN tbl_nilai ON tbl_nilai.kdpenempatan=tbl_penempatan.kdpenempatan
                                              WHERE
                                                  tbl_jurusan.kdjurusan='$baris->kdjurusan'
                                              AND
                                                  tbl_penempatan.tahun='$thn'
                                          ")->row()->total;

              ?>
                    {
                        name: '<?php echo strtoupper($baris->nama); ?>',
                        data: [<?php echo $nilai; ?>]
                    },
              <?php
              }?>

              ]
        });
     });
  </script>


<!-- Main content -->
<div class="content-wrapper">
<section class="content-header">
    <h3>
      Dashboard
    
    </h3>
	
	
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  
       
         

  <!-- Content area -->
  <div class="content">
     
    <div class="row">
    <div class="col-lg-4 col-xs-10">
	   <div class="info-box bg-red">
		    <span class="info-box-icon"><i class="glyphicon glyphicon-list-alt"></i></span>
			     <div class="info-box-content">
             <span class="info-box-text">Mahasiswa PKL</span>
              <span class="info-box-number"> 120 Mahasiswa</span>
                  <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                  </div>
                    
					  <a href="barang.php" class="progress-description"><font color="white">Selengkapnya <i class="fa fa-arrow-circle-right"></i></font> </a>
            </div>
      </div>  
      </div>
      
		<div class="col-lg-4 col-xs-10">
	   <div class="info-box bg-fuchsia-active">
		    <span class="info-box-icon"><i class="glyphicon glyphicon-briefcase"></i></span>
			     <div class="info-box-content">
             <span class="info-box-text">Data Lokasi PKL</span>
              <span class="info-box-number">10 Lokasi</span>
                  <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                  </div>
                    
					  <a href="suplier.php" class="progress-description"><font color="white">Selengkapnya <i class="fa fa-arrow-circle-right"></i></font> </a>
            </div>
		</div>  
		</div>
    
    <div class="col-lg-4 col-xs-10">
	   <div class="info-box bg-blue">
		    <span class="info-box-icon"><i class="glyphicon glyphicon-user"></i></span>
			     <div class="info-box-content">
             <span class="info-box-text">Dosen Pembimbing PKL</span>
              <span class="info-box-number"> 10 Dosen</span>
                  <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                  </div>
                    
					  <a href="user.php" class="progress-description"><font color="white">Selengkapnya <i class="fa fa-arrow-circle-right"></i></font> </a>
            </div>
		</div>  
		</div>
		
		<div class="col-lg-4 col-xs-10">
	   <div class="info-box bg-orange">
		    <span class="info-box-icon"><i class="glyphicon glyphicon-plus"></i></span>
			     <div class="info-box-content">
             <span class="info-box-text">Pembimbing Lapangan PKL</span>
              <span class="info-box-number"> 10 Pembimbing</span>
                  <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                  </div>
                    
					  <a href="barang_masuk.php" class="progress-description"><font color="white">Selengkapnya <i class="fa fa-arrow-circle-right"></i></font> </a>
            </div>
		</div>  
		</div>
		
		<div class="col-lg-4 col-xs-10">
	   <div class="info-box bg-green">
		    <span class="info-box-icon"><i class="	glyphicon glyphicon-minus"></i></span>
			     <div class="info-box-content">
             <span class="info-box-text">Permohonan Perizinan PKL</span>
              <span class="info-box-number"> 120 Perizinan</span>
                  <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                  </div>
                    
					  <a href="barang_keluar.php" class="progress-description"><font color="white">Selengkapnya <i class="fa fa-arrow-circle-right"></i></font> </a>
            </div>
		</div>  
		</div>

    <div class="col-lg-4 col-xs-10">
	   <div class="info-box bg-yellow">
		    <span class="info-box-icon"><i class="glyphicon glyphicon-ok"></i></span>
			     <div class="info-box-content">
             <span class="info-box-text">Penilaian PKL</span>
              <span class="info-box-number"> 20 Penilaian</h3></span>
                  <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                  </div>
                    
					  <a href="peminjaman.php" class="progress-description"><font color="white">Selengkapnya <i class="fa fa-arrow-circle-right"></i></font> </a>
            </div>
		</div>  
		</div>
        
        

    </div>
    <!-- /dashboard content -->

    <script src="assets/chart/raphael-min.js"></script>
    <script src="assets/chart/circle-chart.js"></script>
    <script>
      window.onload = function () {
        var el, c1;
        el = document.querySelector('.circle-chart--with-track');
        c1 = new CircleChart(el, { trackColour: '#bec3ce', fill: '#106c37', colour: '#26a69a', stroke: 10 });
        if (window.MutationObserver) {
          var config = { attributes: false, childList: true, characterData: false };
          var observer = new MutationObserver(function(mutations) {
              console.log(c1.inner.innerText);
              c1.changeValue(parseFloat(c.inner.innerHTML));
          });
          observer.observe(c1.elem, config);
        }
      }
      </script>

      <script src="assets/js/linechart/highcharts.js"></script>
      <script src="assets/js/linechart/exporting.js"></script>
