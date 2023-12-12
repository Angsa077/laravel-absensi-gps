@if ($histori->isEmpty())
<div class="alert alert-outline-warning">
    <p>Data Belum Ada</p>
</div>
@endif
@foreach ($histori as $item)
    <ul class="listview image-listview">
        <li>
            <div class="item">
                @php
                    $path = Storage::url('uploads/absensi/foto_masuk/' . $item->foto_masuk)
                @endphp
                <img src="{{ url($path) }}" alt="image" class="image">
                <div class="in">
                    <div>
                        <b>{{ date("d-m-Y", strtotime($item->created_at)) }}</b> <br>
                    </div>
                    <span
                        class="badge {{ $item->jam_in < '07:00' ? 'badge-success' : 'badge-danger' }}">
                        {{ $item->jam_in }}
                    </span>
                    <span class="badge badge-primary">{{ $item->jam_out }}</span>
                </div>
            </div>
        </li>
    </ul>
@endforeach