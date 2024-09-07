<?php

namespace App\Http\Controllers;

use App\Models\Intake;
use App\Models\IntakeCourse;
use App\Models\University;
use App\Models\Course;
use Illuminate\Http\Request;

class IntakeController extends Controller
{
    public function index(Request $request)
    {
        $data = Intake::orderByDesc('name')->paginate(10);

        return view('intake.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $Universities = University::orderBy('name')->where('status', 1)->get();
        $courses = Course::orderBy('name')->where('status', 1)->get();
        return view('intake.create', compact('Universities', 'courses'));
    }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'status' => 'required',
        //     'name' => 'required|max:200',
        //     'university_id' => 'required',
        //     'start_date' => 'required',
        //     'end_date' => 'required|after:start_date'
        // ]);

        $data = [
            'status' => $request->status ?? 2,
            'name' => $request->name,
            'university_id' => $request->university,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
        ];

        $intake = Intake::create($data);

        $courseCount = count($request->course);
        if ($courseCount > 0) {
            for ($i=0; $i < $courseCount; $i++) {
                $data = [
                    // 'intake_id' => $intake->id,
                    // 'course_id' => $request->course_id,
                    'start_date' => $request->course_start_date[$i],
                    'end_date' => $request->course_end_date[$i],
                    'required_documents' => json_encode($request->required_documents[$i]),
                    'university_id' => $request->university,
                ];

                IntakeCourse::updateOrCreate(
                    [
                        'intake_id' => $intake->id,
                        'course_id' => $request->course[$i],
                    ],
                    $data
                );
            }
        }

        return redirect()->route('intake.index')->with('success','Record created successfully');
    }

    public function show(Intake $intake)
    {
        if (!empty($intake)) {

            $data = [
                'intake' => $intake
            ];
            return view('intake.show', $data);

        } else {
            return redirect()->route('intake.index');
        }
    }

    public function edit(Intake $intake)
    {
        return view('intake.edit', compact('intake'));
    }

    public function update(Request $request, Intake $intake)
    {
        $this->validate($request, [
            'status' => 'required',
            'name' => 'required|max:200',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ]);

        $purchaseId = $intake->id;
        $data = [
            'status' => isset($request->status) ? $request->status : $intake->status,
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
        ];

        Intake::find($purchaseId)->update($data);

        return redirect()->route('intake.index')->with('success','Updated successfully');
    }

    public function destroy(Intake $intake)
    {
        Intake::find($intake->id)->delete();
        return redirect()->route('intake.index')->with('success', 'Deleted successfully');
    }
}
