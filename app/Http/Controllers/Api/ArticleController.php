<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Repositories\ArticleRepository;
use App\Http\Resources\ArticleResource;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    protected $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/articles",
     *     operationId="getArticlesList",
     *     tags={"Articles"},
     *     summary="Get list of articles",
     *     description="Returns a list of articles with their category",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Titre de l'article"),
     *                 @OA\Property(property="type", type="string", example="Type de l'article : PODCAST | ARTICLE"),
     *                 @OA\Property(property="path_resource", type="string", example="Image de l'article"),
     *                 @OA\Property(property="content", type="string", example="Contenu de l'article"),
     *                 @OA\Property(
     *                     property="category",
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=10),
     *                     @OA\Property(property="name", type="string", example="Catégorie 1")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     )
     * )
     */
    public function index() 
    {
        return ArticleResource::collection($this->repository->all(['category']));
    }

    public function store(StoreArticleRequest $request)
    {
        $data = $request->validated();

        // Vérifie si un fichier a été uploadé pour path_resource
        if ($request->hasFile('path_resource')) {
            $file = $request->file('path_resource');

            // Optionnel : générer un nom unique
            $filename = time() . '_' . $file->getClientOriginalName();

            // Stocke dans le disque 'public' (configuré dans config/filesystems.php)
            $path = $file->storeAs('articles', $filename, 'public');

            // Enregistre le chemin relatif dans les données à sauvegarder
            $data['path_resource'] = $path;
        }

        $article = $this->repository->create($data);

        return new ArticleResource($article);
    }

    public function show($id)
    {
        $article = $this->repository->find($id);
        return new ArticleResource($article);
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
            $data['path_resource'] = $path;

            // Optionnel : supprimer l'ancienne image si elle existe
            $article = $this->repository->find($id);
            if ($article && $article->path_resource) {
                Storage::disk('public')->delete($article->path_resource);
            }
        }

        $article = $this->repository->update($id, $data);

        return new ArticleResource($article);
    }


    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->noContent();
    }
}
