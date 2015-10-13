<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use DB;

class LawyerProfileController extends Controller
{

    public function index()
    {

        try {

            $duplixateAppointments = $this->checkForDuplicateAppointments();

            $appointments = Appointment::where('lawyer_id', Auth::user()->lawyer->id)->paginate(2);

            return view('pages.profile.lawyer',['appointments' => $appointments, 'duplixateAppointments' => $duplixateAppointments]);


        }catch (\Exception $e) {

            return redirect()->route('lawyerProfile');

        }


    }

    public function rejectAppointment($id)
    {

        try{

            $appointment = Appointment::findOrFail($id)->where('lawyer_id',Auth::user()->lawyer->id)->where('id',$id)->first();

            $appointment->status = Appointment::STATUS_REJECTED;

            $appointment->save();

            return redirect()->route('lawyerProfile');

        }catch(\Exception $e){

            return redirect()->route('lawyerProfile');

        }

    }

    public function approveAppointment($id)
    {

        try{

            $appointment = Appointment::findOrFail($id)->where('lawyer_id',Auth::user()->lawyer->id)->where('id',$id)->first();

            $appointment->status = Appointment::STATUS_APPROVED;

            $appointment->save();

            return redirect()->route('lawyerProfile');

        }catch(\Exception $e){

            return redirect()->route('lawyerProfile');

        }

    }


    public function checkForDuplicateAppointments()
    {

        $duplicateAppointments = DB::select('SELECT `id` FROM `appointments`
                                    WHERE `appointment_datetime` IN (SELECT `appointment_datetime` FROM `appointments`
                                    WHERE `lawyer_id` = :id
                                    GROUP BY `appointment_datetime`
                                    HAVING COUNT(`appointment_datetime`) > 1)',['id' => Auth::user()->lawyer->id]);

        return $duplicateAppointments;

    }

    public function resolveDuplicateAppointments()
    {

        try {

            $duplicateAppointmentsIds = array();

            $duplicateAppointments = $this->checkForDuplicateAppointments();

            foreach ($duplicateAppointments as $appointment) {

                $duplicateAppointmentsIds[] = $appointment->id;

            }

            $appointments = Appointment::find($duplicateAppointmentsIds);

            return view('pages.appointments.duplicateAppointments',['appointments' => $appointments]);


        }catch (\Exception $e) {

            return redirect()->route('lawyerProfile');

        }

    }

}