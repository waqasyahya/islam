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
    <!-- Add Product Modal -->
    <div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="createBookingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createBookingModalLabel">Create AdminBlog </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <form class="needs-validation row" id="add_blogpage_form" novalidate="" enctype="multipart/form-data">
                    @csrf
                    <input name="id" type="text" hidden>
                    <div class="modal-body ">
                        <div class="row mx-2">




                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">tittle</label>
                                    <input name="tittle" type="text" class="form-control" placeholder="tittle"
                                        required="">
                                    <div class="invalid-feedback"> tittle is Required.</div>
                                </div>
                            </div>








                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">underdecsription</label>
                                    <input name="underdecsription" type="text" class="form-control"
                                        placeholder="underdecsription" required="">
                                    <div class="invalid-feedback"> underdecsription is Required.</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <input name="Description" type="text" class="form-control" placeholder="Description"
                                        required="">
                                    <div class="invalid-feedback">Description is Required.</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Image</label>
                                    <input name="image" id="image" type="file" class="form-control"
                                        placeholder="Select Image">
                                    <div class="invalid-feedback">Image is Required.</div>
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
        $("#add_blogpage_form").submit(function(e) {
            e.preventDefault();
            var form = document.forms["add_blogpage_form"];
            if (form.checkValidity() === true) {
                var id = document.forms["add_blogpage_form"]["id"].value;
                var tittle = document.forms["add_blogpage_form"]["tittle"].value;

                var underdecsription = document.forms["add_blogpage_form"]["underdecsription"].value;

                var Description = document.forms["add_blogpage_form"]["Description"].value;
                // alert(qty);
                var file = $('#image')[0].files;



                if (file.length > 0) {

                    // alert("ok");
                    var formData = new FormData();
                    formData.append('image', file[0]);




                    formData.append('id', id);
                    formData.append('tittle', tittle);
                    formData.append('underdecsription', underdecsription);

                    formData.append('Description', Description);
                    formData.append('_token', "{{ csrf_token() }}");

                    // console.log(formData);
                    $.ajax({
                        url: "{{ route('AdminBlog.store') }}",
                        method: 'post',
                        dataType: 'json',
                        data: formData,
                        contentType: false,
                        processData: false,

                        success: function(response) {
                            // alert(response);
                            // console.log(response);
                            if (response.status == "200") {
                                $("#add_product_modal").modal("hide");
                                document.forms["add_blogpage_form"].reset();
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
        // property ReadById
        function property_read_by_id(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('AdminBlog.readbyid', ['id' => '']) }}/" + id,
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    document.forms["add_blogpage_form"]["id"].value = response.id;
                    document.forms["add_blogpage_form"]["tittle"].value = response.tittle;
                    document.forms["add_blogpage_form"]["underdecsription"].value = response.underdecsription;
                    document.forms["add_blogpage_form"]["Description"].value = response.Description;
                    document.getElementById("image").value = response.image;

                },
                error: function(e, f, g) {
                    console.log(e, f, g);
                }
            });
        }


        function property_delete_by_id(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('AdminBlog.deletebyid', ['id' => '']) }}/" + id,
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

            <h3 class="card-title" style="font-size:24px;font-weight:600;">
                <i class="fas fa-bars-staggered mr-1"></i>
                Dashboard
            </h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                    <li class="nav-item mr-1 mt-2">
                        <button class="btn btn-sm " data-bs-toggle="modal"
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
                        <th>tittle</th>
                        <th>underdecsription</th>


                        <th>Description</th>
                        <th>Image</th>

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
                    url: "{{ route('AdminBlog.read') }}",
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    }
                },
                "columns": [{
                        data: "id"
                    },
                    {
                        data: "tittle"
                    },
                    {
                        data: "underdecsription"
                    },

                    {
                        data: "Description"
                    },
                    {
                        render: function(data, type, row) {
                            return '<img src="{{ asset('BlogImage/') }}/' + row.image +
                                '" alt="Product Image" width="100" />';
                        }
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
                property_read_by_id(data.id);
                $('.addEditText').text("Edit");
            });
            $("#example tbody").on("click", "#delete_product", function() {
                var data = dataTable.row($(this).parentsUntil("tr")).data();
                property_delete_by_id(data.id);
            });

        });
    </script>
    </div>
@endsection
