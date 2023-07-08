<?php

namespace App\DataTables;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EmployeeDataTable extends DataTable
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
                return view('employees.partials.actions', compact('q'));
            })
            ->addColumn('company', function ($q) {
                return '<a target="_blank" href="' . route('companies.show', $q->company_id) . '">' . $q->company->name . '</a>';
            })
            ->editColumn('email', function ($q) {
                return '<a href="mailto:' . $q->email . '">' . $q->email . '</a>';
            })
            ->editColumn('phone', function ($q) {
                return '<a href="tel:' . $q->phone . '">' . $q->phone . '</a>';
            })
            
            ->editColumn('created_at', function ($q) {
                return $q->created_at->toDayDateTimeString();
            })
            ->editColumn('updated_at', function ($q) {
                return $q->created_at->toDayDateTimeString();
            })
            ->rawColumns(['email', 'phone', 'company'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Employee $model): QueryBuilder
    {
        $query = $model->newQuery();

        if (request()->isMethod('GET') && request()->filled('company')) {
            $query = $query->where('company_id', request()->get('company'));
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('employee-table')
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
            Column::make('first_name'),
            Column::make('last_name'),
            Column::make('email'),
            Column::make('company'),
            Column::make('phone'),
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
        return 'Employee_' . date('YmdHis');
    }
}
