@extends('layouts.default')
@section('title','Job Application')
@section('content')
<div class="listing-continents">
  <div class="create-link">
    <a href="{{route('admin.continent.create')}}">Add more continents</a>
  </div>

  <div class="table-wrap">
    <table class="table table-bordered data-table">
      <tr>
        <th>SN No.</th>
        <th>Continent Title</th>
        <th>Action</th>
      </tr>

      @foreach($continents as $continent)
      <tr>
        <td>{{$continent->id}}</td>
        <td>{{$continent->title}}</td>
        <td>
            <div class="action-buttons">
              <div class="edit-btn">
                <a href="{{route('admin.continent.edit',['id'=>$continent->id])}}"><i class="fa fas fa-edit"></i></a>
              </div>

              <div class="delete-btn">
                  <form action="{{route('admin.continent.delete',['id'=>$continent->id])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit"><i class="fa fa-trash"></i></button>
                  </form>
              </div>
            </div>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>

@endsection