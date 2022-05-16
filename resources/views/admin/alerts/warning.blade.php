@if (session('alertify-warning'))
    <script type="text/javascript">
        alertify.set('notifier', 'position', 'top-left');
        alertify.warning('{{ session('alertify-warning') }}');
    </script>
@endif
