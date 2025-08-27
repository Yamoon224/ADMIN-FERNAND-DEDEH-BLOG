<?php

namespace App\Http\Controllers;

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
        $this->middleware(['auth', 'verified']);
        $this->repository = $repository;
    }

    public function index()
    {
        $banners = $this->repository->paginate();
        return view('banners', compact('banners'));
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
            $data['image_path'] = $path;
        }

        $banner = $this->repository->create($data);

        return redirect()->route('banners.index');
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
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');

            // Générer un nom unique pour éviter les collisions
            $filename = time() . '_' . $file->getClientOriginalName();

            // Stocke le fichier dans le disque 'public', dossier 'banners'
            $path = $file->storeAs('banners', $filename, 'public');

            // Supprime l'ancienne image si elle existe
            if ($banner->path && Storage::disk('public')->exists($banner->path)) {
                Storage::disk('public')->delete($banner->path);
            }

            // Met à jour le champ 'path' avec le nouveau chemin
            $data['image_path'] = $path;
        }

        $banner = $this->repository->update($id, $data);

        return redirect()->route('banners.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('banners.index');
    }
}
