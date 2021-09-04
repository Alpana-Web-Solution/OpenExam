<tr>
    <td class="text-center">

      <div class="c-avatar">
        @if (!empty($usersAnswer[$question->id]))
            @if ($usersAnswer[$question->id] == $question->answer )
            <i style="color: green;" class="fa fa-check-circle fa-3x" aria-hidden="true"></i>
            @else
            <i style="color: red;" class="fa fa-times-circle fa-3x" aria-hidden="true"></i>
            @endif
        @else
        <i style="color: red;" class="fa fa-times-circle fa-3x" aria-hidden="true"></i>
        @endif
        </div>
    </td>
    <td>
      <div>{{$question->question}}</div>
      <div class="small text-muted mt-1">
        <button type="button" class="btn btn-primary btn-sm btn-pill" data-toggle="modal" data-target="#questionModel{{$loop->iteration}}">
            {{__("Details")}}
          </button>
          <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="questionModel{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="questionModel{{$loop->iteration}}Label" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="questionModel{{$loop->iteration}}Label">{{$question->question}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <strong>
                        {{__("Correct Answer")}}
                        <p>{{$question->options[$question->answer]}}</p>
                    </strong>
                <p>
                    {!! $question->help !!}
                </p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("Close")}}</button>
                </div>
            </div>
            </div>
        </div>
    </div>
    </td>
    <td class="text-center">
        @if(in_array($question->id,$usersAnsweredQuestionArray))
        {{$question->options[$usersAnswer[$question->id]]}}
        @else
            {{__("Not Answered!")}}
        @endif
    </td>
    <td>
        <strong>{{$usersTime[$question->id] ?? "N/A"}} {{__("Sec")}}</strong>
    </td>
    <td>
        <a class="btn btn-pill btn-warning btn-sm text-white" href="{{route('user.question.reportform',[$result->id,$question->id])}}">{{__('Report')}}</a>
    </td>
  </tr>
