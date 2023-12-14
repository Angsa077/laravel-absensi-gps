<style>
    #map {
        height: 250px;
    }
</style>

{{-- <h2>{{ $absensi->lokasi_masuk }}</h2> --}}
<div id="map"></div>

<script>
    // Lokasi User
    var lokasi = "{{ $absensi->lokasi_masuk }}";
    var lok = lokasi.split(",");
    var latitude = lok[0];
    var longitude = lok[1];

    // Lokasi Kantor
    var lokasi_kantor = "{{ $lokasi_kantor->lokasi }}";
    var loktor = lokasi_kantor.split(",");
    var lat_kantor = loktor[0];
    var long_kantor = loktor[1];
    var radius = "{{ $lokasi_kantor->radius }}"

    var map = L.map('map').setView([latitude, longitude], 18);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker = L.marker([latitude, longitude]).addTo(map);
    var circle = L.circle([lat_kantor, long_kantor], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: radius
    }).addTo(map);

    var popup = L.popup()
        .setLatLng([latitude, longitude])
        .setContent("{{ $absensi->name }}")
        .openOn(map);
</script>
