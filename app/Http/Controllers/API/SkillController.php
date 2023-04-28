<?php

namespace App\Http\Controllers\API;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;
class SkillController extends Controller
{
    public function get_all_skill(){
        $skills = Skill::with('service')->orderBy('id','DESC')->get();
        return response()->json([
            'skills'=>$skills
        ],200);
    }
    public function create_skill(Request $request){
        $this->validate($request,[
            'name'=>'required'
        ]);
        $skill = new Skill();
        $skill->name = $request->name;
        $skill->proficiency = $request->proficiency;
        $skill->service_id = $request->service_id;
        $skill->save();
    }

}
