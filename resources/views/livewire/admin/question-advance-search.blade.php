
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.question.create')}}">{{trans('Create A Question')}}</a>
            <div class="card-header-actions">
                <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.question.importform')}}">{{__('Import / Export Questions')}}</a>
                    <a class="btn btn-pill btn-danger btn-sm" href="{{route('admin.question.trash')}}">{{__('Trash')}}</a>
                    @if (count($selected))
                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                        <button class="btn btn-pill btn-danger" wire:click="deleteSelected()" type="button">{{__('Bulk Delete')}}</button>
                        <button class="btn btn-pill btn-secondary" type="button">{{__('Bulk Export')}}</button>
                    </div>
                    @endif
        </div>
        </div>
        <div class="card-body">
            <div class="card card-body shadow-sm">
                <div class="row">
                    <div class="col-md-2">
                        <select class="custom-select" wire:model='nos_of_qtn_per_page' name="nos_of_qtn_per_page" id="nos_of_qtn_per_page">
                            <option value="10">{{__("10")}}</option>
                            <option value="25">{{__("25")}}</option>
                            <option value="50">{{__("50")}}</option>
                            <option value="100">{{__('100')}}</option>
                        </select>
                    </div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-8">
                                <input wire:model.debounce.500ms="filters.search" class="form-control" type="text" placeholder="{{__("Search Questions")}}...">
                            </div>
                            <div class="col-md-4">
                                <button wire:click="resetSearch()" class="btn btn-pill btn-clear btn-sm">{{__("Reset Search")}}</button>
                                <button wire:click="$toggle('showFilters')" class="btn btn-pill btn-clear btn-sm">
                                    @if($showFilters)
                                    {{__('Hide')}}
                                    @endif
                                    {{__('Advance Search')}}</button>
                            </div>
                        </div>

                        <div class="my-2">
                            @if ($showFilters)
                            <div class="row">
                                <div class="col-sm-4">
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
                                <div class="col-sm-4">
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
                                <div class="col-sm-4">
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
                </div>
            </div>
        <table class="table table-responsive-sm table-hover table-outline mb-0">
        <thead>
            <tr>
                <th>
                    <div>
                        <input type="checkbox" class="form-checkbox " wire:model='selectPage'/>
                        @if (!empty($selected))
                        <button wire:click="deleteSelected()"  class="btn btn-pill btn-sm btn-danger" >
                            <i class="fa fa-trash m-0" aria-hidden="true"></i>
                        </button>
                        @endif
                    </div>
                </th>
            <th>{{__('ID')}}</th>
            <th>{{__('Question')}}</th>
            <th>{{__('Subject')}}</th>
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
            <td>{{$question->id}}</td>

            <td>{{\Str::limit($question->question, 75, '...')}}</td>
            <td>{{$question->subject->name}}</td>
            <td>
                <form action="{{ route('admin.question.destroy',[$question->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.question.show',$question->id)}}">{{__('Show')}}</a>
                    <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.question.edit',$question->id)}}">{{__('Edit')}}</a>
                    <button type="submit"  class="btn btn-pill btn-sm btn-danger" onclick="return confirm('Are you sure you want to Delete')">{{__('Delete')}}</button>
                </form>
            </td>
            </tr>
            @empty
            <tr>
            <td colspan="2">{{__('Sorry ! No Data Found.')}}</td>
            </tr>
            @endforelse
        </tbody>
        </table>
        <div class="row content-center">
            <div class="mt-2">
                {{$questions->links()}}
            </div>
        </div>
        </div>
        <div class="card-footer">
                <a class="btn btn-pill btn-primary" href="{{route('admin.dashboard')}}">{{__('Back')}}</a>
        </div>
    </div>
</div>
