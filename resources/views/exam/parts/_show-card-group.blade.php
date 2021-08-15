<div class="card-group mb-4">
    <div class="card">
    <div class="card-body">
    <div class="text-muted text-right mb-4">
    <i  class=" c-icon c-icon-2xl fas fa-stopwatch"></i>
    </div>
    <div class="text-value-lg">{{round($exam->duration/60, 0)}} {{__("Min")}}</div><small class="text-muted text-uppercase font-weight-bold">{{__('Duration')}}</small>
    <div class="progress progress-xs mt-3 mb-0">
    <div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    </div>
    </div>
    <div class="card">
    <div class="card-body">
    <div class="text-muted text-right mb-4">
        <i class="c-icon c-icon-2xl fas fa-certificate"></i>
    </div>
    <div class="text-value-lg">{{$exam->total_marks}}</div><small class="text-muted text-uppercase font-weight-bold">{{__('Total Marks')}}</small>
    <div class="progress progress-xs mt-3 mb-0">
    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    </div>
    </div>
    <div class="card">
        <div class="card-body">
        <div class="text-muted text-right mb-4">
            <i class="c-icon c-icon-2xl far fa-question-circle"></i>
        </div>
        <div class="text-value-lg">{{$exam->questions()->count()}}</div><small class="text-muted text-uppercase font-weight-bold">{{__('Questions')}}</small>
        <div class="progress progress-xs mt-3 mb-0">
        <div class="progress-bar bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
        <div class="text-muted text-right mb-4">
            <i class="c-icon c-icon-2xl far fa-question-circle"></i>
        </div>
        <div class="text-value-lg">{{$exam->negative_mark ? ($exam->negative_mark/100): __("No") }}</div><small class="text-muted text-uppercase font-weight-bold">{{__('Negative Mark')}}</small>
        <div class="progress progress-xs mt-3 mb-0">
        <div class="progress-bar bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        </div>
    </div>

    <div class="card">
    <div class="card-body">
    <div class="text-muted text-right mb-4">
        <i class="c-icon c-icon-2xl far fa-calendar-alt"></i>
    </div>
    <div class="text-value-lg">{{$exam->end_date->toDayDateTimeString()}}</div><small class="text-muted text-uppercase font-weight-bold">{{__('End Date')}}</small>
    <div class="progress progress-xs mt-3 mb-0">
    <div class="progress-bar bg-danger" role="progressbar" style="width:100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    </div>
    </div>
</div>
