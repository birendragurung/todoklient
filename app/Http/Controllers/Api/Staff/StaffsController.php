<?php

namespace App\Http\Controllers\Api\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateStaffRequest;
use App\Interfaces\StaffsInterface;
use App\Traits\PaginationTrait;
use Illuminate\Http\Request;

class StaffsController extends Controller
{
    use PaginationTrait;
    /**
     * @var \App\Interfaces\StaffsInterface
     */
    private $staffs;

    public function __construct(StaffsInterface $staffs)
    {
        $this->staffs = $staffs;
    }

    public function index(Request $request)
    {
        $paginate = $this->shouldPaginate($request);
        return $this->staffs->paginatedList();
    }

    public function store(CreateStaffRequest $request)
    {
        return $this->staffs->create($request->all());
    }
}
