$(function() {
$('table').DataTable();
//crée une facture
$('#create').on('click', function(e){
// Récuperer le formulaire
let formOrder= $('#formOrder')
if(formOrder[0].checkValidity()){
e.preventDefault();
$.ajax({
url:'process.php',
type:'post',
data:formOrder.serialize() + '&action=create',
success:function(response){
   
    $('#createModal').modal('hide');
    Swal.fire({

  icon: 'success',
  title: 'success',

})
formOrder[0].reset();
}



})

}

})
//recuperer une facture

function getBills(){
$.ajax({

    url:'process.php',
    type:'post',
    data:{ action:'fetch'},
    success:function(response){
        console.log(response);
    }
})

}
})