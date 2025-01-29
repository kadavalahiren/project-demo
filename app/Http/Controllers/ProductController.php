<?php

namespace App\Http\Controllers;

use App\Helper\GlobalHelper;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
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
            $data = Product::orderBy('id', 'desc')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->addColumn('title', function ($row) {
                    return $row->title;
                })
                ->addColumn('price', function ($row) {
                    return $row->price;
                })
                ->addColumn('status', function ($row) {
                    $badgeClass = GlobalHelper::statusColor($row->status);
                    return '<div class="demo-inline-spacing">'.'<span class="badge rounded-pill bg-label-'.$badgeClass['badge_class'].'">'.$badgeClass['status_name'].'</span>'.'</div>';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-inline-block">';

                    // Edit Button
                    $btn .= '<a class="iconColor" href="' . route('products.edit', $row->id) . '">
                    <i class="ti ti-edit ti-md"></i>
                    </a> ';

                    // Delete Button
                    $btn .= '<span onclick="deleteRow(\'' . route('products.destroy', $row->id) . '\');">
                        <i class="ti ti-trash"></i>
                    </span>';

                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('content.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = '';
        $categories = Category::get();
        return view('content.product.create',compact('product','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'product_desc' => 'required|string',
            'product_price' => 'required|numeric|min:0',
            'status' => 'required|in:Active,Inactive',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            DB::beginTransaction();
            try {
                // creating Folder if not exists
                $destinationPath = public_path('categories/');

                if (!file_exists($destinationPath)) {
                    @mkdir($destinationPath, 0777, true);
                }

                if ($request->hasFile('product_image')) {
                    $imagePath = $request->file('product_image')->store('products', 'public');
                } else {
                    $imagePath = null;  // No image uploaded
                }

                $product = new Product();
                $product->image = $imagePath;
                $product->title = $request->product_name;
                $product->description = $request->product_desc ?? '';
                $product->price = $request->product_price ?? '';
                $product->status = $request->status;
                $execute = $product->save();
                if (!$execute) {
                    return redirect()->route('products.index')->with('error_message', 'Oops!Internal Server Error.Please Try Again Later.');
                }
                DB::commit();

                if ($request->has('categories')) {
                    $categories = $request->categories;
                    $data = [];
                    foreach ($categories as $category_id) {
                        $data[] = [
                            'product_id' => $product->id,
                            'category_id' => $category_id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                    ProductCategory::insert($data);
                }

                return redirect()->route('products.index')->with('success_message', 'product Added Successfully!');
            } catch (Exception $e) {
                dd($e);
                DB::rollback();
                return redirect()->route('products.index')
                    ->with('error_message', 'Oops!Internal Server Error.Please Try Again Later.');
            }
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('content.product.create', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'product_desc' => 'required|string',
            'product_price' => 'required|numeric|min:0',
            'status' => 'required|in:Active,InActive',
            'categories' => 'required|array',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            DB::beginTransaction();
            try {
                // creating Folder if not exists
                $destinationPath = public_path('product/');

                if (!file_exists($destinationPath)) {
                    @mkdir($destinationPath, 0777, true);
                }

                if ($request->hasFile('product_image')) {
                    // Delete old image if exists
                    if ($product->product_image && Storage::exists('public/' . $product->product_image)) {
                        Storage::delete('public/' . $product->product_image);
                    }
                    // Store the new image
                    $imagePath = $request->file('product_image')->store('products', 'public');
                } else {
                    $imagePath = $product->product_image;  // Keep the old image if no new one is uploaded
                }

                $product = Product::findOrFail($product->id);
                $product->image = $imagePath;
                $product->title = $request->product_name;
                $product->description = $request->product_desc ?? '';
                $product->price = $request->product_price ?? '';
                $product->status = $request->status;
                $execute = $product->save();
                if (!$execute) {
                    return redirect()->route('products.index')->with('error_message', 'Oops!Internal Server Error.Please Try Again Later.');
                }
                DB::commit();
                return redirect()->route('products.index')->with('success_message', 'product Added Successfully!');
            } catch (Exception $e) {
                dd($e);
                DB::rollback();
                return redirect()->route('products.index')
                    ->with('error_message', 'Oops!Internal Server Error.Please Try Again Later.');
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $productData = Product::find($product->id);
        $productData->delete();
    }
}
