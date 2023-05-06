<?php

namespace App\Http\Controllers\API;

use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Log;
class PrescriptionController extends Controller
{
    public function get_all_prescriptions()
    {
        $prescriptions = Prescription::leftJoin('patients as p','p.id','prescriptions.patient_id')
        ->select('prescriptions.id','prescriptions.patient_id','prescriptions.prescription','prescriptions.note','p.name')->orderBy('id', 'DESC')->get();
        return response()->json([
            'prescriptions' => $prescriptions,
        ], 200);
    }
    public function create_prescription(Request $request)
    {
        try {
            $this->validate($request, [
                'patient_id' => 'required',
                'prescription' => 'required',
            ]);
            $prescription = new Prescription();
            $prescription->patient_id = $request->patient_id;
            $prescription->prescription = $request->prescription;
            $prescription->note = $request->note;
            $prescription->save();
        } catch (Exception $th) {
            Log::alert($th);
           return response($th);

        }

    }
    public function delete_prescription(Request $request, $id)
    {
        $patient = Prescription::destroy($id);
    }
}
