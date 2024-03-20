@extends('layouts.default')
@section('title',isset($role) ? 'Update Role' : 'Create Role')
@section('content')
<div class="inner-section-wrapper grey-bg country-form">
	<form action="{{ isset($role) ? route('admin.role.update', $role->id) : route('admin.role.store') }}" method="post" class="form-data">
		@csrf
		<div class="form-wrapper">
			<div class="form-group group-row align-center">
				<label>Name</label>
				<input type="text" name="name" data-validation="required" class="validation-control" value="{{old('name',$role->name ?? '')}}">
			</div>
			<div class="form-group group-row">
				<label>Permissions</label>
				<div class="form-group group-column" style="width:100%;">
					@foreach($permissions as $permission)
						<div class="form-group group-row">
							<input type="checkbox" name="permissions[]" value="{{$permission->id}}" style="width:15px;height:15px;" {{isset($role) && in_array($permission->id,$role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
							<span>{{$permission->name}}</span>
						</div>
					@endforeach
				</div>
			</div>
			
			<div class="form-group flex-end">
				<button type="submit" class="primary-btn" id="submit-button">{{isset($role) ? 'Update' : 'Add'}} Role </button>
			</div>
		</div>
	</form>
</div>
@endsection

@push('js')
@include('scripts.validation')

@endpush