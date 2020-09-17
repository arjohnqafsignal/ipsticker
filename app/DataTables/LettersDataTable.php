<?php

namespace App\DataTables;

use App\Models\Letter;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LettersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function(Letter $letter){
                $return = "return confirm('Are you sure?')";
                return '<div class="btn-group" role="group">
                            <a class="btn btn-primary btn-sm" href="'.route('admin.sticker.viewstickers', $letter).'"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-danger btn-sm" href="'.route('admin.sticker.deleteletter', $letter).'" onClick="'.$return.'"><i class="fas fa-trash"></i></a>
                        </div>';
            })
            ->editColumn('letter_date', function(Letter $letter){
                return date('F d, Y', strtotime($letter->letter_date));
            })
            ->editColumn('created_at', function(Letter $letter){
                return date('F d, Y h:i:sA', strtotime($letter->created_at));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Letter $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Letter $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('letters-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('id'),
            Column::make('letter_number'),
            Column::make('letter_date'),
            Column::make('created_at'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Letters_' . date('YmdHis');
    }
}
