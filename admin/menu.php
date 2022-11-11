<?php //here it goes!!
if (isset($_SESSION['Level']))
if ($_SESSION['Level']=='admin')
{
?>
<table width="100%">
<tr>
<td align=center height="20px" width="200"><img src="img/siswa.png" width="90px" height="90px"><br>
<a href="pengaturan.php?v=sw">Manajemen Data Siswa</a></td>
<td align=center height="20px" width="191"><img src="img/building.png" width="90px" height="90px"><br>
<a href="pengaturan.php?v=dd">Manajemen Data Instansi</a></td>
<td align=center width="172" height="20px"><img src="img/pokja.png" width="90px" height="90px"><br>
<a href="pengaturan.php?v=pj">Manajemen Data Kelompok Kerja</a></td>
<td align=center width="120px" height="20px"><img src="img/pembimbing.png" width="90px" height="90px"><br>
<a href="pengaturan.php?v=ks">Manajemen Data Pembimbing Sekolah</a></td>
</tr>
<tr>
<td align=center height="20px"><img src="img/pembimbingdudi.png" width="90px" height="90px"><br>
<a href="pengaturan.php?v=pi">Manajemen Data Pembimbing Instansi</a></td>
<td align=center height="20px"><img src="img/head.png" width="90px" height="90px"><br>
<a href="pengaturan.php?v=ps">Manajemen Data Kepala Sekolah</a></td>
<td align=center height="20px"><img src="img/jurusan.png" width="90px" height="90px"><br>
<a href="pengaturan.php?v=jr">Manajemen Data Jurusan</a></td>
</tr>
</table>
<?php
}
?>