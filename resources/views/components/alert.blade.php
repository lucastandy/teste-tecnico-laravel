{{-- O if abaixo verifica se existe uma variável de sessão chamada 'success'. Se ela existir, imprime a mensagem, se não, não exibe a mensagem --}}
@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: "Pronto!",
                html: '{{ session('success') }}',
                icon: "success"
            });
        });
    </script>
@endif

@if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: "Erro!",
                html: '{{ session('error') }}',
                icon: "error"
            });
        });
    </script>
@endif

{{-- O trecho de código abaixo tem o objetivo de apresentar a mensagem de erro da validação dos campos da CourseController --}}
@if ($errors->any())
    @php
        $message = '';
        foreach ($errors->all() as $error) {
            $message .= $error . '<br>';
        }
    @endphp

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: "Erro!",
                html: '{!! $message !!}',
                icon: "error"
            });
        });
    </script>
@endif