<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class RequestTypeTicket implements DataTableScope
{
    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        switch (request()->type) {
            case 'all':
                if(auth()->user()->hasRole('user')) {
                    return $query->myTickets()->where('status', 'open');
                }
                return $query->myTickets()->where('status', 'open')->whereNotNull('assigned_id');
            case 'request':
                return $query->requestTickets();
                break;
            case 'unassigned':
                return $query->unassignedTickets()->where('status','<>', 'closed');
                break;
            case 'solved':
                return $query->myTickets()->where('status', 'solved');
                break;
            case 'updated':
                return $query->myTickets()->recentlyUpdated()->newActivity()->where('status','<>', 'closed');
                break;
            case 'closed':
                return $query->myTickets()->where('status', 'closed');
                break;
            case 'trashed':
                return $query->onlyTrashed()->myTickets();
                break;
            default:
                return $query->myTickets()->where('status', 'open');
                break;
        }
    }
}
