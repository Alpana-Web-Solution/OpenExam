<div class="row">
    <div class="col-md-12">
        <x-form.text-input
            label="{{__('Examination Name')}}"
            name="name"
            placeholder="{{__('Please input a Name')}}"
            addClass='form-control shadow-sm'
            error="$errors->first('name')"
            value="{{$name ?? ''}}"
            required />
    </div>
    <div class="col-md-12 my-2">
            <div class="form-group">
                <label for="textarea">{{__('Description')}}</label>
                <textarea id="description" name="description" cols="40" rows="5" class="form-control @error('description') is-invalid  @enderror"">{{old('description', ($description ?? ''))}}</textarea>
              </div>
            @error('description')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <x-form.text-input
            label="{{__('Examination Start Date')}}"
            name="start_date"
            id="start_date"
            value="{{ old('start_date', \Carbon\Carbon::parse($start_date ?? now())->toDateTimeString()) }}"
            placeholder="{{__('Please input a Date')}}"
            addClass='form-control datetime shadow-sm'
            error="$errors->first('start_date')"
            required />
    </div>
    <div class="col-md-6">
        <x-form.text-input
            label="{{__('Examination End Date')}}"
            name="end_date"
            id="end_date"
            value="{{ old('end_date', (!empty($end_date)) ? \Carbon\Carbon::parse($end_date)->toDateTimeString():'')}}"
            placeholder="{{__('Please input a Date')}}"
            addClass='form-control datetime shadow-sm'
            error="$errors->first('end_date')"
            required />
    </div>
</div>
<div class="row my-2">
    <div class="col-md-4 ">
    <div class="form-group">
        <label for="duration">{{__('Examination Duration')}}</label>
        <div class="input-group">
            <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fa fa-hourglass-start"></i>
            </div>
            </div>
            <input type="number" id="duration" name="duration" type="text" class="form-control shadow-sm @error('duration') is-invalid  @enderror" value="{{old('duration', ($duration ?? 300))}}" required>
            <div class="input-group-append">
            <div class="input-group-text">{{__('In Seconds')}}</div>
            </div>
            @error('duration')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        </div>
    </div>
    <div class="col-md-4">
        <x-form.text-input
            label="{{__('Examination Total Marks')}}"
            name="total_marks"
            type='number'
            placeholder="{{__('Please input total marks')}}"
            addClass='form-control shadow-sm'
            value="{{$total_marks ?? ''}}"
            error="$errors->first('total_marks')"
            required />
    </div>
    <div class="col-md-4">
        <x-form.text-input
            label="{{__('Per Question Default Mark')}}"
            name="default_mark"
            type='number'
            value="{{$default_mark ?? ''}}"
            placeholder="{{__('Please input a default mark')}}"
            addClass='form-control shadow-sm'
            error="$errors->first('default_mark')"
            required />
    </div>
</div>
<hr>
<div class="row my-4">
    <div class="col-md-4">
            <div class="form-group">
                <label for="duration">{{__('Negative Mark ?')}}</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-minus"></i>
                    </div>
                  </div>
                  <input type="number" aria-describedby="negativeMarkingHelpBlock" id="negative_mark" name="negative_mark" type="text" class="form-control shadow-sm @error('negative_mark') is-invalid  @enderror" value="{{old('negative_mark') ??($negative_mark ?? 0)}}" required>
                  <div class="input-group-append">
                    <div class="input-group-text">{{__('/ 100')}}</div>
                  </div>
                </div>
                <span id="negativeMarkingHelpBlock" class="form-text text-muted">{{__("Example : 100/100 =1, 25/100 = 0.25, 50/100 = 0.50, 0 = No negative marks")}}</span>
                @error('negative_mark')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
    </div>

<div class="col-md-4">
        <div class="form-group ">
            <label for="publish_result" class="label label-required">{{__("Publish Result ?")}}</label>
              <select  id="publish_result" name="publish_result" class="custom-select shadow-sm">
                <option value="1" {{(!empty($publish_result) AND ($publish_result == 1))? 'selected':''}}>{{__('Immidiately after exam ends')}}</option>
                <option value="2" {{(!empty($publish_result) AND ($publish_result == 2))? 'selected':''}}>{{__('After End Date')}}</option>
                <option value="3" disabled>{{__('Manually')}}</option>
              </select>
          </div>
    </div>
</div>

<div class="row my-4">
    <div class="col-md-12 my-2">
            <div class="form-group">
                <label for="textarea">{{__('Instruction')}}</label>
                <textarea id="instruction" name="instruction" cols="40" rows="5" class="form-control @error('instruction') is-invalid  @enderror"">{{old('instruction', ($instruction ?? ''))}}</textarea>
              </div>
            @error('instruction')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
    </div>
</div>
<div class="form-group row">
    <div class="col-md-6  text-md-right">
        <label for="attend_negative_marking">{{__("Only attended questions have negative marking?")}}</label>
        </div>
        <div class="col-md-6">
        <label class="c-switch c-switch-label c-switch-pill c-switch-opposite-info">
            <input type="checkbox" class="c-switch-input"
            @if (!empty($attend_negative_marking)) checked @endif name='attend_negative_marking' id="attend_negative_marking">
            <span class="c-switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
          </label>
        </div>
</div>
<div class="form-group row">
    <div class="col-md-6  text-md-right">
        <label for="attend_negative_marking">{{__("Randomise Question Order")}}</label>
        </div>
        <div class="col-md-6">
        <label class="c-switch c-switch-label c-switch-pill c-switch-opposite-info">
            <input type="checkbox" class="c-switch-input"
            @if (!empty($randomise_questions)) checked @endif name='randomise_questions' id="randomise_questions">
            <span class="c-switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
          </label>
        </div>
</div>
