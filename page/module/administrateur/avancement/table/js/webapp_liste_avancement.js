$(function() {
    'use strict';

    $(document).ready(function() {
        var dt_basic_table = $('.datatables-basic'),
            dt_date_table = $('.dt-date'),
            assetPath = '../app-assets/';

        var form_comm = $('#form_comm');

        if (dt_basic_table.length) {
            var dt_basic = dt_basic_table.DataTable({
                ajax: 'table/php/data_liste_avancement.php?job=get_liste_avancement',
                stateSave: true,
                scrollX: true,
                columns: [
                    { data: 'responsive_id' },
                    { data: 'id' },
                    { data: 'id' }, // used for sorting so will hide this column    
                    { data: 'full_name' },
                    { data: 'etude' },
                    { data: 'socle' },
                    { data: 'estim_moy' },
                    { data: 'estim_charge' },
                    { data: 'date_debut' },
                    { data: 'date_fin' },
                    { data: 'nbr_j_reels' },
                    { data: 'progress' },
                    { data: 'start_date' },
                    { data: 'status' },
                    { data: 'Actions' }
                ],
                columnDefs: [{
                        // For Responsive
                        className: 'control',
                        orderable: false,
                        responsivePriority: 2,
                        targets: 0
                    },
                    {
                        // For Checkboxes
                        targets: 1,
                        orderable: false,
                        responsivePriority: 3,
                        render: function(data, type, full, meta) {
                            return (
                                '<div class="custom-control custom-checkbox"> <input class="custom-control-input dt-checkboxes" type="checkbox" value="" id="checkbox' + data + '" /><label class="custom-control-label" for="checkbox' + data + '"></label></div>'
                            );
                        },
                        checkboxes: {
                            selectAllRender: '<div class="custom-control custom-checkbox"> <input class="custom-control-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                        }
                    },
                    {
                        targets: 2,
                        visible: false
                    },
                    {
                        // Avatar image/badge, Name and post
                        targets: 3,
                        responsivePriority: 4,
                        render: function(data, type, full, meta) {
                            var $user_img = full['avatar'],
                                $name = full['full_name'],
                                $post = full['post'];
                            if ($user_img) {
                                // For Avatar image
                                var $output =
                                    '<img src="' + assetPath + 'images/avatars/' + $user_img + '" alt="Avatar" width="32" height="32">';
                            } else {
                                // For Avatar badge
                                var stateNum = full['status'];
                                var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                                var $state = states[stateNum],
                                    $name = full['full_name'],
                                    $initials = $name.match(/\b\w/g) || [];
                                $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                                $output = '<span class="avatar-content">' + $initials + '</span>';
                            }

                            var colorClass = $user_img === '' ? ' bg-light-' + $state + ' ' : '';
                            // Creates full output for row
                            var $row_output =
                                '<div class="d-flex justify-content-left align-items-center">' + '<div class="avatar ' +
                                colorClass +
                                ' mr-1">' +
                                $output +
                                '</div>' +
                                '<div class="d-flex flex-column">' +
                                '<span class="emp_name text-truncate font-weight-bold">' +
                                $name +
                                '</span>' +
                                '<small class="emp_post text-truncate text-muted">' +
                                $post +
                                '</small>' +
                                '</div>' +
                                '</div>';
                            return $row_output;
                        }
                    },
                    {
                        responsivePriority: 1,
                        targets: 4
                    }
                ],
                order: [
                    [2, 'desc']
                ],
                dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                displayLength: 7,
                lengthMenu: [7, 10, 25, 50, 75, 100],
                buttons: [{
                    extend: 'collection',
                    className: 'btn btn-outline-secondary dropdown-toggle mr-0',
                    text: feather.icons['share'].toSvg({ class: 'font-small-4 mr-50' }) + 'Export',
                    buttons: [{
                            extend: 'print',
                            text: feather.icons['printer'].toSvg({ class: 'font-small-4 mr-50' }) + 'Print',
                            className: 'dropdown-item',
                            exportOptions: { columns: [3, 4, 5, 6, 7] }
                        },
                        {
                            extend: 'csv',
                            text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Csv',
                            className: 'dropdown-item',
                            exportOptions: { columns: [3, 4, 5, 6, 7] }
                        },
                        {
                            extend: 'excel',
                            text: feather.icons['file'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel',
                            className: 'dropdown-item',
                            exportOptions: { columns: [3, 4, 5, 6, 7] }
                        },
                        {
                            extend: 'pdf',
                            text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 mr-50' }) + 'Pdf',
                            className: 'dropdown-item',
                            exportOptions: { columns: [3, 4, 5, 6, 7] }
                        },
                        {
                            extend: 'copy',
                            text: feather.icons['copy'].toSvg({ class: 'font-small-4 mr-50' }) + 'Copy',
                            className: 'dropdown-item',
                            exportOptions: { columns: [3, 4, 5, 6, 7] }
                        }
                    ],
                    init: function(api, node, config) {
                        $(node).removeClass('btn-secondary');
                        $(node).parent().removeClass('btn-group');
                        setTimeout(function() {
                            $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                        }, 50);
                    }
                }],
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function(row) {
                                var data = row.data();
                                return 'Détails de ' + data['full_name'];
                            }
                        }),
                        type: 'column',
                        renderer: function(api, rowIdx, columns) {
                            var data = $.map(columns, function(col, i) {
                                console.log(columns);
                                return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                                    ?
                                    '<tr data-dt-row="' +
                                    col.rowIndex +
                                    '" data-dt-column="' +
                                    col.columnIndex +
                                    '">' +
                                    '<td>' +
                                    col.title +
                                    ':' +
                                    '</td> ' +
                                    '<td>' +
                                    col.data +
                                    '</td>' +
                                    '</tr>' :
                                    '';
                            }).join('');

                            return data ? $('<table class="table"/>').append(data) : false;
                        }
                    }
                },
                language: {
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;',


                    },
                    info: "Affichage page _PAGE_ jusqu'à _PAGES_",
                    lengthMenu: "Affichage _MENU_ lignes par page",
                    search: "Recherche :",
                    zeroRecords: "Aucune donnée disponible !",
                    infoEmpty: "Aucun enregistrement disponible",
                    infoFiltered: "(filtré depuis _MAX_ total des enregistrements)",
                    processing: "Chargement des données...",
                    loadingRecords: "Chargement des Affectation en cours ..."
                }
            });
            $('div.head-label').html('<h6 class="mb-0">Liste des Affectation</h6>');

        }

        if (dt_date_table.length) {
            dt_date_table.flatpickr({
                monthSelectorType: 'static',
                dateFormat: 'm/d/Y'
            });
        }
        // Verifier la supp
        $(document).on('click', '#exampleModalScrollable', function(e) {
            /*var id      = $(this).data('id');
    var name      = $(this).data('name');
    e.preventDefault();
    


      var onSuccess = function (data) {
        console.log('Success');
          if (data.result == 'success'){
            $('ul#cible').text(data.message);
          } 
    
      };
      var onError = function (jqXHR, textStatus, errorThrown) {
          console.log(jqXHR);
          console.log(textStatus);
          console.log(errorThrown);
          alert("Probléme de mise à jour de la base de donnée");
      
      };
      
      var onBeforeSend = function () {
          console.log("Loading");
          $.blockUI({
            message: '<div class="spinner-border text-white" role="status"></div>',
            timeout: 1000,
            css: {
              backgroundColor: 'transparent',
              border: '0'
            },
            overlayCSS: {
              opacity: 0.5
            }
          });
          
      };
	  
      var request   = $.ajax({
        url:          'table/php/data_liste_avancement.php?job=get_liste_progress',
        data:         'id=' + id,
        type:         'post',
        async: true,
        dataType: 'json',
        beforeSend: onBeforeSend,
        error: onError,
        success: onSuccess
      });*/


        });


        // Verifier la supp
        $(document).on('click', '#delete-record', function(e) {
            var id = $(this).data('id');
            var name = $(this).data('name');
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Supprimer',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-danger ml-1',
                cancelButtonText: 'Annuler',
                buttonsStyling: false

            }).then(function(result) {

                if (result.value) {

                    e.preventDefault();
                    var onSuccess = function(data) {
                        console.log('Success');

                        Swal.fire({
                            type: "success",
                            title: 'Supprimé !',
                            text: "Affectation '" + name + "' supprimée avec succès.",
                            confirmButtonClass: 'btn btn-success',
                        });
                        //$(".dtr-bs-modal").removeClass("show");
                        //$(".modal-backdrop").removeClass("show");
                        dt_basic.ajax.reload();

                    };

                    var onError = function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                        Swal.fire({
                            title: 'Annulé',
                            text: "Une erreur s'est produite lors de l'enregistrement " + textStatus,
                            type: 'error',
                            confirmButtonClass: 'btn btn-danger',
                        })

                    };

                    var onBeforeSend = function() {
                        console.log("Loading");


                    };

                    var request = $.ajax({
                        url: 'table/php/data_liste_avancement.php?job=del_avancement',
                        data: 'id=' + id,
                        type: 'post',
                        async: false,
                        beforeSend: onBeforeSend,
                        error: onError,
                        success: onSuccess
                    });



                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'Annulé',
                        text: '',
                        type: 'error',
                        confirmButtonClass: 'btn btn-danger',
                    });
                    $(".dtr-bs-modal").removeClass("show");
                    $(".modal-backdrop").removeClass("show");
                }
            })

        });

        $(document).on('submit', '.add', function(e) {

            e.preventDefault();
            var date_debut = $("#basic-default-date_debut").val();
            var date_fin = $("#basic-default-date_fin").val();
            var date1 = new Date(date_debut);
            var date2 = new Date(date_fin);
            if (date1 > date2) {
                Swal.fire({
                    title: 'Erreur',
                    text: 'Verifiez les dates !',
                    icon: 'error',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
            } else {

                var form_data = $('#jquery-val-form').serialize();

                var onSuccess = function(data) {
                    console.log('Success');
                    if (data.result == 'success') {
                        window.location.assign("liste_avancement.php");
                    } else {
                        Swal.fire({
                            title: 'Erreur',
                            text: 'Technicien déja sur le projet ',
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                    }


                };
                var onError = function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                    alert("Probléme de mise à jour de la base de donnée");

                };

                var onBeforeSend = function() {
                    console.log("Loading");
                    $.blockUI({
                        message: '<div class="spinner-border text-white" role="status"></div>',
                        timeout: 1000,
                        css: {
                            backgroundColor: 'transparent',
                            border: '0'
                        },
                        overlayCSS: {
                            opacity: 0.5
                        }
                    });

                };

                var request = $.ajax({
                    url: 'table/php/data_liste_avancement.php?job=add_avancement',
                    data: form_data,
                    type: 'post',
                    async: true,
                    dataType: 'json',
                    beforeSend: onBeforeSend,
                    error: onError,
                    success: onSuccess
                });
            }

        });

        $(document).on('submit', '.edit', function(e) {

            e.preventDefault();

            var form_data = $('#jquery-val-form').serialize();

            var onSuccess = function(data) {
                console.log('Success');
                window.location.assign("liste_avancement.php");

            };
            var onError = function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                alert("Probléme de mise à jour de la base de donnée");

            };

            var onBeforeSend = function() {
                console.log("Loading");
                $.blockUI({
                    message: '<div class="spinner-border text-white" role="status"></div>',
                    timeout: 1000,
                    css: {
                        backgroundColor: 'transparent',
                        border: '0'
                    },
                    overlayCSS: {
                        opacity: 0.5
                    }
                });
            };
            var request = $.ajax({
                url: 'table/php/data_liste_avancement.php?job=edit_avancement',
                data: form_data,
                type: 'post',
                async: false,
                beforeSend: onBeforeSend,
                error: onError,
                success: onSuccess
            });

        });

    });
});