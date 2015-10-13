<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Citizen;
use App\Models\Lawyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;

class CitizenProfileController extends Controller
{

    public function index()
    {

        $lawyers = Lawyer::paginate(2);

        $loggedCitizen = Citizen::where('id',Auth::user()->citizen->id)->first();

        return view('pages.profile.citizen',['lawyers' => $lawyers, 'loggedCitizen' => $loggedCitizen]);
    }

    public function makeAppointment($id)
    {

        try{

            $lawyer = Lawyer::findOrFail($id);

            return view('pages.appointments.makeAppointment', ['lawyer' => $lawyer]);

        } catch(\Exception $e) {

            return redirect()->route('citizenProfile');

        }


    }

    public function saveAppointment(Request $oRequest)
    {

        try{

            $lawyer = Lawyer::findOrFail($oRequest->input('lawyer_id'));

            if (strtotime($oRequest->input('appointment_datetime')) < time()) {
                return redirect()->route('citizenProfile')->with('dateInPast', 'You can not choose date in the past.');
            }
            $appointmentDateTime = date('Y-m-d H:i:s',strtotime($oRequest->input('appointment_datetime')));

            $oValidator =  Validator::make($oRequest->all(),[
                'appointment_datetime'  => 'required|date'
            ]);

            if ($oValidator->fails()) {

                return redirect()->route('lawyer_appointment')->withErrors($oValidator)->withInput();

            } else {

                Appointment::create([
                    'citizen_id'            => Auth::user()->citizen->id,
                    'lawyer_id'             => $lawyer->id,
                    'appointment_datetime'  => $appointmentDateTime,
                    'status'                => Appointment::STATUS_PENDING

                ]);

            }

            return redirect()->route('citizenProfile');

        } catch(\Exception $e) {

            return redirect()->route('citizenProfile');

        }

    }

    public function scheduledAppointments()
    {

        try {

            $appointments = Appointment::where('citizen_id', Auth::user()->citizen->id)->paginate(2);

            return view('pages.appointments.citizenScheduledAppointments',['appointments' => $appointments]);


        }catch (\Exception $e) {

            return redirect()->route('citizenProfile');

        }

    }

    public function deleteAppointment($id)
    {

        try{

            $appointment = Appointment::findOrFail($id)->where('citizen_id',Auth::user()->citizen->id)->first();

            $appointment->delete();

            return redirect()->route('scheduled_appointments');

        }catch(\Exception $e){

            return redirect()->route('citizenProfile');

        }

    }

    public function editAppointment($id)
    {

        try{



            $appointment = Appointment::findOrFail($id)->where('citizen_id',Auth::user()->citizen->id)->where('id',$id)->first();


            return view('pages.appointments.editAppointment',['appointment' => $appointment]);

        }catch(\Exception $e){

            return redirect()->route('citizenProfile');

        }

    }

    public function editAppointmentSave(Request $request)
    {

        $oValidator =  Validator::make($request->all(),[
            'appointment_datetime'  => 'required|date'
        ]);


        if ($oValidator->fails()) {

            return redirect()->route('lawyer_appointment')->withErrors($oValidator)->withInput();

        } else {

            try{

                if (strtotime($request->input('appointment_datetime')) < time()) {
                    return redirect()->route('citizenProfile')->with('dateInPast', 'You can not choose date in the past.');
                }

                $appointment = Appointment::findOrFail($request->input('appointment_id'))
                    ->where('citizen_id',Auth::user()->citizen->id)
                    ->where('id',$request->input('appointment_id'))
                    ->first();

                $appointmentDateTime = date('Y-m-d H:i:s',strtotime($request->input('appointment_datetime')));

                $appointment->appointment_datetime = $appointmentDateTime;

                $appointment->save();

                return redirect()->route('scheduled_appointments');

            } catch(\Exception $e) {

                return redirect()->route('citizenProfile');

            }


        }

    }

    public function searchLawyers()
    {

        return view('pages.search.searchLawyers');

    }

    public function searchLawyersResults(Request $request)
    {

        $oValidator =  Validator::make($request->all(),[
            'lawyer_name'  => 'required|string'
        ]);


        if ($oValidator->fails()) {

            return redirect()->route('search_lawyers')->withErrors($oValidator)->withInput();

        } else {

            $lawyerName = explode(' ',trim($request->input('lawyer_name')));

            $lawyerName = array_diff($lawyerName, array(''));

            $lawyerName = array_slice($lawyerName, 0 , 2);

            $searchCriteria = implode(' ',$lawyerName);


            $searchResults = Lawyer::where('firstname', 'LIKE', '%'. $lawyerName[0] .'%')->orWhere('lastname', 'LIKE', '%'. $lawyerName[0] .'%')->get();

            return view('pages.search.searchLawyersResults', ['lawyers' => $searchResults,'searchCriteria' => $searchCriteria]);

        }

    }

    public function approvedAppointments()
    {
        try {

            $appointments = Appointment::where('citizen_id', Auth::user()->citizen->id)->where('status',Appointment::STATUS_APPROVED)->paginate(2);

            return view('pages.appointments.citizenScheduledAppointments',['appointments' => $appointments]);


        }catch (\Exception $e) {

            return redirect()->route('citizenProfile');

        }
    }

    public function rejectedAppointments()
    {
        try {

            $appointments = Appointment::where('citizen_id', Auth::user()->citizen->id)->where('status',Appointment::STATUS_REJECTED)->paginate(2);

            return view('pages.appointments.citizenScheduledAppointments',['appointments' => $appointments]);


        }catch (\Exception $e) {

            return redirect()->route('citizenProfile');

        }
    }

}