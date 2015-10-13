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

                    <?php if (count($lawyers) > 0): ?>

                        <legend>Results of serching for <strong><?= htmlspecialchars($searchCriteria,ENT_QUOTES); ?></strong></legend>

                        <table id="mytable" class="table table-bordred table-striped">

                            <thead>
                            <th width="15%">First Name</th>
                            <th width="15%">Last Name</th>
                            <th>Email</th>
                            <th width="15%"></th>
                            </thead>

                        <?php foreach ($lawyers as $lawyer): ?>

                        <tbody>
                        <tr>
                            <td><?= htmlspecialchars($lawyer->firstname, ENT_QUOTES); ?></td>
                            <td><?= htmlspecialchars($lawyer->lastname, ENT_QUOTES); ?></td>
                            <td><?= htmlspecialchars($lawyer->user->email, ENT_QUOTES); ?></td>
                            <td><a href="{{ URL::route('lawyer_appointment',[htmlspecialchars($lawyer->id, ENT_QUOTES)]) }}" class="btn-primary btn">Create appointment</a></td>
                        </tr>

                        </tbody>

                        <?php endforeach; ?>

                    <?php else: ?>

                            <legend>No records found for  <strong><?= htmlspecialchars($searchCriteria,ENT_QUOTES); ?></strong></legend>

                    <?php endif; ?>

                        </table>

                    </div>

                </fieldset>
            </form>

        </div>
    </div>
@stop