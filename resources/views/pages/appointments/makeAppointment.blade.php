@extends('app')

@section('content')

    <div class="container">
        <form class="form-horizontal" action="<?= URL::route('make_lawyer_appointment_post'); ?>" method="POST">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! csrf_field() !!}
            <fieldset>

                <!-- Form Name -->
                <legend>Please choose a date for appointment with <strong style="text-transform: uppercase;"><?= htmlspecialchars($lawyer->firstname, ENT_QUOTES) .' '. htmlspecialchars($lawyer->lastname, ENT_QUOTES); ?></strong></legend>

                <!-- Text input-->
                <div class="form-group">

                    <label class="col-md-4 control-label" for="textinput">Appointment date</label>
                    <div class="col-md-4">
                        <input class="form-control input-md" name="appointment_datetime" placeholder="Click here and appointment calendar will appear" id="datetimepicker" type="text" >
                        <input type="hidden" name="lawyer_id" value="<?= htmlspecialchars($lawyer->id, ENT_QUOTES); ?>"/>

                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="singlebutton"></label>
                    <div class="col-md-4">
                        <button id="singlebutton" name="singlebutton" class="btn btn-primary">Create appointment</button>
                    </div>
                </div>

            </fieldset>
        </form>

    </div>
@stop