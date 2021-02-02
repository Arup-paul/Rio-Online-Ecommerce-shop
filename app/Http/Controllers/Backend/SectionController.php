<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Section;
use Illuminate\Http\Request;
use Session;

class SectionController extends Controller
{
    public function sections()
    {
        Session::put('page', 'sections');
        $data['sections'] = Section::all();
        return view('admin.section.sections', $data);
    }

    public function updateSectionStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Section::where('id', $data['section_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'section_id' => $data['section_id']]);
        }
    }
}

// echo "<pre>";
// print_r($data);
// die;
// echo "</pre>";
