@extends("layouts.app")
@section('title') Islameapp  @endsection

@section('page-header')
<!-- PAGE HEADER -->
<div class="page-header mt-5-7">
    <div class="page-leftheader">
        <h4 class="page-title mb-0">Islameapp</h4>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa-solid fa-chart-tree-map mr-2 fs-12"></i>Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#"> Islameapp </a></li>
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
                <h5 class="modal-title" id="createBookingModalLabel">Create Islame </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <form class="needs-validation row" id="add_Islame_form" novalidate="">
                @csrf
                <input name="id" type="text" hidden>
                <div class="modal-body ">
                    <div class="row mx-2">
                        <div class="col-md-12">
                            <label class="form-label">Ayat_Name</label>
                            <input name="Ayat_Name" type="text" class="form-control" placeholder="Ayat_Name" required="">
                            <div class="invalid-feedback"> Ayat_Name is Required.</div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Ayat_Referance</label>
                            <input name="Ayat_Referance" type="text" class="form-control" placeholder="Ayat_Referance" required="">
                            <div class="invalid-feedback"> Ayat_Referance is Required.</div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                            <label class="form-label">Hadith_Arabic</label>
                        <input name="Hadith_Arabic" type="text" class="form-control" placeholder="Hadith_Arabic" required="">
                        <div class="invalid-feedback"> Hadith_Arabic is Required.</div>
                            </div>
                        </div>
                    <div class="col-md-12">
                        <label class="form-label">Hadith_Translate</label>
                        <input name="Hadith_Translate" type="text" class="form-control" placeholder="Hadith_Translate" required="">
                        <div class="invalid-feedback"> Hadith_Translate is Required.</div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Hadith_Name</label>
                        <input name="Hadith_Name" type="text" class="form-control" placeholder="Hadith_Name" required="">
                        <div class="invalid-feedback"> Hadith_Name is Required.</div>
                    </div>
                 
                    <div class="col-md-12">
                        <label class="form-label">Hadith_Referance</label>
                        <input name="Hadith_Referance" type="text" class="form-control" placeholder="Hadith_Referance" required="">
                        <div class="invalid-feedback"> Hadith_Referance is Required.</div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Ayat_Arabic</label>
                        <input name="Ayat_Arabic" type="text" class="form-control" placeholder="Ayat_Arabic" required="">
                        <div class="invalid-feedback"> Ayat_Arabic is Required.</div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Ayat_Translate</label>
                        <input name="Ayat_Translate" type="text" class="form-control" placeholder="Ayat_Translate" required="">
                        <div class="invalid-feedback"> Ayat_Translate is Required.</div>
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
$("#add_Islame_form").submit(function(e) {
    e.preventDefault();
    var form = document.forms["add_Islame_form"];
    if (form.checkValidity() === true) {
        var id = document.forms["add_Islame_form"]["id"].value;
        var Hadith_Name = document.forms["add_Islame_form"]["Hadith_Name"].value;
        var Hadith_Referance = document.forms["add_Islame_form"]["Hadith_Referance"].value;
        var Hadith_Arabic = document.forms["add_Islame_form"]["Hadith_Arabic"].value;
        var Hadith_Translate = document.forms["add_Islame_form"]["Hadith_Translate"].value;
        var Ayat_Name = document.forms["add_Islame_form"]["Ayat_Name"].value;
        var Ayat_Referance = document.forms["add_Islame_form"]["Ayat_Referance"].value;
        var Ayat_Arabic = document.forms["add_Islame_form"]["Ayat_Arabic"].value;
        var Ayat_Translate = document.forms["add_Islame_form"]["Ayat_Translate"].value;
      

        $.ajax({
            type: "GET",
            url: "{{route('Islameapp.store')}}",
            data: {
                id: id,
                Hadith_Name: Hadith_Name,
                Hadith_Referance: Hadith_Referance,
                Hadith_Arabic: Hadith_Arabic,
                Hadith_Translate: Hadith_Translate,
                Ayat_Name: Ayat_Name,
                Ayat_Referance: Ayat_Referance,
                Ayat_Arabic: Ayat_Arabic,
                Ayat_Translate: Ayat_Translate,
              

                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.status == "200") {
                    $("#add_property_modal").modal("hide");
                    document.forms["add_Islame_form"].reset();
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
        url: "{{ route('Islameapp.readbyid', ['id' => '']) }}/" + id,
        dataType: "json",
        data: {
            "_token": "{{ csrf_token() }}"
        },
        success: function(response) {
            document.forms["add_Islame_form"]["id"].value = response.id;
            document.forms["add_Islame_form"]["Hadith_Name"].value = response.Hadith_Name;
            document.forms["add_Islame_form"]["Hadith_Referance"].value = response.Quaida_Words;
            document.forms["add_Islame_form"]["Hadith_Arabic"].value = response.Hadith_Arabic;
            document.forms["add_Islame_form"]["Hadith_Translate"].value = response.Hadith_Translate;
            document.forms["add_Islame_form"]["Ayat_Name"].value = response.Ayat_Name;
            document.forms["add_Islame_form"]["Ayat_Referance"].value = response.Ayat_Referance;
            document.forms["add_Islame_form"]["Ayat_Arabic"].value = response.Ayat_Arabic;
            document.forms["add_Islame_form"]["Ayat_Translate"].value = response.Ayat_Translate;
           



        },
        error: function(e, f, g) {
            console.log(e, f, g);
        }
    });
}
function purpose_delete(id) {
    $.ajax({
        type: "GET",
        url: "{{ route('Islameapp.delete', ['id' => '']) }}/" + id,
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
            Islameapp
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


                    <th>Hadith_Name</th>
                    <th>Hadith_Referance</th>
                    <th>Hadith_Arabic</th>
                    <th>Hadith_Translate</th>
                    <th>Ayat_Name</th>
                    <th>Ayat_Referance</th>
                    <th>Ayat_Arabic</th>
                    <th>Ayat_Translate</th>
                  
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
                url: "{{route('Islameapp.read')}}",
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                }
            },
            "columns": [{
                data: "id"
            },
             {
                data: "Hadith_Name"
            },
            {
                data: "Hadith_Referance"
            },
            {
                data: "Hadith_Arabic"
            },  {
                data: "Hadith_Translate"
            },  {
                data: "Ayat_Name"
            },  {
                data: "Ayat_Referance"
            },  {
                data: "Ayat_Arabic"
            },  {
                data: "Ayat_Translate"
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
            read_read_by_id(data.id);
            $('.addEditText').text("Edit");
        });
        $("#example tbody").on("click", "#delete_purpose", function() {
            var data = dataTable.row($(this).parentsUntil("tr")).data();
            purpose_delete(data.id);
            $('.addEditText').text("delete");
        });
    });
    </script>

</div>@endsection
