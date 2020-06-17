<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use App\models\Country;
use App\models\Doctor;
use App\models\Hospital;
use App\models\Patient;
use App\models\Medical;
use App\models\Service;
use App\User;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function hasOneRelation() {
       $user = User::with(['phone'=>function($q) {
           $q->select('code','phone','user_id');
       }])->find(3);
       return response()->json($user);
    }
    public function getUserHasPhone(){
     //   $user = User::WhereHas('phone')->get();
      //  $user = User::WhereDoesntHave('phone')->get();
        $user = User::WhereHas('phone',function ($con){
            $con->where('name','Abdelazem Abdelhaemd');
        })->get();
        return response()->json($user);
    }

    public function getAllDoctors() {
         $hospital = Hospital::with('doctors')->find(1);
         foreach($hospital->doctors as $doctor) {
              echo $doctor->name.'<br>';
         }
    }
    public function  hospitals() {
        $hospitals = Hospital::select('id','hospital_name','address')->get();
        return view('doctors.hospitals',compact('hospitals'));
    }
    public function doctors($hospital_id) {
        $hospital = Hospital::find($hospital_id);
        $doctors = $hospital->doctors;
        return view('doctors.doctors',compact('doctors'));
    }
    public function delete($hospital_id) {
         $hospital =Hospital::find($hospital_id);
         if(!$hospital) {
              return abort('404');
         }else {
              $hospital->doctors()->delete();
              $hospital->delete();
              return redirect()->route('hospitals.all');
         }
    }

    // many to many relations
    public function getDoctorServices() {
        // return doctor and his services
         return $services = Doctor::with('services')->find(1);

    }
    public function getServiceDoctors() {
        // return service and there doctors
        return $doctor = Service::with(['doctors'=>function($q) {
             $q->select('doctors.id','name');  //doctors.id because the services table has col name is id doctors.id to get the doctor id
        }])->find(1);

    }
    public function  getDoctorServicesById($doctor_id) {
         $doctor= Doctor::find($doctor_id);
         $doctors = Doctor::select('id','name')->get();
         $allServices = Service::select('id','name')->get();
         if(!$doctor) {
              return abort('404');
         } else {
              $services = $doctor->services;
              return view('doctors.services',compact('services','doctors','allServices'));
         }
    }

    public function saveDoctorServices(Request $request) {
         $doctor = Doctor::find($request->doctorId);
        if(!$doctor)
            return abort('404');
       // $doctor->services()->attach($request->servicesIds);
       // $doctor->services()->sync($request->servicesIds);
        $doctor->services()->syncWithoutDetaching($request->servicesIds);
         return 'success';
    }

    // has one through  relation
    public function getPatientDocotor() {

          $patient = Patient::find(1);
           return $patient->doctor;

    }
    // has many through  relation
    public function getCountryDocotors() {

        $country = Country::find(1);
        return $country->doctors;

    }

}
