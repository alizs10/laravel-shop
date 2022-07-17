@if (session('alert'))
    <script>
        iqwerty.toast.toast('{{ session('alert') }}');
    </script>
@endif
