<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Plan;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        try {
            $planDetails = DB::table('plans')->get();
            return view('plan', compact('planDetails'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Check permission for creating a plan
        // ResponseService::noPermissionThenRedirect('plan-create');

        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric'],
        ]);

        // If validation fails, return errors as a response
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'message' => $validator->errors()->all(),
            ];
            return response()->json($response);
        }

        // Create a new Plan record
        $plan = new Plan();
        $plan->name = $request->name;
        $plan->description = $request->description ?? '';  // Default to empty string if not provided
        $plan->price = $request->price;

        // Save the new plan to the database
        $plan->save();

        // Return a success response
        $response = [
            'error' => false,
            'message' => __('created_success'),
        ];
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        // Check permission for viewing plans
        // ResponseService::noPermissionThenRedirect('plan-list');

        // Get pagination and sorting parameters from the request
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);
        $sort = $request->input('sort', 'created_at');
        $order = $request->input('order', 'ASC');

        // Initialize the query to fetch plans
        $sql = Plan::query();

        // Filter by name if search term is provided
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $sql = $sql->where(function ($q) use ($search) {
                $q->where('id', 'LIKE', "%{$search}%")->orwhere('name', 'LIKE', "%{$search}%");
            });
        }

        // Get the total count of plans before pagination
        $total = $sql->count();

        // Apply sorting and pagination
        $sql = $sql->orderBy($sort, $order)->skip($offset)->take($limit);

        // Fetch the paginated rows
        $rows = $sql->get()->map(function ($row) {
            // Define action buttons (Edit and Delete)
            $edit = '';
            $delete = '';

            // Check for edit and delete permissions
            // if (auth()->user()->can('plan-edit')) {
            $edit = '<a class="dropdown-item edit-data" data-toggle="modal" data-target="#editDataModal" title="' . __('edit') . '"><i class="fa fa-pen mr-1 text-primary"></i>' . __('edit') . '</a>';
            // }
            // if (auth()->user()->can('plan-delete')) {
            $delete = '<a data-url="' . url('plan', $row->id) . '" class="dropdown-item delete-form" data-id="' . $row->id . '" title="' . __('delete') . '"><i class="fa fa-trash mr-1 text-danger"></i>' . __('delete') . '</a>';
            // }

            // Check if there are any actions to show (edit or delete)
            $operate = ($edit || $delete) ?
                '<div class="dropdown">
                   <a href="javascript:void(0)" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <button class="btn btn-primary btn-sm px-3"><i class="fas fa-ellipsis-v"></i></button>
                   </a>
                   <div class="dropdown-menu dropdown-scrollbar" aria-labelledby="dropdownMenuButton">
                       ' . $edit . $delete . '
                   </div>
               </div>'
                : '-';

            // Return the formatted plan data
            // $operate ='1';
            return [
                'id' => $row->id,
                'name' => $row->name,
                'description' => $row->description,
                'price' => $row->price,
                'created_at' => $row->created_at->toDateString(),
                'updated_at' => $row->updated_at->toDateString(),
                'operate' => $operate,
            ];
        });

        // Return the paginated response
        return response()->json([
            'total' => $total,
            'rows' => $rows,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
