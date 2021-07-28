<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Tasks For
                    developers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('task_create') }}" method="POST" id="frmTask">
                    @csrf
                    <div class="from-group row">
                        <label for="task_title" class="col-md-12 col-form-label ">Task
                            Title</label>

                        <div class="col-md-12">
                            <input id="task_title" type="text"
                                class="form-control @error('task_title') is-invalid @enderror" name="task_title"
                                value="{{ old('task_title') }}" required autocomplete="task_title" autofocus>

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

                            <textarea id="" cols="30" rows="4"
                                class="form-control @error('task_desc') is-invalid @enderror" name="task_desc"
                                value="{{ old('task_desc') }}" required></textarea>

                            @error('task_desc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="start_time" class="col-12">Start time:</label>
                        <div class="input-group date col-12" id="reservationdatetime" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input"
                                data-target="#reservationdatetime" id="joined-date" />
                            <div class="input-group-append" data-target="#reservationdatetime"
                                data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="end_time" class="col-12">End time:</label>
                          <div class="input-group date col-12" id="reservationdatetime1" data-target-input="nearest">
                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime"/>
                              <div class="input-group-append" data-target="#reservationdatetime1" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                      </div>
                    <div class="form-group row">
                        <label for="mention_dev" class="col-md-12 col-from-label ">
                            Developers mention
                        </label>
                        <div class="col-md-12">
                            <input type="text" name="developers_mention[]" class="mention col-md-12"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Save changes</button>
            </div>
        </div>
    </div>
</div>
