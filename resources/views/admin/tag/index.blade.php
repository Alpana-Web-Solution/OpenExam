@extends('layouts.admin')

@section('content')
  <div class="container-fluid">
  	@include('layouts.parts.message')
    <div class="row justify-content-center">
      <div class="col-sm-12">
      	<div class="card">
      		<div class="card-header">
      			<div class="card-header-actions">
              <a class="btn btn-primary btn-sm" href="{{route('admin.tag.create')}}">{{trans('Create')}}</a>
            </div>
      		</div>
      		<div class="card-body">
      			<table class="table">
              <thead>
                <tr>
                  <th>{{trans('ID')}}</th>
                  <th>{{__("Name")}}</th>
                  <th>{{trans('Action')}}</th>
                </tr>
              </thead>
              <tbody>
                @forelse($tags as $tag)
                <tr>
                  <td>{{$tag->id}}</td>
                  <th>{{$tag->name}}</th>
                  <td>
                    <form action="{{ route('admin.tag.destroy',[$tag->id]) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit"  class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to Delete')">{{__('Delete')}}</button>
                    </form>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="2">{{__('Sorry ! No Data Found.')}}</td>
                </tr>
                @endforelse
              </tbody>
              <div class="content-center">
                {{$tags->links()}}
              </div>

            </table>
      		</div>
      		<div class="card-footer">
      			<a class="btn btn-primary" href="{{url()->previous()}}">{{__('Back')}}</a>
      		</div>

      	</div>
      </div>
  </div>
</div>
@endsection
