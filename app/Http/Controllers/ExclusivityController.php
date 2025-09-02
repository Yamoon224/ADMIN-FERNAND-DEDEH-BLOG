<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExclusivityRequest;
use App\Http\Requests\UpdateExclusivityRequest;
use App\Repositories\ExclusivityRepository;
use App\Http\Resources\ExclusivityResource;
use App\Models\Exclusivity;

class ExclusivityController extends Controller
{
    protected $repository;

    public function __construct(ExclusivityRepository $repository)
    {
        $this->middleware(['auth', 'verified', 'admin.blogger']);
        $this->repository = $repository;
    }

    public function index()
    {
        $exclusivities = $this->repository->all(['user']);
        return view('exclusivities', compact('exclusivities'));
    }

    public function store(StoreExclusivityRequest $request)
    {
        $exclusivity = $this->repository->create($request->validated());
        return redirect()->route('exclusivities.index');
    }

    public function show($id)
    {
        $exclusivity = $this->repository->find($id, ['user']);
        return new ExclusivityResource($exclusivity);
    }

    public function update(UpdateExclusivityRequest $request, $id)
    {
        $exclusivity = $this->repository->update($id, $request->validated());
        return redirect()->route('exclusivities.index');
    }

    public function destroy($id)
    {
        $exclusivity = Exclusivity::find($id);
        $this->repository->delete($exclusivity);
        return redirect()->route('exclusivities.index');
    }
}
