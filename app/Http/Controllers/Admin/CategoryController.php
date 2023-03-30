<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CreateCategoriesRequest;
use App\Http\Requests\Categories\UpdateCategoriesRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->category->latest('id')->paginate(3);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoriesParent = $this->category->getAllParent();
        return view('admin.categories.create', compact('categoriesParent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoriesRequest $request)
    {
        $dataCreate = $request->all();

        $categoriesCreate = $this->category->create($dataCreate);
        return redirect()->route('categories.index')->with(['message' => 'Create Categories ' .$categoriesCreate->name . ' Success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = $this->category->with('childrens')->findOrFail($id);
        $parentCategories = $this->category->getAllParent();
        return view('admin.categories.edit', compact('categories', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriesRequest $request, string $id)
    {
        $dateUpdate = $request->all();
        $categories = $this->category->findOrFail($id);
        $categories->update($dateUpdate);
        return to_route('categories.index')->with(['message' => 'Update ' . $categories->name . ' Success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = $this->category->findOrFail($id);
        $categories->delete($categories);

        return redirect()->route('categories.index')->with(['message' => 'Delete '. $categories->name . ' Success']);
    }
}
