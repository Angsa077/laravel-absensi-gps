<style>
    #map {
        height: 250px;
    }
</style>

<h2>{{ $absensi->lokasi_masuk }}</h2>
<div id="map"></div>

<script>
    var lokasi = "{{ $absensi->lokasi_masuk }}";
    var lok = lokasi.split(",");
    var latitude = lok[0];
    var longitude = lok[1];

    var map = L.map('map').setView([latitude, longitude], 18);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker = L.marker([latitude, longitude]).addTo(map);

    // jika mencoba lokasi kantor diganti dengan lokasi user
    // var circle = L.circle([latitude, longitude], {
    //     color: 'red',
    //     fillColor: '#f03',
    //     fillOpacity: 0.5,
    //     radius: 20
    // }).addTo(map);

    // radius kantor sebenarnya
    //  var circle = L.circle([-6.159423188334594, 106.72437925975636], {
    var circle = L.circle([-6.159423188334594, 106.72437925975636], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 20
    }).addTo(map);

    var popup = L.popup()
        .setLatLng([latitude, longitude])
        .setContent("{{ $absensi->name }}")
        .openOn(map);
</script>
