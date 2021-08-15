@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    @include('layouts.parts.message')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Subjects') }}
                <div class="card-header-actions">
                    <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.subject.create')}}">{{__('Create')}}</a>
                    <a class="btn btn-pill btn-danger btn-sm" href="{{route('admin.subject.trash')}}">{{__('Trash')}}</a>
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
                                <td>{{$subject->parentSubject->name ?? __('No Parent')}}</td>
                                <td>
                                  <form action="{{ route('admin.subject.destroy',[$subject->id]) }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.subject.show',$subject->id)}}">{{trans('Show')}}</a>
                                  <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.subject.edit',$subject->id)}}">{{trans('Edit')}}</a>
                                  <button type="submit"  class="btn btn-pill btn-sm btn-danger" onclick="return confirm('Are you sure you want to Delete')">Delete</button>
                                      </form>
                                </td>
                              </tr>
                              @empty
                              <tr>
                                <td colspan="5">{{__('Sorry ! No Data Found.')}}</td>
                              </tr>
                              @endforelse
                            </tbody>
                          </table>
                          <div class="row content-center">
                            {{$subjects->links()}}
                          </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-pill btn-primary btn-sm" href="{{url()->previous()}}">{{__('Back')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection
