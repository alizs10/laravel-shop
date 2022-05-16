@if (session('alertify-info'))
    <script type="text/javascript">
        alertify.set('notifier', 'position', 'top-left');
        alertify.notify('{{ session('alertify-info') }}');
    </script>
@endif
