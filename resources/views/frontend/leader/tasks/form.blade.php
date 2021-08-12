@php

// default values
$StartDate = new DateTime();
$EndDate = new DateTime('2025-12-31 23:15:40');

// time of task to edit
if (isset($task->start_time)) {
    $StartDate = new DateTime($task->start_time);
}
if (isset($task->end_time)) {
    $EndDate = new DateTime($task->end_time);
}
$arrayOfDevelopers = '';
if (isset($task->users) && count($task->users)) {
    for ($i = 0; $i < count($task->users); $i++) {
        $arrayOfDevelopers .= '@' . $task->users[$i]->name . ' ';
    }
}
@endphp

<div class="from-group row">
    <label for="task_title" class="col-md-12 col-form-label ">Task
        Title</label>

    <div class="col-md-12">
        <input type="text" class="form-control @error('task_title') is-invalid @enderror" name="task_title"
            value="{{ isset($task->task_title) ? $task->task_title : '' }}" required autocomplete="task_title"
            autofocus>

        @error('task_title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="from-group row">
    <label for="task_desc" class="col-md-12 col-form-label ">Task
        Description</label>

    <div class="col-md-12">

        <textarea cols="30" rows="4" class="form-control @error('task_desc') is-invalid @enderror" name="task_desc"
            required>{{ isset($task->task_desc) ? $task->task_desc : '' }}</textarea>
        @error('task_desc')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="start_time" class="col-12">Start time:</label>
    <div class="input-group date col-12" data-target-input="nearest" class="reservationdatetime">
        <input type="datetime-local" class="form-control" data-target=".reservationdatetime" name="start_time"
            value="{{ $StartDate->format('Y-m-d\TH:i:s') }}" />
    </div>
</div>
<div class="form-group row">
    <label for="end_time" class="col-12">End time:</label>
    <div class="input-group date col-12" class="reservationdatetime1" data-target-input="nearest">
        <input type="datetime-local" class="form-control" data-target=".reservationdatetime" name="end_time"
            value="{{ $EndDate->format('Y-m-d\TH:i:s') }}" />
    </div>
</div>
<div class="form-group row">
    <label for="mention_dev" class="col-md-12 col-from-label ">
        Developers mention
    </label>
    <div class="col-md-12">
        <input type="text" name="developers_mention[]" class="mention col-md-12"
            value="{{ !isset($task->users) ? '' : $arrayOfDevelopers }}">
    </div>
</div>
