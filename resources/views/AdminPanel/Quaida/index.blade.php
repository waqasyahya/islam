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
                    <h5 class="modal-title" id="createBookingModalLabel">Create Quaida </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <form class="needs-validation row" id="add_Quaida_form" novalidate="">
                    @csrf
                    <input name="id" type="text" hidden>
                    <div class="modal-body ">
                        <div class="row mx-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Quaida_Name</label>
                                    <input name="Quaida_Name" type="text" class="form-control" placeholder="Quaida_Name"
                                        required="">
                                    <div class="invalid-feedback"> Quaida_Name is Required.</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Quaida_Words</label>
                                    <input name="Quaida_Words" type="text" class="form-control"
                                        placeholder="Quaida_Words" required="">
                                    <div class="invalid-feedback"> Quaida_Words is Required.</div>
                                </div>
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
        $("#add_Quaida_form").submit(function(e) {
            e.preventDefault();
            var form = document.forms["add_Quaida_form"];
            if (form.checkValidity() === true) {
                var id = document.forms["add_Quaida_form"]["id"].value;
                var Quaida_Name = document.forms["add_Quaida_form"]["Quaida_Name"].value;
                var Quaida_Words = document.forms["add_Quaida_form"]["Quaida_Words"].value;



                $.ajax({
                    type: "GET",
                    url: "{{ route('Quaida.store') }}",
                    data: {
                        id: id,
                        Quaida_Name: Quaida_Name,
                        Quaida_Words: Quaida_Words,



                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.status == "200") {
                            $("#add_property_modal").modal("hide");
                            document.forms["add_Quaida_form"].reset();
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
        function Quaida_read_by_id(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('Quaida.readbyid', ['id' => '']) }}/" + id,
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    document.forms["add_Quaida_form"]["id"].value = response.id;
                    document.forms["add_Quaida_form"]["Quaida_Name"].value = response.Quaida_Name;
                    document.forms["add_Quaida_form"]["Quaida_Words"].value = response.Quaida_Words;






                },
                error: function(e, f, g) {
                    console.log(e, f, g);
                }
            });
        }

        function Quaida_delete(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('Quaida.delete', ['id' => '']) }}/" + id,
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
                        <th>Quaida_Name</th>
                        <th>Quaida_Words</th>


                        <th>Action</th>

                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <script>
        var dataTable;
        $(document).ready(function() {
            dataTable = $("#example").DataTable({
                "ajax": {
                    url: "{{ route('Quaida.read') }}",
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    }
                },
                "columns": [{
                        data: "id"
                    },
                    {
                        data: "Quaida_Name"
                    },
                    {
                        data: "Quaida_Name"
                    },
                    {
                        "defaultContent": '<a class="fa-solid fa-pen table-action-buttons edit-action-button" id="edit_purpose" data-bs-toggle="modal" data-bs-target="#add_property_modal" ></a><a class="fa-solid fa-trash table-action-buttons delete-action-button" id="delete_purpose"></a>'
                    },



                ],
                "order": [
                    [0, "desc"]
                ],


            });
            $('div.head-label').html('<h3 class="card-title mb-0">lesson</h3>');
            $("#example tbody").on("click", "#edit_purpose", function() {
                var data = dataTable.row($(this).parentsUntil("tr")).data();
                Quaida_read_by_id(data.id);
                $('.addEditText').text("Edit");
            });
            $("#example tbody").on("click", "#delete_purpose", function() {
                var data = dataTable.row($(this).parentsUntil("tr")).data();
                Quaida_delete(data.id);
                $('.addEditText').text("delete");
            });
        });
    </script>

    </div>
@endsection
