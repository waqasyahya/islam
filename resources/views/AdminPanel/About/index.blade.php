@extends("layouts.app")
@section('title') About  @endsection

@section('page-header')
<!-- PAGE HEADER -->
<div class="page-header mt-5-7">
    <div class="page-leftheader">
        <h4 class="page-title mb-0">About</h4>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa-solid fa-chart-tree-map mr-2 fs-12"></i>Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#"> About </a></li>
        </ol>
    </div>
</div>
<!-- END PAGE HEADER -->
@endsection
@section('content')
<!-- Add Waqas  Modal -->
<div class="modal fade" id="add_property_modal" tabindex="-1" role="dialog" aria-labelledby="createBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createBookingModalLabel">Create About </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <form class="needs-validation row" id="add_about_form" novalidate=""  enctype="multipart/form-data">
                @csrf
                <input name="id" type="text" hidden>
                <div class="modal-body ">
                    <div class="row mx-2">
                     
                 
                    <div class="col-md-12">
                        <label class="form-label">Heading</label>
                        <input name="Heading" type="text" class="form-control" placeholder="detaillesson_id" required="">
                        <div class="invalid-feedback"> Heading is Required.</div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">detailpara</label>
                        <input name="detailpara" type="text" class="form-control" placeholder="detailpara" required="">
                        <div class="invalid-feedback"> detailpara is Required.</div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">image</label>
                        <input name="image"id="image" type="file" class="form-control" placeholder="image" required="">
                        <div class="invalid-feedback"> image is Required.</div>
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

    function purposeChange(value)
    {
        if(value==1){$('#rent_period_section').show();}
        else{$('#rent_period_section').hide();}
    }
//property
$("#add_about_form").submit(function(e) {
    e.preventDefault();
    var form = document.forms["add_about_form"];
    if (form.checkValidity() === true) {
        var id = document.forms["add_about_form"]["id"].value;
             
                var Heading = document.forms["add_about_form"]["Heading"].value;
                var detailpara = document.forms["add_about_form"]["detailpara"].value;
                var imageFile = $('#image')[0].files;
                if (imageFile.length > 0) {


var formData = new FormData();

formData.append('image', imageFile[0]);



formData.append('id', id);

formData.append('Heading', Heading);
formData.append('detailpara', detailpara);



formData.append('_token', "{{ csrf_token() }}");

// console.log(formData);
$.ajax({
    url: "{{ route('about.store') }}",
    method: 'post',
    dataType: 'json',
    data: formData,
    contentType: false,
    processData: false,

    success: function(response) {

        if (response.status == "200") {
            $("#add_product_modal").modal("hide");
            document.forms["add_about_form"].reset();
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
function about_read_by_id(id) {
    $.ajax({
        type: "GET",
        url: "{{ route('about.readbyid', ['id' => '']) }}/" + id,
        dataType: "json",
        data: {
            "_token": "{{ csrf_token() }}"
        },
        success: function(response) {
            document.forms["add_about_form"]["id"].value = response.id;
                
                    document.forms["add_about_form"]["Heading"].value = response.Heading;
                    document.forms["add_about_form"]["detailpara"].value = response.detailpara;


document.getElementById("image").value = response.image;



        },
        error: function(e, f, g) {
            console.log(e, f, g);
        }
    });
}
function about_delete_by_id(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('about.deletebyid', ['id' => '']) }}/" + id,
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
    about
        </h3>
        <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
                <li class="nav-item mr-1 mt-2">
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add_property_modal"><i class="fas fa-plus-circle"></i> Add NEW </button>
                </li>

            </ul>
        </div>
    </div>
    <div class="card-body table-responsive ">
        <table class=" responsive datatables-basic table border-top  table cell-border compact stripe nowrap" id="example">
            <thead>
                <tr>
                    <th>id</th>
                    {{-- <th>Main_heading1</th>
                    <th>Main_heading1</th>
                    <th>paragraph</th> --}}
                    <th>Heading</th>
                    <th>detailpara</th>
                    <th>image</th>
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
                url: "{{route('about.read')}}",
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                }
            },
            "columns": [{
                data: "id"
            },
          
            {
                data: "Heading"
            },
            {
                data: "detailpara"
            },
            {
                        render: function(data, type, row) {
                            return '<img src="{{ asset('image/') }}/' + row.image +
                                '" alt="about Image" width="100" />';
                        }
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
            about_read_by_id(data.id);
            $('.addEditText').text("Edit");
        });
        $("#example tbody").on("click", "#delete_purpose", function() {
            var data = dataTable.row($(this).parentsUntil("tr")).data();
            about_delete_by_id(data.id);
            $('.addEditText').text("delete");
        });
    });
    </script>

</div>@endsection
