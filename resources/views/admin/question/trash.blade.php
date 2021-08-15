@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    @include('layouts.parts.message')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Questions') }}
                <div class="card-header-actions clear-fix">
                        <form action="{{ route('admin.question.trash.restoreAll') }}" method="POST" class="m-1">
                            @csrf
                            <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.question.index')}}">{{__('Question Index')}}</a>
                            <button type="submit"
                            class="btn btn-pill btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to Restore All?')">{{__("Restore All")}}</button>
                        </form>
                  </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <table class="table table-responsive-sm table-hover table-outline m-0 p-0">
                            <thead>
                              <tr>
                                <th>{{trans('ID')}}</th>
                                <th>{{trans('Question')}}</th>
                                <th>{{__('Parent Subject')}}</th>
                                <th>{{trans('Action')}}</th>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse ($questions as $question )
                              <tr>
                                <td>{{$question->id}}</td>
                                <td>{{\Str::limit($question->question, 35, '...')}}</td>
                                <td>{{$question->subject->name ?? ""}}</td>
                                <td class="row">
                                    <div class="col-sm-6">
                                    <form action="{{ route('admin.question.restoreDeleted',[$question->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit"  class="btn btn-pill btn-sm btn-danger" onclick="return confirm('Are you sure you want to restore')">{{__('Restore')}}</button>
                                    </form>
                                    </div>
                                    <div class="col-sm-6">
                                    <form action="{{ route('admin.question.forceDelete',[$question->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit"  class="btn btn-pill btn-sm btn-danger" onclick="return confirm('Are you sure you want to Delete')">{{__("Delete")}}</button>
                                    </form>
                                    </div>
                                </td>
                              </tr>
                              @empty
                              <tr>
                                <td colspan="4">{{__("Awesome ! Nothing to recycle.")}}</td>

                              </tr>

                              @endforelse

                            </tbody>

                          </table>
                          <div class="content-center mt-2">
                            {{$questions->links()}}
                          </div>
                </div>

                <div class="card-footer">
                  <strong>{{__("Please note you can only delete questions that are not used in any exams.")}}</strong>
                    <div class="card-header-actions clear-fix">
                        <form action="{{ route('admin.question.trash.empty') }}" method="POST">
                            @csrf
                            <button type="submit"
                            class="btn btn-pill btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to Delete All?')">{{__("Delete All")}}</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')


@endsection
