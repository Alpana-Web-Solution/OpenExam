@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Showing Subject') }}
                    <div class="card-header-actions">
                        <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.subject.index')}}">{{__('Index')}}</a>
                        <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.subject.edit',$subject->id)}}">{{__('Edit')}}</a>
                      </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{__('Name')}} : {{$subject->name}}
                    <br>
                    {{__('Code')}} : {{$subject->code}}
                    <br>
                    {{__('Description')}} : {{$subject->description}}
                    <br>
                    {{__('Parent')}} : {{!empty($subject->parentSubject->name) ? $subject->parentSubject->name:'No Parent'}}


                </div>
                <div class="card-footer">
                    <a class="btn btn-pill btn-primary" href="{{url()->previous()}}">{{__("Back")}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
