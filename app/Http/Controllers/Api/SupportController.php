<?php

namespace App\Http\Controllers;

use App\Http\Resources\SupportResource;
use App\Repositories\SupportRepository;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    protected $repository;

    public function __construct(SupportRepository $suportRepository)
    {
        $this->repository = $suportRepository;
    }

    public function index(Request $request)
    {
        $supports = $this->repository->getSupports();

        return SupportResource::collection($supports);
    }
}
