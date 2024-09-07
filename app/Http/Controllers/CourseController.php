<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseLevel;
use App\Models\Department;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $data = Course::orderBy('name')->paginate(10);

        return view('course.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $levels = CourseLevel::where('status', 1)->orderBy('name')->get();
        $departments = Department::where('status', 1)->orderBy('name')->get();
        return view('course.create', compact('levels', 'departments'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'name' => 'required|max:200',
            'short_name' => 'required|max:200',
            'duration' => 'required|max:200',
            'course_level' => 'required',
            'department' => 'required',
        ]);

        $data = [
            'status' => $request->status ?? 1,
            'name' => $request->name,
            'short_name' => $request->short_name,
            'years' => $request->duration,
            'course_level_id' => $request->course_level,
            'department_id' => $request->department,
            'description' => $request->description,
        ];

        Course::create($data);

        return redirect()->route('course.index')->with('success','Record created successfully');
    }

    public function show(Course $course)
    {
        if (!empty($course)) {

            $data = [
                'item' => $course
            ];
            return view('course.show', $data);

        } else {
            return redirect()->route('course.index');
        }
    }

    public function edit(Course $course)
    {
        $levels = CourseLevel::where('status', 1)->orderBy('name')->get();
        $departments = Department::where('status', 1)->orderBy('name')->get();
        return view('course.edit', compact('levels', 'departments', 'course'));
    }

    public function update(Request $request, Course $course)
    {
        $this->validate($request, [
            'status' => 'required',
            'name' => 'required|max:200',
            'short_name' => 'required|max:200',
            'duration' => 'required|max:200',
            'course_level' => 'required',
            'department' => 'required',
        ]);

        $data = [
            'status' => isset($request->status) ? $request->status : $course->status,
            'name' => $request->name,
            'short_name' => $request->short_name,
            'years' => $request->duration,
            'course_level_id' => $request->course_level,
            'department_id' => $request->department,
            'description' => $request->description,
        ];

        Course::find($course->id)->update($data);

        return redirect()->route('course.index')->with('success','Updated successfully');
    }

    public function destroy(Course $course)
    {
        Course::find($course->id)->delete();
        return redirect()->route('course.index')->with('success', 'Deleted successfully');
    }
}
