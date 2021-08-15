@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">

            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center">
                      <div class="bg-primary p-3 mr-3">
                        <i class="fas fa-users c-icon c-icon-xl"></i>
                      </div>
                      <div>
                        <div class="text-value text-primary">{{$userCount}}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">{{__('Users')}}</div>
                      </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{route('admin.usermanager.index')}}">
                            <span class="small font-weight-bold">{{__("View More")}}</span>
                            <i class="fas fa-angle-double-right"></i>
                        </a>
                    </div>
                  </div>
              </div>
              <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center">
                      <div class="bg-primary p-3 mr-3">
                        <i class="fas fa-book c-icon c-icon-xl"></i>
                      </div>
                      <div>
                        <div class="text-value text-primary">{{$examCount}}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">{{__('Exams')}}</div>
                      </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{route('admin.exam.index')}}">
                            <span class="small font-weight-bold">{{__("View More")}}</span>
                            <i class="fas fa-angle-double-right"></i>
                        </a>
                    </div>
                  </div>
              </div>
              <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center">
                      <div class="bg-primary p-3 mr-3">
                        <i class="fas fa-question c-icon c-icon-xl"></i>
                      </div>
                      <div>
                        <div class="text-value text-primary">{{$questionCount}}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">{{__('Questions')}}</div>
                      </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{route('admin.question.index')}}">
                            <span class="small font-weight-bold">{{__("View More")}}</span>
                            <i class="fas fa-angle-double-right"></i>
                        </a>
                    </div>
                  </div>
              </div>
              <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center">
                      <div class="bg-primary p-3 mr-3">
                        <i class="fas fa-clipboard-list c-icon c-icon-xl"></i>
                      </div>
                      <div>
                        <div class="text-value text-primary">{{$subjectCount}}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">{{__('Subjects')}}</div>
                      </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{route('admin.subject.index')}}">
                            <span class="small font-weight-bold">{{__("View More")}}</span>
                            <i class="fas fa-angle-double-right"></i>
                        </a>
                    </div>
                  </div>
    </div>
</div>
@endsection
