$(document).ready( function () {
    $('#listHistoryOrderTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/listHistoryOrderTable',
        columns: [
            { data: 'id', name: 'id', class: 'text-center' },
            { data: 'gor', name: 'gor', class: 'text-capitalize' },
            { data: 'field', name: 'field', class: 'text-capitalize' },
            { data: 'created_at', name: 'created_at', class: 'text-center' },
            { data: 'grand_total', name: 'grand_total', class: 'text-center' },
            { data: 'status', name: 'status', class: 'text-center' },
            { data: 'action', name: 'action', class: 'text-center' }
        ]
    });

    $('#listHistoryOrderWaitingTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/listHistoryOrderWaitingTable',
        columns: [
            { data: 'gor', name: 'gor', class: 'text-capitalize' },
            { data: 'field', name: 'field', class: 'text-capitalize' },
            { data: 'created_at', name: 'created_at', class: 'text-center' },
            { data: 'grand_total', name: 'grand_total', class: 'text-center' },
            { data: 'status', name: 'status', class: 'text-center' },
            { data: 'action', name: 'action', class: 'text-center' }
        ]
    });
});