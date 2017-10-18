@section('title')
Archivos
@endsection

@include('Admin/Template/main')


<h1 class="flow-text" style="text-align: center;">Archivos compartidos</h1>
<div style="margin-top: 50px" class="row">
	<div class="col s12 m4 l2"></div>
	<div class="col s12 m4 l8">
		<div class="collection">

			@if(Auth::user()->notifications()->count() == 0)
			<h2 class="flow-text center">No tienes archivos compartidos por el momento</h2>
			@else
			@foreach(Auth::user()->notifications->all() as $rec)
			@if(Auth::user()->id == $rec->user_id)
			<h4 class="flow-text center">Te han compartido el archivo {{$rec->record_name}}</h4>
			<a style="" disabled href="http://localhost:8000/storage/files/{{$rec->author_id}}/{{$rec->record_name}}" type="text" class="validate">{{$rec->name}}descargar</a>
			@endif
			@endforeach
			@endif
		</div>
	</div>
	<div class="col s12 m4 l2"></div>
</div>


</section>

@include('Admin.template.parts.toogleuser')

@include('Admin/Template/Parts/footer')