@extends('layouts.app')
@section('content')
	
	<h1>@{{ name }}</h1>

@endsection

@section('scripts')
	<script>
		new Vue({
			el: '#main',
			data: {
				name: 'Boedo'			
			}
		});
	</script>
@endsection

