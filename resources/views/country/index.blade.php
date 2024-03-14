@extends('layouts.default')
@section('title','Job Application')
@section('content')
<div class="listing-continents">
  <div class="create-link">
    <a href="{{route('admin.country.create')}}">Add more country</a>
  </div>

  <div class="table-wrap">
    <table class="table table-bordered data-table">
      <tr>
        <th>SN No.</th>
        <th>Continent</th>
        <th>Country Title</th>
        <th>Action</th>
      </tr>

      @foreach($countries as $country)
      <tr>
        <td>{{$country->id}}</td>
        <td>{{$country->continent_title}}</td>
        <td>{{$country->title}}</td>
        <td>
          <div class="action-buttons">
            <div class="edit-btn">
              <a href="{{route('admin.country.edit',['id'=>$country->id])}}"><i class="fa fas fa-edit"></i></a>
            </div>

            <div class="delete-btn">
              <form action="{{route('admin.country.delete',['id'=>$country->id])}}" method="post">
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