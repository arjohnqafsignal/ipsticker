<?php

namespace App\DataTables;

use App\IpSticker;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class IpStickersDataTable extends DataTable
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
            ->addColumn('action', function(IpSticker $ipsticker){
                $return = "return confirm('Are you sure?')";
                return '<div class="btn-group" role="group">
                            <a class="btn btn-primary btn-sm" href="'.route('admin.ipsticker.view', $ipsticker).'"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-danger btn-sm" href="'.route('admin.ipsticker.delete', $ipsticker).'" onClick="'.$return.'"><i class="fas fa-trash"></i></a>
                        </div>';
            })
            ->editColumn('created_at', function(IpSticker $ipsticker){
                return date('F d, Y h:i:sA', strtotime($ipsticker->created_at));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\IpSticker $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(IpSticker $model)
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
                    ->setTableId('ipstickers-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('user_name'),
            Column::make('computer_name'),
            Column::make('ip_address'),
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
        return 'IpStickers_' . date('YmdHis');
    }
}
