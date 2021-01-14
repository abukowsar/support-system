<?php
namespace App\DataTables;

use App\Traits\DataTableTrait;
use App\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Yajra\DataTables\Services\DataTable;

class ArticleDataTable extends DataTable
{
    use DataTableTrait;

    public function dataTable()
    {
        return datatables($this->query())

            ->editColumn('status', function($row) {
                if($row->status == '0')
                    $status = '<span class="badge  badge-danger">Un publish</span>';
                    else
                        $status = '<span class="badge  badge-success">Publish</span>';

                return $status;
            })
            ->editColumn('title',function ($row){
                $title = stringLong($row->title,'title','40');
              return $title;
            })
            ->addColumn('action', 'admin.articles.datatables-actions')

            ->rawColumns([ 'status', 'action']);
    }

    public function query()
    {

        return $this->applyScopes(Article::query());
    }

    public function html()
    {
        return $this->builder()
                    ->columns([
                        'id'              =>  [ 'title' => 'Id'],
                        'title'           =>  [ 'title' => 'Title'],
                        'status'          =>  [ 'title' => 'Status'],

                    ])
                    ->ajax('')
                    ->addAction(['title' => 'Actions','width' => '100px', 'printable' => false])
                    ->parameters($this->getBuilderParameters());
    }



    protected function filename()
    {
        return 'articles' . time();
    }
}
