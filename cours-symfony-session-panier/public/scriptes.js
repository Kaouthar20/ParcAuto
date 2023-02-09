
$(".categorie").on("click", function () {
var idCategorie = $(this).attr("id");
$.ajax({

type: "POST",
url: "/articlesInCategorie",


data: {
idCategorie: idCategorie
},
success: function (result) {
$("#listArticles").empty().append(result);

}
});
})