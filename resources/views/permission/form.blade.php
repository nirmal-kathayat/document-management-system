@extends('layouts.default')
@section('title',isset($permission) ? 'Update Permission' : 'Create Permission')
@section('content')
<div class="inner-section-wrapper grey-bg country-form">
	<form action="{{ isset($permission) ? route('admin.permission.update', $permission->id) : route('admin.permission.store') }}" method="post" class="form-data">
		@csrf
		<div class="form-wrapper">
			<div class="form-group group-row align-center">
				<label>Name</label>
				<input type="text" name="name" data-validation="required" class="validation-control" value="{{old('name',$permission->name ?? '')}}">
			</div>
			<div class="form-group group-column">
				<label>Permissions List</label>
				<div class="permission-lists-wrapper grid-row template-repeat-4 col-gap-20 row-gap-20">
					@foreach($routeLists as $key => $items)
					<div class="permission-item">
						<div class="permission-item-header">
							<h3>{{preg_replace('/([a-z])([A-Z])/', '$1 $2',ucfirst($key))}}</h3>
						</div>
						<div class="permission-body">
							<ul>
								@foreach($items as $itemKey =>$route)
								@if(is_array($route))
									@foreach($route as $otherRoute)
										@if($otherRoute!=='admin/dashboard')
											@php
												$arr = explode('/',$otherRoute);
												
											@endphp
										<li>
											<input type="checkbox" name="access_uri[]" value="{{$otherRoute}}" {{ isset($permission) && is_array($permission->access_uri) && in_array($otherRoute, $permission->access_uri) ? 'checked' : '' }}>
											<label>{{ucfirst($arr[2])}} {{ucfirst($key)}}</label>
										</li>
										@endif
									@endforeach
								@else
								<li>
									<input type="checkbox" name="access_uri[]" value="{{$route}}" {{ isset($permission) && is_array($permission->access_uri) && in_array($route, $permission->access_uri) ? 'checked' : '' }}>
									<label>{{str_replace('-',' ',ucfirst($itemKey))}} {{$key == 'admin' ? '' :preg_replace('/([a-z])([A-Z])/', '$1 $2',ucfirst($key))}}</label>
								</li>
								@endif
								@endforeach
							</ul>
						</div>
					</div>
					@endforeach
				</div>
				@error('access_uri')
					<p class="validation-error">{{$message}}</p>
				@enderror
			</div>
			<div class="form-group flex-end">
				<button type="submit" class="primary-btn" id="submit-button">{{isset($permission) ? 'Update' : 'Add'}} Permission </button>
			</div>
		</div>
	</form>
</div>
@endsection

@push('js')
@include('scripts.validation')

@endpush