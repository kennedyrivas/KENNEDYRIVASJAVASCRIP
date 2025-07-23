@extends('adminlte::page')

{{-- Extend and customize the browser title --}}

@section('title')
    {{ config('adminlte.title') }}
    @hasSection('subtitle')
        | @yield('subtitle')
    @endif
@stop

{{-- Extend and customize the page content header --}}

@section('content_header')
    @hasSection('content_header_title')
        <h1 class="text-muted">
            @yield('content_header_title')

            @hasSection('content_header_subtitle')
                <small class="text-dark">
                    <i class="fas fa-xs fa-angle-right text-muted"></i>
                    @yield('content_header_subtitle')
                </small>
            @endif
        </h1>
    @endif
@stop



@section('content')
    @yield('content_body')
@stop


@section('footer')
    <div class="float-right text-light">
        Version: {{ config('app.version', '') }}
    </div>

    <strong>
        <a class="text-light" href="{{ config('app.company_url', '') }}" target="_blank">
            {{ config('app.company_name', '') }}
        </a>
    </strong>
@stop

@push('js')
    <script>
        document.oncontextmenu = function() {
            return false;
        }
        const notificacion = Swal.mixin({
            toast: true,
            position: "bottom-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
    </script>
@endpush


@push('css')
    <style type="text/css">
        {{-- You can add AdminLTE customizations here --}} .main-footer {
            background-color: rgb(28, 34, 31);
            color: lightyellow;
        }

        /*
            .card-header {
                border-bottom: none;
            }
            .card-title {
                font-weight: 600;
            }
            */
    </style>
@endpush
