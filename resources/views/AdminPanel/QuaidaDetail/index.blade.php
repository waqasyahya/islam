@extends("layouts.app")
@section('title') QuaidaDetail  @endsection

@section('page-header')
<!-- PAGE HEADER -->
<div class="page-header mt-5-7">
    <div class="page-leftheader">
        <h4 class="page-title mb-0" style="color: #006d74;font-size:24px; font-weight:500;">QuaidaDetail</h4>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i style="color: #006d74;font-size:24px; font-weight:500;" class="fa-solid fa-chart-tree-map mr-2 fs-12"></i>Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#"> QuaidaDetail </a></li>
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
                <h5 class="modal-title" id="createBookingModalLabel">Create QuaidaDetail </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <form class="needs-validation row" id="add_QuaidaDetail_form" novalidate=""  enctype="multipart/form-data">
                @csrf
                <input name="id" type="text" hidden>
                <div class="modal-body ">
                    <div class="row mx-2">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label class="form-label">Quaida_id</label>
                        <input name="Quaida_id" type="text" class="form-control" placeholder="Quaida_id" required="">
                        <div class="invalid-feedback"> Quaida_id is Required.</div>
                            </div>
                        </div>
                    <div class="col-md-12">
                        <label class="form-label">Words_Arabic</label>
                        <input name="Words_Arabic" type="text" class="form-control" placeholder="Words_Arabic" required="">
                        <div class="invalid-feedback"> Words_Arabic is Required.</div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Words_id</label>
                        <input name="Words_id" type="text" class="form-control" placeholder="Words_id" required="">
                        <div class="invalid-feedback"> Words_id is Required.</div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Words_Urdu</label>
                        <input name="Words_Urdu" type="text" class="form-control" placeholder="Words_Urdu" required="">
                        <div class="invalid-feedback">Words_Urdu is Required.</div>
                    </div>
                  
                    <div class="col-md-12">
                        <label class="form-label">audio1</label>
                        <input name="audio1" id="audio1" type="file" class="form-control" placeholder="audio1" required="">
                        <div class="invalid-feedback">audio1  is Required.</div>
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
$("#add_QuaidaDetail_form").submit(function(e) {
    e.preventDefault();
    var form = document.forms["add_QuaidaDetail_form"];
    if (form.checkValidity() === true) {
        var id = document.forms["add_QuaidaDetail_form"]["id"].value;
                var Quaida_id = document.forms["add_QuaidaDetail_form"]["Quaida_id"].value;
                var Words_Arabic = document.forms["add_QuaidaDetail_form"]["Words_Arabic"].value;
                var Words_id = document.forms["add_QuaidaDetail_form"]["Words_id"].value;
                var Words_Urdu = document.forms["add_QuaidaDetail_form"]["Words_Urdu"].value;
               
                var audio1File = $('#audio1')[0].files;
                if (audio1File.length > 0) {


var formData = new FormData();

formData.append('audio1', audio1File[0]);



formData.append('id', id);
formData.append('Quaida_id', Quaida_id);
formData.append('Words_Arabic', Words_Arabic);
formData.append('Words_id', Words_id);
formData.append('Words_Urdu', Words_Urdu);




formData.append('_token', "{{ csrf_token() }}");

// console.log(formData);
$.ajax({
    url: "{{ route('QuaidaDetail.store') }}",
    method: 'post',
    dataType: 'json',
    data: formData,
    contentType: false,
    processData: false,

    success: function(response) {

        if (response.status == "200") {
            $("#add_product_modal").modal("hide");
            document.forms["add_QuaidaDetail_form"].reset();
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
function practic_read_by_id(id) {
    $.ajax({
        type: "GET",
        url: "{{ route('QuaidaDetail.readbyid', ['id' => '']) }}/" + id,
        dataType: "json",
        data: {
            "_token": "{{ csrf_token() }}"
        },
        success: function(response) {
            document.forms["add_QuaidaDetail_form"]["id"].value = response.id;
                    document.forms["add_QuaidaDetail_form"]["Quaida_id"].value = response.Quaida_id;
                    document.forms["add_QuaidaDetail_form"]["Words_Arabic"].value = response.Words_Arabic;
                    document.forms["add_QuaidaDetail_form"]["Words_id"].value = response.Words_id;
                    document.forms["add_QuaidaDetail_form"]["Words_Urdu"].value = response.Words_Urdu;
                   


document.getElementById("audio1").value = response.audio1;



        },
        error: function(e, f, g) {
            console.log(e, f, g);
        }
    });
}
function practic_delete_by_id(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('QuaidaDetail.deletebyid', ['id' => '']) }}/" + id,
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
            QuranDetail
        </h3>
        <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
                <li class="nav-item mr-1 mt-2">
                    <button class="btn btn-sm " data-bs-toggle="modal" data-bs-target="#add_property_modal" style="background-color:white;color:#006d74;font-size:16px;font-weight:600;"><i class="fas fa-plus-circle"></i> Add NEW </button>
                </li>

            </ul>
        </div>
    </div>
    <div class="card-body table-responsive ">
        <table class=" responsive datatables-basic table border-top  table cell-border compact stripe nowrap" id="example">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Quaida_id</th>
                    <th>Words_Arabic</th>
                    <th>Words_id</th>
                    <th>Words_Urdu</th>
                    <th>audio1</th>
                  
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
//     var dataTable;
//     $(document).ready(function() {
//         dataTable = $("#example").DataTable({
//             "ajax": {
//                 url: "{{route('QuaidaDetail.read')}}",
//                 type: "GET",
//                 data: {
//                     "_token": "{{ csrf_token() }}"
//                 }
//             },
//             "columns": [{
//                 data: "id"
//             },
//              {
//                 data: "Quaida_id"
//             },
//             {
//                 data: "Words_Arabic"
//             },
//             {
//                 data: "Words_id"
//             },
//             {
//                 data: "Words_Urdu"
//             },
//             {

// render: function(data, type, row) {

//         return '<audio controls style="width: 100px; margin-left: 20px; margin-top: 30px;"><source src="{{asset('Quranfolder/')}}/' + row.audio1 +'" type="audio/mpeg"></audio>';


// }

// },

           

//               {
//                 "defaultContent": '<a class="fa-solid fa-pen table-action-buttons edit-action-button" id="edit_purpose" data-bs-toggle="modal" data-bs-target="#add_property_modal" ></a><a class="fa-solid fa-trash table-action-buttons delete-action-button" id="delete_purpose"></a>'
//             },



//         ],
//             "order": [
//                 [0, "desc"]
//             ],


//         });
//         $('div.head-label').html('<h3 class="card-title mb-0">lesson</h3>');
//         $("#example tbody").on("click", "#edit_purpose", function() {
//             var data = dataTable.row($(this).parentsUntil("tr")).data();
//             practic_read_by_id(data.id);
//             $('.addEditText').text("Edit");
//         });
//         $("#example tbody").on("click", "#delete_purpose", function() {
//             var data = dataTable.row($(this).parentsUntil("tr")).data();
//             practic_delete_by_id(data.id);
//             $('.addEditText').text("delete");
//         });
//     });
// new
var dataTable;
    $(document).ready(function() {
    var dataTable = $("#example").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "{{ route('QuaidaDetail.read') }}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}"
            }
        },
        "columns": [
            { data: "id" },
            { data: "Quaida_id" },
            { data: "Words_Arabic" },
            { data: "Words_id" },
            { data: "Words_Urdu" },
            { render: function(data, type, row) {

return '<audio controls style="width: 100px; margin-left: 20px; margin-top: 30px;"><source src="{{asset('Quranfolder/')}}/' + row.audio1 +'" type="audio/mpeg"></audio>';


}},
           
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
            practic_read_by_id(data.id);
            $('.addEditText').text("Edit");
        });
        $("#example tbody").on("click", "#delete_purpose", function() {
            var data = dataTable.row($(this).parentsUntil("tr")).data();
            practic_delete_by_id(data.id);
            $('.addEditText').text("delete");
        });
});



    </script>

</div>@endsection
