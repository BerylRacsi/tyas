@extends('layouts.app')

@section('content')
    <div class="row justify-content-center pt-3">
        <div class="col-12">
            <div class="card" id="main-card">

            </div>
        </div>
    </div>



    <script type="text/javascript">
        const dashboard = $('#main-card');
        var rowSelected = null;

        //select table row
        dashboard.on("click", "#main-table tbody tr", function() {
            rowSelected = $('#main-table').DataTable();
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                rowSelected = null;
            } else {
                rowSelected.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        //page navigation
        function navigate(src, callback) {
            $.ajax({
                url: src,
                type: 'GET',
                dataType: 'html',
                success: function(response) {
                    dashboard.html(response);
                    callback();
                },
                error: function() {
                    toastr.error('Something is wrong');
                }
            });
        }

        function drawTable() {
            $('#main-table').hide();
            $('#main-table').DataTable({
                info: false,
                ajax: {
                    'url': "{{ route('user.getData') }}",
                    'data': function(data) {
                        data._token = "{{ csrf_token() }}"
                    },
                },
                columns: [{
                        data: 'name',
                        name: 'name',
                    }, {
                        data: 'email',
                        name: 'email',
                    }, {
                        data: 'department',
                        name: 'department',
                    }, {
                        data: 'position',
                        name: 'position',
                    },

                ],
                initComplete: function() {
                    $('#main-table').show();
                    $('#main-spinner').hide();
                    $("#main-table").wrap('<div class="dataTables_scroll" />');
                },
            })
        }

        $("#main-table").on('column-sizing.dt', function(e, settings) {
            $(".dataTables_scrollH  eadInner").css("width", "100%");
        });

        function showPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function setAddForm() {
            dashboard.find('#form-title').text('Add User');

            $('#department').select2({
                width: '100%',
            });

            $('#role').select2({
                width: '100%',
                placeholder: 'Please Select'
            });

        }

        function setEditForm() {
            var dataRow = rowSelected.row('.selected').data();
            var id = dataRow['id'];

            $.ajax({
                url: '{{ route('user.show') }}',
                type: 'GET',
                data: {
                    id: id,
                },
                beforeSend: function() {
                    $("#btn-request-submit").prop("disabled", true);
                },
                success: function(data) {
                    $("#btn-request-submit").prop("disabled", false);
                    $('#form-title').text('Edit Department');

                    $('#id').val(data.id);
                    $('#department').val(data.name);

                },
                error: function() {
                    toastr.error('Something is wrong');
                },
            })
        }

        dashboard.on("click", "#btn-request-submit", function(e) {
            e.preventDefault();

            var formData = new FormData(dashboard.find('#main-form')[0]);

            $.ajax({
                url: '{{ route('user.store') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $("#btn-request-submit").prop("disabled", true);
                    $('.loading-overlay-process').removeAttr('hidden')
                },
                success: function(data) {
                    $("#btn-request-submit").prop("disabled", false);
                    $('.loading-overlay-process').attr('hidden', 'true')
                    if (data.error == 0) {
                        navigate('{{ route('user.getList') }}', drawTable);
                        toastr.success(data.message);
                    } else if (data.error == 1) {
                        if (data.code == 'csrf' || data.code == 'other') {
                            toastr.error(data.message);
                        }
                        if (data.code == 'validation') {
                            $.each(data.message, function(index, value) {
                                toastr.error(value);
                            });
                        }
                    } else {
                        toastr.error('System Error');
                    }
                },
                error: function() {
                    $("#btn-request-submit").prop("disabled", false);
                    $('.loading-overlay-process').attr('hidden', 'true')
                }
            })
        })

        //delete
        function deleteRecord() {
            var dataRow = rowSelected.row('.selected').data();
            var id = dataRow['id'];
            var department = dataRow['department'];

            Swal.fire({
                title: 'Are you sure?',
                text: "Delete Department " + department + " ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('user.destroy') }}',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: id
                        },
                        success: function(data) {
                            if (data.error == 0) {
                                navigate('{{ route('user.getList') }}',
                                    drawTable);
                                toastr.success(data.message);
                            } else if (data.error == 1) {
                                if (data.code == 'csrf' || data.code == 'other') {
                                    toastr.error(data.message);
                                }
                            } else {
                                toastr.error('System Error');
                            }
                        },
                        error: function() {
                            toastr.error('Something is wrong');
                        }
                    });
                }
            })
        }

        $(document).ready(function() {
            navigate('{{ route('user.getList') }}', drawTable);
        })

        dashboard.on("click", "#btn-add", function() {
            $(this).find('i').removeClass('fas fa-plus').addClass('fas fa-spinner fa-spin');
            navigate('{{ route('user.getForm') }}', setAddForm);
        })

        dashboard.on("click", "#btn-back", function() {
            navigate('{{ route('user.getList') }}', drawTable);
        })

        dashboard.on("click", "#btn-edit", function() {
            if (rowSelected == null) {
                toastr.warning("Choose row first !")
            } else {
                navigate('{{ route('user.getForm') }}', setEditForm);
            }
        })

        dashboard.on("click", "#btn-delete", function() {
            if (rowSelected == null) {
                toastr.warning("Choose row first !")
            } else {
                deleteRecord();
            }
        })
    </script>
@endsection
