<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Permission</title>
</head>

<body>
  <section class="inner-section-wrapper">
    <div class=" bg-white inventory-form">
      <div class="title-wrapper">
        <div class="page-title flex align-items-center">
          <svg class="mr-16" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20 11H7.83L13.42 5.41L12 4L4 12L12 20L13.41 18.59L7.83 13H20V11Z" fill="#333333" />
          </svg>
          {{isset($permission) ? 'Edit' : "Create"}} Permission
        </div>
      </div>
      <div class="container">
        <div class="inventory-form-wrapper">
          $url=(isset($permission))? route('admin.permission.update',['id'=>$permission['id']]) :route('admin.permission.store');
          @endphp
          {!! Form::open(['url' => $url, 'class'=>'form-data']) !!}

          <div class="row">
            <div class="col-6">
              <div class="form-group">
                {!! Form::label('name', 'Permission Name',['class' => 'input-label required']) !!}
                {!! Form::text('name',old('name',$permission->name ??
                ''),['class'=>'form-control','placeholder'=>'Permission Name',
                'data-validation'=>'required']) !!}


                @if($errors->has('name'))
                <span class="text-danger">{{$errors->first('name')}}</span>
                @endif
              </div>
            </div>
          </div>

          <div class="form-group">
            @if($errors->has('access_uri'))
            <span class="text-danger">{{$errors->first('access_uri')}}</span>
            @endif
            <label></label>
            <div class="permission-lists-wrapper">
              @foreach($routeLists as $key => $items)
              <div class="permission-item">
                <div class="permission-item-header">
                  <h3>{{preg_replace('/([a-z])([A-Z])/', '$1 $2',ucfirst($key))}}</h3>
                </div>
                <div class="permission-body">
                  <ul>
                    @foreach($items as $itemKey =>$route)
                    <li>
                      {!!Form::checkbox('access_uri[]',$route,(in_array($route,$permission->access_uri ?? []) ? true : false)) !!}
                      <label>{{str_replace('-',' ',ucfirst($itemKey))}} {{$key == 'admin' ? '' :preg_replace('/([a-z])([A-Z])/', '$1 $2',ucfirst($key))}}</label>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
              @endforeach
            </div>
          </div>

          <div class="form-button-wrapper">
            @if(isset($permission))
            <a href="{{route('admin.permission.create')}}" class="btn btn-success">Back to create</a>
            @else
            <a href="{{route('admin.permission')}}" class="btn-cancel">Cancel</a>
            @endif
            <button type="submit" class="btn-action-primary">{{(isset($permission)) ? 'Update Permission' : 'Create Permission'}}</button>

          </div>


          {!! Form::close() !!}
        </div>
      </div>

    </div>
  </section>
</body>

</html>