<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Models\Student;
use App\Models\Teacher;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $teacher = Teacher::all();
        if ($request->ajax()) {
            $data = Student::with(['teacher'])->select('id', 'name', 'age', 'gender', 'teacher_id')->orderBy('id', 'DESC')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function ($data) {
                    $name = ucfirst($data->name);
                    return $name;
                })
                ->editColumn('teacher_id', function ($data) {
                    if (isset($data->teacher)) {
                        $teacher = ucfirst($data->teacher->name);
                    }
                    return $teacher;
                })
                ->editColumn('gender', function ($data) {
                    if ($data->gender == 'M') {
                        $gender = 'Male';
                    } elseif ($data->gender == 'F') {
                        $gender = 'Female';
                    }
                    return $gender;
                })
                ->addColumn('action', function ($data) {
                    $btn = '';
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-outline-secondary btn-sm editModal" data-id="' . $data->id . '" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="fa fa-pencil"></i></a> &nbsp;';
                    $btn .= '<a href="javascript:void(0);" class="edit btn btn-outline-danger btn-sm modal_accept" data-id="' . $data->id . '" data-toggle="tooltip" data-placement="top" data-original-title="Archive"><i class="icon-trash"></i></a> &nbsp;';
                   return $btn;
                })
                ->rawColumns(['action', 'teacher_id'])
                ->removeColumn('id')
                ->make(true);
        }
        $count = Student::count();
        return view('students.index', compact('count', 'teacher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'age'  => 'required|integer',
                'gender'  => 'required',
                'teacher_id'  => 'required',
            ],
            [
                'name.required' => 'The student name field is required.',
                'age.required' => 'The Age field is required.',
                'age.integer' => 'The Age field must an integer.',
                'gender.required' => 'The Gender field is required.',
                'teacher_id.required' => 'The Reporting Teacher field is required.',

            ]
        );
        $error_array = array();
        $success_output = '';

        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }
        } else {

            $Student = new Student();
            $array = ['created_by' => auth()->user()->id];
            $request->merge($array);
            $Student->fill($request->all());
            $save = $Student->save();
            if ($save) {
                $request->session()->flash('message', 'New Student added succssfully');
                $success_output = 'success';
            } else {
                $success_output = 'error';
                $request->session()->flash('error', 'Failed to add new student.Please try again later.');
                $error_array[] = 'Failed to add new student.Please try again later.';
            }
        }
        $output = array('error'     => $error_array, 'status' => $success_output);
        return json_encode($output);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id) {
            $teacher = Teacher::all();
            $modal = Student::with(['teacher'])->findOrFail($id);

            if ($modal) {
                $view = view("students.manage", compact('modal','teacher'))->render();
                return response()->json(['html' => $view]);
            }
            return response()->json(['html' => ""]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'age'  => 'required',
                'gender'  => 'required',
                'teacher_id'  => 'required',
            ],
            [
                'name.required' => 'The student name field is required.',
                'age.required' => 'The Age field is required.',
                'gender.required' => 'The Gender field is required.',
                'teacher_id.required' => 'The Reporting Teacher field is required.',

            ]
        );
        $error_array = array();
        $success_output = '';

        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }
        } else {

            $Student = Student::findOrFail($id);
            $Student->fill($request->all());
            $save = $Student->save();
            if ($save) {
                $request->session()->flash('message', ' Student data updated succssfully');
                $success_output = 'success';
            } else {
                $success_output = 'error';
                $request->session()->flash('error', 'Failed to update student.Please try again later.');
                $error_array[] = 'Failed to update student.Please try again later.';
            }
        }
        $output = array('error'     => $error_array, 'status' => $success_output);
        return json_encode($output);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $model = Student::findOrFail($id);
            $model->delete();
            $model->deleted_by = auth()->user()->id;
            $model->save();
            return response()->json(['status' => 'success', 'message' => 'Archived' . 'Successfully', 'success_message' => 'Archived Successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'failed', 'message' => 'Failed to Change status.Please try again later.']);
        }
    }
}
