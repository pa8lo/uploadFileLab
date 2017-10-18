@include('Admin/Template/main')

@section('title')
<div>
	<div style="margin-top: 50px" class="row">
		<div class="col s12 m4 l2"></div>
		<div style="text-align: center" class="col s12 m4 l8">

			

				<ul id="tabs-swipe-demo" class="tabs" style="margin-left: 12%">
					<li class="tab col s3"><a href="#test-swipe-1"><i class="material-icons">folder</i></a></li>
					<li class="tab col s3"><a class="active" href="#test-swipe-2"><i class="material-icons">insert_drive_file</i></a></li>
					<li class="tab col s3"><a href="#test-swipe-3"><i class="material-icons">share</i></a></li>
				</ul>

				{{-- Creacion de carpeta --}}

				<div id="test-swipe-1" class="col s12 z-depth-1" style="margin-bottom: 70px; height: 170px"">
					<form method="POST" action="{{ route('files.store') }}" accept-charset="UTF-8" enctype="multipart/form-data">

						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<input type="hidden" value="{{ Auth::user()->id }}" name="id">
						<input type="hidden" value="yes" name="is_folder">

						<span class="flow-text">Agrega una nueva carpeta a tu nube</span>
						<input type="text" name="folder_name" placeholder="Nombre" required="">

						<div class="form-group">
							<div class="center">
								<button type="submit" class="btn btn-primary">Enviar</button>
							</div>
						</div>
					</form>
				</div>

				{{-- Subida de archivo --}}

				<div id="test-swipe-2" class="col s12 z-depth-1" style="margin-bottom: 70px; height: 170px">
					<form method="POST" action="{{ route('files.store') }}" accept-charset="UTF-8" enctype="multipart/form-data">
						<span class="flow-text">Agrega un archivo a tu nube</span>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<input type="hidden" value="{{ Auth::user()->id }}" name="id">
						<input type="hidden" value="no" name="is_folder">

						<div class="file-field input-field">
							<div class="btn">
								<span>File</span>
								<input type="file" class="form-control" name="file" required="">
							</div>
							<div class="file-path-wrapper">
								<input class="file-path validate" type="text" placeholder="Upload files">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4" style="padding-left: 32%">
								<input type="checkbox" id="test5" name="is_public" value="yes"/>
								<label for="test5" style="padding-right: 25%">Archivo publico?</label>
								<button type="submit" class="btn btn-primary">Enviar</button>
							</div>
						</div>

					</form>
				</div>

				{{-- Compartir con usuarios --}}

				<div id="test-swipe-3" class="col s12 green" style="margin-bottom: 70px">Test 3</div>


				<div class="row">
					<div class="col s12"><span class="flow-text">Mis archios</span></div>
				</div>

				<table class="z-depth-2">
				@if( Auth::user()->records()->count() == 0)
				<h2 class="flow-text">No existen archivos para mostrar, sube tu primer archivo</h2>
				@else
				<thead>
					<tr>
						<th></th>
						<th>Nombre</th>
						<th>Propietario</th>
						<th>Ultima Modificacion</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					<td><i class="material-icons">folder_open</i></td>
					<td><a href="/files">Home</a></td>


					@foreach (Auth::user()->records as $role)
					<tr>
						@if($role->folder_hash == $id_de_hash && $role->is_folder != "yes")
							<td><i class="material-icons">insert_drive_file</i></td>
							<td>{{$role->name}}</td>
							<td>Yo</td>
							<td>{{$role['updated_at']}}</td>
							<td>
							<a href="#modal1-{{$role->id}}" class="waves-effect waves-light btn modal-trigger" ><i class="material-icons">settings</i></a>

							<div id="modal1-{{$role->id}}" class="modal bottom-sheet">
								<div class="modal-content">
									<h4 style="text-align: center;">Modificar archivo</h4>
									<ul class="collection">
										<li class="collection-item">
											<section style="height: 100px">
												{!! Form::open(['route' => ['files.update', $role, $role->id],  'method' => 'PUT']) !!}

												<input type="hidden" value="{{ $role->id }}" name="id">
												<input type="hidden" value="{{ $role->name }}" name="oldname">

												<label style="margin-left: 40%;">Modificar nombre de archivo</label>
												<input style="width: 70%" type="text" name="name" class="validate" value="{{ $role->name }}">

												<button style="position: relative; top: -120px; left: 65%" class="btn-floating blue" id="alinea_boton" type="submit">
													<i class="material-icons">edit</i>
												</button>

												{!! Form::close() !!}
											</section>
										</li>
										<li class="collection-item avatar">
											<label style="margin-left: 41%;">Borrar archivo</label>

											<br>
											<a href="{{ route('files.destroy', $role->id) }}" onclick="return confirm('Sure?')" class="modal-trigger open-edit"><i style="margin-left: 92%; margin-top: -10px" class="material-icons circle red">delete</i></a>
											<span style="margin-left: -54px" class="title">Titulo: {{ $role->name }}</span>
											<p style="margin-left: -54px">Propietario: {{Auth::user()->name}}
											</p>

										</li>

										<li class="collection-item avatar">
											<label style="margin-left: 40.5%;">Link de descarga</label>
											<i style="margin-left: 92%; margin-top: 27px" class="material-icons circle green">link</i>
											<input style="width: 73%; margin-left: -50px;" disabled value="http://localhost:8000/storage/files/{{Auth::user()->id}}/{{$role->name}}" type="text" class="validate">
										</li>


										<li class="collection-item avatar">
										<section style="height: 130px">
											<label style="margin-left: 40.5%;">Mover archivo a carpeta</label>
											@if($role->is_folder != "yes")
											@foreach(Auth::user()->records as $rec)
											@if($rec->is_folder != "no")
												{!! Form::open(['route' => ['files.update', $rec, $rec->id],  'method' => 'PUT']) !!}
												<select>
												<option value="" disabled selected>Mover a</option>
												<option value="{{$role->id}}" required="">{{$rec->name}}</option>
												<input type="hidden" value="{{ $role->id }}" name="file_id">
												<input type="hidden" value="{{ $rec->folder_hash }}" name="hash_folder">
												<input type="hidden" value="{{ $rec->name }}" name="name_folder">
												<input type="hidden" value="{{ $role->name }}" name="name_file">
												</select>
												<button class="btn-floating grey" style="margin-left: 44%" type="submit"><i  class="material-icons">redo</i></button>
												{!! Form::close() !!}
											@endif
											@endforeach
											@endif
											</section>
										</li>
										<br>
										<li class="collection-item avatar">
											<label style="margin-left: 40.5%;">Descargar archivo</label>
											<a style="width: 30%; margin-left: 30%; margin-top: 1.5%" href="http://localhost:8000/storage/files/{{Auth::user()->id}}/{{$role->name}}" class="waves-effect waves-light btn modal-trigger" ><i  class="material-icons">cloud_download</i></a>
										</li>
									</ul>
								</div>
							</div>
						</td>
						@endif
					</tr>
					@endforeach
				</tbody>

				@endif

			</table>
		</div>
		<div class="col s12 m4 l2"></div>
	</div>
</div>


		
	</div>


	<script type="text/javascript">
		$(document).ready(function() {
			$('select').material_select();
		});
	</script>

	@if(! Auth::guest() )

	@include('Admin.template.parts.toogleuser')

	@endif

	@include('Admin/Template/Parts/footer')