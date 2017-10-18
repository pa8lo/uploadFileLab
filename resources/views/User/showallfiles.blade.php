@include('Admin/Template/main')

@section('title')
<div>
	@if(Auth::User())

	<h1 class="flow-text" style="text-align: center;">Ultimos archivos publicados</h1>
	<div style="height: 59%;">
		<div style="margin-top: 50px" class="row">
			<div style="text-align: center" class="col s12 center">
				<div class="collection">



					@foreach ($notify as $notify)
					@if($notify->is_public == "yes")

					@if($notify->folder_hash != "106a6c241b8797f52e1e77317b96a201")
					<h4 class="center flow-text">Han compartido un archivo publico {{$notify['name']}}</h4>
					<a href='http://localhost:8000/storage/files/{{$notify['user_id']}}/{{$notify['name']}}'>Ver archivo</a>
					@else
					<h4 class="center flow-text">Han compartido un archivo publico {{$notify['name']}}</h4>
					<a href='http://localhost:8000/storage/files/{{$notify['user_id']}}/{{$notify['name']}}'>Ver archivo</a>
					@endif

					@endif

					@endforeach()

{{-- 
					@foreach ($dato as $datos)

					<a href="http://localhost:8000/storage/files/{{$datos['user_id']}}/{{$datos['name']}}" class="collection-item"><span style="left: 30px">{{ $datos["name"] }}</span></a>
        			
					@endforeach --}}
				</div>
			</div>
		</div>
	</div>


	@include('Admin.template.parts.toogleuser')

	@else

	<h1 class="flow-text" style="text-align: center;">Debe registrarse para descargar archivos</h1>

	@endif
</div>
@include('Admin/Template/Parts/footer')