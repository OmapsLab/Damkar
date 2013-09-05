<style>
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
            latLng: [<?=@$_GET['lat']?>,<?=@$_GET['long']?>],
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
              zoom: 5
            }
          }
        });
        
      });
    </script>
<div id="map" class="gmap3"></div>
<hr>
<div align="center"><a class="btn btn-mini" href="{SITE_INDEX}">Kembali</a></div>