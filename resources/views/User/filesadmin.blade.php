<link rel="stylesheet" href="{{ asset('plugins/dropzone/css/dropzone.css') }}">
<script src="{{ asset('plugins/dropzone/js/dropzone.js') }}"></script>

@include('Admin/Template/main')

@section('title')<table>
				<thead>
					<tr>
						<th></th>
						<th>Nombre</th>
						<th>id del propietario</th>
						<th>Ultima Modificacion</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($record as $role)
					<tr>


						{{-- Modal para los archivos --}}

						<td><i class="material-icons">insert_drive_file</i></td>
						<td>{{ $role['name'] }}</td>
						<td>{{ $role['user_id']}}</td>
						<td>{{ $role['updated_at'] }}</td>
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
											{!! Form::open(['route' => ['files.update', $role, $role->id],  'method' => 'PUT']) !!}
											
											@foreach(Auth::user()->records as $rec)
											@if($rec->is_folder != "no")
												
												<select>
												<option value="" disabled selected>Mover a</option>
												<option value="{{$role->id}}" required="">{{$rec->name}}</option>
												<input type="hidden" value="{{ $role->id }}" name="file_id">
												<input type="hidden" value="{{ $rec->folder_hash }}" name="hash_folder">
												<input type="hidden" value="{{ $rec->name }}" name="name_folder">
												<input type="hidden" value="{{ $role->name }}" name="name_file">
												</select>
												
											@endif
											@endforeach

											<button class="btn-floating grey" style="margin-left: 44%" type="submit"><i  class="material-icons">redo</i></button>
												{!! Form::close() !!}
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
						
						
						
						{{-- 
						@if( $role->is_folder == "yes" )
						<td><a href="folder/{{$role->folder_hash}}">{{ $role['name'] }}</a></td>
						@else
						<td>{{ $role['name'] }}</td>
						@endif
						 --}}
						
						
					</tr>
					@endforeach
				</tbody>

				

			</table>
		</div>
		<div class="col s12 m4 l2"></div>
	</div>
</div>




	{{-- <div class="row">
		<div class="col s12 m4 l2"></div>
		<div class="col s12 m4 l12">

			<form class="dropzone" method="POST" action="{{ route('files.store') }}" enctype="multipart/form-data">
				{{csrf_field()}}
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" value="{{ Auth::user()->id }}" name="id">

				<div class="fallback">
					<input name="file" type="file" multiple />
				</div>
			</form>

		</div>
		<div class="col s12 m4 l2"></div> --}}
		
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