@extends('admin.layouts.app')

@section('content')
<!-- header -->
<div class="clearfix mb-3">
    <div class="float-left">
        <h2>Toko</h2>
    </div>
    
    <a href="{{route('admin.store.add')}}" class="btn btn-primary float-right">Tambah Toko</a>
    
</div>
<div class="card p-4">

    <div class="table-responsive">
        <table id="data-table" class="display expandable-table" style="width:100%">
            <thead>
                <tr>
                    <th>No#</th>
                    <th>Nama Cabang</th>
                    <th>Kota</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- DeleteModal -->
<div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <form action="{{route('admin.store.delete')}}" method="POST" class="remove-record-model">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <div class="modal-body text-center">
                    <span style="font-size: 72px;" class="mx-auto"><i class="ti-trash text-danger"></i></span>

                    <h4 class="mb-3"><strong>Yakin ingin menghapus?</strong></h4>
                    <p id="delMsg"></p>
                    <input type="hidden" name="idStore" id="idStore">
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col pl-0">
                            <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">Batal</button>
                        </div>
                        <div class="col pr-0">
                            <button type="submit" class="btn btn-danger w-100">Hapus</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@push('stylesheets')
    <link rel="stylesheet" href="{{asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/js/select.dataTables.min.css') }}">
@endpush

@push('js')
<script src="{{asset('admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{asset('admin/js/dataTables.select.min.js') }}"></script>

<script>
    $(document).ready(function() {

        // Swal.fire(
        // 'The Internet?',
        // 'That thing is still around?',
        // 'question'
        // )

        var table = jQuery('#data-table').DataTable({
            processing:true,
            serverSide:true,
            destroy:true,
            responsive: true,
            ajax:{
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '{{ route('admin.stores') }}'
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name:'name', searchable: true},
                {data: 'city', name:'city'},
                {data: 'address', name:'address'},
                {data: 'phone', name:'phone'},
                {data: 'action', name:'action', className:'dataTables_empty'},
            ],
            columnDefs: [
            {
                className: 'text-center', targets: [4] ,
            },
            {
                className: 'text-center', targets: [0,4,5] , orderable: false, searchable: false,
            }],
            order: [[2, "asc"]],
            bLengthChange: false,
            pageLength: 10,
            autoWidth: false,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                'copy', 'excel', 'pdf'
            ]
        });
        jQuery.fn.dataTable.ext.errMode = 'none';

        //delete with modal
        $(document).on('click', '.deleteData', function () {
            var id = $(this).attr('data-storeId');
            var title = $(this).attr('data-storeTitle');
            $('#idStore').val(id);
            $('#delMsg').html("Apakah kamu yakin ingin menghapus toko" + title.bold() +
                "?");
        });

    });
</script>
@endpush