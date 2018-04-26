@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col">
			<h3>Edit Pelanggaran</h3>
			<form action="{{ route('violations.update', $violation) }}" method="post">
				
				{{ csrf_field() }}
				@method('PUT')

				<div class="form-group">
					<label>Nomor Identitas Pelanggar</label>
					<input type="text" name="violator_identity_number" class="form-control" value="{{ $violation->violator_identity_number}}">
				</div>
				<div class="form-group">
					<label>Nama Pelanggar</label>
					<input type="text" name="violator_name" class="form-control" value="{{ $violation->violator_name}}">
				</div>
				<div class="form-group">
					<label>Pos Jaga Tempat Kejadian</label>
					  <select name="station_id" class="form-control" value="{{ $violation->station_id }}" required>
					  @foreach ($stations as $station)	
					    <option value="{{ $station['id'] }}">{{ $station['address'] }}</option>
					  @endforeach
					  </select>
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>
@endsection
