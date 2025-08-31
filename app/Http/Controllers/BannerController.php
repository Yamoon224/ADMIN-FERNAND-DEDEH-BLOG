<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Repositories\BannerRepository;
use App\Http\Resources\BannerResource;

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
        $horizontales = $this->repository->paginate(['HEADER','HOMEPAGE_TOP','HOMEPAGE_MIDDLE','HOMEPAGE_BOTTOM', 'FOOTER','POPUP','MOBILE_TOP','MOBILE_BOTTOM']);
        $verticales = $this->repository->paginate(['SIDEBAR_LEFT','SIDEBAR_RIGHT']);
        return view('banners', compact('horizontales', 'verticales'));
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
            $data['image_path'] = 'storage/'.$file->storeAs('banners', $filename, 'public');
        }

        $banner = $this->repository->create($data);

        return redirect()->route('banners.index')->with(['message'=>'Bannière Ajoutée avec succès!']);
    }


    public function show($id)
    {
        $banner = $this->repository->find($id);
        return new BannerResource($banner);
    }

    public function update(UpdateBannerRequest $request, $id)
    {
        $data = $request->validated();

        // Vérifie si un fichier a été uploadé pour 'path'
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');

            // Générer un nom unique pour éviter les collisions
            $filename = time() . '_' . $file->getClientOriginalName();

            // Stocke le fichier dans le disque 'public', dossier 'banners'
            $data['image_path'] = 'storage/'.$file->storeAs('banners', $filename, 'public');
        }

        $this->repository->update($id, $data);

        return redirect()->route('banners.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('banners.index');
    }
}
