@if (session('alertify-error'))
    <script>
        alertify.set('notifier', 'position', 'top-left');
        alertify.error('{{ session('alertify-error') }}');
    </script>
@endif
