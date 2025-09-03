<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDailyRequest;
use App\Http\Requests\UpdateDailyRequest;
use App\Repositories\DailyRepository;
use App\Repositories\ContentRepository;
use App\Repositories\HashtagRepository;

class DailyController extends Controller
{
    protected $repository;
    protected $hashtagRepository;
    protected $contentRepository;

    public function __construct(DailyRepository $repository, HashtagRepository $hashtagRepository, ContentRepository $contentRepository)
    {
        $this->middleware(['auth', 'verified', 'admin.blogger']);
        $this->repository = $repository;
        $this->hashtagRepository = $hashtagRepository;
        $this->contentRepository = $contentRepository;
    }

    public function index()
    {
        $dailies = $this->repository->paginate(['user', 'contents']);
        return view('dailies.index', compact('dailies'));
    }

    public function create()
    {
        $hashtags = $this->hashtagRepository->all();
        return view('dailies.add', compact('hashtags'));
    }

    public function store(StoreDailyRequest $request)
    {
        // On valide uniquement les champs du daily
        $data = $request->only(['introduction', 'published_at', 'created_by']);

        // 1. Création du Daily
        $daily = $this->repository->create($data);

        // 2. Insertion des contenus associés
        if ($request->has('body')) {
            foreach ($request->body as $index => $body) {
                if (!empty($body)) {

                    $path = null;

                    // Vérifie si une image a été uploadée pour ce contenu
                    if ($request->hasFile("path_image.$index")) {
                        $file = $request->file("path_image.$index");

                        // Générer un nom unique pour éviter les collisions
                        $filename = time() . '_' . $file->getClientOriginalName();

                        // Stocker le fichier dans storage/app/public/contents
                        $path = 'storage/' . $file->storeAs('contents', $filename, 'public');
                    }

                    // Création du contenu lié au daily
                    $this->contentRepository->create([
                        'body'       => $body,
                        'path_image' => $path, // prend le chemin s’il existe
                        'hashtag_id' => $request->hashtag_id[$index],
                        'daily_id'   => $daily->id,
                        'created_by' => $daily->created_by,
                    ]);
                }
            }
        }

        return redirect()->route('dailies.index')->with('message', __('locale.created_successfully'));
    }

    public function show($id)
    {
        $daily = $this->repository->find($id, ['user', 'contents']);
        return view('dailies.show', compact('daily'));
    }

    public function edit(int $id)
    {
        $hashtags = $this->hashtagRepository->all();
        $daily = $this->repository->find($id);
        return view('dailies.edit', compact('hashtags', 'daily'));
    }

    public function update(UpdateDailyRequest $request, $id)
    {
        // 1. Mise à jour des champs du Daily
        $data = $request->only(['introduction', 'published_at', 'created_by']);
        dd($request->all());
        $daily = $this->repository->update($id, $data);

        // 2. Gestion des contenus à supprimer
        if ($request->has('deleted_contents')) {
            foreach ($request->deleted_contents as $contentId) {
                $existingContent = $this->contentRepository->find($contentId);
                if ($existingContent) {
                    // Supprime l'image si elle existe
                    if ($existingContent->path_image && file_exists(public_path($existingContent->path_image))) {
                        unlink(public_path($existingContent->path_image));
                    }
                    $this->contentRepository->delete($contentId);
                }
            }
        }

        // 3. Gestion des contenus associés (création / mise à jour)
        if ($request->has('body')) {
            foreach ($request->body as $index => $body) {
                if (!empty($body)) {

                    $path = null;

                    // Si le contenu existe déjà
                    if (isset($request->content_id[$index])) {
                        $contentId = $request->content_id[$index];
                        $existingContent = $this->contentRepository->find($contentId);

                        if ($existingContent) {
                            // Vérifie si une nouvelle image est uploadée
                            if ($request->hasFile("path_image.$index")) {
                                $file = $request->file("path_image.$index");
                                $filename = time() . '_' . $file->getClientOriginalName();
                                $path = 'storage/' . $file->storeAs('contents', $filename, 'public');

                                // Supprime l'ancienne image si elle existe
                                if ($existingContent->path_image && file_exists(public_path($existingContent->path_image))) {
                                    unlink(public_path($existingContent->path_image));
                                }
                            }

                            // Met à jour le contenu
                            $this->contentRepository->update($contentId, [
                                'body'       => $body,
                                'path_image' => $path ?? $existingContent->path_image,
                                'hashtag_id' => $request->hashtag_id[$index],
                                'daily_id'   => $daily->id,
                                'created_by' => $daily->created_by,
                            ]);
                        }
                    } else {
                        // Nouveau contenu
                        if ($request->hasFile("path_image.$index")) {
                            $file = $request->file("path_image.$index");
                            $filename = time() . '_' . $file->getClientOriginalName();
                            $path = 'storage/' . $file->storeAs('contents', $filename, 'public');
                        }

                        $this->contentRepository->create([
                            'body'       => $body,
                            'path_image' => $path,
                            'hashtag_id' => $request->hashtag_id[$index],
                            'daily_id'   => $daily->id,
                            'created_by' => $daily->created_by,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('dailies.index')->with('message', __('locale.updated_successfully'));
    }


    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('dailies.index');
    }
}
