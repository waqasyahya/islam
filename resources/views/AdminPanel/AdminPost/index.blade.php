@extends('layouts.app')
@section('title')
AdminPost
@endsection

@section('page-header')
    <!-- PAGE HEADER -->
    <div class="page-header mt-5-7">
        <div class="page-leftheader">
            <h4 class="page-title mb-0" 
            style="color: #006d74;font-size:24px; font-weight:500;">Create AdminPost</h4>
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                            class="fa-solid fa-chart-tree-map mr-2 fs-12" 
                            style="color: #006d74;font-size:24px; font-weight:500;"></i>Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#"> AdminPost</a></li>
            </ol>
        </div>
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
                    <h5 class="modal-title" id="createBookingModalLabel">Create AdminPost</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <form class="needs-validation row" id="add_blogpost_form" novalidate="" enctype="multipart/form-data">
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
                                    <label class="form-label">Description1</label>
                                    <input name="Description1" type="text" class="form-control"
                                        placeholder="Description1" required="">
                                    <div class="invalid-feedback"> Description1 is Required.</div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Description2</label>
                                    <input name="Description2" type="text" class="form-control" placeholder="Description2"
                                        required="">
                                    <div class="invalid-feedback">Description2 is Required.</div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Description3</label>
                                    <input name="Description3" type="text" class="form-control" placeholder="Description3"
                                        required="">
                                    <div class="invalid-feedback">Description3 is Required.</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">blogpage_id</label>
                                    <input name="blogpage_id" type="text" class="form-control" placeholder="blogpage_id"
                                        required="">
                                    <div class="invalid-feedback">blogpage_id is Required.</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">meta_title</label>
                                    <input name="meta_title" type="text" class="form-control" placeholder="meta_title"
                                        required="">
                                    <div class="invalid-feedback">meta_title is Required.</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">meta_keywords</label>
                                    <input name="meta_keywords" type="text" class="form-control" placeholder="meta_keywords"
                                        required="">
                                    <div class="invalid-feedback">meta_keywords is Required.</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">meta_description</label>
                                    <input name="meta_description" type="text" class="form-control" placeholder="meta_description"
                                        required="">
                                    <div class="invalid-feedback">meta_description is Required.</div>
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
        $("#add_blogpost_form").submit(function(e) {
            e.preventDefault();
            var form = document.forms["add_blogpost_form"];
            if (form.checkValidity() === true) {
                var id = document.forms["add_blogpost_form"]["id"].value;
                var tittle = document.forms["add_blogpost_form"]["tittle"].value;

                var Description1 = document.forms["add_blogpost_form"]["Description1"].value;
                var Description2 = document.forms["add_blogpost_form"]["Description2"].value;
                var Description3 = document.forms["add_blogpost_form"]["Description3"].value;

                var blogpage_id = document.forms["add_blogpost_form"]["blogpage_id"].value;
                var meta_title = document.forms["add_blogpost_form"]["meta_title"].value;
                var meta_keywords = document.forms["add_blogpost_form"]["meta_keywords"].value;
                var meta_description = document.forms["add_blogpost_form"]["meta_description"].value;

                 var file = $('#image')[0].files;



                if (file.length > 0 ) {


                    var formData = new FormData();
                     formData.append('image', file[0]);




                    formData.append('id', id);
                    formData.append('tittle', tittle);
                    formData.append('blogpage_id', blogpage_id);

                    formData.append('Description1', Description1);
                    formData.append('Description2', Description2);
                    formData.append('Description3', Description3);
                    formData.append('meta_title', meta_title);
                    formData.append('meta_keywords', meta_keywords);
                    formData.append('meta_description', meta_description);
                    formData.append('_token', "{{ csrf_token() }}");

                    // console.log(formData);
                    $.ajax({
                        url: "{{ route('AdminPost.store') }}",
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
                                document.forms["add_blogpost_form"].reset();
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
                url: "{{ route('AdminPost.readbyid', ['id' => '']) }}/" + id,
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    document.forms["add_blogpost_form"]["id"].value = response.id;
                    document.forms["add_blogpost_form"]["tittle"].value = response.tittle;
                    document.forms["add_blogpost_form"]["blogpage_id"].value = response.blogpage_id;
                    document.forms["add_blogpost_form"]["Description1"].value = response.Description1;
                    document.forms["add_blogpost_form"]["Description2"].value = response.Description2;
                    document.forms["add_blogpost_form"]["Description3"].value = response.Description3;
                    document.forms["add_blogpost_form"]["meta_title"].value = response.meta_title;
                    document.forms["add_blogpost_form"]["meta_keywords"].value = response.meta_keywords;
                    document.forms["add_blogpost_form"]["meta_description"].value = response.meta_description;
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
                url: "{{ route('AdminPost.deletebyid', ['id' => '']) }}/" + id,
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
            Post
            </h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                    <li class="nav-item mr-1 mt-2">
                        <button class="btn btn-sm " data-bs-toggle="modal" style="background-color:white;color:#006d74;font-size:16px;font-weight:600;"
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
                        <th>blogpage_id</th>
                        <th>Description1</th>
                        <th>Description2</th>
                        <th>Description3</th>
                        <th>meta_title</th>
                        <th>meta_keywords</th>
                        <th>meta_description</th>
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
                    url: "{{ route('AdminPost.read') }}",
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
                        data: "blogpage_id"
                    },

                    {
                        data: "Description1"
                    },
                    {
                        data: "Description2"
                    },
                    {
                        data: "Description3"
                    },
                    {
                        data: "meta_title"
                    },
                    {
                        data: "meta_keywords"
                    },
                    {
                        data: "meta_description"
                    },
                    {
                        render: function(data, type, row) {
                            return '<img src="{{ asset('Blogpostimage/') }}/' + row.image +
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
