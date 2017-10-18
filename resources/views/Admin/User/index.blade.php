@include('Admin/Template/main')

@section('title')

<section>

<table class="responsive-table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Email</th>
			<th>Tipo</th>
			<th>Espacio Disponible</th>
			<th>Estado</th>
		</tr>
	</thead>

	<tbody>
		@foreach($usuarios as $users)
		<tr>
			<td>{{ $users['id'] }}</td>
			<td>{{ $users['name'] }}</td>
			<td>{{ $users['email'] }}</td>
			<td>{{ $users['type'] }}</td>
			<td>{{ $users['space'] }}</td>
			<td>
				@if($users['status'] == "active")
					<a  class="btn-floating green"><i class="material-icons">thumb_up</i></a>
				@else
					<a class="btn-floating red"><i class="material-icons">thumb_down</i></a>
				@endif
			</td>

			<td>
				<!-- <button class="btn-floating waves-effect waves-light modal-trigger open-edit" data-model-id="{{ $users['id'] }}" data-target="modal1"><i class="material-icons" >edit</i></button>-->

				<a href="#modal1-{{$users->id}}" class="btn-floating waves-effect waves-light modal-trigger open-edit"><i class="material-icons">edit</i></a>


					<!-- MODAL -->


					<div id="modal1-{{$users->id}}" class="modal">
						<div class="modal-content">
							<h4 id="modelId">Modificar al usuario {{$users->name}} </h4>

							<section id="section_create">

							{!! Form::open(['route' => ['users.update', $users, $users->id],  'method' => 'PUT']) !!}
								
								<input type="hidden" value="{{ $users->id }}" name="id">

								<label>Modificar estado</label>
								@if($users->status == 'active')
								<select class="browser-default" name="state">
									<option value="{{ $users->status }}" disabled selected>Seleccione una opcion</option>
									<option value="denied">Bloquear</option>
								</select>
								@else
								<label>Modificar estado</label>
								<select class="browser-default" name="state">
									<option value="{{ $users->status }}" disabled selected>Seleccione una opcion</option>
									<option value="active">Activar</option>
								</select>
								@endif

								<br>

								<label>Modificar permisos</label>
								@if($users->type == 'member')
								<select class="browser-default" name="type">
									<option value="{{ $users->type }}" disabled selected>Seleccione una opcion</option>
									<option value="admin" name="type">Administrador</option>
								</select>
								@else
								<select class="browser-default" name="type">
									<option value="{{ $users->type }}" disabled selected>Seleccione una opcion</option>
									<option value="member" name="type">Miembro</option>
								</select>
								@endif

								<br>

								<label>Modificar espacio</label>
								<input type="text" value="{{ $users->space }}" name="space" class="validate">
								
								<!-- <a href=" {{ route('users.show', $users->id) }} " class="btn waves-effect waves-light"><i class="material-icons right">send</i>Enviar</a>
								{{ Form::submit('enviar') }}-->

								<button class="btn waves-effect waves-light" id="alinea_boton" type="submit">Modificar
							      <i class="material-icons right">send</i>
							    </button>

								{!! Form::close() !!}

							</section>

						</div>
						<div class="modal-footer">
							<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
						</div>
					</div>

					<!-- BOTON DE CONFIRMACION -->

				<a href="{{ route('users.destroy', $users->id) }}" onclick="return confirm('Sure?')" class="btn-floating waves-effect waves-light modal-trigger open-edit"><i class="material-icons">delete</i></a> 
			</td>
		</tr>
		@endforeach
	</tbody>
</table>


<!-- Modal Structure -->


		<!-- /*<div id="modal1" class="modal">
			<div class="modal-content">
				<h4 id="modelId">Modificar ID: </h4>

					<section id="section_create">
						
						
						<label>Modificar estado</label>
						<select class="browser-default" name="state">
							<option value="" disabled selected>Seleccione una opcion</option>
							<option value="active">Activo</option>
							<option value="denied">Bloqueado</option>
						</select>
						<br>
						<label>Modificar permisos</label>
						<select class="browser-default" name="type">
       						<option value="" disabled selected>Seleccione una opcion</option>
        					<option value="member" name="type">Miembro</option>
        					<option value="admin" name="type">Administrador</option>
      					</select>
      					<br>
      					<label>Modificar espacio</label>
      					<input type="text" name="space" class="validate">

      					<button value="1" class="btn waves-effect waves-light" id="alinea_boton" type="submit">Enviar
      					</button>
      					<a href="#" class="btn waves-effect waves-light" id="alinea_boton">Enviar</a>
						

	
					</section>

			</div>
			<div class="modal-footer">
				<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
			</div>
		</div> */ -->
 
<script type="text/javascript">

	/*document.querySelectorAll(".open-edit").forEach((button)=>{
		button.addEventListener("click",()=>{
			const id = button.getAttribute("data-model-id")
			document.getElementById('modelId').innerText =  "Modificar ID: " + id;
		})
	});*/

$(document).ready(function(){
    	$('.modal').modal();
});
    
</script>

<ul class="pagination">
{!! $usuarios->render() !!}
</ul>

<a href="{{ route('users.create') }}">Añadir Usuarios</a>

</section>

@include('Admin/Template/Parts/footer')