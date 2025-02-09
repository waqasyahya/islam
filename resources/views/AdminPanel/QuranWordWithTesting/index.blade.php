@extends('layouts.app')
@section('title')
    Dashboard
@endsection

@section('page-header')
    <!-- PAGE HEADER -->
    <div class="page-header mt-5-7">

    </div>
    <!-- END PAGE HEADER -->
@endsection
@section('content')
    <!-- Add Waqas  Modal -->
    <div class="modal fade" id="add_property_modal" tabindex="-1" role="dialog" aria-labelledby="createBookingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createBookingModalLabel">Create QuranWithWord </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <form class="needs-validation row" id="add_QuranWithWord_form" novalidate="">
                    @csrf
                    <input name="id" type="text" hidden>
                    <div class="modal-body ">
                        <div class="row mx-2">
                            <div class="col-md-12">
                                <label class="form-label">Quran_id</label>
                                <input name="Quran_id" type="text" class="form-control" placeholder="Quran_id"
                                    required="">
                                <div class="invalid-feedback"> Quran_id is Required.</div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">option_1</label>
                                <input name="option_1" type="text" class="form-control" placeholder="option_1"
                                    required="">
                                <div class="invalid-feedback"> option_1 is Required.</div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">option_2</label>
                                <input name="option_2" type="text" class="form-control" placeholder="option_2"
                                    required="">
                                <div class="invalid-feedback"> option_2 is Required.</div>
                            </div>



                            <div class="col-md-12">
                                <label class="form-label">audios_link</label>
                                <input name="audios_link" type="text" class="form-control" placeholder="audios_link"
                                    required="">
                                <div class="invalid-feedback"> audios_link is Required.</div>
                            </div>



                        </div>

                        <div class="modal-footer justify-content-between mt-3 ml-2">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <b-button variant="primary" v-if="!load" class="btn-lg " disabled>
                                <b-spinner small type="grow"></b-spinner>
                            </b-button>
                            <button type="submit" class="btn btn-lg btn-primary  " id="">Save </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        $('#rent_period_section').hide();

        function purposeChange(value) {
            if (value == 1) {
                $('#rent_period_section').show();
            } else {
                $('#rent_period_section').hide();
            }
        }
        //property
        $("#add_QuranWithWord_form").submit(function(e) {
            e.preventDefault();
            var form = document.forms["add_QuranWithWord_form"];
            if (form.checkValidity() === true) {
                var id = document.forms["add_QuranWithWord_form"]["id"].value;
                var Quran_id = document.forms["add_QuranWithWord_form"]["Quran_id"].value;
                var option_1 = document.forms["add_QuranWithWord_form"]["option_1"].value;
                var option_2 = document.forms["add_QuranWithWord_form"]["option_2"].value;

                var audios_link = document.forms["add_QuranWithWord_form"]["audios_link"].value;


                $.ajax({
                    type: "GET",
                    url: "{{ route('QuranWordWithTesting.store') }}",
                    data: {
                        id: id,
                        Quran_id: Quran_id,
                        option_1: option_1,
                        option_2: option_2,

                        audios_link: audios_link,


                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.status == "200") {
                            $("#add_property_modal").modal("hide");
                            document.forms["add_QuranWithWord_form"].reset();
                            toastr.success("Record Save Successfully");
                            dataTable.ajax.reload();
                        } else {
                            toastr.error("Operation Failed");
                        }
                    },
                    error: function(e, f, g) {
                        toastr.error("Error: " + e.responseJSON.message);
                    }
                });
            } else {
                console.log("Not ok");
            }
        });
    </script>

    <script>
        // property ReadById
        function read_read_by_id(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('QuranWordWithTesting.readbyid', ['id' => '']) }}/" + id,
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    document.forms["add_QuranWithWord_form"]["id"].value = response.id;
                    document.forms["add_QuranWithWord_form"]["Quran_id"].value = response.Quran_id;
                    document.forms["add_QuranWithWord_form"]["option_1"].value = response.option_1;
                    document.forms["add_QuranWithWord_form"]["option_2"].value = response.option_2;

                    document.forms["add_QuranWithWord_form"]["audios_link"].value = response.audios_link;




                },
                error: function(e, f, g) {
                    console.log(e, f, g);
                }
            });
        }

        function purpose_delete(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('QuranWordWithTesting.delete', ['id' => '']) }}/" + id,
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status == "600") {
                        toastr.success("Record Deleted Successfully");
                        dataTable.ajax.reload();
                    } else {
                        toastr.error("Operation Failed");
                    }
                },
                error: function(e, f, g) {
                    console.log(e, f, g);
                }
            });
        }
    </script>
    <div class="card">
        <div class="card-header ui-sortable-handle" style="cursor: move;display: table-row;">

            <h3 class="card-title">
                <i class="fas fa-bars-staggered mr-1"></i>
                Dashboard
            </h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                    <li class="nav-item mr-1 mt-2">
                        <button class="btn btn-sm " data-bs-toggle="modal" data-bs-target="#add_property_modal"
                            style="background-color:white;color:#006d74;font-size:16px;font-weight:600;"
                            data-bs-target="#add_product_modal"><i class="fas fa-plus-circle"></i> Add new</button>
                    </li>

                </ul>
            </div>
        </div>
        <div class="card-body table-responsive ">
            <table class=" responsive datatables-basic table border-top  table cell-border compact stripe nowrap"
                id="example">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Quran_id</th>
                        <th>option_1</th>
                        <th>option_2</th>

                        <th>audios_link</th>

                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <script>
        //    $(document).ready(function() {
        //     var dataTable = $("#example").DataTable({
        //         "ajax": {
        //             "processing": true,
        //             "serverSide": true,
        //             url: "{{ route('QuranWordWithTesting.read') }}",
        //             type: "GET",
        //             data: {
        //                 "_token": "{{ csrf_token() }}"
        //             }
        //         },
        //         "columns": [
        //             { data: "id" },
        //             { data: "Quran_id" },
        //             { data: "option_1" },
        //             { data: "option_2" },
        //             { data: "audios_link" },
        //             {
        //                 "defaultContent": `
    //                     <a class="fa-solid fa-pen table-action-buttons edit-action-button" id="edit_purpose" data-bs-toggle="modal" data-bs-target="#add_property_modal"></a>
    //                     <a class="fa-solid fa-trash table-action-buttons delete-action-button" id="delete_purpose"></a>
    //                 `
        //             }
        //         ],
        //         "order": [[0, "desc"]]
        //     });

        //     $("#example tbody").on("click", "#edit_purpose", function() {
        //         var data = dataTable.row($(this).parentsUntil("tr")).data();
        //         read_read_by_id(data.id);
        //         $('.addEditText').text("Edit");
        //     });

        //     $("#example tbody").on("click", "#delete_purpose", function() {
        //         var data = dataTable.row($(this).parentsUntil("tr")).data();
        //         purpose_delete(data.id);
        //         $('.addEditText').text("Delete");
        //     });
        // });
        // new
        $(document).ready(function() {
            var dataTable = $("#example").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "{{ route('QuranWordWithTesting.read') }}",
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    }
                },
                "columns": [{
                        data: "id"
                    },
                    {
                        data: "Quran_id"
                    },
                    {
                        data: "option_1"
                    },
                    {
                        data: "option_2"
                    },
                    {
                        data: "audios_link"
                    },
                    {
                        "defaultContent": '<a class="fa-solid fa-pen table-action-buttons edit-action-button" id="edit_purpose" data-bs-toggle="modal" data-bs-target="#add_property_modal" ></a><a class="fa-solid fa-trash table-action-buttons delete-action-button" id="delete_purpose"></a>'
                    },
                ],
                "order": [
                    [0, "desc"]
                ]
            });

            $('div.head-label').html('<h3 class="card-title mb-0">lesson</h3>');
            $("#example tbody").on("click", "#edit_purpose", function() {
                var data = dataTable.row($(this).parentsUntil("tr")).data();
                read_read_by_id(data.id);
                $('.addEditText').text("Edit");
            });
            $("#example tbody").on("click", "#delete_purpose", function() {
                var data = dataTable.row($(this).parentsUntil("tr")).data();
                purpose_delete(data.id);
                $('.addEditText').text("delete");
            });
        });

        // new
    </script>

    </div>
@endsection
