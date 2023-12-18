$(document).ready( function () {
    $('#dataMasterRenter').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataMasterRenter',
        columns: [
            { data: 'name', name: 'name', class: 'text-capitalize' },
            { data: 'phone', name: 'phone', class: 'text-center'},
            { data: 'created_at', name: 'created_at', class: 'text-center'},
            { data: 'status', name: 'status', class: 'text-center text-capitalize' },
            { data: 'action', name: 'action', class: 'text-center' }
        ]
    });

    $('#dataMasterGor').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataMasterGor',
        columns: [
            { data: 'name', name: 'name', class: 'text-capitalize' },
            { data: 'price', name: 'price', class: 'text-center'},
            { data: 'type_duration', name: 'type_duration', class: 'text-center'},
            { data: 'address', name: 'address'},
            { data: 'created_at', name: 'created_at', class: 'text-center'},
            { data: 'status', name: 'status', class: 'text-center text-capitalize' },
            { data: 'action', name: 'action', class: 'text-center' }
        ]
    });

    $('#dataMasterField').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataMasterField',
        columns: [
            { data: 'name', name: 'name', class: 'text-capitalize' },
            { data: 'gor', name: 'gor', class: 'text-center text-capitalize'},
            { data: 'field_category', name: 'field_category', class: 'text-center text-capitalize'},
            { data: 'description', name: 'description'},
            { data: 'created_at', name: 'created_at', class: 'text-center'},
            { data: 'status', name: 'status', class: 'text-center text-capitalize' },
            { data: 'action', name: 'action', class: 'text-center text-capitalize' }
        ]
    });

    $('#dataMasterFieldCategory').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataMasterFieldCategory',
        columns: [
            { data: 'name', name: 'name', class: 'text-center text-capitalize' },
            { data: 'action', name: 'action', class: 'text-center' }
        ]
    });
});