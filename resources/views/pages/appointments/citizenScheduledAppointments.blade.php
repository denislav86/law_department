@extends('app')

@section('content')
    <div class="container">
        <div class="row">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="form-horizontal" role="form">

                <fieldset>

                    {!! csrf_field() !!}

                    <div class="container">


                            <?php if (count($appointments) == 0) { ?>

                                <div class="alert alert-warning" role="alert">
                                    There are no appointments scheduled at the moment
                                </div>

                                <a href="{{ URL::route('citizenProfile') }}" class="btn-primary btn">Create appointment</a>

                            <?php } else { ?>

                                <legend>You scheduled appointments</legend>
                                <a href="{{ URL::route('citizen_approved_appointments') }}" class="btn-primary btn">View approved appointments</a>
                                <a href="{{ URL::route('citizen_rejected_appointments') }}" class="btn-primary btn">View rejected appointments</a>
                                <a href="{{ URL::route('scheduled_appointments') }}" class="btn-primary btn">View all appointments</a>

                                <table id="mytable" class="table table-bordred table-striped">
                                    <thead>
                                    <th width="10%">First Name</th>
                                    <th width="10%">Last Name</th>
                                    <th>Email</th>
                                    <th>Time</th>
                                    <th width="15%"></th>
                                    <th width="15%"></th>
                                    </thead>
                                    <tbody>

                                    <?php foreach ($appointments as $appointment): ?>

                                        <tr>
                                            <td><?= htmlspecialchars($appointment->lawyer->firstname, ENT_QUOTES); ?></td>
                                            <td><?= htmlspecialchars($appointment->lawyer->lastname, ENT_QUOTES); ?></td>
                                            <td><?= htmlspecialchars($appointment->lawyer->user->email, ENT_QUOTES); ?></td>
                                            <td><?= date('F j, Y, g:i',strtotime(htmlspecialchars($appointment->appointment_datetime, ENT_QUOTES))) ?></td>

                                            <?php if ($appointment->status == \App\Models\Appointment::STATUS_PENDING) { ?>

                                                <td><a href="{{ URL::route('edit_appointment',[htmlspecialchars($appointment->id, ENT_QUOTES)]) }}" class="btn-primary btn">Edit appointment</a></td>
                                                <td><a href="{{ URL::route('citizen_delete_appointment',[htmlspecialchars($appointment->id, ENT_QUOTES)]) }}" class="btn-danger btn">Cancel appointment</a></td>

                                            <?php } else { ?>

                                                <td colspan="2">
                                                    <div class="alert alert-warning" role="alert">
                                                        Appointment <?= htmlspecialchars($appointment->status, ENT_QUOTES); ?>
                                                    </div>
                                                </td>

                                            <?php } ?>

                                        </tr>

                                    <?php endforeach; ?>

                                    </tbody>

                                </table>

                                {!! $appointments->render() !!}

                                <div class="divider"></div>

                                <a href="{{ URL::route('citizenProfile') }}" class="btn-primary btn">Create appointment</a>

                            <?php } ?>

                    </div>

                </fieldset>
            </form>

        </div>
    </div>
@stop