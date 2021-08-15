@extends('layouts.admin')

@section('content')
  <div class="container-fluid">
  	@include('layouts.parts.message')
    <div class="row justify-content-center">
      <div class="col-sm-12">
      	<div class="card shadow-sm">
      		<div class="card-header">
            {{__('Manage User')}}
      			<div class="card-header-actions">
              <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.usermanager.create')}}">{{__('Create')}}</a>
            </div>
      		</div>
      		<div class="card-body" style="padding: 5px;">
      			<table class="table table-responsive-sm table-hover table-outline mb-0">
              <thead class="dark-thread">
                <tr >
                  <th class="text-center">{{__('Avatar')}}</th>
                  <th>{{__('ID')}}</th>

                  <th>{{__('Name')}}</th>
                  <th>{{__('Username')}}</th>
                  <th>{{__('Email')}}</th>
                  <th>{{__('Action')}}</th>
                </tr>
              </thead>
              <tbody>
                @forelse($data as $d)
                <tr>
                  <td class="text-center">
                    <div class="c-avatar">
                        <img class="c-avatar-img" src="{{asset($d->avatar ?? 'https://res.cloudinary.com/debjit/image/upload/v1508259244/computer-icon-2429310_640_vjicij.png')}}" alt="{{$d->email}}">
                    </div>
                  </td>
                  <td>{{$d->id}}</td>

                  <th>{{$d->name}}</th>
                  <th>{{$d->username}}</th>
                  <th>{{$d->email}}</th>
                  <td>
                    <form action="{{ route('admin.usermanager.destroy',[$d->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.usermanager.show',$d->id)}}">{{__('Show')}}</a>
                    <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.usermanager.edit',$d->id)}}">{{__('Edit')}}</a>
                    <button type="submit"  class="btn btn-pill btn-sm btn-danger" onclick="return confirm('Are you sure you want to Delete')">{{__('Delete')}}</button>
                        </form>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="2">__("Sorry ! No Data Found.")</td>

                </tr>

                @endforelse

              </tbody>
            </table>
            {{$data->links()}}
      		</div>
      		<div class="card-footer">
      			<a class="btn btn-pill btn-primary" href="{{url()->previous()}}">{{__('Back')}}</a>
      		</div>

      	</div>
      </div>
  </div>
</div>
@endsection
