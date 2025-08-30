<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Repositories\BannerRepository;
use App\Http\Resources\BannerResource;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    protected $repository;

    public function __construct(BannerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/banners",
     *     operationId="getBannersList",
     *     tags={"Banners"},
     *     summary="Get list of banners",
     *     description="Returns a list of banners with their creator",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="image_path", type="string", example="/images/banner1.jpg"),
     *                 @OA\Property(property="position", type="string", example="HOMEPAGE_TOP"),
     *                 @OA\Property(property="link", type="string", example="https://example.com"),
     *                 @OA\Property(property="status", type="integer", example=1),
     *                 @OA\Property(
     *                     property="creator",
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Admin")
     *                 ),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time"),
     *                 @OA\Property(property="deleted_at", type="string", format="date-time", nullable=true)
     *             )
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=403, description="Forbidden")
     * )
     */
    public function index()
    {
        return BannerResource::collection($this->repository->all());
    }

    public function store(StoreBannerRequest $request)
    {
        $data = $request->validated();

        // Vérifie si un fichier a été uploadé pour 'path'
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');

            // Générer un nom unique pour éviter les collisions
            $filename = time() . '_' . $file->getClientOriginalName();

            // Stocke le fichier dans le disque 'public', dossier 'banners'
            $path = $file->storeAs('banners', $filename, 'public');

            // Met à jour le champ 'path' avec le chemin relatif
            $data['path'] = $path;
        }

        $banner = $this->repository->create($data);

        return new BannerResource($banner);
    }


    public function show($id)
    {
        $banner = $this->repository->find($id);
        return new BannerResource($banner);
    }

    public function update(UpdateBannerRequest $request, $id)
    {
        $banner = $this->repository->find($id); // Récupère l'enregistrement existant
        $data = $request->validated();

        // Vérifie si un nouveau fichier a été uploadé pour 'path'
        if ($request->hasFile('path')) {
            $file = $request->file('path');

            // Générer un nom unique pour éviter les collisions
            $filename = time() . '_' . $file->getClientOriginalName();

            // Stocke le fichier dans le disque 'public', dossier 'banners'
            $path = $file->storeAs('banners', $filename, 'public');

            // Supprime l'ancienne image si elle existe
            if ($banner->path && Storage::disk('public')->exists($banner->path)) {
                Storage::disk('public')->delete($banner->path);
            }

            // Met à jour le champ 'path' avec le nouveau chemin
            $data['path'] = $path;
        }

        $banner = $this->repository->update($id, $data);

        return new BannerResource($banner);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->noContent();
    }
}
