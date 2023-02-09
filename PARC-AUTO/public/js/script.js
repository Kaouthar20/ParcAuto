$(document).ready(function () {
  $("body").on("change", ".DDLtypeprestation", function () {
    let selectedProject = $(this).val();
    $.ajax({
      type: "post",
      url: "/repmlirPrestationByType/" + selectedProject,
      success: function (data) {
        $(".DDLprestation").html(data);
        // console.log(data);
      },
    });
  });

  $("body").on("change", ".DDLtypeprestation_2", function () {
    let selectedProject = $(this).val();
    $.ajax({
      type: "post",
      url: "/repmlirPrestationByType_v2/" + selectedProject,
      success: function (data) {
        $(".DDLprestation_2").html(data);
        // console.log(data);
      },
    });
  });

  $("body").on("change", ".DDLprestation", function () {
    let selectedProject = $(this).val();
    $.ajax({
      type: "post",
      url: "/repmlirVehiculeByPrestation/" + selectedProject,
      success: function (data) {
        $(".DDLtypevehicule").html(data);
        // console.log(data);
      },
    });
  });

  $("body").on("change", ".DDLprestation_2", function () {
    let selectedProject = $(this).val();
    $.ajax({
      type: "post",
      url: "/repmlirVehiculeByPrestation/" + selectedProject,
      success: function (data) {
        $(".DDLtypevehicule").html(data);
        // console.log(data);
      },
    });
  });

  $("body").on("click", ".btnajouterprestation", function () {
    let typeprestation = $(".DDLtypeprestation option:selected").text();
    let typevehicule = $(".DDLtypevehicule option:selected").text();
    let prestation = $(".DDLprestation option:selected").text();

    let idtypeprestation = $(".DDLtypeprestation option:selected").val();
    let idtypevehicule = $(".DDLtypevehicule option:selected").val();
    let idprestation = $(".DDLprestation option:selected").val();

    // alert(typevehicule);
    let nbrrow = $(
      ".tbodylisteprestation tr > td:contains(" + prestation + ") "
    ).length;
    if (nbrrow == 0) {
      $(".tbodylisteprestation tr:last").after(
        '<tr class="table-default"><td data-id="' +
          idprestation +
          '">' +
          typeprestation +
          '</td><td data-id="' +
          idtypeprestation +
          '">' +
          prestation +
          '</td><td data-id"' +
          idtypevehicule +
          '">' +
          typevehicule +
          '</td><td><button class="btn btndeleteprestation">x</button></td></tr>'
      );
    } else {
      alert("prestation deja choisi");
    }
  });

  $("body").on("click", ".btnajouterprestation_2", function () {
    let typeprestation = $(".DDLtypeprestation_2 option:selected").text();
    let typevehicule = $(".DDLtypevehicule option:selected").text();
    let prestation = $(".DDLprestation_2 option:selected").text();
    let idtypeprestation = $(".DDLtypeprestation_2 option:selected").val();
    let idtypevehicule = $(".DDLtypevehicule option:selected").val();
    let idprestation = $("body .DDLprestation_2 option:selected").val();

    let nbrrow = $(
      ".tbodylisteprestation_2 tr > td:contains(" + prestation + ") "
    ).length;
    if (nbrrow == 0) {
      $(".tbodylisteprestation_2 tr:last").after(
        '<tr class="table-default"><td data-id="' +
          idprestation +
          '">' +
          typeprestation +
          '</td><td data-id="' +
          idtypeprestation +
          '">' +
          prestation +
          '</td><td data-id"' +
          idtypevehicule +
          '">' +
          typevehicule +
          '</td><td><button class="btn btndeleteprestation">x</button></td></tr>'
      );
    } else {
      alert("prestation deja choisi");
    }
  });

  $("body").on("click", ".btndeleteprestation", function () {
    $(this).closest("tr").remove();
  });

  $("body").on("click", ".addMission", function () {
    // let typeprestation = $('.DDLtypeprestation option:selected').val();
    // let typevehicule =$('.DDLtypevehicule option:selected').val();
    // let prestation =$('.DDLprestation option:selected').val();
    let site = $(".txtsite").attr("data-id");
    let demandeur = $(".txtDemandeur").val();
    let benif = $(".txtBenif").val();
    var nbrP = $(".nptTxt").val();
    let ville = $(".txtVille").val();
    let numTel = $(".txtNum").val();
    let adresse = $(".txtAdress").val();
    let dateDepart = $(".dtpDepart").val();
    let dateRetour = $(".dtpRetour").val();
    let Heure = $(".txtHeure").val();
    let idprestation;
    let typevehicule;
    let typeprestation;
    let i = $(".tbodylisteprestation tr").length;
    let idDemande;
    idprestation = $(".tbodylisteprestation tr")
      .find("td:eq(0)")
      .map(function () {
        return $(this).attr("data-id");
      })
      .get();
    //    idtypeprestation=$('.tbodylisteprestation tr').find('td:eq(1)').map(function(){
    //     return $(this).attr("data-id");
    //    }).get();
    //    idtypevehicule=$('.tbodylisteprestation tr').find('td:2').map(function(){
    //     return $(this).attr("data-id");
    //    }).get();
    if (
      site == "" ||
      demandeur == "" ||
      nbrP == "" ||
      ville == "" ||
      numTel == "" ||
      adresse == "" ||
      dateDepart == "" ||
      dateRetour == "" ||
      Heure == ""
    ) {
      alert("veuillez remplir tous les champs");
    } else {
      $.ajax({
        type: "POST",
        url: "/addMission",
        data: {
          // 'typeprestation':typeprestation,
          // 'typevehicule':typevehicule,
          // 'prestation':prestation,
          site: site,
          demandeur: demandeur,
          benif: benif,
          " npt": nbrP,
          ville: ville,
          numTel: numTel,
          adresse: adresse,
          dateDepart: dateDepart,
          dateRetour: dateRetour,
          Heure: Heure,
        },
        success: function (data1) {
          for (j = 0; j <= i - 1; j++) {
            //  alert(repartitio);
            $.ajax({
              type: "POST",
              url: "/addPrestationMission",
              data: {
                idmission: data1,
                idprestation: idprestation[j],
                //    'idrepartition' : repartitio,
                //    'qtep':qteP[j],
              },
              success: function () {},
            });
          }

          $(".btn-outline-secondary").click();
          location.href = "/mission";
        },
      });
    }
  });
  $("body").on("click", ".EditerMission", function () {
    var weekend = $(".checkWeek").is(":checked");
    var nuit = $(".checkNuit").is(":checked");
    let demandeur = $(".txtDemandeur").val();
    var nbrP = $(".nptTxt").val();
    let ville = $(".txtVille").val();
    let numTel = $(".txtNum").val();
    let adresse = $(".txtAdress").val();
    let dateDepart = $(".dtpDepart").val();
    let dateRetour = $(".dtpRetour").val();
    let Heure = $(".txtHeure").val();
    alert(demandeur);
    if (weekend == true) {
      weekend = 1;
    } else {
      weekend = 0;
    }
    if (nuit == true) {
      nuit = 1;
    } else {
      nuit = 0;
    }

    var id_mission = $("body #mission").attr("at");

    idprestation = $("body .tbodylisteprestation_2 tr")
      .find("td:eq(0)")
      .map(function () {
        return $(this).attr("data-id");
      })
      .get();
    $.ajax({
      type: "POST",
      url: "/deletePrestationMission",
      data: {
        idmission: id_mission,
      },
      success: function () {
        $.ajax({
          type: "POST",
          url: "/editPrestationMission",
          data: {
            idmission: id_mission,
            idprestation: idprestation,
            weekend: weekend,
            nuit: nuit,
          },
          success: function () {
            $("#modalScrollable_edite").modal("hide");
          },
        });
        // }
      },
    });
  });

  $("body").on("click", ".btninitierPre", function () {
    $("#modalConfirmationInitiation").modal("toggle");
    $("#modalConfirmationInitiation").modal("show");

    var idrelation_mission = $(this).parent().parent().find("td:eq(0)").text();
    var idprestation = $(this).parent().parent().find("td:eq(1)").text();

    $.ajax({
      type: "post",
      url: "/initierMission_v2/" + idrelation_mission,
      data: {
        idrelation_mission: idrelation_mission,
        idprestation: idprestation,
      },
      success: function (data) {
        $("#modal_initiation_v2").html(data);
        console.log(data);
      },
    });
  });

  $("body").on("click", ".validerprestation", function () {
    $("#modalConfirmationvalidation").modal("toggle");
    $("#modalConfirmationvalidation").modal("show");
    var idrelation_mission = $(this).attr("at");
    var idprestation = $(this).attr("art");
    $("body #data").html(
      '<input at="' +
        idprestation +
        '" art="' +
        idrelation_mission +
        '" class="form-control data_valide"  id="firstName"  autofocus="" hidden >'
    );
  });

  $("body").on("click", "#remise", function () {
    if ($('[name="remise"]').is(":checked")) {
      $("body #data_remise").html(
        '<div class="mb-3"><label  class="form-label">Remise</label><input class="form-control" type="number" id="remise_data" min="0"  autofocus=""></div>'
      );
    } else {
      $("body #data_remise").empty().html();
    }
  });

  $("body").on("click", ".validerprestation_f", function () {
    var carburant = $("#carburant").val();
    var jawaz = $("#jawaz").val();
    var nbrj = $("#nbrj").val();
    var remise = $("#remise_data").val();
    var idprestation = $(".data_valide").attr("at");
    var idrelation_mission = $(".data_valide").attr("art");

    $.ajax({
      type: "post",
      url: "/validermission_v2/" + idrelation_mission,
      data: {
        idrelation_mission: idrelation_mission,
        idprestation: idprestation,
        carburant: carburant,
        jawaz: jawaz,
        remise: remise,
        nbrj: nbrj,
      },
      success: function (data) {
        $("#modalConfirmationvalidation").modal("hide");
        $("#modalConfirmationvalidation").modal();
        $("body #" + data)
          .closest("tr")
          .remove();
      },
    });
  });

  $("body").on("click", ".EditerMission_v2", function () {
    // var idrelationmission = $(this).attr('data-id');
    var idvehicule = $(".DDLvehicule option:selected").val();
    var idconducteur = $(".DDLconducteur option:selected").val();
    var kilometrage = $(".txtKm").val();
    var idrelationmission = $(".txtidrelationmission").attr("data-id");

    $.ajax({
      type: "post",
      url: "/confirmerInitiation/" + idrelationmission,
      data: {
        // 'idrelation_mission':idrelationmission,
        idvehicule: idvehicule,
        idconducteur: idconducteur,
        kilometrage: kilometrage,
        idrelationmission: idrelationmission,
      },
      success: function (data) {
        console.log(data);
        $("#modalConfirmationInitiation").modal("hide");
        // location.href="http://127.0.0.1:8000/etatInitier/"+data;
        $("body #" + idrelationmission)
          .closest("tr")
          .remove();

        window.open("/etatInitier/" + data);
      },
    });
  });

  // $("body").on("click" , ".Intier_mission" , function() {

  //     var idmissioncab = $('.lblidmissioncab').val();

  //     // alert(idmissioncab);
  //     // var idrelationmission = $(this).attr('data-id');
  //      let prestation =$('.DDLprestation_2 option:selected').text();

  //     let nbrrow= $('.tbodylisteprestation_3 tr > td:contains(Faut initier) ').length;
  //     let nbrrow2= $('.tbodylisteprestation_3 tr > td:contains('+prestation+') ').length;

  //     // let nbrrow= $('.tbodylisteprestation tr > td:contains('+prestation+') ').length;
  //     // alert(nbrrow)
  //     if(nbrrow==0 || nbrrow2==0){
  //         $.ajax({
  //             type: "post",
  //             url:'/initiermissioncab/'+idmissioncab,
  //             data:{

  //             },
  //             success:function(data) {
  //                 console.log(data);
  //                 location.href="/mission";
  //                 // $('body #'+data).closest('tr').remove();
  //                 $('#modalScrollable_edite').modal('hide');

  //             }
  //         })
  //     }
  //     else{
  //         alert("Veuillez initier tous les prestations");
  //     }

  //     // $.ajax({
  //     //                         type: "post",
  //     //                         url:'/initiermissioncab/'+idmissioncab,
  //     //                         data:{

  //     //                         },
  //     //                         success:function(data) {
  //     //                             console.log(data);
  //     //                             $('#modalScrollable_edite').modal('hide');
  //     //                             location.href="http://127.0.0.1:8000/mission/";

  //     //                         }
  //     //                     })

  //                 });

  $("body").on("click", ".btnfiltre", function () {
    // var idrelationmission = $(this).attr('data-id');

    var idmissioncab = $(this).attr("data-id");

    $.ajax({
      type: "post",
      url: "/filter/" + idmissioncab,
      data: {},
      success: function (data) {
        console.log(data);
        // $('#modalScrollable_edite').modal('hide');
        // location.href="http://127.0.0.1:8000/mission/";
        $(".tbodymissionfiltre").html(data);
      },
    });
  });

  $("body").on("click", ".annuler", function () {
    // var idrelationmission = $(this).attr('data-id');

    var idmissioncab = $(this).attr("at");

    $.ajax({
      type: "post",
      url: "/annulerMission/" + idmissioncab,
      data: {},
      success: function (data) {
        console.log(data);
        // $('#modalScrollable_edite').modal('hide');
        location.href = "/mission";
      },
    });
  });

  $("body").on("click", ".detailMission", function () {
    $("#detaimmissionmodal").modal("toggle");
    $("#detaimmissionmodal").modal("show");

    var idm = $(this).attr("at");
    // var idrelation_mission = $(this).parent().parent().find('td:eq(0)').text();
    // var idprestation = $(this).parent().parent().find('td:eq(1)').text();

    $.ajax({
      type: "post",
      url: "/detailmission/" + idm,
      data: {
        // 'idrelation_mission':idrelation_mission,
        // 'idprestation':idprestation,
      },
      success: function (data) {
        $(".modal-body").empty();
        $(".modal-body").html(data);
        console.log(data);
      },
    });
  });
});
