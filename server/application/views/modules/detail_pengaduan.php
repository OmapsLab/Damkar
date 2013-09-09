<style>
      .foto{
        margin: 20px auto;
        border: 1px dashed #C0C0C0;
        width: 300px;
      }
      .gmap3{
        margin: 20px auto;
        border: 1px dashed #C0C0C0;
        width: 500px;
        height: 250px;
      }
</style>
<script type="text/javascript">
      $(function(){
      
        $("#map").gmap3({
          marker:{
            latLng: [<?=$q_pengaduan[0]->latitude?>,<?=$q_pengaduan[0]->longitude?>],
            options:{
              draggable:true
            },
            events:{
              dragend: function(marker){
                $(this).gmap3({
                  getaddress:{
                    latLng:marker.getPosition(),
                    callback:function(results){
                      var map = $(this).gmap3("get"),
                        infowindow = $(this).gmap3({get:"infowindow"}),
                        content = results && results[1] ? results && results[1].formatted_address : "no address";
                      if (infowindow){
                        infowindow.open(map, marker);
                        infowindow.setContent(content);
                      } else {
                        $(this).gmap3({
                          infowindow:{
                            anchor:marker, 
                            options:{content: content}
                          }
                        });
                      }
                    }
                  }
                });
              }
            }
          },
          map:{
            options:{
              zoom: 17
            }
          }
        });
        
      });
</script>
<div class="row">
	<div class="span10">
		<h3>Detail Pengaduan</h3>
		<a class="btn btn-mini pull-right" href="{SITE_INDEX}">Kembali</a>
		<hr>
		<table class="table list table-striped table-hover">
	    	<tr>
	        	<td>Tanggal Pengaduan</td>
	            <td>: <?=$q_pengaduan[0]->tgl_pengaduan?></td>
	        </tr>
	        <tr>
	        	<td>Nama Pengadu</td>
	            <td>: <?=@$q_pengaduan[0]->nama?></td>
	        </tr>
	         <tr>
	        	<td>HP</td>
	            <td>: <?=@$q_pengaduan[0]->hp?></td>
	        </tr>
	        <tr>
	        	<td>Alamat Kebakaran</td>
	            <td>: <?=$q_pengaduan[0]->alamat?></td>
	        </tr>
	        <tr>
	        	<td>Latitude</td>
	            <td>: <?=$q_pengaduan[0]->latitude?></td>
	        </tr>
	        <tr>
	        	<td>Longitude</td>
	            <td>: <?=$q_pengaduan[0]->longitude?></td>
	        </tr>
	         <tr>
	        	<td>Status</td>
	            <td>: <?=$q_pengaduan[0]->status?></td>
	        </tr>
		</table>
	</div>
	<div class="span9">
		<div class="span4">
			<h4>Foto</h4>
			<img class="foto" src="<?=SITE.$q_pengaduan[0]->foto?>" width="300"/>
		</div>
		<div class="span4">
			<h4>Maps</h4>
			<div id="map" class="gmap3"></div>
		</div>
	</div>
</div>
<br>