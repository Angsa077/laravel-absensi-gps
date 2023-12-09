@extends('layouts.app', ['title' => 'Camera - E-Absensi'])

@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">E-Absensi</div>
        <div class="right"></div>
    </div>

    <style>
        .webcam-capture,
        .webcam-capture video,
        #map {
            height: 485px;
            width: 100%;
            max-width: 600px;
            display: block;
            margin: 20px auto;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endsection

@section('content')
    <div class="row" style="margin-top: 70px; text-align: center">
        <div class="col-md-12">
            @if ($cek > 0)
                <button id="takeabsen" class="btn btn-danger rounded">
                    <ion-icon name="camera-outline"></ion-icon> Absen Pulang
                </button>
            @else
                <button id="takeabsen" class="btn btn-primary rounded">
                    <ion-icon name="camera-outline"></ion-icon> Absen Masuk
                </button>
            @endif
        </div>

        <div class="col-md-6">
            <input type="hidden" id="lokasi">
            <div class="webcam-capture"></div>
        </div>

        <div class="col-md-6">
            <div id="map"></div>
        </div>
    </div>
@endsection

@push('webcam-capture')
    <script>
        Webcam.set({
            height: 480,
            width: 640,
            image_format: 'jpeg',
            jpeg_quality: 80
        });

        Webcam.attach('.webcam-capture');

        var lokasi = document.getElementById('lokasi');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }

        function successCallback(position) {
            lokasi.value = position.coords.latitude + "," + position.coords.longitude;
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 15);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
            // radius kantor nanti dirubah sesuai titik coord kantor
            var circle = L.circle([position.coords.latitude, position.coords.longitude], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: 20
            }).addTo(map);
        }

        function errorCallback() {

        }

        $("#takeabsen").click(function(e) {
            Webcam.snap(function(uri) {
                image = uri;
            });
            var lokasi = $("#lokasi").val();
            $.ajax({
                type: 'POST',
                url: '/absensi',
                data: {
                    _token: "{{ csrf_token() }}",
                    image: image,
                    lokasi: lokasi
                },
                cache: false,
                success: function(response) {
                    var status = response.split("|");
                    if (status[0] == "success") {
                        Swal.fire({
                            title: "Berhasil!",
                            text: status[1],
                            icon: "success",
                        })
                        setTimeout("location.href='/'", 3000);
                    } else {
                        Swal.fire({
                            title: "Failed!",
                            text: status[1],
                            icon: "error",
                        })
                    }
                }
            })
        });
    </script>
@endpush
