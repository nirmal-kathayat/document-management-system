@extends('layouts.default')
@section('title','Job Application')
@section('content')
<div class="listing-continents">
  <div class="create-link">
    <a href="{{route('admin.jobPosition.create')}}">Add more continents</a>
  </div>

  <div class="table-wrap">
    <table style="width: 97.2%;" class="table table-bordered data-table">
      <tr>
        <th>SN No.</th>
        <th>Job Position Title</th>
        <th>IS Description</th>
        <th>Action</th>
      </tr>

      @foreach($jobPositions as $jobPosition)
      <tr>
        <td>{{$jobPosition->id}}</td>
        <td>{{$jobPosition->title}}</td>
        <td>{{$jobPosition->isDescription}}</td>
        <td>
          <div class="action-buttons">
            <div class="edit-btn">
              <a href="{{route('admin.jobPosition.edit',['id'=>$jobPosition->id])}}">Edit</a>
            </div>

            <div class="delete-btn">
              <form action="{{route('admin.jobPosition.delete',['id'=>$jobPosition->id])}}" method="post">
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