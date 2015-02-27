@extends('app')

@section('content')
    <style type="text/css">
        #map-canvas { height: 800px; margin: 0; padding: 0;}
    </style>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{Config::get('services.google.maps.api_key')}}">
    </script>
    <script type="text/javascript">
        function initialize() {
            var mapOptions = {
                center: { lat: 50.083, lng: 14.417},
                zoom: 4
            };
            var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

            var mentions = [
                @foreach($mentions as $mention)
                [
                    new google.maps.LatLng( {{$mention->source->toString()}} ),
                    new google.maps.LatLng( {{$mention->destination->toString()}} )
                ],
                @endforeach
            ];

            var icon = {
                icon: { path: google.maps.SymbolPath.FORWARD_OPEN_ARROW },
                offset: '100%'
            };

            for (i = 0; i < mentions.length; i++) {
                new google.maps.Polyline({
                    path: mentions[i],
                    icons: [icon],
                    map: map
                });
            }
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="map-canvas">
                </div>
            </div>
        </div>
    </div>
@endsection