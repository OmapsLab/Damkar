<style>
      .gmap3{
        margin: 20px auto;
        border: 1px dashed #C0C0C0;
        width: 980px;
        height: 650px;
      }
</style>
 <script type="text/javascript">
        
      $(function(){
      
        $('#map2').gmap3({
          map:{
            options:{
              center:[-6.917467, 107.633333],
              zoom: 13
            }
          },
          marker:{
            values:[
                    {latLng:[-6.917467, 107.633333], data:"Kantor Pemadam Kebakaran", options:{icon: "http://maps.google.com/mapfiles/marker_green.png"}},
                    <?=@$data_location?>
                   ],
            options:{
              draggable: false
            },
            events:{
              mouseover: function(marker, event, context){
            	  $(this).gmap3({
                      getaddress:{
                        latLng:marker.getPosition(),
                        callback:function(results){
                          var map = $(this).gmap3("get"),
                            infowindow = $(this).gmap3({get:"infowindow"}),
                            content = results && results[1] ? results && results[1].formatted_address : "Alamat tidak ditemukan";
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
              },
              mouseout: function(){
                var infowindow = $(this).gmap3({get:{name:"infowindow"}});
                if (infowindow){
                  infowindow.close();
                }
              },
              click: function (marker, event, context) {
                  if (context.id != 'gmap3_1') {
                	  window.location.href= base_url + "index.php/home/detail_pengaduan/" + context.id;
                  }
            	  
              }
            }
          }
        });
      });
    </script>
<div>
<div>
	<div class="checkbox">
		<input type="checkbox" name="read_time" /> Real-Time Monitoring
	</div> 
</div>

<hr>
<div>
	<img alt="" src="http://maps.google.com/mapfiles/marker_green.png"> Kantor Pemadam Kebakaran 
	<img alt="" src="http://maps.google.com/mapfiles/marker.png"> Lokasi Kebakaran
	<img alt="" src="http://maps.google.com/mapfiles/marker_black.png"> Lokasi Kebakaran diluar Bandung
</div>  
</div>
<div id="map2" class="gmap3"></div>
<hr>
<div align="center"><a class="btn btn-mini" href="{SITE_INDEX}">Kembali</a></div>