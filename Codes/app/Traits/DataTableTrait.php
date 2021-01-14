<?php


namespace App\Traits;

use Yajra\DataTables\Services\DataTable;

trait DataTableTrait {

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->ajax('')
            ->addAction(['printable' => false])
            ->parameters($this->getBuilderParameters());
    }


    public function getBuilderParameters()
    {
        return [
            'lengthMenu'   => [[10, 50, 100, 500, -1], [10, 50, 100, 500, "All"]],
            "dom"         => "<'row mt-3' <'col-md-2' <'ml-2' l>><'col-md-6' B><'col-md-4' <'mr-2' f>>> <'row m-0' <'col-md-12 table-responsive' t>>" .
                                "<'row'<'col-sm-6' <'ml-2 mb-3' i>><'col-sm-6 text-sm-center' <'mr-2 mb-3' p>>>",
            'buttons' => [
                [
                    'extend' => 'reload',
                    'text' => '<i class="fas fa-redo"></i> Reload',
                    'className' => 'btn btn-sm',
                ],
                [
                    'extend' => 'reset',
                    'text' => '<i class="fas fa-sync"></i> Reset',
                    'className' => 'btn btn-sm',
                ],
                [
                    'extend' => 'print',
                    'text' => '<i class="fas fa-print"></i> Print',
                    'className' => 'btn btn-sm',
                ],
            ],
            'language'      => [
                "paginate" => [
                    "next"=> '<i class="fas fa-angle-right"></i>',
                    "previous"=> '<i class="fas fa-angle-left"></i>'
                ]
            ],
            'initComplete' => "function () {
                $('#dataTableBuilder_wrapper thead').addClass('thead-light');
                this.api().columns().every(function () {
                    /*var column = this;
                    var input = document.createElement(\"input\");
                    input.className = \"form-control h-3\";
                    $(input).appendTo($(column.footer()).empty())
                    .on('keyup change', function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? val : '', false, false, true).draw();
                    });*/

                    /*$('#dataTableBuilder_wrapper thead').append($('#dataTableBuilder_wrapper tfoot tr'));*/
                });
            }"
        ];
    }
}
