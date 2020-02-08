<?php


namespace App\Traits;


use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

trait PaginationTrait
{
    public function paginationParams(Request $request)
    {
        return [
            'page'     => $request->get('page') ?? 1 ,
            'paginate' => $this->shouldPaginate($request) ,
        ];
    }

    public function shouldPaginate($params, $queryName = 'paginate')
    {
        $default = '1';
        $allowed = ['0', '1'];
        $paginate = $default;
        if (isset($params[$queryName])) {
            if (! in_array($params[$queryName], $allowed)) {
                throw new BadRequestHttpException("allowed values: " . join(", ", $allowed));
            }
            $paginate = $params[$queryName];
        }

        switch ($paginate) {
            case '0':
                return false;
            case '1':
                return true;
        }
    }
}
