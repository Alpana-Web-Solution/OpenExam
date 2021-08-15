<div>
    <div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }}">
        <label for="subjectName" class="col-md-3 col-form-label text-md-right">{{ __('Subject Name') }}</label>

        <div class="col-md-6">
            <input wire:model.defer='subjectName' id="subjectName" type="text" class="form-control @error('subjectName') is-invalid @enderror" name="subjectName" value="{{ old('subjectName') }}" autocomplete="subjectName" autofocus >
    @error('subjectName')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
        </span>
        @enderror
        </div>

    </div>
     <div class="form-group row {{ $errors->has('subjectCode') ? 'has-error' : '' }}">
                      <label for="subjectCode" class="col-md-3 col-form-label text-md-right">{{ __('Subject Code') }}</label>

      <div class="col-md-6">
       <input wire:model.defer='subjectCode' id="subjectCode" type="text" class="form-control @error('subjectCode') is-invalid @enderror" name="subjectCode" value="{{ old('subjectCode') ?? $subjectCode }}" autocomplete="subjectCode" autofocus >

       @error('subjectCode')
           <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
           </span>
         @enderror
     </div>

    </div>
     <div class="form-group row {{ $errors->has('subjectDescription') ? 'has-error' : '' }}">
        <label for="subjectDescription" class="col-md-3 col-form-label text-md-right">{{ __('Subject Description') }}</label>

      <div class="col-md-6">
       <input wire:model.defer='subjectDescription' id="subjectDescription" type="text" class="form-control @error('subjectDescription') is-invalid @enderror" name="subjectDescription" value="{{ old('subjectDescription') ?? $subjectDescription }}" autocomplete="subjectDescription" autofocus >

       @error('subjectDescription')
           <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
           </span>
         @enderror
     </div>
    </div>

<div class="form-group row">
    <div class="col-md-3 text-md-right">
    <label class="text-md-right">{{__("Add Parent Subject ?")}} </label>
    </div>
    <div class="col-md-6">
    <label class="c-switch c-switch-label c-switch-pill c-switch-opposite-info">
        <input wire:model="hasParent" type="checkbox" class="c-switch-input">
        <span class="c-switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
      </label>
    </div>
    </div>
    {{-- Parent input --}}
    @if(!empty($hasParent))
        <div class="form-group row">
            <label for="parent" class="col-3 col-form-label text-md-right">{{__("Parent Subject")}}</label>
            <div class="col-6">
                <select wire:model.defer='parentId' id="parent" name="parent" class="parent select2 custom-select">
                    <option value="">{{__("Please Select")}}</option>
                    @foreach ($parentSubjectList as $parentSubject )
                    <option value="{{$parentSubject->id}}">{{$parentSubject->name}}</option>
                    @foreach ($parentSubject->childSubjects as $subjectValue)
                    <option value="{{$subjectValue->id}}">-{{$subjectValue->name}}</option>
                        @foreach ($subjectValue->childSubjects as $subSubjectLbl2)
                        <option value="{{$subSubjectLbl2->id}}">--{{$subSubjectLbl2->name}}</option>
                        @endforeach
                    @endforeach
                    @endforeach
                </select>
            </div>
            </div>
    @endif
    <button wire:click='addSubject' class="btn btn-pill btn-primary btn-sm">{{__("Save")}}</button>
    <button wire:click='resetInput' class="btn btn-pill btn-primary btn-sm" >{{__('Reset')}}</button>
</div>
