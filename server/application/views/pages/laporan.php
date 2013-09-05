<div class="row-fluid">
    <div class="block">
        <div class="block-heading">
            <span class="block-icon pull-right">
                <a href="#" class="demo-cancel-click" rel="tooltip" title="Click to refresh"><i class="icon-refresh"></i></a>
            </span>

            <a href="#widget2container" data-toggle="collapse">Laporan Kebakaran</a>
        </div>
        <div id="widget2container" class="block-body collapse in">
            <table class="table list table-striped">
            	<thead>
                  <tr>
                      <th>No</th>
                      <th>Nama Pelapor</th>
                      <th>Hp</th>
                      <th>Lokasi</th>
                      <th>Status</th>
                      <th>Aksi</th>
                  </tr>
              	</thead>
             	<tbody>
             	  <?php for ($i = 0; $i < 10; $i++) {?>
                  <tr>
                  	  <td><?=$i?></td>
                  	  <td>Nama Pelapor</td>
                      <td>085003030</td>
                      <td>Sukabirus</td>
                      <td>New</td>
                      <td><a href="{SITE_INDEX}laporan/detail" class="btn btn-mini">Lihat Peta</a> </td>
                  </tr>
                  <?php }?>
              	</tbody>
            </table>
        </div>
    </div>
</div>