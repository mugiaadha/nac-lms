<link
    href="{{ asset('backoffice/plugins/datatable/css/dataTables.bootstrap5.min.css') }}"
    rel="stylesheet" />
<script src="{{ asset('backoffice/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backoffice/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $("[data-table]").DataTable();
    });
</script>