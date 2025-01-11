<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\StoreRequest;
use App\Http\Requests\Article\UpdateRequest;
use App\Models\Article;
use App\Models\Content;
use App\Models\ContentProgress;
use App\Models\Material;
use App\Models\Student;
use App\Services\ContentService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function create(Material $material)
    {
        return view('resource.article.create', [
            'title' => __('Add Article'),
            'material' => $material,
        ]);
    }

    public function store(StoreRequest $request, Material $material)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            $content = Content::create([
                'type' => 'article',
                'order' => (new ContentService)->getNextOrder($material),
                'material_id' => $material->id,
            ]);

            $students = Student::all();
            foreach ($students as $student) {
                ContentProgress::create([
                    'student_id' => $student->id,
                    'content_id' => $content->id,
                ]);
            }

            $validatedData['content_id'] = $content->id;
            $validatedData['slug'] = Str::slug($validatedData['title']);

            Article::create($validatedData);

            DB::commit();

            session()->flash('success', __('Article successfully added'));

            return redirect()->route('material.show', $material);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to add article'));

            return redirect()->back();
        }
    }

    public function show(Material $material, Article $article)
    {
        return view('resource.article.show', [
            'title' => __('View Article'),
            'material' => $material,
            'article' => $article,
        ]);
    }

    public function edit(Material $material, Article $article)
    {
        return view('resource.article.edit', [
            'title' => __('Edit Article'),
            'material' => $material,
            'article' => $article,
        ]);
    }

    public function update(UpdateRequest $request, Article $article)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            $article->update($validatedData);

            DB::commit();

            session()->flash('success', __('Article successfully updated'));

            return redirect()->back();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to update article'));

            return redirect()->back();
        }
    }

    public function destroy(Material $material, Article $article)
    {
        try {
            DB::beginTransaction();

            $article->content()->forceDelete();
            $article->forceDelete();

            ContentProgress::where('content_id', $article->content_id)
                ->forceDelete();

            DB::commit();

            session()->flash('success', __('Article successfully deleted'));

            return redirect()->route('material.show', $material);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            DB::rollBack();

            session()->flash('error', __('Failed to delete article'));

            return redirect()->back();
        }
    }

    public function read(Material $material, $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $contentProgress = ContentProgress::where('content_id', $article->content_id)
            ->where('student_id', auth()->user()->student->id)
            ->first();

        if ($contentProgress) {
            $contentProgress->update([
                'is_done' => true,
                'score' => 100,
            ]);
        }

        return view('resource.article.read', [
            'title' => __('Read Article'),
            'article' => $article,
            'material' => $material,
        ]);
    }
}
