@extends('layouts.main')
@section('meta')

@endsection

@section('css')

@endsection

@section('title', 'Events')

@section('content')
    <div class="card rounded-xxl">
        <div class="card-body" style="min-height: calc(100vh - 10.3rem);">
            <div class="d-flex mb-3">
                <a href="{{ route('events.create') }}" class="btn btn-primary rounded-xxl">
                    New Event <i class="fas fa-plus ms-2"></i>
                </a>
            </div>

            <div class="row">
                <div class="col">
                    <div id="eventTable"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')

@endsection

@section('js')
    <script>
        let eventTable = null;
        function deleteEvent(id) {
            Swal.fire({
                title: 'Do you want to delete this event?',
                showCancelButton: true,
                showConfirmButton: false,
                showDenyButton: true,
                denyButtonText: 'Delete this event',
                cancelButtonText: `No!`,
            }).then((result) => {
                if (result.isDenied) {
                    $.ajax({
                        url: `{{ route('events.index') }}/${id}`,
                        type: "DELETE",
                        data: {},
                        success: (res) => {
                            Toast.fire({
                                icon: 'success',
                                title: res.message
                            });
                            eventTable.refresh();
                        },
                        error: (error) => {
                            console.log(error);
                        }
                    });
                }
            });
        }

        $(document).ready(() => {
            eventTable = $('#eventTable').dxDataGrid({
                dataSource: "{{ route('events.index') }}",
                keyExpr: 'Id',
                columnAutoWidth: true,
                hoverStateEnabled: true,
                columns: [
                    {
                        caption: '#',
                        cellTemplate: function(container, options) {
                            container.html(`${options.row.rowIndex + 1}`);
                        }
                    },
                    {
                        dataField: 'Kode',
                    },
                    {
                        dataField: 'Event',
                    },
                    {
                        dataField: 'Formula'
                    },
                    {
                        dataField: 'Daily',
                    },
                    {
                        dataField: 'Once',
                    },
                    {
                        dataField: 'LockDelay',
                        dataType: 'number',
                        cellTemplate: function (container, options) {
                            container.html(`
                                ${options.value} min
                            `);
                        }
                    },
                    {
                        dataField: 'Keterangan'
                    },
                    {
                        dataField: 'Id',
                        caption: '',
                        cellTemplate: function (container, options) {
                            container.html(`
                                <a href="{{ route('events.index') }}/${options.value}/edit" class="btn btn-primary btn-sm rounded-xxl" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <i class="fas fa-pencil-alt fa-sm"></i>
                                </a>
                                <button onclick="deleteEvent(${options.value});" class="btn btn-danger btn-sm rounded-xxl" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                    <i class="fas fa-trash-alt fa-sm"></i>
                                </button>
                            `);
                            activateTooltip();
                        }
                    }
                ],
                showBorders: false,
                showColumnLines: false,
                showRowLines: true,
            }).dxDataGrid('instance');
        });
    </script>
@endsection
