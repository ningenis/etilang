@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col">
			<h3>Tambah Pelanggaran Baru</h3>
			<form action="{{ route('violations.store') }}" method="post">
				
				{{ csrf_field() }}

				<div class="form-group">
					<label>Nomor Identitas Pelanggar</label>
					<input type="text" name="violator_identity_number" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Nama Pelanggar</label>
					<input type="text" name="violator_name" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Pos Jaga Tempat Kejadian</label>
					  <select name="station_id" class="form-control" required>
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
