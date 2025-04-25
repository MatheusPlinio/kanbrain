<?php

namespace App\Http\Controllers;

use App\Http\Requests\Column\StoreColumnRequest;
use App\Models\Board;
use App\Repositories\Contracts\Column\ColumnRepositoryInterface;
use Log;
use Symfony\Component\HttpFoundation\Response;

class ColumnController extends Controller
{
    public function __construct(protected ColumnRepositoryInterface $columnRepository)
    {
    }

    public function store(StoreColumnRequest $request)
    {
        $slug = $request->query('board_slug');
        $board = Board::where('slug', $slug)->first();

        try {
            $this->columnRepository->store($request->validated(), $board->id);

            return response()->json(
                ["message" => "Kanban criado com sucesso"],
                Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao criar status',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
