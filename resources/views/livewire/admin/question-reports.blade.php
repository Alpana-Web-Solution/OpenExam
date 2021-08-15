<div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{__("Question Reports")}}

            </div>
    <div class="card-body">
        <table class="table table-responsive-sm table-hover table-outline mb-0">
            <thead>
                <tr>
                <th>{{__('ID')}}</th>
                <th>{{__('Report')}}</th>
                <th>{{__('Action')}}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $report)
                <tr>
                <td>{{$report->id}}</td>
                <td>{{$report->report}}</td>
                <td>
                        <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.question.show',$report->question_id)}}">{{__('Show Question')}}</a>
                        <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.question.edit',$report->question_id)}}">{{__('Edit Question')}}</a>
                        <button wire:click="deleteReport({{$report->id}})"
                            class="btn btn-pill btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to Delete')">
                            {{__('Delete Report')}}
                        </button>
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
                {{$reports->links()}}
            </div>
            </div>
        </div>
    </div>
</div>
