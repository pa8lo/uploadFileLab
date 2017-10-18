 <link rel="stylesheet" href="{{ asset('plugins/materialize/css/materialize.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/icons/icons.css') }}">
  <script src="{{ asset('plugins/jquery/jquery-3.2.1.js') }}"></script>
  <script src="{{ asset('plugins/materialize/js/materialize.js') }}"></script>

@include('Admin.template.main')

@section('title'){{-- Section se usa para rellenar aquello que fue marcado con Yield --}}
    Inicio de mi pagina
@endsection

@section('contenido')

@endsection


@if(Auth::User())

@include('Admin.template.parts.toogleuser')

@endif
 @if(isset($nombre))
  <div class="red deep-orange white-text darken-1 card-panel pulse " style="text-align: center">Ya existe un usuario con ese mail por favor registrarse con uno distinto</div>
   @endif
<section>

     <div class="parallax-container">

      <div style="margin-top: 170px;" class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center teal-text text-lighten-2">Upload File Lab</h1>
        <div class="row center">
          <h5 class="header col s12 light">The personal cloud you've always wanted</h5>
        </div>
        <div class="row center">
          <a href="{{ route('files.index') }}" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Suba Archivos</a>
        </div>
        <br><br>

      </div>
      </div>

    <div class="parallax"><img src="{{  asset('image/fondo.jpg') }}"></div>
  </div>
  <div class="section white">
    <div class="row container">



<div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">Maxima velocidad de carga</h5>

            <p class="light">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components. Additionally, we refined animations and transitions to provide a smoother experience for developers.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">group</i></h2>
            <h5 class="center">Comparta sus archivos</h5>

            <p class="light">By utilizing elements and principles of Material Design, we were able to create a framework that incorporates components and animations that provide more feedback to users. Additionally, a single underlying responsive system across all platforms allow for a more unified user experience.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Sin limite de espacio</h5>

            <p class="light">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about Materialize.</p>
          </div>
        </div>
      </div>


      <h2 class="header">Parallax</h2>
      <p class="grey-text text-darken-3 lighten-3">Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.</p>
    </div>
  </div>
  <div class="parallax-container">
    <div class="parallax"><img src="{{  asset('image/second.jpg') }}"></div>
  </div>
</section>

@include('admin.template.parts.footer')

<script type="text/javascript">
    
  // Initialize collapse button
  $(".button-collapse").sideNav();
  // Initialize collapsible (uncomment the line below if you use the dropdown variation)
  //$('.collapsible').collapsible();


  $(document).ready(function(){
      $('.parallax').parallax();
    });


</script>