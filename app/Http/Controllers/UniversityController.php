<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\Cities;
use App\Models\States;
use App\Models\Countries;
use App\Models\Keyword;
use App\Models\UniversityKeyword;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index(Request $request)
    {
        $data = University::orderBy('name')->paginate(10);

        return view('university.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $universities = University::orderBy('name')->where('status', 1)->whereNull('university_id')->get();
        $countries = Countries::orderBy('name')->limit(20)->get();
        $states = States::orderBy('name')->limit(20)->get();
        $cities = Cities::orderBy('name')->limit(20)->get();
        return view('university.create', compact('universities', 'countries', 'states', 'cities'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'name' => 'required|max:200',
            'short_name' => 'required|max:200',
            'established_year' => 'required',
            'city_id' => 'required',
            'state_id' => 'required',
            'country_id' => 'required',
        ]);

        $data = [
            'status' => $request->status ?? 1,
            'name' => $request->name,
            'short_name' => $request->short_name,
            'established_year' => $request->established_year,
            'university_id' => $request->main_campus,
            'lattitude' => $request->lattitude ?? null,
            'longitude' => $request->longitude ?? null,
            'city_id' => $request->city_id,
            'state_id' => $request->state_id,
            'country_id' => $request->country_id,
            'description' => $request->description,
        ];

        $university = University::create($data);

        $keywordsArray = array_map('trim', explode(',', $request->keywords));
        $keywordsArray = array_unique($keywordsArray);

        $keywordIds = [];
        foreach ($keywordsArray as $keyword) {
            $keywordModel = Keyword::firstOrCreate(['keyword' => $keyword]);
            $keywordIds[] = $keywordModel->id;
        }

        $university->universityKeywords()->attach($keywordIds);

        return redirect()->route('university.index')->with('success','Record created successfully');
    }

    public function show(University $university)
    {
        if (!empty($university)) {

            $data = [
                'item' => $university
            ];
            return view('university.show', $data);

        } else {
            return redirect()->route('university.index');
        }
    }

    public function edit(University $university)
    {
        $universities = University::orderBy('name')->where('id', '!=', $university->id)->where('status', 1)->whereNull('university_id')->get();
        $countries = Countries::orderBy('name')->limit(20)->get();
        $states = States::orderBy('name')->limit(20)->get();
        $cities = Cities::orderBy('name')->limit(20)->get();

        $keywordsArray = $university->keywords->pluck('keyword')->toArray();
        $keywords = implode(", ", $keywordsArray);

        return view('university.edit', compact('university', 'universities', 'countries', 'states', 'cities', 'keywords'));
    }

    public function update(Request $request, University $university)
    {
        $this->validate($request, [
            'status' => 'required',
            'name' => 'required|max:200',
            'short_name' => 'required|max:200',
            'established_year' => 'required',
            'city_id' => 'required',
            'state_id' => 'required',
            'country_id' => 'required',
        ]);

        $data = [
            'status' => isset($request->status) ? $request->status : $university->status,
            'name' => $request->name,
            'short_name' => $request->short_name,
            'established_year' => $request->established_year,
            'university_id' => $request->main_campus,
            'lattitude' => $request->lattitude,
            'longitude' => $request->longitude,
            'city_id' => $request->city_id,
            'state_id' => $request->state_id,
            'country_id' => $request->country_id,
            'description' => $request->description,
        ];

        University::find($university->id)->update($data);

        $university = University::find($university->id);

        $keywordsArray = array_map('trim', explode(',', $request->keywords));
        $keywordsArray = array_unique($keywordsArray);

        $keywordIds = [];
        foreach ($keywordsArray as $keyword) {
            $keywordModel = Keyword::firstOrCreate(['keyword' => $keyword]);
            $keywordIds[] = $keywordModel->id;
        }

        $university->universityKeywords()->sync($keywordIds);

        return redirect()->route('university.index')->with('success','Updated successfully');
    }

    public function destroy(University $university)
    {
        University::find($university->id)->delete();
        return redirect()->route('university.index')->with('success', 'Deleted successfully');
    }
}
