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


                        <?php if (count($duplixateAppointments) > 0) { ?>

                            <div class="alert alert-danger" role="alert" style="text-align: center">
                                <p>You have some duplicate appointments. Please click the link below to resolve them.</p>

                                <div class="divider"></div>

                                <a href="{{ URL::route('lawyer_duplicate_appointments') }}" class="btn-primary btn">Duplicate appointments</a>
                            </div>

                        <?php } ?>

                        <?php if (count($appointments) > 0): ?>

                            <legend>Here you can approve/reject appointment requests </legend>

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
                                    <td><?= htmlspecialchars($appointment->citizen->firstname, ENT_QUOTES); ?></td>
                                    <td><?= htmlspecialchars($appointment->citizen->lastname, ENT_QUOTES); ?></td>
                                    <td><?= htmlspecialchars($appointment->citizen->user->email, ENT_QUOTES); ?></td>
                                    <td><?= date('F j, Y, g:i',strtotime(htmlspecialchars($appointment->appointment_datetime, ENT_QUOTES))) ?></td>

                                    <?php if ($appointment->status == 'pending') { ?>

                                        <td><a href="{{ URL::route('lawyer_approve_appointment',[htmlspecialchars($appointment->id, ENT_QUOTES)]) }}" class="btn-info btn">Approve appointment</a></td>
                                        <td><a href="{{ URL::route('lawyer_reject_appointment',[htmlspecialchars($appointment->id, ENT_QUOTES)]) }}" class="btn-danger btn">Reject appointment</a></td>

                                    <?php } else { ?>

                                        <td colspan="2">
                                            <div class="alert alert-warning" role="alert">
                                                Appointment <?= $appointment->status; ?>
                                            </div>
                                        </td>

                                    <?php } ?>

                                </tr>

                                <?php endforeach; ?>

                        <?php else: ?>

                            <legend>Currently you have no requested appointments</legend>

                        <?php endif; ?>

                            </tbody>

                        </table>

                        {!! $appointments->render() !!}

                        <div class="divider"></div>

                    </div>

                </fieldset>
            </form>

        </div>
    </div>
@stop