@if (session('alertify-success'))
    <script>
        alertify.set('notifier', 'position', 'top-left');
        alertify.success('{{ session('alertify-success') }}');
    </script>
@endif
