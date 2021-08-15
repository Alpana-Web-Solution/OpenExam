<div class="row justify-content-center">
    <div class="col-sm-8">
        <div class="card shadow">
            <div class="card-header">
                <div class="card-header-actions">

                    <button class="btn btn-pill btn-warning text-white" wire:click="skipQuestion()">{{__("Skip")}}</button>
                    </div>
                    {{$questionDetails->question}}
            </div>
            <div class="card-body">
                {{-- {{$time}} --}}

                <form wire:submit.prevent='addAnswerResponse()'>
                    @foreach ($questionDetails->options as $key=> $option)
                    <div class="custom-control custom-radio m-3">
                        <input wire:model.defer='usersAnswer' name="option" id="option_{{$key}}" type="radio" class="custom-control-input" value="{{$key}}">
                        <label for="option_{{$key}}" class="custom-control-label">{{$option}}</label>
                        </div>
                    @endforeach

                    <div class="content-center m-0">
                        @error('usersAnswer') <span class="error content-cecnter"><h5>{{ $message }}</h5></span> @enderror
                    </div>
                <button class="btn btn-pill btn-success" type="submit">
                    <div wire:loading>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </div>
                    <div wire:loading.remove>
                        {{__("Save & Next")}}
                    </div>
                </button>

                </form>

            </div>
        </div>
    </div>
    <div class="col-sm-4 m-0">
        <div class="card">
            <div class="card-header">
                    <div class="card-header-actions ml-3">
                        <button class="btn btn-pill btn-danger text-white" wire:click="finishExam()">{{__("Finish")}}</button>
                    </div>
                    <div class="progress-group">
                        <div class="progress-group-header">
                            <i class="c-icon progress-group-icon far fa-question-circle"></i>
                            <div> {{__('Completed')}}</div>
                            <div class="ml-auto font-weight-bold">{{$progress}}%</div>
                        </div>
                        <div class="progress-group-bars">
                            <div class="progress progress-xs">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{$progress}}%" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-body">
                <h5>{{__("Jump To Question")}}</h5>
                @foreach ($examQuestions as $key => $questionId)
                <button  class="m-1 btn btn-pill @if($loop->index == $currentQuestion) btn-primary  @else btn-success @endif" wire:click="jumpToQuestion({{$loop->index}})">{{$loop->iteration}}</button>
                @endforeach
            </div>
        </div>
    </div>
</div>
