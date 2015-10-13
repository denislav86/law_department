@extends('app')

@section('content')

<div class="container">
    <form class="form-horizontal" action="<?= URL::route('edit_appointment_save'); ?>" method="POST">

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
            <legend>You have scheduled appointment with <strong style="text-transform: uppercase;"><?= htmlspecialchars($appointment->lawyer->firstname, ENT_QUOTES) .' '. htmlspecialchars($appointment->lawyer->lastname, ENT_QUOTES); ?></strong>
                for <strong><?= date('F j, Y, g:i',strtotime(htmlspecialchars($appointment->appointment_datetime, ENT_QUOTES))) ?></strong></legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Chane appointment date</label>
                <div class="col-md-4">

                    <input class="form-control input-md" name="appointment_datetime" placeholder="Click here and appointment calendar will appear" id="datetimepicker" type="text" >
                    <input type="hidden" name="appointment_id" value="<?= htmlspecialchars($appointment->id, ENT_QUOTES); ?>"/>

                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton"></label>
                <div class="col-md-4">
                    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Change Appointment</button>
                </div>
            </div>

        </fieldset>
    </form>

</div>
@stop