@extends('layouts.admin')

@section('content')
  <div class="container-fluid">
  	@include('layouts.parts.message')
    <div class="row justify-content-center">
      <div class="col-sm-12">
      	<div class="card">
      		<div class="card-header">
                {{__('Deleted Exam Lists')}}
      		</div>
      		<div class="card-body">
      			<table class="table table-responsive-sm table-hover table-outline mb-0">
              <thead>
                <tr>
                  <th>{{__('ID')}}</th>
                  <th>{{__('Name')}}</th>
                  <th>{{__('Action')}}</th>
                </tr>
              </thead>
              <tbody>
                @forelse($exams as $exam)
                <tr>
                  <td>{{$exam->id}}</td>
                  <td>{{$exam->name}}</td>
                  <td>
                    <form action="{{ route('admin.exam.forceDelete',[$exam->id]) }}" method="POST">
                      @csrf
                      <button type="submit"  class="btn btn-pill btn-sm btn-danger" onclick="return confirm('Are you sure you want to Delete?')">{{__('Permanently Delete')}}</button>
                    </form>
                    <form action="{{ route('admin.exam.restoreDeleted',[$exam->id]) }}" method="POST">
                        @csrf
                        <button type="submit"  class="btn btn-pill btn-sm btn-danger" onclick="return confirm('Are you sure you want to Restore This examination?')">{{__('Restore')}}</button>
                      </form>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="2">{{__('No deleted exam to show.')}}</td>
                </tr>
                @endforelse
              </tbody>
            </table>
            <div>
                {{$exams->links()}}
            </div>
      		</div>
      		<div class="card-footer">
      			<a class="btn btn-pill btn-primary" href="{{route('admin.exam.index')}}">{{__('Back')}}</a>
      		</div>

      	</div>
      </div>
  </div>
</div>
@endsection
