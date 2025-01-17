<?php
	$themeClass = '';
	if (!empty($_COOKIE['theme'])) {
		if ($_COOKIE['theme'] == 'dark') {
			$themeClass = 'dark-theme';
		} else if ($_COOKIE['theme'] == 'light') {
			$themeClass = 'light-theme';
		}  
	}
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<!-- METADATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="" name="description">
		<meta content="" name="author">
		<meta name="keywords" content=""/>
		
        <!-- CSRF TOKEN -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- TITLE -->
        <title>@yield('title')-{{ config('app.name') }}</title>
        
        @include('layouts.header')
        <link rel="stylesheet" href="{{asset('icofont/icofont.min.css')}}">

        <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
        <script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>

		<style>
        
		.btn {
    border-radius: 4px!important;
		}
		.card-header > .card-tools {
    float: right!important;
    margin-right: -0.625rem;
}
.card-header > .card-title{
    margin-top: 1%;
}
.card-title {
    float: left;
    font-size: 1.1rem;
    font-weight: 400;
    margin: 0;
}.card-header:first-child {
    border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
}.card-header {
    background-color: #fff;
}
.edit-action-button{
    cursor:pointer!important
}
table.dataTable.dtr-inline.collapsed.compact>tbody>tr>td:first-child:before, table.dataTable.dtr-inline.collapsed.compact>tbody>tr>th:first-child:before {
    top: 12px!important;
}
	  </style>
	</head>

	<body class="app sidebar-mini <?php echo $themeClass; ?>">

		<!-- LOADER -->
		{{-- <div id="preloader" >
			<img src="{{URL::asset('img/svgs/preloader.gif')}}" alt="loader">           
		</div> --}}
		<!-- END LOADER -->

		<!-- PAGE -->
		<div class="page">
			<div class="page-main">

			 @include('layouts.nav-aside')

				<!-- APP CONTENT -->			
				<div class="app-content main-content">

					<div class="side-app">

					@include('layouts.nav-top')

                        {{-- @include('layouts.flash') --}}

						@yield('page-header')

						@yield('content')						

                    </div>                   
                </div>
                <!-- END APP CONTENT -->

		 @include('layouts.footer')               

            </div>		
        </div><!-- END PAGE -->
        <!-- Confirmation modal -->
<div class="modal fade" id="modal-confirm">
    <div class="modal-dialog">
        <form id="modal-form">
            @csrf
            <div id="customInput"></div>
        <div class="modal-content">
            <div class="modal-header p-2">
                <h4 class="modal-title">{{trans('customer.confirmation')}}</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer p-2">
                <button id="modal-confirm-btn" type="button" class="btn btn-primary btn-sm">{{trans('customer.confirm')}}</button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{trans('customer.cancel')}}</button>
            </div>
        </div>
        <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
		@include('layouts.footer-backend')  

	<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
	@yield('extra-scripts')
	<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	<style>
        .select2-container .select2-selection--single{
            height: 37px !important;
        }
        .lang-colour i{
            color: black;
            font-size: 24px;
        }
    </style>
	<script>
    jQuery('button[type="submit"]').on('click', function (e) {
        var form = $(this).parents('form:first');
        if (form.valid()) {
            $(this).attr('disabled', 'disabled').addClass('disabled')
            $(this).html(' <i class="fa fa-spinner fa-spin"></i> Loading');
            form.submit();
        }
    });
    jQuery('#modal-confirm-btn').on('click', function (e) {
        var form = $(this).parents('form:first');
        if (form.valid()) {
            $(this).attr('disabled', 'disabled').addClass('disabled')
            $(this).html(' <i class="fa fa-spinner fa-spin"></i> Loading');
            form.submit();
        }
    });
</script>
<script>
    $(document).on('click','.gateway-bb', function (e){
        const type = $(this).attr('data-type');
        localStorage.setItem("gateway_type", type);
    });
    $(document).on('click','.sending-setting', function (e){
        const type = $(this).attr('data-type');
        localStorage.setItem("sending_setting", type);
    });

</script>
<script>
    if ('{{request()->segment(2)== 'settings'}}') {
        const gateway = localStorage.getItem("gateway_type");
        const sending_setting_nav = localStorage.getItem("sending_setting");

        if (gateway) {
            $("#" + gateway).trigger('click');
            $('.gateway-bb').addClass('active');
        }
        if (sending_setting_nav) {
            $("#" + sending_setting_nav).trigger('click').addClass('active');
            $('.sending-setting').addClass('active');
        }
    }else {
        localStorage.clear();
    }
</script>
<script>
    $( document ).ready(function() {
        $('.form-control-sm').attr('placeholder', 'Type here to search...');
    });
    (() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
</script>

@if(session()->has('success') || session()->has('fail') || count($errors)>0)
@endif
	</body>
</html>


