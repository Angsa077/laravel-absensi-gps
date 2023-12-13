<!-- ///////////// Js Files ////////////////////  -->
<!-- Libs JS -->
<script src="{{ asset('tabler/dist/libs/apexcharts/dist/apexcharts.min.js?1692870487') }}" defer></script>
<script src="{{ asset('tabler/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1692870487') }}" defer></script>
<script src="{{ asset('tabler/dist/libs/jsvectormap/dist/maps/world.js?1692870487') }}" defer></script>
<script src="{{ asset('tabler/dist/libs/jsvectormap/dist/maps/world-merc.js?1692870487') }}" defer></script>
<!-- Tabler Core -->
<script src="{{ asset('tabler/dist/js/tabler.min.js?1692870487') }}" defer></script>
<script src="{{ asset('tabler/dist/js/demo.min.js?1692870487') }}" defer></script>
<!-- Sweat Alert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: 'Kamu tidak dapet mengambalikan data ini!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm' + id).submit();
            }
        });
    }
</script>