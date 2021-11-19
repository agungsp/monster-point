@extends('layouts.main')
@section('meta')

@endsection

@section('title', 'Merchants')

@section('css')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card rounded-xxl">
                <div class="card-body" style="min-height: calc(100vh - 10.3rem);">
                    <div class="row mb-3">
                        <div class="col">
                            <button type="button" id="createMerchant" class="btn btn-primary rounded-xxl" data-bs-toggle="modal" data-bs-target="#addMerchantModal">
                                Add Merchant <i class="fas fa-plus ms-3"></i>
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div id="merchantTable"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card rounded-xxl">
                <div class="card-body position-relative" style="min-height: calc(100vh - 10.3rem);">
                    <div class="row justify-content-between mb-3">
                        <div class="col-auto fw-bold">
                            <span id="merchant-name">No Name</span> <i class="fas fa-pencil-alt ms-3"></i>
                        </div>
                        <div class="col-auto">
                            <span id="total-member">0</span> <i class="fas fa-user ms-1"></i>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col">
                            <div id="memberTable"></div>
                        </div>
                    </div>
                    <button type="button" id="createMember" class="btn btn-primary rounded-xxl position-absolute" style="bottom: 1rem; right: 1rem;" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                        Add Member <i class="fas fa-plus ms-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    {{-- Add Merchant Modal --}}
    <div class="modal fade modalMerchant" id="addMerchantModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addMerchantModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-xxl">

            </div>
        </div>
    </div>

    {{-- Add Member Modal --}}
    <div class="modal fade modalMember" id="addMemberModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-xxl">

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let merchantPicPhone = null;
        let submitted = false;
        let merchantTable = null;
        let memberTable = null;
        let memberCount = null;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Delete Data Merchant / Member >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        function deleteData(id) {
            console.log('masuk');
            $('button').click(function() {
                let cekID = $(this).attr('id');
                // console.log(cek == 'deleteMerchant');
                if (cekID == 'deleteMember' || cekID == 'deleteMerchant') {
                    Swal.fire({
                        title: cekID == 'deleteMember' ? 'Do you want to delete this Member?' : 'Do you want to delete this Merchant?',
                        showCancelButton: true,
                        showConfirmButton: false,
                        showDenyButton: true,
                        denyButtonText: cekID == 'deleteMember' ? 'Delete this Member' : 'Delete this Merchant',
                        cancelButtonText: `No!`,
                    }).then((result) => {
                        if (result.isDenied) {
                            $.ajax({
                                url: cekID == 'deleteMember' ? `{{ route('members.index') }}/${id}` : `{{ route('merchants.index') }}/${id}`,
                                type: "DELETE",
                                data: {},
                                success: (res) => {
                                    Toast.fire({
                                        icon: 'success',
                                        title: res.message
                                    });
                                    if (cekID == 'deleteMember') {
                                        memberTable.refresh();
                                    } else {
                                        merchantTable.refresh();
                                    }
                                },
                                error: (error) => {
                                    console.log(error);
                                }
                            });
                        }
                    });
                }
            });
        }
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Delete Data Merchant / Member >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        $(document).ready(() => {
            $('#myCollapsible').on('shown.bs.collapse', function () {
                $('.collapse').collapse();
                console.log('test');
            })

            $('#addMerchantModal').on('shown.bs.modal', function () {
                $(this).find('#merchant_name').focus();
            });

            $('#addMemberModal').on('shown.bs.modal', function () {
                $(this).find('#member_key').focus();
            });

            getMembers();
            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Get Data Merchant >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            merchantTable = $('#merchantTable').dxDataGrid({
                dataSource: `{{ route('merchants.index') }}`,
                // keyExpr: 'Id',
                columnAutoWidth: true,
                hoverStateEnabled: true,
                selection: {
                    mode: "single" // or "multiple" | "none"
                },
                columns: [
                    {
                        caption: 'No',
                        width: 40,
                        cellTemplate: function(container, options) {
                            container.html(`${options.row.rowIndex + 1}`);
                        }
                    },
                    {
                        dataField: 'Nama',
                    },
                    {
                        dataField: 'Alamat',
                    },
                    {
                        dataField: 'Pic',
                    },
                    {
                        dataField: 'PicTelp',
                    },
                    {
                        dataField: 'Email',
                    },
                    {
                        dataField: 'Kebutuhan',
                    },
                    {
                        dataField: 'Id',
                        cellTemplate: function (container, options) {
                            container.html(`
                                <button class="btn btn-primary btn-sm rounded-xxl" data-id="${options.value}" id="editMerchant">
                                    <i class="fas fa-edit fa-sm"></i>
                                </button>
                                <button onclick="deleteData(${options.value});" class="btn btn-danger btn-sm rounded-xxl" id="deleteMerchant">
                                    <i class="fas fa-trash-alt fa-sm"></i>
                                </button>
                            `);
                        }
                    }
                ],
                showBorders: false,
                showColumnLines: false,
                showRowLines: true,
                activeStateEnabled: true,
                onSelectionChanged(selectedItems) {
                    const data = selectedItems.selectedRowsData[0];
                    if (data) {
                        let merchantId = data.Id;
                        document.getElementById('merchant-name').innerText = data.Nama;
                        getMembers(merchantId);
                    }
                },
            }).dxDataGrid('instance');
            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Get Data Merchant >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Get Data Member >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

            function getMembers(id = ''){
                memberTable = $('#memberTable').dxDataGrid({
                    // dataSource: `{{ route('members.index') }}`,
                    dataSource: `{{ url('members/getMembers') }}?id=${id}`,
                    data: {IdMerhant: id},
                    // keyExpr: 'Id',
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
                            dataField: 'Nama',
                        },
                        {
                            dataField: 'Point',
                        },
                        {
                            dataField: 'Id',
                            caption: '',
                            cellTemplate: function (container, options) {
                                container.html(`
                                    <button class="btn btn-primary btn-sm rounded-xxl" data-id="${options.value}" id="editMember">
                                        <i class="fas fa-edit fa-sm"></i>
                                    </button>
                                    <button onclick="deleteData(${options.value});" class="btn btn-danger btn-sm rounded-xxl" id="deleteMember">
                                        <i class="fas fa-trash-alt fa-sm"></i>
                                    </button>
                                `);
                            }
                        }
                    ],
                    showBorders: false,
                    showColumnLines: false,
                    showRowLines: true,
                }).dxDataGrid('instance');

                // =========== Get Total Member ==========
                var countMembers = memberTable.getDataSource().load().done(function (data) {
                    document.getElementById('total-member').innerText = data.length;
                })
            }

            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Get Data Member >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Call modal Create Data >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            $(document).on('click', '#createMerchant', function () {
                // $('.editorassets').find('form')[0].reset();
                $.get('{{ route("merchants.create") }}', function(data) {
                    $('.modalMerchant').find('.modal-content').html(data);
                    $('.modalMerchant').modal('show');
                    showRedStarRequired();
                });
            });

            $('.modalMerchant').on('hidden.bs.modal', function (event) {
                if (submitted) {
                    merchantTable.refresh();
                    submitted = false;
                }
            });

            $(document).on('click', '#createMember', function () {
                // $('.editorassets').find('form')[0].reset();
                $.get('{{ route("members.create") }}', function(data) {
                    $('.modalMember').find('.modal-content').html(data);
                    $('.modalMember').modal('show');
                });
            });

            $('.modalMember').on('hidden.bs.modal', function (event) {
                console.log('cek');
                if (submitted) {
                    memberTable.refresh();
                    submitted = false;
                }
            });
            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Call modal Create Data >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Edit Data >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            $(document).on('click', '#editMerchant', function() {
                let merchant_id = $(this).data('id');
                $('.modalMerchant').find('span.error-text').text('');
                $.get(`{{ route("merchants.index") }}/${merchant_id}/edit`, function(data) {
                    $('.modalMerchant').find('.modal-content').html(data);
                    $('.modalMerchant').modal('show');
                    showRedStarRequired();
                });
            });

            $(document).on('click', '#editMember', function() {
                let member_id = $(this).data('id');
                $('.modalMember').find('span.error-text').text('');
                $.get(`{{ route("members.index") }}/${member_id}/edit`, function(data) {
                    $('.modalMember').find('.modal-content').html(data);
                    $('.modalMember').modal('show');
                });
            });
            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Edit Data >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        });
    </script>
@endsection
