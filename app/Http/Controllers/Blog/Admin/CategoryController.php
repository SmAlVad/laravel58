<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryCreateRequest;
use App\Models\BlogCategory;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Repositories\BlogCategoryRepository;
use Str;

class CategoryController extends BaseBlogAdminController
{
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    /**
     * Количество записей на странице
     *
     * @var int
     */
    public $itemPerPage = 15;

    public function __construct()
    {
        parent::__construct();

        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->blogCategoryRepository->getAllWithPaginate($this->itemPerPage);

        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogCategoryCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Создаст объект, но не добавит в бд
        $item = new BlogCategory($data);
        $item->save();

        if ($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->blogCategoryRepository->getEdit($id);
        if (empty($item)) {
           abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BlogCategoryUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        $item = $this->blogCategoryRepository->getEdit($id);

        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено'])
                ->withInput();
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения"])
                ->withInput();
        }
    }
}
