<?php

namespace App\Http\Controllers;

use App\Helper\GlobalHelper;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::guard('web')->check()) {
            $adminId = Auth::guard('web')->user()->id;
        } else {
            return redirect('/')->with('error', 'Please log in to continue.');
        }

        if ($request->ajax()) {
            $data = Category::orderBy('id', 'desc')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->addColumn('category_name', function ($row) {
                    return $row->category_name;
                })
                ->addColumn('status', function ($row) {
                    $badgeClass = GlobalHelper::statusColor($row->status);
                    return '<div class="demo-inline-spacing">'.'<span class="badge rounded-pill bg-label-'.$badgeClass['badge_class'].'">'.$badgeClass['status_name'].'</span>'.'</div>';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-inline-block">';

                    // Edit Button
                    $btn .= '<a class="iconColor" href="' . route('categories.edit', $row->id) . '">
                    <i class="ti ti-edit ti-md"></i>
                    </a> ';

                    // Delete Button
                    $btn .= '<span onclick="deleteRow(\'' . route('categories.destroy', $row->id) . '\');">
                        <i class="ti ti-trash"></i>
                    </span>';

                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('content.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = '';
        return view('content.category.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'category_desc' => 'nullable',
            'category_image' => 'nullable|mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            DB::beginTransaction();
            try {
                // creating Folder if not exists
                $destinationPath = public_path('/storage/categories/');
                $destinationPathThumbnail = public_path('/storage/categories/thumbnail/');

                if (!file_exists($destinationPath)) {
                    @mkdir($destinationPath, 0777, true);
                }
                if (!file_exists($destinationPathThumbnail)) {
                    @mkdir($destinationPathThumbnail, 0777, true);
                }

                $fileName = '';
                if ($request->hasFile('category_image')) {
                    $file = $request->file('category_image');
                    $fileName = md5($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . '/storage/categories/', $fileName);
                    if (File::copy(public_path('/storage/categories/' . $fileName), public_path('/storage/categories/thumbnail/' . $fileName))) {
                    }

                    GlobalHelper::createThumbnail(public_path('/storage/categories/thumbnail/' . $fileName), 100, 100);
                }

                $category = new Category();
                $category->category_image = $fileName;
                $category->category_name = $request->category_name;
                $category->category_desc = $request->category_desc ?? '';
                $category->status = $request->status;
                $execute = $category->save();
                if (!$execute) {
                    return redirect()->route('categories.index')->with('error_message', 'Oops!Internal Server Error.Please Try Again Later.');
                }
                DB::commit();
                return redirect()->route('categories.index')->with('success_message', 'Category Added Successfully!');
            } catch (Exception $e) {
                dd($e);
                DB::rollback();
                return redirect()->route('categories.index')
                    ->with('error_message', 'Oops!Internal Server Error.Please Try Again Later.');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('content.category.create',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'category_desc' => 'nullable',
            'category_image' => "nullable|mimes:jpeg,png,jpg",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            DB::beginTransaction();
            try {

                $destinationPath = public_path('/storage/categories/');
                $destinationPathThumbnail = public_path('/storage/categories/thumbnail/');

                if (!file_exists($destinationPath)) {
                    @mkdir($destinationPath, 0777, true);
                }
                if (!file_exists($destinationPathThumbnail)) {
                    @mkdir($destinationPathThumbnail, 0777, true);
                }

                $fileName = '';
                if ($request->hasFile('category_image')) {
                    $file = $request->file('category_image');
                    $fileName = md5($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . '/storage/categories/', $fileName);
                    if (File::copy(public_path('/storage/categories/' . $fileName), public_path('/storage/categories/thumbnail/' . $fileName))) {
                    }

                    GlobalHelper::createThumbnail(public_path('/storage/categories/thumbnail/' . $fileName), 100, 100);
                }

                $category = Category::findOrFail($category->id);
                $category->category_image = $fileName;
                $category->category_name = $request->category_name;
                $category->category_desc = $request->category_desc ?? '';
                $category->status = $request->status;
                $execute = $category->update();
                if (!$execute) {
                    return redirect()->route('categories.index')->with('error_message', 'Oops!Internal Server Error.Please Try Again Later.');
                }
                DB::commit();
                return redirect()->route('categories.index')->with('success_message', 'Category Update Successfully!');
            } catch (Exception $e) {
                dd($e);
                DB::rollback();
                return redirect()->route('categories.index')
                    ->with('error_message', 'Oops!Internal Server Error.Please Try Again Later.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $categoryData = Category::find($category->id);
        $categoryData->delete();
    }
}
