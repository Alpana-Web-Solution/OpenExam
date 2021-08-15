@extends('layouts.admin')

@section('content')
  <div class="container-fluid">
  	@include('layouts.parts.message')
    <div class="row justify-content-center">
      <div class="col-sm-12">
      	<div class="card">
      		<div class="card-header">
                {{__('Exam Lists')}}
      			<div class="card-header-actions">
              <a class="btn btn-primary btn-pill btn-sm" href="{{route('admin.exam.create')}}">{{trans('Create')}}</a>
              <a class="btn btn-danger btn-pill btn-sm" href="{{route('admin.exam.trash')}}">{{trans('Trash')}}</a>
            </div>
      		</div>
      		<div class="card-body">
      			<table class="table table-responsive-sm table-hover table-outline mb-0">
              <thead>
                <tr>
                  <th>{{__('ID')}}</th>
                  <th>{{__('Name')}}</th>
                  <th>{{__('Attended')}}</th>
                  <th>{{__('Status')}}</th>
                  <th>{{__('Action')}}</th>
                </tr>
              </thead>
              <tbody>
                @forelse($exams as $exam)
                <tr>
                  <td>{{$exam->id}}</td>
                  <td>{{$exam->name}}</td>
                  <td>{{$exam->user_attended}}</td>
                  <td>{{ examStatusH($exam->status) }}</td>
                  <td>
                    <form action="{{ route('admin.exam.destroy',[$exam->id]) }}" method="POST">
                      @csrf
                      @method('DELETE')

                      <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.exam.show',$exam->id)}}">{{__('Show')}}</a>
                      @if (empty($exam->status))
                      <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.exam.edit',$exam->id)}}">{{__('Edit')}}</a>
                      @endif
                      @if (!empty($exam->status))
                      <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.exam.result',$exam->id)}}">{{__('Result')}}</a>
                      @endif
                      {{-- <a class="btn btn-primary btn-sm" href="{{route('admin.exam.questions',$exam->id)}}">{{__('Question Bank')}}</a> --}}
                      <button type="submit"  class="btn btn-pill btn-sm btn-danger" onclick="return confirm('Are you sure you want to Delete')">{{__('Delete')}}</button>
                    </form>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="2">{{__('Sorry ! No Data Found.')}}</td>
                </tr>
                @endforelse
              </tbody>

            </table>
            <div>
                {{$exams->links()}}
            </div>
      		</div>
      		<div class="card-footer">
      			<a class="btn btn-pill btn-sm btn-primary" href="{{url()->previous()}}">{{__('Back')}}</a>
      		</div>

      	</div>
      </div>
  </div>
</div>
@endsection
