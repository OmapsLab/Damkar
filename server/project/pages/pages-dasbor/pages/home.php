<div class="row-fluid">
 <div class="block">
        <div class="block-heading">
            <span class="block-icon pull-right">
                <a href="{SITE_INDEX}" rel="tooltip" title="Click to refresh"><i class="icon-refresh"></i></a>
            </span>
            <a href="#widget3container" data-toggle="collapse">Pengaduan Terbaru</a>
        </div>
        <div id="widget3container" class="block-body collapse in">
            <div style="padding: 5px;">
            	<table class="table list table-striped table-hover">
            	<thead>
                  <tr>
                  	  <th>No</th>
                  	  <th>Tgl</th>
                      <th>User Phone</th>
                      <th>Status</th>
                      <th>Aksi</th>
                  </tr>
              	</thead>
             	<tbody>
             	<?php $i = 1; foreach ($q_pengaduan as $row) {?>
                  <tr>
                  	  <td><?=$i++?></td>
                  	  <td><?=$row->tgl_pengaduan?></td>
                      <td><?=$row->hp?></td>
                      <td><?=$row->status?></td>
                      <td>
                      		<a href="#myModal" role="button" data-id="<?=$row->id_masyarakat?>" class="btn btn-mini update-masyarakat" data-toggle="modal">Update Masyarakat</a>
                      		<a href="{SITE_INDEX}home/maps_masyarakat?lat=<?=$row->latitude?>&long=<?=$row->longitude?>" class="btn btn-mini">Lihat Peta</a> 
                      		<a href="{SITE_INDEX}home/foto_masyarakat/<?=$row->id_pengaduan?>" class="btn btn-mini">Lihat Foto</a>
                      		<?php if ($row->status == 'AVAILABLE') {?>
                      		<a href="javascript:;" onclick="return alert('AVAILABLE STATUS')" class="btn btn-mini">Update Status</a>
                      		<?php } else {?>
                      		<a href="{SITE_INDEX}home/foto_masyarakat/<?=$row->id_pengaduan?>" class="btn btn-mini">Update Status</a>
                      		<?php }?>
                      		<a href="{SITE_INDEX}home/detail_pengaduan/<?=$row->id_pengaduan?>" class="btn btn-mini">Detail</a>
                      </td>
                  </tr>
                  <?php }?>
              	</tbody>
            </table>
        	</div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form id="myForm" method="post" action="{SITE_INDEX}home/update_masyarakat">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h3 id="myModalLabel">Update Masyarakat</h3>
		</div>
		<div class="modal-body">
			<div id="notif"></div>
			<div><input name="nama" type="text" placeholder="Nama"/></div>
			<div><textarea name="alamat" rows="" cols="" placeholder="Alamat"></textarea></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			<button class="btn btn-primary">Save</button>
		</div>
		<input id="id_masyarakat" type="hidden" name="id_masyarakat" value=""/>
	</form>
</div>
<!-- Modal -->
<div id="myModalMaps" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form id="myForm" method="post" action="{SITE_INDEX}home/update_masyarakat">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h3 id="myModalLabel">View Maps</h3>
		</div>
		<div class="modal-body">
			XXX
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		</div>
		<input id="id_masyarakat" type="hidden" name="id_masyarakat" value=""/>
	</form>
</div>
<script type="text/javascript">
$(document).on("click", ".update-masyarakat", function () {
    var myBookId = $(this).data('id');
    $("#id_masyarakat").val( myBookId );
});

jQuery(function($) {
	$('#myForm').live('submit', function(event) {
		var $form = $(this);
		var $target = $($form.attr('data-target'));
		 
		$.ajax({
			type: $form.attr('method'),
			url: $form.attr('action'),
			data: $form.serialize(),
			 
			success: function(data, status) {
				var obj = $.parseJSON(data);
				if (obj.n == "err_null") {
					$('#notif').html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button> <strong>Error!!!</strong> Field Masih Kosong</div>');
				} else {
					window.location.assign(base_url)
					$('#myModal').modal('hide');
				}	
			}
		});
		event.preventDefault();
	});
});
</script>