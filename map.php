  <script>
        var marker;          //variable del marcador
        var coords = {};    //coordenadas obtenidas con la geolocalización

        //Funcion principal
        initMap = function () 
        {

            //usamos la API para geolocalizar el usuario
            navigator.geolocation.getCurrentPosition(
                function (position){
                    coords =  {
                        lng: position.coords.longitude,
                        lat: position.coords.latitude
                    };
                    setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa


                },function(error){console.log(error);});

        }

        function setMapa (coords)
        {   
            //Se crea una nueva instancia del objeto mapa
            var map = new google.maps.Map(document.getElementById('map'),
                                          {
                zoom: 16,
                center:new google.maps.LatLng(coords.lat,coords.lng),
            });

            //Creamos el marcador en el mapa con sus propiedades
            //para nuestro obetivo tenemos que poner el atributo draggable en true
            //position pondremos las mismas coordenas que obtuvimos en la geolocalización
            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: new google.maps.LatLng(coords.lat,coords.lng),

            });
            //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica 
            //cuando el usuario a soltado el marcador
            marker.addListener('click', toggleBounce);

            marker.addListener( 'dragend', function (event)
                               {
                //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords

                document.getElementById("idlat").value = this.getPosition().lat();
                document.getElementById("idlon").value = this.getPosition().lng();
            });
        }

        //callback al hacer clic en el marcador lo que hace es quitar y poner la animacion BOUNCE
        function toggleBounce() {
            if (marker.getAnimation() !== null) {
                marker.setAnimation(null);
            } else {
                marker.setAnimation(google.maps.Animation.BOUNCE);
            }
        }
        function validaNumericos(event) {
            if(event.charCode >= 48 && event.charCode <= 57){
                return true;
            }
            return false;        
        }



        // Carga de la libreria de google maps 

    </script>
    <script
            src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>
        var options = {
            adsl : ["5 Mbps","6 Mbps","7 Mbps","8 Mbps","9 Mbps","10 Mbps","12 Mbps"],
            vdsl : ["8 Mbps (D) - 4 Mbps (U)","9 Mbps (D) - 4.5 Mbps (U)","10 Mbps (D) - 5 Mbps (U)"],
            ftth : ["2 Mbps","3 Mbps","5 Mbps","6 Mbps","8 Mbps","10 Mbps","20 Mbps"]

        }

        $(function(){
            var fillSecondary = function(){
                var selected = $('#primary').val();
                $('#secondary').empty();
                options[selected].forEach(function(element,index){
                    $('#secondary').append('<option value="'+element+'">'+element+'</option>');
                });
            }
            $('#primary').change(fillSecondary);
            fillSecondary();
        });
    </script>
    <!--<script async defer src="http://maps.google.com/maps/api/js?key=AIzaSyBWb-7W7m5qkvzdVYvIn7Ocy9AI0GzeDLs&sensor=false&amp;language=es" type="text/javascript"></script>-->
    <script src="https://www.google.com/maps/api/js?callback=initMap&key=AIzaSyBWb-7W7m5qkvzdVYvIn7Ocy9AI0GzeDLs" type="text/javascript"></script>
    <div id="map">

    </div>
