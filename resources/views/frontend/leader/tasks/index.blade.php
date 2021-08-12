@extends('layouts.frontend.app')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.atwho.css') }}">
    <style>
        .datetimepicker {
            z-index: 9999;
        }

        .td-actions .btn {
            margin: 5px;
        }

    </style>
    <script>
        function submitForm() {

            document.getElementById('frmTask').submit();
        }
    </script>
@endsection

@php
$idToEditTask = '';
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">DataTable with default features</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <button class="btn btn-primary" type="button" data-toggle="modal"
                                    data-target="#CreateModal">Create Task</button>

                                {{-- Create Modal --}}
                                <div class="modal fade" id="CreateModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    @include('frontend.leader.tasks.form')
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Save
                                                            changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Of Create Modal --}}
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search"
                                            class="form-control form-control-sm" placeholder=""
                                            aria-controls="example1"></label></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                    role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Rendering engine: activate to sort column descending">Task
                                                Title</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1" aria-label="Browser: activate to sort column ascending">Task
                                                Description
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                Start Time</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1" aria-label="Engine version: activate to sort column ascending">
                                                End time</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                Remaining time</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                Devlopers</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                Control</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <td>{{ $task->task_title }}</td>
                                                <td>{{ $task->task_desc }}</td>
                                                <td>{{ strftime($task->start_time) }}</td>
                                                <td>{{ strftime($task->end_time) }}</td>
                                                <td>{{ date_diff(new DateTime($task->start_time), new DateTime($task->end_time))->format('%d days, %h hours and %i minuts') }}
                                                </td>
                                                <td>
                                                    @if (count($task->users))
                                                        @foreach ($task->users as $dev)
                                                            <div>{{ $dev->name }}</div>
                                                        @endforeach
                                                    @else
                                                        <p>Not assigned</p>
                                                    @endif
                                                </td>
                                                <td class="td-actions">
                                                    <button class="btn btn-primary btn-sm load-form-modal"
                                                        data-toggle="modal" data-target="#Edit{{ $task->id }}">
                                                        <i class="material-icons">
                                                            edit
                                                        </i>
                                                    </button>
                                                    <form action="{{ route('tasks_destroy', ['id' => $task->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        {{ method_field('delete') }}
                                                        <button type="submit" rel="tooltip" title=""
                                                            class="btn btn-danger btn-sm btn-inline"
                                                            data-original-title="Remove task">
                                                            <i class="material-icons">
                                                                close
                                                            </i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            {{-- Edit Modal --}}
                                            <div class="modal fade" id="Edit{{ $task->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Tasks Of
                                                                developers</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('tasks_edit', ['id' => 1]) }}"
                                                                method="POST" class="frmTask1">
                                                                
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $task->id }}">
                                                                @include('frontend.leader.tasks.form')
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-success">Update
                                                                        changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- End Of Edit Modal --}}
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1
                                    to 10 of entries</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                    {{ $tasks->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('js/caret.js') }}"></script>
    <script src="{{ asset('js/jquery.atwho.js') }}"></script>
    <script>
        $(function() {

            $.get("{{ route('get_developers') }}", function(developers) {
                $('input.mention').atwho({
                    at: '@',
                    data: developers,
                });
            });


        });
    </script>
@endsection
