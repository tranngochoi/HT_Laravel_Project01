@extends('backend.layouts.master')

@section('title', 'Detail')

@push('css')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.css') }}">
@endpush

@section('content')
<section class="content-header">
	<h1>Review table</h1>
	<ol class="breadcrumb">
		<li>
			<a href="{{ route('admin.dashboard') }}">
				<i class="fas fa-tachometer-alt"></i> Home
			</a>
		</li>
		<li>
			<a href="{{ route('admin.users.index') }}">
				<i class="fas fa fa-users"></i> Users
			</a>
		</li>
		<li class="active">Review</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="box">
		<div class="box-header">
			@if (Session::has('success'))
			<div class="box-header with-border">
				<div class="col-md-6">
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-check"></i> Success!</h4>
						<p>* {{ Session::get('success') }}</p>
					</div>
				</div>
			</div>
			@endif
			@if (Session::has('error'))
			<div class="box-header with-border">
				<div class="col-md-6">
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-check"></i> Error!</h4>
						<p>* {{ Session::get('error') }}</p>
					</div>
				</div>
			</div>
			@endif
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
				<div class="row">
					<div class="col-sm-12">
						<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
							<thead>
								<tr role="row">
									<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 80px; text-align: center;">STT</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;text-align: center;">Book name</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 100px;text-align: center;">Image</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 100px;text-align: center;">Author</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 100px;text-align: center;">Category</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 100px;text-align: center;">Star</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 100px;text-align: center;">Review</th>
									<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 199px;text-align: center;">Action</th>
								</tr>
							</thead>
							<tbody>
								@include('backend.layouts.partials.modal')
								@foreach ($details as $key => $detail)
								<tr role="row" class="odd">
									<td class="sorting_1" style="text-align: center;">{{ $key + 1 }}</td>
									<td style="text-align: center;" class="text-red"><strong>{{ $detail->name }}</strong></td>
									<td style="text-align: center;"><img src="images/books/{{ $detail->image }}" class="attachment-img" alt="book Image"></td>
									<td style="text-align: center;">{{ $detail->name_author }}</td>
									<td style="text-align: center;">{{ $detail->name_category }}
									</td>
									<td style="text-align: center;">{{ $detail->star }}</td>
									<td style="text-align: center;" class="text-green">
										@if($detail->content)
										<i>" {{ $detail->content }} "</i>
										@else
										NULL
										@endif
									</td>
									<td style="text-align: center;">
										<form method="POST" action="{{ route('admin.users.delete_review', ['id'=> $detail->user_id, 'id_book'=> $detail->book_id]) }}" class="inline">
											{{ csrf_field() }}
											{{ method_field('delete') }}
											<button type="button" class="btn btn-danger form-delete btn-delete-item"
											data-title="Delete User"
											data-confirm="Are you sure you want to delete review ' {{ $detail->content }} ' of <strong>{{ $detail->username }}</strong>">Delete</button>
										</form> 
									</td>
								</tr>
								@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th rowspan="1" colspan="1" style="text-align: center;">STT</th>
									<th rowspan="1" colspan="1" style="text-align: center;">Book name</th>
									<th rowspan="1" colspan="1" style="text-align: center;">image</th>
									<th rowspan="1" colspan="1" style="text-align: center;">Author</th>
									<th rowspan="1" colspan="1" style="text-align: center;">Category</th>
									<th rowspan="1" colspan="1" style="text-align: center;">Star</th>
									<th rowspan="1" colspan="1" style="text-align: center;">Review</th>
									<th rowspan="1" colspan="1" style="text-align: center;">Action</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
	</div>
</section>
<!-- /.content -->
@endsection

@push('js')
<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('bower_components/admin-lte/dist/js/demo.js') }}"></script>
<!-- page script -->
<script>
	$(function () {
		$('#example1').DataTable()
		$('#example2').DataTable({
			'paging'      : true,
			'lengthChange': false,
			'searching'   : false,
			'ordering'    : true,
			'info'        : true,
			'autoWidth'   : false
		})
	})
</script>
<script src="{{ asset('js/main.js') }}"></script>
@endpush
