@extends('layouts.default')
@section('title','Job Application')
@section('content')
<div class="listing-continents">
  <div class="create-link">
    <a href="{{route('admin.demand.create')}}">Add more demands</a>
  </div>

  <div class="table-wrap">
    <table style="width: 97.2%;" class="table table-bordered data-table">
      <tr>
        <th>SN No.</th>
        <th>Date</th>
        <th>Demand Name</th>
        <th>Salary</th>
        <th>Experience</th>
        <th>Country</th>
        <th>Comment</th>
        <th>Action</th>
      </tr>

      @foreach($demands as $demand)
      <tr>
        <td>{{$demand->id}}</td>
        <td>{{$demand->date}}</td>
        <td>{{$demand->demand_name}}</td>
        <td>{{$demand->salary}}</td>
        <td>{{$demand->experience}}</td>
        <td>{{$demand->country}}</td>
        <td>{{$demand->comment}}</td>
        <td>
          <div class="action-buttons">
            <div class="edit-btn">
              <a href="{{route('admin.demand.edit',['id'=>$demand->id])}}">Edit</a>
            </div>

            <div class="delete-btn">
              <form action="{{route('admin.demand.delete',['id'=>$demand->id])}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
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