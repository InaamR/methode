!(function (t) {
    "use strict";
    $(document).ready(function () {
        var table_companies = $("#table_planning_prod").dataTable({
            bStateSave: false,

            ajax: "module/planning/table/php/data_liste_planning.php?job=get_liste_planning",

            columns: [
                { data: "Livrable", sClass: "" },

                { data: "Code_GMOD_P", sClass: "" },

                { data: "Technicien", sClass: "" },

                { data: "MARQUE", sClass: "" },

                { data: "GMOD_P", sClass: "" },

                { data: "Statut", sClass: "" },

                { data: "Date_insertion", sClass: "" },

                { data: "bouton_1", sClass: "" },

            ],

            dom: "Bfrtip",
            colReorder: true,
            language: {
                sEmptyTable: "Aucune donnée disponible dans le tableau",
                sInfo: "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
                sInfoEmpty: "Affichage de l'élément 0 à 0 sur 0 élément",
                sInfoFiltered: "(filtré à partir de _MAX_ éléments au total)",
                sInfoPostFix: "",
                sInfoThousands: ",",
                sLengthMenu: "Afficher _MENU_ éléments",
                sLoadingRecords: "Chargement...",
                sProcessing: "Traitement...",
                sSearch: "Rechercher :",
                sZeroRecords: "Aucun élément correspondant trouvé",
                oPaginate: {
                    sFirst: "Premier",
                    sLast: "Dernier",
                    sNext: "Suivant",
                    sPrevious: "Précédent",
                },
                oAria: {
                    sSortAscending: ": activer pour trier la colonne par ordre croissant",
                    sSortDescending: ": activer pour trier la colonne par ordre décroissant",
                },
            },
            buttons: [
                {
                    extend: "copyHtml5",
                    exportOptions: {
                        columns: [0, ":visible"],
                    },
                },
                {
                    extend: "pdfHtml5",
                    exportOptions: {
                        columns: ":visible",
                    },
                },
                {
                    extend: "print",
                    exportOptions: {
                        columns: ":visible",
                    },
                },
                {
                    extend: "csv",
                    exportOptions: {
                        columns: ":visible",
                    },
                },
            ],
        });

        $(document).on("click", "#refresh", function (e) {
            table_companies.api().ajax.reload(function () {
                hide_loading_message();
                show_message("Rafraîchissement terminé", "success");
            }, true);
        });

        // add new sidebar starts //

        $(document).on("click", "#add_tech", function (e) {
            e.preventDefault();

            $("#titre_h4").text("Affecter un nouveau rédacteur");

            $("#form_company #btn_ok").text("Affecter");

            $("#form_company").attr("class", "form add");

            $("#form_company").attr("data-id", "");

            $("#form_company .field_container label.error").hide();
            $("#form_company .field_container").removeClass("valid").removeClass("error");

            $("#form_company #user_id").val("");
            $("#form_company #menu_socle_id").val("");
            $("#form_company #planning_prod_technicien_date_debut").val("");
            $("#form_company #planning_prod_technicien_date_fin").val("");
            $("#form_company #planning_prod_technicien_estimation_charge").val("");

            $(".add-new-data").addClass("show");
            $(".overlay-bg").addClass("show");
        });
        // add new sidebar ends //

        // hide new sidebar starts //

        $(".hide-data-sidebar, .cancel-data-btn, .overlay-bg").on("click", function () {
            $(".add-new-data").removeClass("show");
            $(".overlay-bg").removeClass("show");
            $("#data-name, #data-price").val("");
            $("#data-category, #data-status").prop("selectedIndex", 0);
        });

        // hide new sidebar ends //

        $(document).on("submit", "#form_company_tech1.add", function (e) {
            e.preventDefault();

            var form_data = $("#form_company_tech1").serialize();

            var request = $.ajax({
                url: "module/planning/table/php/data_liste_planning.php?job=add_tech",
                cache: false,
                data: form_data,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                type: "get",
            });

            request.done(function (output) {
                if (output.result == "success") {
                    $(".modal-body #charge").val("5666");
                } else {
                    Swal.fire({
                        title: "ERREUR !",
                        text: "ALERTE : " + output.message,
                        type: "error",
                        confirmButtonClass: "btn btn-primary",
                        buttonsStyling: false,
                    });
                }
            });

            request.fail(function (jqXHR, textStatus) {
                Swal.fire({
                    title: "ERREUR !",
                    text: "ALERTE : " + output.message,
                    type: "error",
                    confirmButtonClass: "btn btn-primary",
                    buttonsStyling: false,
                });
            });
        });

        $(document).on("submit", "#form_company_tech2.add", function (e) {
            e.preventDefault();

            var form_data = $("#form_company_tech2").serialize();

            var request = $.ajax({
                url: "module/planning/table/php/data_liste_planning.php?job=add_tech",
                cache: false,
                data: form_data,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                type: "get",
            });

            request.done(function (output) {
                if (output.result == "success") {
                } else {
                    show_message("ALERTE : " + output.message, "error");
                }
            });

            request.fail(function (jqXHR, textStatus) {
                show_message("ALERTE :" + output.message, "error");
            });
        });

        $(document).on("submit", "#form_company_tech3.add", function (e) {
            e.preventDefault();

            var form_data = $("#form_company_tech3").serialize();

            var request = $.ajax({
                url: "module/planning/table/php/data_liste_planning.php?job=add_tech",
                cache: false,
                data: form_data,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                type: "get",
            });

            request.done(function (output) {
                if (output.result == "success") {
                } else {
                    show_message("ALERTE : " + output.message, "error");
                }
            });

            request.fail(function (jqXHR, textStatus) {
                show_message("ALERTE :" + output.message, "error");
            });
        });

        $(document).on("click", "#function_duree_traitement", function (e) {
            var id = $(this).data("id");
            var request = $.ajax({
                url: "module/planning/table/php/data_liste_planning.php?job=get_modal_plan_data",
                cache: false,
                data: "id=" + id,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                type: "get",
            });
            request.done(function (output) {
                if (output.result == "success") {
                    $(".modal-header h5").text("Détails affectation");
                    $(".modal-body #estimation_moyenne_jrs").text(output.data[0].estimation_moyenne_jrs);
                    $(".modal-body #estimation_charge").text(output.data[0].estimation_charge);
                    $(".modal-body #date_debut").text(output.data[0].date_debut);
                    $(".modal-body #date_fin").text(output.data[0].date_fin);
                    $(".modal-body #nbre_de_jours_reels").text(output.data[0].nbre_de_jours_reels);
                    $(".modal-body #remarques").text(output.data[0].remarques);
                    $(".modal-body #prestation_md").text(output.data[0].prestation_md);
                    $(".modal-body #prestation_pe").text(output.data[0].prestation_pe);
                    $(".modal-body #var_ident").text(output.data[0].var_ident);
                    $(".modal-body #var_se").text(output.data[0].var_se);

                    $("#form_company_tech1 #planning_id").val(output.data[0].planning_prod_id);
                    $("#form_company_tech2 #planning_id").val(output.data[0].planning_prod_id);
                    $("#form_company_tech3 #planning_id").val(output.data[0].planning_prod_id);
                } else {
                    show_message("Une erreur lors de l'enregistrement", "error");
                }
            });
            request.fail(function (jqXHR, textStatus) {
                show_message("Une erreur lors de l'enregistrement " + textStatus, "error");
            });
        });

        $(document).on("click", "#function_edit_chapitre", function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            var name = $(this).data("name");

            var request = $.ajax({
                url: "module/planning/table/php/data_liste_chapitre.php?job=get_chapitre_edit",
                cache: false,
                data: "id=" + id,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                type: "get",
            });

            request.done(function (output) {
                if (output.result == "success") {
                    $("#titre_h4").text("Modifier le niveau : " + name);

                    $("#form_company #btn_ok").text("Modifier");

                    $("#form_company").attr("class", "form edit");

                    $("#form_company").attr("data-id", id);

                    $("#form_company #nom_chapitre").val(output.data[0].nom_chapitre);

                    $(".add-new-data").addClass("show");
                    $(".overlay-bg").addClass("show");
                } else {
                    hide_loading_message();
                    show_message("Une erreur s'est produite lors de l'enregistrement", "error");
                }
            });
        });

        $(document).on("submit", "#form_company.edit", function (e) {
            e.preventDefault();
            if (form_company.valid() == true) {
                var id = $("#form_company").attr("data-id");
                var form_data = $("#form_company").serialize();
                var request = $.ajax({
                    url: "module/chapitre/table/php/data_liste_chapitre.php?job=chapitre_edit&id=" + id,
                    cache: true,
                    data: form_data,
                    dataType: "json",
                    contentType: "application/json; charset=utf-8",
                    type: "get",
                });
                request.done(function (output) {
                    if (output.result == "success") {
                        $(".add-new-data").removeClass("show");
                        $(".overlay-bg").removeClass("show");
                        table_companies.api().ajax.reload(function () {
                            Swal.fire({
                                title: "BRAVO !",
                                text: "Chapitre modifié avec succés",
                                type: "success",
                                confirmButtonClass: "btn btn-primary",
                                buttonsStyling: false,
                            });
                            //toastr.success('Nouvelle équipe ajoutée avec succés', 'succés', { positionClass: 'toast-bottom-full-width' , "progressBar": true , "closeButton": true });
                        }, true);
                    } else {
                        Swal.fire({
                            title: "Annulée",
                            text: "La demande de modification a échoué : " + textStatus,
                            type: "error",
                            confirmButtonClass: "btn btn-success",
                        });
                    }
                });

                request.fail(function (jqXHR, textStatus) {
                    Swal.fire({
                        title: "Annulée",
                        text: "La demande de modification a échoué : " + textStatus,
                        type: "error",
                        confirmButtonClass: "btn btn-success",
                    });
                });
            }
        });
    });
})(jQuery);
