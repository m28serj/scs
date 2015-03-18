@extends('layouts/default')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-body" id="form-container">
                {!! Form::open(['id' => 'user-data', 'url' => 'login','method' => 'POST', 'class' => 'form-horizontal'])
                !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group clearfix">
                            {!! Form::label('locale', 'Язык:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::select('locale', $locales->lists('name', 'code'), null, ['class' =>
                                'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            {!! Form::label('group', 'Группа:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                @foreach($groups as $group)
                                    <label class="radio-inline">
                                        {!! Form::radio('group', $group->id, null) !!} {{$group->id}}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            {!! Form::label('interval', 'Периодичность:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::select('interval', $periodicities->lists('name_' . App::getLocale(), 'interval'), null, ['class' =>
                                'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group clearfix">
                            {!! Form::label('year', 'Год:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::text('year', '2015', ['class' => 'form-control datepicker year']) !!}
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            {!! Form::label('date_from', 'Дата (от):', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::text('date_from', '01.01.2015', ['class' => 'form-control datepicker date'])
                                !!}
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            {!! Form::label('date_to', 'Дата (до)', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::text('date_to', '01.01.2016', ['class' => 'form-control datepicker date']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    {!! Form::submit('Отправить', ['class' => 'btn btn-default pull-right']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div id="messages-container"></div>
@stop

@section('styles')
    {!! HTML::style(asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')) !!}
@stop

@section('scripts')
    {!! HTML::script(asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')) !!}
    {!! HTML::script(asset('plugins/bootstrap-datepicker/locales/bootstrap-datepicker.ru.min.js')) !!}
    <script>
        $(function () {
            var form = $('form#user-data');

            $('input[type=radio]:first', this).attr('checked', 'checked');

            form.on('submit', function (event) {
                $('label.error').remove();
                event.preventDefault();
                $.ajax({
                    url: "/messages",
                    type: "POST",
                    dataType: "json",
                    data: form.serialize(),
                    success: function (response) {
                        var count = 0;
                        var output = "<div class='row'>";
                        $.each(response.data, function () {
                            count++
                        });

                        $.each(response.data, function (key, messageGroup) {
                            output += "<div class='col-md-" + (12 / count) + "'>";
                            $.each(messageGroup, function (i, message) {
                                output += "<div class='alert alert-success'>" + message + "</div>";
                            });
                            output += "</div>";
                        });
                        output += "</div>";
                        $('#messages-container').html(output);
                    },
                    error: function (response) {
                        $.each(response.responseJSON, function (key, item) {
                            $("#" + key).after("<label class='error'>" + item + "</label>");
                        });
                    }
                });
            });

            $('.datepicker.date').datepicker({
                format: 'dd.mm.yyyy',
                startView: 1,
                orientation: "top right"
            });

            $('.datepicker.year').datepicker({
                format: 'yyyy',
                startView: 2,
                minViewMode: 2,
                orientation: "top right"
            })

        });
    </script>
@stop
