<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Repositories\QuestionRepository;
use App\Http\Resources\QuestionResource;

class QuestionController extends Controller
{
    protected $repository;

    public function __construct(QuestionRepository $repository)
    {
        $this->middleware(['auth', 'verified', 'admin.blogger']);
        $this->repository = $repository;
    }

    public function index()
    {
        $questions = $this->repository->all(['user', 'comments']);
        return view('questions', compact('questions'));
    }

    public function store(StoreQuestionRequest $request)
    {
        $question = $this->repository->create($request->validated());
        return redirect()->route('questions.index');
    }

    public function show($id)
    {
        $question = $this->repository->find($id, ['user', 'comments']);
        return new QuestionResource($question);
    }

    public function update(UpdateQuestionRequest $request, $id)
    {
        $question = $this->repository->update($id, $request->validated());
        return redirect()->route('questions.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('questions.index');
    }
}
