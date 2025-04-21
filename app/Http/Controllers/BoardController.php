<?php

namespace App\Http\Controllers;

use App\Http\Requests\Board\BoardStoreRequest;
use App\Http\Resources\BoardsResource;
use App\Repositories\Contracts\Board\BoardRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

class BoardController extends Controller
{

    public function __construct(protected BoardRepositoryInterface $boardRepository)
    {
    }

    /**
     * Listar Quadros de kanbans
     */
    public function index()
    {
        auth()->user()->boards;

        return BoardsResource::collection(auth()->user()->boards);
    }

    //**
    // * Criar Quadro de Kanban */
    public function store(BoardStoreRequest $request)
    {
        try {
            $this->boardRepository->create($request->validated());

            return response()->json(
                ["message" => "Kanban criado com sucesso"],
                Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao criar board',
                'error' => $e->getMessage()
            ], $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
