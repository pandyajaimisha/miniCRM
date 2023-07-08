<?php

namespace App\DataTables;

use App\Models\Company;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CompanyDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($q) {
                return view('companies.partials.actions', compact('q'));
            })
            ->addColumn('logo', function ($q) {
                return ($q->logo) ? view('companies.partials.logo', compact('q')) : '';
            })
            ->editColumn('email', function ($q) {
                return '<a href="mailto:' . $q->email . '">' . $q->email . '</a>';
            })
            ->editColumn('website_url', function ($q) {
                return '<a href="' . $q->website_url . '" target="_blank">' . $q->website_url . '</a>';
            })
            ->editColumn('created_at', function ($q) {
                return $q->created_at->toDayDateTimeString();
            })
            ->editColumn('updated_at', function ($q) {
                return $q->created_at->toDayDateTimeString();
            })
            ->rawColumns(['email', 'website_url'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Company $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('company-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::computed('logo')
                  ->exportable(false)
                  ->printable(false)
                  ->width(100),
            Column::make('name'),
            Column::make('email'),
            Column::make('website_url'),
            Column::make('contact_person'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Company_' . date('YmdHis');
    }
}
