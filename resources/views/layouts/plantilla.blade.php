<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('imagenes/logo.png') }}" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="{{ asset('js/all-scripts.js') }}"></script>
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.maphighlight.min.js') }}"></script>
    <script src="{{ asset('js/imageMapResizer.min.js') }}"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const stateTitle = document.getElementById('stateTitle');
            const stateInfo = document.getElementById('stateInfo');
            const stateText = document.getElementById('stateText');
            const areas = document.querySelectorAll('area');
            let lastClickedArea = null;
        
            areas.forEach(area => {
                area.addEventListener('mouseover', function() {
                    if (!lastClickedArea || lastClickedArea !== this) {
                        const title = area.getAttribute('title');
                        const info = area.getAttribute('data-info');
                        stateTitle.textContent = title;
                        stateInfo.innerHTML = info; // Usamos innerHTML para permitir HTML en el contenido
                        stateText.style.display = 'block';
                    }
                });
        
                area.addEventListener('mouseout', function() {
                    if (lastClickedArea && lastClickedArea !== this) {
                        stateText.style.display = 'none';
                    }
                });
        
                area.addEventListener('click', function() {
                    if (lastClickedArea && lastClickedArea !== this) {
                        lastClickedArea.style.outline = '';
                        stateText.style.display = 'none';
                    }
                    lastClickedArea = this;
                    this.style.outline = '2px solid #000'; // Opcional: Resaltar el área seleccionada
                    const title = area.getAttribute('title');
                    const info = area.getAttribute('data-info');
                    stateTitle.textContent = title;
                    stateInfo.innerHTML = info; // Usamos innerHTML para permitir HTML en el contenido
                    stateText.style.display = 'block';
                });
            });
        
            document.addEventListener('click', function(event) {
                if (!stateText.contains(event.target) && !event.target.matches('area')) {
                    stateText.style.display = 'none';
                    if (lastClickedArea) {
                        lastClickedArea.style.outline = '';
                        lastClickedArea = null;
                    }
                }
            });
        });
    </script>
    <script>
        $(function () {
            var lastClickedArea;

            $('.listaEdos').click(function (e) {
                e.preventDefault();
                var stateId = $(this).data('parent-map').substring(1); // Obtener el ID del estado desde el atributo data-parent-map
                var $area = $('#' + stateId);

                if (lastClickedArea && lastClickedArea[0] !== $area[0]) {
                    lastClickedArea.css('outline', '');
                    $('#stateText').hide();
                }

                lastClickedArea = $area;
                $area.css('outline', '2px solid #000'); // Opcional: Resaltar el área seleccionada

                // Obtener el título y la información del área clickeada
                const title = $area.attr('title');
                const info = $area.data('info');

                $('#stateTitle').text(title);
                $('#stateInfo').html(info);
                $('#stateText').show();
            });
        });
    </script>

    <script type="text/javascript">        
        function cargarEstado(id_estado){
            //que quiero hacer cuando se seleccione un estado
            console.log('Se seleccionó el id_estado: '+id_estado);
        }
        /* State Names */
        var state_names = new Array();
        var state_class = new Array();
            state_names[1]="Aguascalientes";state_names[2]="Baja California";state_names[3]="Baja California Sur";state_names[4]="Campeche";state_names[5]="Coahuila";state_names[6]="Colima";state_names[7]="Chiapas";state_names[8]="Chihuahua";state_names[9]="Distrito Federal";state_names[10]="Durango";state_names[11]="Guanajuato";state_names[12]="Guerrero";state_names[13]="Hidalgo";state_names[14]="Jalisco";state_names[15]="Estado de M&eacute;xico";state_names[16]="Michoac&aacute;n";state_names[17]="Morelos";state_names[18]="Nayarit";state_names[19]="Nuevo Le&oacute;n";state_names[20]="Oaxaca";state_names[21]="Puebla";state_names[22]="Quer&eacute;taro";state_names[23]="Quintana roo";state_names[24]="San Luis Potos&iacute;";state_names[25]="Sinaloa";state_names[26]="Sonora";state_names[27]="Tabasco";state_names[28]="Tamaulipas";state_names[29]="Tlaxcala";state_names[30]="Veracruz";state_names[31]="Yucat&aacute;n";state_names[32]="Zacatecas";
            state_class[1]="AGU";state_class[2]="BCN";state_class[3]="BCS";state_class[4]="CAM";state_class[5]="COA";state_class[6]="COL";state_class[7]="CHP";state_class[8]="CHH";state_class[9]="DIF";state_class[10]="DUR";state_class[11]="GUA";state_class[12]="GRO";state_class[13]="HID";state_class[14]="JAL";state_class[15]="MEX";state_class[16]="MIC";state_class[17]="MOR";state_class[18]="NAY";state_class[19]="NLE";state_class[20]="OAX";state_class[21]="PUE";state_class[22]="QUE";state_class[23]="ROO";state_class[24]="SLP";state_class[25]="SIN";state_class[26]="SON";state_class[27]="TAB";state_class[28]="TAM";state_class[29]="TLA";state_class[30]="VER";state_class[31]="YUC";state_class[32]="ZAC";
        $(function () {
            $('.listaEdos').mouseover(function(e) {                
                $($(this).data('parent-map')).mouseover();
            }).mouseout(function(e) {                
                $($(this).data('parent-map')).mouseout();                    
            }).click(function(e) { 
                e.preventDefault(); 
                $($(this).data('parent-map')).click(); 
            });
            
        
            $('.area').hover(function () {
                var id_estado = $(this).data('id-estado');
                var meid = $(this).attr('id');
                $('#edo').html(state_names[id_estado]);                
                $('#letras'+meid).addClass('listaEdosHover');
                $('.escudo').addClass('escudo_img');
                if(last_selected_id_estado!==null){
                    $('.escudo').removeClass(state_class[last_selected_id_estado]);
                }
                $('.escudo').addClass(meid);
            }).mouseout(function () {
                var meid = $(this).attr('id');
                $('#letras'+meid).removeClass('listaEdosHover');
                $('.escudo').removeClass(meid);
                if(last_selected_id_estado!==null){
                    $('#edo').html(state_names[last_selected_id_estado]);
                    $('.escudo').addClass(state_class[last_selected_id_estado]);
                }else{                    
                    $('#edo').html("&nbsp;");
                    $('.escudo').removeClass('escudo_img');
                    //$('.escudo').attr('class','escudo');
                }
            });
            //$('#map_ID').imageMapResize();//funciona perfectamente
            var areaLastClicked=null;
            var last_selected_id_estado=null;
            $('.area').click(function (e) {
                    e.preventDefault();
                    var $area = $(this);
                    var meid = $area.attr('id');
                    //$('.area').mouseout();
                    var data = $area.data('maphilight') || {};                    
                    if(areaLastClicked!==null){                        
                        var lastData = areaLastClicked.data('maphilight') || {};
                        lastData.alwaysOn=false;
                        $('#letras'+areaLastClicked.attr('id')).removeClass('listaEdosActive');
                        $('.escudo').removeClass(state_class[last_selected_id_estado]);
                    }
                    $('#letras'+meid).addClass('listaEdosActive');
                    areaLastClicked=$area;
                    //data.alwaysOn = !data.alwaysOn;
                    data.alwaysOn = true;
                    $(this).data('maphilight', data).trigger('alwaysOn.maphilight');
                    last_selected_id_estado = $(this).data('id-estado');
                    cargarEstado(last_selected_id_estado);
            });
                                    
            $('.map').maphilight({ fade: true,strokeColor: '950054', fillColor: '950054', fillOpacity: 0.3 });//funciona, pero no cuando se redimienciona la imagen (cuando se cambia el estylo de la img con widt o height)                        
        });
    </script>

    <link type="text/css" rel="stylesheet" href="{{ asset('css/estilos_mapa.css') }}" />

    @vite(['resources/js/app.js'])

    <title>@yield('titulo')</title>

    <style>
        .searchable {
            display: none;
        }
        .searchable.visible {
            display: block;
        }
    </style>
</head>
<body>
    @include('partials.navbar')
    
    @yield('contenido')

    <script>
        document.getElementById('searchButton').addEventListener('click', function() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const elements = document.querySelectorAll('.searchable');

            elements.forEach(element => {
                if (element.textContent.toLowerCase().includes(query)) {
                    element.classList.add('visible');
                } else {
                    element.classList.remove('visible');
                }
            });
        });
    </script>
    
</body>
</html>