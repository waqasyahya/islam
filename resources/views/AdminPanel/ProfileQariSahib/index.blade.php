@extends('layouts.app')
@section('title')
    ProfileQariSahib
@endsection

@section('page-header')
    <!-- PAGE HEADER -->
    <div class="page-header mt-5-7">
        <div class="page-leftheader">
            <h4 class="page-title mb-0" style="color: #006d74;font-size:24px; font-weight:500;">ProfileQariSahib</h4>
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                            style="color: #006d74;font-size:24px; font-weight:500;"
                            class="fa-solid fa-chart-tree-map mr-2 fs-12"></i>Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#"> ProfileQariSahib</a></li>
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
                    <h5 class="modal-title" id="createBookingModalLabel">Create ProfileQariSahib </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <form class="needs-validation row" id="add_blogpage_form" novalidate="" enctype="multipart/form-data">
                    @csrf
                    <input name="id" type="text" hidden>
                    <div class="modal-body ">
                        <div class="row mx-2">




                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">name</label>
                                    <input name="name" type="text" class="form-control" placeholder="name"
                                        required="">
                                    <div class="invalid-feedback"> name is Required.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">language</label>
                                    <input name="language" type="text" class="form-control" placeholder="language"
                                        required="">
                                    <div class="invalid-feedback"> language is Required.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">phone_number</label>
                                    <input name="phone_number" type="text" class="form-control"
                                        placeholder="phone_number" required="">
                                    <div class="invalid-feedback"> phone_number is Required.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">email</label>
                                    <input name="email" type="text" class="form-control" placeholder="email"
                                        required="">
                                    <div class="invalid-feedback"> email is Required.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">rate</label>
                                    <input name="rate" type="text" class="form-control" placeholder="rate"
                                        required="">
                                    <div class="invalid-feedback"> rate is Required.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">gender</label>
                                    <input name="gender" type="text" class="form-control" placeholder="gender"
                                        required="">
                                    <div class="invalid-feedback"> gender is Required.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">location</label>
                                    <input name="location" type="text" class="form-control" placeholder="location"
                                        required="">
                                    <div class="invalid-feedback"> location is Required.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">experience</label>
                                    <input name="experience" type="text" class="form-control"
                                        placeholder="experience" required="">
                                    <div class="invalid-feedback"> experience is Required.</div>
                                </div>
                            </div>








                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">about</label>
                                    <input name="about" type="text" class="form-control" placeholder="about"
                                        required="">
                                    <div class="invalid-feedback"> about is Required.</div>
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
                var name = document.forms["add_blogpage_form"]["name"].value;
                var language = document.forms["add_blogpage_form"]["language"].value;
                var phone_number = document.forms["add_blogpage_form"]["phone_number"].value;
                var email = document.forms["add_blogpage_form"]["email"].value;
                var rate = document.forms["add_blogpage_form"]["rate"].value;
                var gender = document.forms["add_blogpage_form"]["gender"].value;
                var location = document.forms["add_blogpage_form"]["location"].value;
                var experience = document.forms["add_blogpage_form"]["experience"].value;

                var about = document.forms["add_blogpage_form"]["about"].value;


                // alert(qty);
                var file = $('#image')[0].files;



                if (file.length > 0) {

                    // alert("ok");
                    var formData = new FormData();
                    formData.append('image', file[0]);




                    formData.append('id', id);
                    formData.append('name', name);
                    formData.append('language', language);

                    formData.append('phone_number', phone_number);

                    formData.append('email', email);
                    formData.append('rate', rate);
                    formData.append('gender', gender);
                    formData.append('location', location);

                    formData.append('experience', experience);

                    formData.append('about', about);
                    formData.append('_token', "{{ csrf_token() }}");

                    // console.log(formData);
                    $.ajax({
                        url: "{{ route('ProfileQariSahib.store') }}",
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
                url: "{{ route('ProfileQariSahib.readbyid', ['id' => '']) }}/" + id,
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    document.forms["add_blogpage_form"]["id"].value = response.id;
                    document.forms["add_blogpage_form"]["name"].value = response.name;
                    document.forms["add_blogpage_form"]["language"].value = response.language;
                    document.forms["add_blogpage_form"]["phone_number"].value = response.phone_number;
                    document.forms["add_blogpage_form"]["email"].value = response.email;
                    document.forms["add_blogpage_form"]["rate"].value = response.rate;
                    document.forms["add_blogpage_form"]["gender"].value = response.gender;
                    document.forms["add_blogpage_form"]["location"].value = response.location;
                    document.forms["add_blogpage_form"]["experience"].value = response.experience;
                    document.forms["add_blogpage_form"]["about"].value = response.about;
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
                url: "{{ route('ProfileQariSahib.deletebyid', ['id' => '']) }}/" + id,
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
                Blog
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
                        <th>name</th>
                        <th>language</th>
                        <th>phone_number</th>
                        <th>email</th>
                        <th>rate</th>
                        <th>gender</th>
                        <th>location</th>
                        <th>experience</th>


                        <th>about</th>
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
                    url: "{{ route('ProfileQariSahib.read') }}",
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    }
                },
                "columns": [{
                        data: "id"
                    },
                    {
                        data: "name"
                    },
                    {
                        data: "language"
                    },
                    {
                        data: "phone_number"
                    },
                    {
                        data: "email"
                    },
                    {
                        data: "rate"
                    },
                    {
                        data: "gender"
                    },
                    {
                        data: "location"
                    },
                    {
                        data: "experience"
                    },

                    {
                        data: "about"
                    },
                    {
                        render: function(data, type, row) {
                            return '<img src="{{ asset('/BlogImage/') }}/' + row.image +
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
