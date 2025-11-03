<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreArticleRequest;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArticleController extends Controller
{

    /**
     * Display a listing of 
     * the resource.
     */
    use AuthorizesRequests;
    public function index()
    {
        // Lấy tất cả bài viết từ DB
        $articles = Article::latest()->get();
        return view('articles.index', compact('articles'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',Article::class);
        return view('articles.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $this->authorize('create', Article::class);
        $data = $request->validated();
        // Xử lý ảnh (nếu có)
        if ($request->hasFile('image')) {
            // Lưu vào disk 'public' (đường dẫn: storage/app/public/articles/...)
            $path = $request->file('image')->store('articles', 'public');
            $data['image_path'] = $path; // lưu đường dẫn tương đối
        }
        Article::create($data);
        return redirect()->route('articles.index')
            ->with('success', 'Tạo bài viết thành công');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       
       
        return view('articles.show', compact('article'));
    }

    /**

    * Show the form for editing the specified resource.
    */
    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StoreArticleRequest $request, Article $article)
{
    $this->authorize('update', $article);
    $data = $request->validated();

    if ($request->hasFile('image')) {
        // Xóa ảnh cũ nếu tồn tại
        if (!empty($article->image_path) && Storage::disk('public')->exists($article->image_path)) {
            Storage::disk('public')->delete($article->image_path);
        }

        // Lưu ảnh mới
         $path = $request->file('image')->store('articles', 'public');
            $data['image_path'] = $path; //      đường dẫn tương đối
        }

    $article->update($data);

    return redirect()->route('articles.index', $article->id)
        ->with('success', 'Cập nhật bài viết thành công');
}

    /**
     * Remove the specified resource from storage.
     */


    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        // Demo: giả xoá (mock), sau này sẽ $article->delete();
        return redirect()
            ->route('articles.index')
            ->with('success', "Đã xoá bài viết #{$article->id} (demo).");
    }




}
