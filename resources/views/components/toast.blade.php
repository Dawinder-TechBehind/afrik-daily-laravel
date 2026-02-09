@if (session('success'))
    <script>
        Toastify({
            text: "{{ session('success') }}",
            duration: 4000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "#22c55e",
            stopOnFocus: true,
        }).showToast();
    </script>
@endif

@if (session('error'))
    <script>
        Toastify({
            text: "{{ session('error') }}",
            duration: 4000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "#ef4444",
            stopOnFocus: true,
        }).showToast();
    </script>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            Toastify({
                text: "{{ $error }}",
                duration: 4000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#f97316",
                stopOnFocus: true,
            }).showToast();
        </script>
    @endforeach
@endif
