@foreach ($absensi as $item)
    @php
        function selisih($jam_in, $jam_out)
        {
            [$h, $m, $s] = explode(':', $jam_in);
            $dtgAwal = mktime($h, $m, $s, '1', '1', '1');
            [$h, $m, $s] = explode(':', $jam_out);
            $dtgAkhir = mktime($h, $m, $s, '1', '1', '1');
            $dtgSelisih = $dtgAkhir - $dtgAwal;
            $totalMenit = $dtgSelisih / 60;
            $jam = explode('.', $totalMenit / 60);
            $sisaMenit = $totalMenit / 60 - $jam[0];
            $sisaMenit2 = $sisaMenit * 60;
            $jmlJam = $jam[0];
            return $jmlJam . ':' . round($sisaMenit2);
        }

        $foto_masuk = Storage::url('uploads/absensi/foto_masuk/' . $item->foto_masuk);
        $foto_keluar = Storage::url('uploads/absensi/foto_keluar/' . $item->foto_keluar);
    @endphp
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->user_id }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->jam_in }}</td>
        <td>
            <img src="{{ url($foto_masuk) }}" class="avatar" alt="foto_masuk">
        </td>
        <td>
            {!! $item->jam_out != null ? $item->jam_out : '<span class="badge bg-danger text-white">Belum Absen</span>' !!}
        </td>
        <td>
            @if ($item->jam_out != null)
                <img src="{{ url($foto_keluar) }}" class="avatar" alt="foto_keluar">
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hourglass-high" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M6.5 7h11" />
                    <path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z" />
                    <path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z" />
                </svg>
            @endif
        </td>
        <td>
            @if ($item->jam_in >= '07:00')
                @php
                    $jamTerlambat = selisih('07:00:00', $item->jam_in);
                @endphp
                <span class="badge bg-danger text-white">Terlambat {{ $jamTerlambat }}</span>
            @else
                <span class="badge bg-success">Tepat Waktu</span>
            @endif
        </td>
        <td>
            <a href="#" class="btn btn-primary tampilkanpeta" id="{{ $item->id }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5" />
                    <path d="M9 4v13" />
                    <path d="M15 7v5.5" />
                    <path
                        d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" />
                    <path d="M19 18v.01" />
                </svg>
            </a>
        </td>
    </tr>
@endforeach

<script>
    $(function() {
        $(".tampilkanpeta").click(function(e) {
            var id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: '/admin/monitoring/tampilkanpeta',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                cache: false,
                success:function(response) {
                    $("#loadmap").html(response);
                }
            });
            $('#modal-tampilkanpeta').modal('show');
        });
    });
</script>