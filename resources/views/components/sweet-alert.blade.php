
@if (session()->has('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            jSuites.notification({
                name: @json(session('success')),
                message: '',
            })
        });
    </script>
@endif

@if (session()->has('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            jSuites.notification({
                error: 1,
                name: @json(session('error')),

            })
        });
    </script>
@endif

@if ($errors->any())
    <script>
        var html = '<ul>';
        @foreach ($errors->all() as $error)
            html += '<li>{{ $error }}</li>';
        @endforeach
        html += '</ul>';
        document.addEventListener('DOMContentLoaded', function() {
            jSuites.notification({
                error: 2,
                name: html,
            })
        });
    </script>
@endif
