@extends('layouts.app')
@section('title')
    Dashboard
@endsection

@section('page-header')
    <div class="page-header mt-5-7">

    </div>
@endsection
@section('content')
    <div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="createBookingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createBookingModalLabel">Create Testing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <form class="needs-validation row" id="add_Testing_form" novalidate="" enctype="multipart/form-data">
                    @csrf
                    <input name="id" type="text" hidden>
                    <div class="modal-body ">
                        <div class="row mx-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">option_1</label>
                                    <input name="option_1" id="option_1" type="text" class="form-control"
                                        placeholder="option_1 " required="">
                                    <div class="invalid-feedback"> Name is Required.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">option_2</label>
                                    <input name="option_2" id="option_2" type="text" class="form-control"
                                        placeholder="option_2 " required="">
                                    <div class="invalid-feedback"> Name is Required.</div>
                                </div>
                            </div>


















                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">audio1</label>
                                    <input name="audio1" id="audio1" type="file" class="form-control"
                                        placeholder="Select audio1">
                                    <div class="invalid-feedback">audio1 is Required.</div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label"> select Quaida_id</label>
                                    <input name="Quaida_id" id="Quaida_id" type="text" class="form-control"
                                        placeholder="Select audio">
                                    <div class="invalid-feedback">Quaida_id is Required.</div>
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
        $("#add_Testing_form").submit(function(e) {
            e.preventDefault();
            var form = document.forms["add_Testing_form"];
            if (form.checkValidity() === true) {
                var id = document.forms["add_Testing_form"]["id"].value;
                var option_1 = document.forms["add_Testing_form"]["option_1"].value;
                var option_2 = document.forms["add_Testing_form"]["option_2"].value;


                var Quaida_id = document.forms["add_Testing_form"]["Quaida_id"].value;





                var audio1File = $('#audio1')[0].files;



                if (audio1File.length > 0) {


                    var formData = new FormData();

                    formData.append('audio1', audio1File[0]);




                    formData.append('id', id);
                    formData.append('option_1', option_1);
                    formData.append('option_2', option_2);


                    formData.append('Quaida_id', Quaida_id);



                    formData.append('_token', "{{ csrf_token() }}");

                    // console.log(formData);
                    $.ajax({
                        url: "{{ route('QuaidaTest.store') }}",
                        method: 'post',
                        dataType: 'json',
                        data: formData,
                        contentType: false,
                        processData: false,

                        success: function(response) {

                            if (response.status == "200") {
                                $("#add_product_modal").modal("hide");
                                document.forms["add_Testing_form"].reset();
                                toastr.success("Record Save Successfully");
                                dataTable.ajax.reload();
                            } else {
                                toastr.error("Operation Failed");
                            }
                        },
                        error: function(response) {
                            console.log("error : " + JSON.stringify(response));
                        }
                    });

                } else {
                    alert("Please select a file.");
                }
            } else {
                console.log("Not ok");
            }
        });
    </script>

    <script>
        function Testing_read_by_id(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('QuaidaTest.readbyid', ['id' => '']) }}/" + id,
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    document.forms["add_Testing_form"]["id"].value = response.id;
                    document.forms["add_Testing_form"]["option_1"].value = response.option_1;
                    document.forms["add_Testing_form"]["option_2"].value = response.option_2;


                    document.forms["add_Testing_form"]["Quaida_id"].value = response.Quaida_id;


                    document.getElementById("audio1").value = response.audio1;

                },
                error: function(e, f, g) {
                    console.log(e, f, g);
                }
            });
        }


        function Testing_delete_by_id(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('QuaidaTest.deletebyid', ['id' => '']) }}/" + id,
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    toastr.success("Record Deleted Successfully");
                    dataTable.ajax.reload();
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
                        <button class="btn btn-sm " data-bs-toggle="modal" data-bs-target="#add_product_modal"
                            style="background-color:white;color:#006d74;font-size:16px;font-weight:600;"><i
                                class="fas fa-plus-circle"></i> Add new</button>
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
                        <th>option_1</th>
                        <th>option_2</th>

                        <th>audio1</th>

                        <th>Quaida_id</th>

                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


    <script>
        var dataTable;


        $(document).ready(function() {
            var dataTable = $("#example").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "{{ route('QuaidaTest.read') }}",
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    }
                },


                "columns": [{
                        data: "id"
                    },
                    {
                        data: "option_1"
                    },
                    {
                        data: "option_2"
                    },





                    {

                        render: function(data, type, row) {

                            return '<audio controls style="width: 100px; margin-left: 20px; margin-top: 30px;"><source src="{{ asset('Quranfolder/') }}/' +
                                row.audio1 + '" type="audio/mpeg"></audio>';


                        }
                    },

                    {
                        data: "Quaida_id"
                    },


                    {
                        "defaultContent": '<a class="fa-solid fa-pen table-action-buttons edit-action-button" id="edit_product" data-bs-toggle="modal" data-bs-target="#add_product_modal" ></a><a class="fa-solid fa-trash table-action-buttons edit-action-button" id="delete_product"></a>'
                    },
                ],
                "order": [
                    [0, "desc"]
                ],


            });
            $('div.head-label').html('<h3 class="card-title mb-0">property</h3>');
            $(
                "#example tbody").on("click", "#edit_product", function() {
                var data = dataTable.row($(this).parentsUntil("tr")).data();
                Testing_read_by_id(data.id);
                $('.addEditText').text("Edit");
            });
            $("#example tbody").on("click", "#delete_product", function() {
                var data = dataTable.row($(this).parentsUntil("tr")).data();
                Testing_delete_by_id(data.id);
            });

        });
    </script>
    </div>
@endsection
