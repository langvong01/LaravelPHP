<?php
?>
@extends('layout.app')
@section('content')
    <form action="{{url('task')}}" method="post">
        {{csrf_field()}}
    <div class="row  d-flex justify-content-center pt-3">
        @include('errors.503')
        <div class="col-auto">
            <label for="inputTask" class="col-form-label">Task Name</label>
        </div>
        <div class="col-auto">
            <input type="text" id="task-name" class="form-control"  name="name">
        </div>
        <div class="col-auto">
    <span id="TaskHelpInline" class="form-text">
      Must be 8-20 characters long.
    </span>
        </div>
        <div class="col-auto">
            <span class="form-text" id="submit">
                <input class="btn btn-primary" type="submit" value="Add Task">
            </span>
        </div>
    </div>
    </form>
    <br>
    @if(count($tasks)>0)
    <table class="table table-danger">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Created_at</th>
            <th scope="col">Updadte_at</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task )
            <tr>
                <th scope="row">{{$task->id}}</th>
                <td>{{$task->name}}</td>
                <td>{{$task->created_at}}</td>
                <td>{{$task->updated_at}}</td>
{{--                Them nut xoa--}}
                <td>
                    <form action="{{route('task.delete',$task->id)}}" method="post">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button  class="btn btn-outline-dark">Delete Task</button>
                        <input type="hidden" name="method" value="DELETE">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
@endsection
