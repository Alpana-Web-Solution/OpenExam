<div>
    <div class="row mb-3">
        <div class="col-md-1">
            <select class="custom-select" wire:model='nos_of_qtn_per_page' name="nos_of_qtn_per_page" id="nos_of_qtn_per_page">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-6">
                    <input wire:model="filters.search" class="form-control" type="text" placeholder="{{__("Search Questions")}}...">
                </div>
                <div class="col-md-6">
                    <button wire:click="resetSearch()" class="btn btn-clear btn-sm">{{__("Reset Search")}}</button>
                    <button wire:click="$toggle('showFilters')" class="btn btn-clear btn-sm">
                        @if($showFilters)
                        {{__('Hide')}}
                        @endif
                        {{__('Advance Search')}}</button>

                </div>
            </div>

                <div class="row my-2" style="visibility: ">
                    @if ($showFilters)
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="subject"  class="label label-required">{{__("Question Subject")}}</label>
                                <select wire:model="filters.subject_id" id="subject" name="subject" class="subject select2 custom-select" required>
                                    <option value="" disabled>{{__('Select Subject.')}}</option>
                                    @foreach ($subjectList as $parentSubject )
                                    <option value="{{$parentSubject->id}}">{{$parentSubject->name}}</option>
                                    @foreach ($parentSubject->childSubjects as $subjectValue)
                                    <option value="{{$subjectValue->id}}">-{{$subjectValue->name}}</option>
                                        @foreach ($subjectValue->childSubjects as $subSubjectLbl2)
                                        <option value="{{$subSubjectLbl2->id}}">--{{$subSubjectLbl2->name}}</option>
                                        @endforeach
                                    @endforeach
                                    @endforeach
                                </select>

                                <div class="form-group ">
                                    <label for="difficulty" class="label label-required">{{__("Difficulty")}}</label>
                                      <select wire:model='filters.difficulty' id="difficulty" name="difficulty" class="custom-select">
                                        <option value="" disabled>{{__('Select Difficulty.')}}</option>
                                        <option value="1">{{__('Simple')}}</option>
                                        <option value="2">{{__('Medium')}}</option>
                                        <option value="3">{{__('Hard')}}</option>
                                      </select>
                                  </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col">
                                <x-form.text-input
                                    label="{{__('From')}}"
                                    wire:model="filters.start_date"
                                    name="start_date"
                                    id="start_date"
                                    type=date
                                    value="{{ old('start_date') }}"
                                    placeholder="{{__('Please input a Date')}}"
                                    addClass='form-control datetime shadow-sm'
                                    error="$errors->first('start_date')"
                                    required />
                            </div>
                            <div class="col mt-1">
                                <x-form.text-input
                                    label="{{__('Before')}}"
                                    wire:model="filters.end_date"
                                    name="end_date"
                                    id="end_date"
                                    type=date
                                    value="{{ old('end_date')}}"
                                    placeholder="{{__('Please input a Date')}}"
                                    addClass='form-control datetime shadow-sm'
                                    error="$errors->first('end_date')"
                                    required />
                            </div>

                        </div>
                        <div class="col-sm-12">

                                <div class="form-group ">
                                    <label for="sort" class="label label-required">{{__("Sort by Field")}}</label>
                                      <select wire:model='sort.field' id="sort_field" name="sort_field" class="custom-select">
                                        <option value="created_at">{{__('Question Created')}}</option>
                                        <option value="id">{{__('Question ID')}}</option>
                                      </select>
                                  </div>
                                  <div class="form-group ">
                                    <label for="sort" class="label label-required">{{__("Sort by ")}}</label>
                                      <select wire:model='sort.direction' id="sort_direction" name="sort_direction" class="custom-select">
                                        <option value="desc">{{__('Descending')}}</option>
                                        <option value="asc">{{__('Ascending')}}</option>
                                      </select>
                                  </div>


                        </div>

                    </div>

                    @endif
                </div>

        </div>
        <div class="col-md-4 float-right">
            <div class="row">
                <div class="col-md-8 mb-2">
                    {{__('Total Questions')}} : {{count($addedQuestions)}}
                    <br>
                    {{__("Per Question Point")}} : {{$exam->default_mark}}
                    <br>
                </div>
                <div class="col-md-7">
                    <label >{{__("Hide Added Questions?")}} </label>
                </div>
                <div class="col-md-1">
                    <label class="c-switch c-switch-label c-switch-pill c-switch-opposite-info">
                    <input wire:model="doNotShowAddedQuestions" type="checkbox" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
                  </label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <label >{{__("Show Notifications?")}} </label>
                </div>
                <div class="col-md-1">
                    <label class="c-switch c-switch-label c-switch-pill c-switch-opposite-info">
                    <input wire:model="showConfirmationDialouge" type="checkbox" class="c-switch-input">
                    <span class="c-switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
                  </label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1">
                    <button
                        wire:click="resetQuestions()"
                        class="btn btn-pill btn-sm btn-danger"
                        onclick="return confirm('Are you sure you want to Remove all questions from this exam?')">
                        {{__('Remove All Questions From Exam!')}}
                    </button>
                </div>

            </div>
        </div>

    </div>
    <table class="table table-responsive-sm table-hover table-outline mb-0">
        <thead>
          <tr>
            <th>
                <div>
                    <input type="checkbox" class="form-checkbox " wire:model='selectPage'/>
                    <button wire:click="addSelected()"  class="btn btn-pill btn-sm btn-primary" ><i class="fa fa-plus" aria-hidden="true"></i></button>
                    <button wire:click="removeSelected()"  class="btn btn-pill btn-sm btn-danger" ><i class="fa fa-trash m-0" aria-hidden="true"></i></button>
                </div>
            </th>
            <th>{{__('ID')}}</th>
            <th>{{__('Question')}}</th>
            <th>{{__('Action')}}</th>
          </tr>
        </thead>
        <tbody>
          @forelse($questions as $question)
          <tr>
            <td>
                <div>
                    <input  type="checkbox" class="form-checkbox-questions" wire:model="selected" value="{{$question->id}}" />
                </div>
            </td>
            <td class="sortable">{{$question->id}}</td>
            <td>{{\Str::limit($question->question, 80, '...')}}</td>
            <td>
                @if (in_array($question->id,$addedQuestions))
                <button wire:click="removeFromExam('{{$question->id}}')"  class="btn btn-pill btn-sm btn-danger" ><i class="fa fa-trash m-0" aria-hidden="true"></i></button>
                @else
                <button wire:click="addToExam('{{$question->id}}')"  class="btn btn-pill btn-sm btn-primary" ><i class="fa fa-plus" aria-hidden="true"></i></button>
                @endif
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="2">{{__('Sorry ! No Data Found.')}}</td>
          </tr>
          @endforelse
        </tbody>
      </table>
      <div class="row my-2  content-center">
          {{$questions->links()}}
      </div>
      <div class="row my-2  content-center">
        Showing {{ $questions->firstItem() }} to {{ $questions->lastItem() }} out of {{ $questions->total() }} results
      </div>
</div>
