<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\Marklist;
use App\Models\Student;
use Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class MarklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $student = Student::all();
        if ($request->ajax()) {
            $data = Marklist::with(['student'])->select('id', 'student_id', 'maths', 'science', 'history', 'term', 'created_at')->orderBy('id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('student_id', function ($data) {
                    if (isset($data->student_id)) {
                        $student_name = ucfirst($data->student->name);
                    }
                    return $student_name;
                })
                ->editColumn('term', function ($data) {
                    if ($data->term == 1) {
                        $term = 'One';
                    } elseif ($data->term == 2) {
                        $term = 'Two';
                    }
                    return $term;
                })

                ->addColumn('total', function ($data) {
                    $total = $data->maths + $data->science + $data->history;
                    return $total;
                })

                ->editColumn('created_at', function ($data) {
                    $created_at = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('M d,Y h:i A');
                    return $created_at;
                })

                ->addColumn('action', function ($data) {
                    $btn = '';
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-outline-secondary btn-sm editModal" data-id="' . $data->id . '" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="fa fa-pencil"></i></a> &nbsp;';
                    $btn .= '<a href="javascript:void(0);" class="edit btn btn-outline-danger btn-sm modal_accept" data-id="' . $data->id . '" data-toggle="tooltip" data-placement="top" data-original-title="Archive"><i class="icon-trash"></i></a> &nbsp;';
                    return $btn;
                })
                ->rawColumns(['action', 'student_id', 'total'])
                ->removeColumn('id')
                ->make(true);
        }
        return view('marklist.index', compact('student'));
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
        $term = $request['term'];
        $validation = Validator::make(
            $request->all(),
            [
                'student_id' => ['required', Rule::unique('marklists')
                    ->where('term', $term)
                    ->Where('deleted_at', '<>', null)],
                'term'  => 'required',
                'maths'  => 'required|integer|min:0|max:100',
                'science'  => 'required|integer|min:0|max:100',
                'history'  => 'required|integer|min:0|max:100',
            ],
            [
                'student_id.required' => 'Please select any student.',
                'term.required' => 'Please select any term.',
                'maths.required' => 'Maths subject mark required.',
                'maths.integer' => 'Maths subject mark must an integer.',
                'history.required' => 'history subject mark required.',
                'history.integer' => 'history subject mark must an integer.',
                'science.required' => 'science subject mark required.',
                'science.integer' => 'science subject mark must an integer.',

            ]
        );
        $error_array = array();
        $success_output = '';

        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }
        } else {

            $marklist = new Marklist();
            $array = ['created_by' => auth()->user()->id];
            $request->merge($array);
            $marklist->fill($request->all());
            $save = $marklist->save();
            if ($save) {
                $request->session()->flash('message', 'New marklist added succssfully');
                $success_output = 'success';
            } else {
                $success_output = 'error';
                $request->session()->flash('error', 'Failed to add new marklist.Please try again later.');
                $error_array[] = 'Failed to add new marklist.Please try again later.';
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
            $student = Student::all();
            $modal = Marklist::with(['student'])->findOrFail($id);

            if ($modal) {
                $view = view("marklist.manage", compact('modal', 'student'))->render();
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
        $term = $request['term'];
        $validation = Validator::make(
            $request->all(),
            [
                'student_id' => ['required', Rule::unique('marklists')
                    ->ignore($id)
                    ->where('term', $term)
                    ->Where('deleted_at', '<>', null)],
                'term'  => 'required',
                'maths'  => 'required|integer|min:0|max:100',
                'science'  => 'required|integer|min:0|max:100',
                'history'  => 'required|integer|min:0|max:100',
            ],
            [
                'student_id.required' => 'Please select any student.',
                'term.required' => 'Please select any term.',
                'maths.required' => 'Maths subject mark required.',
                'maths.integer' => 'Maths subject mark must an integer.',
                'history.required' => 'history subject mark required.',
                'history.integer' => 'history subject mark must an integer.',
                'science.required' => 'science subject mark required.',
                'science.integer' => 'science subject mark must an integer.',

            ]
        );
        $error_array = array();
        $success_output = '';

        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }
        } else {

            $marklist = Marklist::findOrFail($id);
            $marklist->fill($request->all());
            $save = $marklist->save();
            if ($save) {
                $request->session()->flash('message', ' Mark list data updated succssfully');
                $success_output = 'success';
            } else {
                $success_output = 'error';
                $request->session()->flash('error', 'Failed to update mark list.Please try again later.');
                $error_array[] = 'Failed to update mark list.Please try again later.';
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
            $model = Marklist::findOrFail($id);
            $model->delete();
            $model->deleted_by = auth()->user()->id;
            $model->save();
            return response()->json(['status' => 'success', 'message' => 'Archived' . 'Successfully', 'success_message' => 'Archived Successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'failed', 'message' => 'Failed to Change status.Please try again later.']);
        }
    }
}
