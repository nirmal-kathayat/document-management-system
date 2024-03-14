@extends('layouts.default')
@section('title','Job Application')
@section('content')
<div class="listing-continents">
  <div class="create-link">
    <a href="{{route('admin.jobPosition.create')}}">Add more job Position</a>
  </div>

  <div class="table-wrap">
    <table  class="table table-bordered data-table">
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
              <a href="{{route('admin.jobPosition.edit',['id'=>$jobPosition->id])}}"><i class="fa fas fa-edit"></i></a>
            </div>

            <div class="delete-btn">
              <form action="{{route('admin.jobPosition.delete',['id'=>$jobPosition->id])}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit"><i class="fa fas fa-trash"></i></button>
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