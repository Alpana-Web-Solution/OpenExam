<div>
    <form wire:submit.prevent>
        @csrf
        <div class="row">
            <div class="col-sm-6">
                    <label for="subject" class="label label-required">{{__("Question Subject")}}</label>
                        <select wire:model.defer="subject_id"  id="subject_id" name="subject_id" class="custom-select" required>
                            <option value="">-- {{__("Select A Subject")}} --</option>
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
            @error('subject_id') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-sm-3">
                <x-form.text-input  wire:model.defer='point'
                 label="Point"
                  type='number'
                   name="point"
                    placeholder="{{__('Per Question Point')}}"
                     addClass='form-control' required />
            </div>
            <div class="col-sm-3">
                <div class="form-group ">
                    <label for="difficulty" class="label label-required">{{__("Difficulty")}}</label>
                      <select wire:model.defer='difficulty' id="difficulty" name="difficulty" class="custom-select">
                        <option value="1">{{__('Simple')}}</option>
                        <option value="2">{{__('Medium')}}</option>
                        <option value="3">{{__('Hard')}}</option>
                      </select>
                  </div>
            </div>
        </div>
        <hr>
        <x-form.text-input
            wire:model.defer='question'
            label="Question"
            name="question"
            placeholder="{{__('Please input a Question')}}"
            addClass='form-control'
            required
            error="$errors->first('question')"
        />
    </span>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <x-form.text-input wire:model.defer='options.1'
             label="Option 1" name="option[1]"
              placeholder="{{__('Option')}}"
               addClass='form-control'
                required />
        </div>
        <div class="col-md-6">
            <x-form.text-input wire:model.defer='options.2'
             label="Option 2"
              name="option[2]"
               placeholder="{{__('Option')}}"
                addClass='form-control'
                 required />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <x-form.text-input wire:model.defer='options.3'
             label="Option 3"
              name="option[3]"
               placeholder="{{__('Option')}}"
                addClass='form-control'
                 required />
        </div>
        <div class="col-md-6">
            <x-form.text-input wire:model.defer='options.4'
             label="Option 4"
              name="option[4]"
               placeholder="{{__('Option')}}"
                addClass='form-control'
                 required />
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-6">
        <div class="form-group ">
            <label for="answer" class="label label-required">{{__("Answer")}}</label>
              <select wire:model.defer='answer' id="answer" name="answer" class="custom-select">
                <option value="1">{{__('Option 1')}}</option>
                <option value="2">{{__('Option 2')}}</option>
                <option value="3">{{__('Option 3')}}</option>
                <option value="4">{{__('Option 4')}}</option>
              </select>
          </div>
        </div>
    </div>
    <hr>
    <div class="col-md-12 my-2">
        <div class="form-group">
            <label for="textarea">{{__('Help')}}</label>
            <textarea wire:model.defer='help'
            id="help" name="help"
            placeholder="{{__("Leave it blank if you dont have an other details to provide")}} "
            class="form-control @error('help') is-invalid  @enderror">
            {{old('help', ($help ?? ''))}}
        </textarea>
          </div>
        @error('help')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
    </div>
    <hr>

    <p>{{__("Select Tags For The Examination.")}}</p>
        <div wire:ignore>
            <select class="form-control select2" id="tagSelector" multiple>
                @foreach($allTags as $key => $tagName)
                <option value="{{ $key }}">{{ $tagName }}</option>
                @endforeach
            </select>
        </div>
    <hr>
    <button wire:click='createAnother()' type="submit" class="btn btn-pill btn-primary">{{__('Save & Add Another')}}</button>
    <button wire:click='save()' class="btn btn-pill btn-primary">{{__('Save')}}</button>
    </form>
</div>


@push('scripts')

<script>

    $(document).ready(function() {

        $('#tagSelector').select2();

        $('#tagSelector').on('change', function (e) {

            var data = $('#tagSelector').select2("val");

            @this.set('tags', data);

        });

    });
    ClassicEditor
    .create( document.querySelector( '#help' ) )
    .catch( error => {
        console.error( error );
    } );

</script>

@endpush

