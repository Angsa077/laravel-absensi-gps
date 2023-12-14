    <!-- App Bottom Menu -->
    <div class="appBottomMenu">
        <a href="{{ route('dashboard') }}" class="item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <div class="col">
                <ion-icon name="home-outline" role="img" class="md hydrated" aria-label="home outline"></ion-icon>
                <strong>Home</strong>
            </div>
        </a>
        <a href="{{ route('histori.index') }}" class="item {{ request()->routeIs('histori.index') ? 'active' : '' }}">
            <div class="col">
                <ion-icon name="document-text-outline" role="img" class="md hydrated"
                    aria-label="document text outline"></ion-icon>
                <strong>Histori</strong>
            </div>
        </a>

        @if (!empty($absensi->lokasi_keluar))
            <a href="#" class="item" id="sudahAbsen">
                <div class="col">
                    <div class="action-button large">
                        <ion-icon name="camera" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
                    </div>
                </div>
            </a>
        @else
            <a href="{{ route('absensi.create') }}" class="item">
                <div class="col">
                    <div class="action-button large">
                        <ion-icon name="camera" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
                    </div>
                </div>
            </a>
        @endif

        <a href="{{ route('izin.index') }}"
            class="item {{ request()->routeIs('izin.index') || request()->routeIs('izin.create') ? 'active' : '' }}">
            <div class="col">
                <ion-icon name="calendar-outline" role="img" class="md hydrated"
                    aria-label="calendar outline"></ion-icon>
                <strong>Izin</strong>
            </div>
        </a>
        <a href="{{ route('profile.index') }}" class="item {{ request()->routeIs('profile.index') ? 'active' : '' }}">
            <div class="col">
                <ion-icon name="people-outline" role="img" class="md hydrated"
                    aria-label="people outline"></ion-icon>
                <strong>Profile</strong>
            </div>
        </a>
    </div>
    <!-- * App Bottom Menu -->

    @push('sudah-absen')
        <script>
            $(document).ready(function() {
                $('#sudahAbsen').click(function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Absen Pulang',
                        text: 'Anda sudah melakukan absen pulang.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                });
            });
        </script>
    @endpush
