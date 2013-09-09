<style>
      .gmap3{
        margin: 20px auto;
        border: 1px dashed #C0C0C0;
        width: 800px;
        height: 650px;
      }
</style>
 <script type="text/javascript">
        
      $(function(){
      
        $('#map2').gmap3({
          map:{
            options:{
              center:[-6.917467, 107.633333],
              zoom: 5
            }
          },
          marker:{
            values:[],
            options:{
              draggable: false
            },
            events:{
              mouseover: function(marker, event, context){
                var map = $(this).gmap3("get"),
                  infowindow = $(this).gmap3({get:{name:"infowindow"}});
                if (infowindow){
                  infowindow.open(map, marker);
                  infowindow.setContent(context.data);
                } else {
                  $(this).gmap3({
                    infowindow:{
                      anchor:marker, 
                      options:{content: context.data}
                    }
                  });
                }
              },
              mouseout: function(){
                var infowindow = $(this).gmap3({get:{name:"infowindow"}});
                if (infowindow){
                  infowindow.close();
                }
              }
            }
          }
        });
      });
    </script>
<div id="map2" class="gmap3"></div>
<hr>
<div align="center"><a class="btn btn-mini" href="{SITE_INDEX}">Kembali</a></div>