<?php

namespace App\Http\Controllers\API;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    public function get_all_patients(){
        $patients=Patient::orderBy('id','DESC')->get();
        return response()->json([
            'patients'=>$patients
        ],200);
    }

    public function create_patient(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'dob'=>'required'
        ]);

        $patient = new Patient();
        $patient->name=$request->name;
        $patient->dob= $request->dob;
        $patient->mobile=$request->mobile;
        $patient->address=$request->address;
        $patient->save();
    }

    public function update_patient(Request $request, $id){
        $patient = Patient::find($id);
        $this->validate($request,[
            'name'=>'required',
            'dob'=>'required'
        ]);
        $patient->name=$request->name;
        $patient->dob= $request->dob;
        $patient->mobile=$request->mobile;
        $patient->address=$request->address;
        $patient->save();
    }

    public function delete_patient(Request $request,$id){
        $patient = Patient::destroy($id);
    }
}
