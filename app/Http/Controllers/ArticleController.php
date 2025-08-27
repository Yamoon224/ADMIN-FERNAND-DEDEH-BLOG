<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Repositories\ArticleRepository;
use App\Http\Resources\ArticleResource;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    protected $repository;
    protected $categoryRepository;

    public function __construct(ArticleRepository $repository, CategoryRepository $categoryRepository)
    {
        $this->middleware(['auth', 'verified']);
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $articles = $this->repository->paginate();
        return view('articles.index', compact('articles'));
    }

    public function podcasts()
    {
        $podcasts = $this->repository->paginate([], 'PODCAST');
        return view('articles.podcasts', compact('podcasts'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->all();
        return view('articles.add', compact('categories'));
    }

    public function store(StoreArticleRequest $request)
    {
        $data = $request->validated();

        $data = array_diff_key($data, array_flip(['path_file', 'path_text']));
        // Vérifie si un fichier a été uploadé pour path_resource
        if ($request->hasFile('path_resource')) {
            $file = $request->file('path_resource');

            // Optionnel : générer un nom unique
            $filename = time() . '_' . $file->getClientOriginalName();

            // Stocke dans le disque 'public' (configuré dans config/filesystems.php)
            $path = $file->storeAs('articles', $filename, 'public');

            // Enregistre le chemin relatif dans les données à sauvegarder
            $data['path_resource'] = 'storage/'.$path;
        }

        $article = $this->repository->create($data);

        return redirect()->route('articles.index');
    }

    public function show($id)
    {
        $article = $this->repository->find($id);
        return new ArticleResource($article);
    }

    public function edit(int $id)
    {
        $categories = $this->categoryRepository->all();
        $article = $this->repository->find($id);
        return view('articles.edit', compact('categories', 'article'));
    }

    public function update(UpdateArticleRequest $request, $id)
    {
        $data = $request->validated();

        // Vérifie si un nouveau fichier a été uploadé pour path_resource
        if ($request->hasFile('path_resource')) {
            $file = $request->file('path_resource');

            // Optionnel : générer un nom unique
            $filename = time() . '_' . $file->getClientOriginalName();

            // Stocke dans le disque 'public'
            $path = $file->storeAs('articles', $filename, 'public');

            // Enregistre le chemin relatif dans les données à sauvegarder
            $data['path_resource'] = 'storage/'.$path;

            // Optionnel : supprimer l'ancienne image si elle existe
            $article = $this->repository->find($id);
            if ($article && $article->path_resource) {
                Storage::disk('public')->delete($article->path_resource);
            }
        }

        $article = $this->repository->update($id, $data);

        return redirect()->route('articles.index');
    }


    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('articles.index');
    }
}
