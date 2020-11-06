<style>
    #map {
        height: 300px;
        width: 100%;
    }

    .pac-container {
        z-index: 9999 !important;
    }

    #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
    }

    #infowindow-content .title {
        font-weight: bold;
    }

    #infowindow-content {
        display: none;
    }

    #map #infowindow-content {
        display: inline;
    }

    .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
    }

    #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
    }

    .pac-controls {
        display: inline-block;
        padding: 5px 11px;
    }

    .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }

    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
    }

    #pac-input:focus {
        border-color: #4d90fe;
    }

    #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
    }

    #target {
        width: 345px;
    }
</style>
@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
            @endif
            @endif

            @if ($showLabel && $options['label'] !== false && $options['label_show'])
                {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
            @endif

            @if ($showField)
                <div>
                    <div id="map"></div>
                </div>
                @include('core/base::forms.partials.help_block')
            @endif

            @include('core/base::forms.partials.errors')

            @if ($showLabel && $showField)
                @if ($options['wrapper'] !== false)
        </div>
    @endif
@endif

<script>
    $(window).keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
    var map;

    function createMarker(map, position, updateInput = true) {
        if (updateInput) {
            $('input[name="latitude"]').val(position.lat);
            $('input[name="longitude"]').val(position.lng);
        }
        return new google.maps.Marker({
            position: position,
            map: map,
        });
    }

    function initAutocomplete() {
        var latitude = 21.024504739869194;
        var longitude = 105.83201234215858;
        if ($('input[name="latitude"]').val() && $('input[name="longitude"]').val()) {
            latitude = parseFloat($('input[name="latitude"]').val());
            longitude = parseFloat($('input[name="longitude"]').val());
        }
        var myLatLng = {lat: latitude, lng: longitude};
        var map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 13,
            mapTypeId: 'roadmap'
        });

        var marker = createMarker(map, myLatLng, false);
        var input = document.getElementById("<?= Arr::get($options['attr'], 'address-field-id', '') ?>");
        var searchBox = new google.maps.places.SearchBox(input);

        map.addListener('bounds_changed', function () {
            searchBox.setBounds(map.getBounds());
        });

        google.maps.event.addListener(map, 'click', function (event) {
            marker.setMap(null);
            var position = {lat: event.latLng.lat(), lng: event.latLng.lng()};
            marker = createMarker(map, position);
        });

        var markers = [];
        searchBox.addListener('places_changed', function () {
            var places = searchBox.getPlaces();

            if (places.length == 0) return;

            markers.forEach(function (marker) {
                marker.setMap(null);
            });

            var bounds = new google.maps.LatLngBounds();
            places.forEach(function (place) {
                if (!place.geometry) {
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                if (place.geometry.viewport) {
                    bounds.union(place.geometry.viewport);
                    marker.setMap(null);
                    marker = createMarker(map, place.geometry.location);

                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });
    }
</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLEMAP_API_KEY') }}&libraries=places&callback=initAutocomplete"
    async defer></script>
