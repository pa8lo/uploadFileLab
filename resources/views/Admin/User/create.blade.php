@section('title'){{-- Section se usa para rellenar aquello que fue marcado con Yield--}}
    Crear Usuario
@endsection

@include('Admin/Template/main')

<h3 style="text-align: center; margin-top: 50px">Registro de Usuario</h3>

<section id="section_create">

@include('Admin/Template/Parts/errors');

	{!! Form::open (['route' => 'users.store', 'method' => 'POST', 'files' => true]) !!} <!-- Creo un formulario y le asigno la ruta que eliga, para saber cual es la ruta todo depende de lo que vaya a hacer, tirar comando php artisan route:list para saber mis rutas y de querer hacerlo por POST fijarme la ruta -->
	@include('Admin/Template/Parts/form')

	<!--{!! Form::submit('Registrar', ['class'=>'btn waves-effect waves-light', 'id'=>'alinea_boton']) !!} -->

	{!! Form::close() !!}
	
</section>

@include('Admin/Template/Parts/footer')