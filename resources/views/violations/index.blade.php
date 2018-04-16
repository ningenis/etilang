@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col">
			<h3>Daftar Pelanggaran</h3>
			@if(Session::has('message'))
				<div class="alert alert-success">{{ Session::get('message') }}</div>
			@endif
			<a href="{{ route('violations.create') }}" class="btn btn-primary"><span class="fa fa-plus"></span>Tambah Pelanggaran</a>
			<br></br>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nomor Pelanggaran</th>
						<th>Nama Pelanggar</th>
						<th>Nama Petugas</th>
						<th>Identitas Pelanggar</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($items as $item)
					<tr>
						<td>{{ $item->id }}</td>
						<td>{{ $item->violator_name }}</td>
						<td>{{ $item->user->name }}</td>
						<td>{{ $item->violator_identity_number }}</td>
						<td>
							<a href="{{ route('violations.edit', $item) }}" class="btn btn-info"><span class="fa fa-pencil"></span>Edit</a>
							<a href="{{ route('violations.delete', $item) }}" class="btn btn-danger">Delete</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{!! $items->links() !!}
		</div>
	</div>
</div>
@endsection