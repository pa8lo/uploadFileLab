@if(count($errors) > 0)

<ul class="collapsible" style="margin-left: 120px; margin-top: -100px; margin-bottom: 60px;" data-collapsible="accordion">
	<li>
		<div class="collapsible-header">
			<i class="material-icons">error</i>
			An Error Ocurred, Click Me to show more details!
		</div>
		<div class="collapsible-body">

			@foreach($errors->all() as $error)
			<p>{{ $error }}</p>
			@endforeach

		</div>
	</li>
</ul>

@endif