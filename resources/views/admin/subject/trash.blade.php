@extends('layouts.admin')
@section('content')
<div class="container">
    @include('layouts.parts.message')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Subjects') }}
                <div class="card-header-actions">
                    <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.subject.index')}}">{{__('Index')}}</a>
                    <a class="btn btn-pill btn-danger btn-sm" href="{{route('admin.subject.trash')}}">{{__('Delete All')}}</a>
                  </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                        <table class="table table-responsive-sm table-hover table-outline mb-0">
                            <thead>
                              <tr>
                                <th>{{trans('ID')}}</th>
                                <th>{{trans('Name')}}</th>
                                <th>{{trans('Code')}}</th>
                                <th>{{__('Parent Subject')}}</th>

                                <th>{{trans('Action')}}</th>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse ($subjects as $subject )
                              <tr>
                                <td>{{$subject->id}}</td>
                                <td>{{$subject->name}}</td>
                                <td>{{$subject->code}}</td>
                                <td>{{$subject->parentSubject->name ?? ""}}</td>
                                <td class="row">
                                    <div class="col-sm-6">
                                    <form action="{{ route('admin.subject.restoreDeleted',[$subject->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit"  class="btn btn-pill btn-sm btn-danger" onclick="return confirm('Are you sure you want to restore')">{{__('Restore')}}</button>
                                    </form>
                                    </div>
                                    <div class="col-sm-6">
                                    <form action="{{ route('admin.subject.forceDelete',[$subject->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit"  class="btn btn-pill btn-sm btn-danger" onclick="return confirm('Are you sure you want to Delete')">{{__("Delete")}}</button>
                                    </form>
                                    </div>
                                </td>
                              </tr>
                              @empty
                              <tr>
                                <td colspan="2">Sorry ! No Data Found.</td>

                              </tr>

                              @endforelse

                            </tbody>

                          </table>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')


@endsection
