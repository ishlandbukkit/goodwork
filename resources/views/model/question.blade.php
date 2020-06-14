<div class="form-group {{ $errors->has('question_'.$question->name) ? ' has-error' : '' }}">
    <label for="name">{{ $question->tittle }}</label>
    <input type="text"
           class="form-control {{ $errors->has('question_'.$question->name) ? ' is-invalid' : '' }}"
           id="name" name="name" value="{{ old('question_'.$question->name) ? old('question_'.$question->name) : '' }}"
           required autofocus>
    @if ($errors->has('question_'.$question->name))
        <div class="invalid-feedback">{{ $errors->first('question_'.$question->name) }}</div>
    @endif
</div>
