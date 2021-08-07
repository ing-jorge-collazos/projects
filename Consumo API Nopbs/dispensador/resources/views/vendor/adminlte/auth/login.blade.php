@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.login_message'))

@section('auth_body')
    <form action="{{ $login_url }}" method="post" class="mb-0">
        {{ csrf_field() }}

        {{-- Nit field --}}
        <div class="input-group mb-3">
            <input type="text" name="nit" class="form-control {{ $errors->has('nit') ? 'is-invalid' : '' }}"
                   value="{{ old('nit') }}" placeholder="{{ __('adminlte::adminlte.nit') }}" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('nit'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('nit') }}</strong>
                </div>
            @endif
        </div>

        {{-- Token field --}}
        <div class="input-group mb-3">
            <input type="password" name="token" id="token" class="form-control {{ $errors->has('token') ? 'is-invalid' : '' }}"
                   placeholder="{{ __('adminlte::adminlte.token') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-eye {{ config('adminlte.classes_auth_icon', '') }}" id="btn-show"></span>
                </div>
            </div>
            @if($errors->has('token'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('token') }}</strong>
                </div>
            @endif
        </div>

        {{-- Login field --}}
        <div class="row">            
            <div class="col-12 mb-1">
                <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }} rounded-lg">
                    <span class="fas fa-sign-in-alt"></span>
                    {{ __('adminlte::adminlte.sign_in') }}
                </button>
            </div>
            <div class="col-12">
                <button type="button" class="btn btn-block btn-flat btn-success rounded-lg" id="btn-service">                    
                    <span class="fab fa-buffer"></span>   
                    {{ __('adminlte::adminlte.get_service') }}                 
                </button>
            </div>
        </div>        
        @if($errors->has('validate'))
        <div class="alert alert-danger px-3 py-1">
            <strong>No es posible iniciar sesión</strong>
            @if($errors->has('message'))
            <br><span>Este error se presenta por:</span>
            @endif
            <ul>
                <li>{{ $errors->first('validate') }}</li>
                @if($errors->has('message'))
                <li>{{ $errors->first('message') }}</li>
                @endif
            </ul>
        </div>
        @endif
    </form>
@stop
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#btn-show").css('cursor', 'pointer');
    
        $("#btn-show").on("click", function() {
            if ($(this).hasClass('fa-eye')) {
                $(this).removeClass('fa-eye');
                $(this).addClass('fa-eye-slash');
                $("#token").attr('type', 'text');
            }else if ($(this).hasClass('fa-eye-slash')) {
                $(this).removeClass('fa-eye-slash');
                $(this).addClass('fa-eye');
                $("#token").attr('type', 'password');
            }
        });

        $("#btn-service").on("click", function () {
            Swal.fire({
                title: '¡Solicita tu servicio!',
                text: 'Deja tu correo y nos pondremos en contacto contigo:',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Enviar',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    //return fetch(`//api.github.com/users/${login}`)
                    return fetch(``)
                    .then(response => {
                        if (!response.ok) {
                        throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(
                        //`Request failed: ${error}`
                        'Servicio en desarrollo'
                        )
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                    title: `${result.value.login}'s avatar`,
                    imageUrl: result.value.avatar_url
                    })
                }
            });
        });
    });
</script>
    