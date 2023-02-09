
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css"
        integrity="sha512-GQGU0fMMi238uA+a/bdWJfpUGKUkBdgfFdgBm72SUQ6BeyWjoY/ton0tEjH+OSH9iP4Dfh+7HM0I9f5eR0L/4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>

<body>
    <header>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><i class="fas fa-user-secret"></i>
                    Facture</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled">Disabled</a>
                        </li>
                    </ul>
                   
                </div>
            </div>
        </nav>
    </header>
    <section class="container py-5">
        <div class="row">
            <div class="col-lg-8 col-sm mb-5 mx-auto">
            <h1 class="fs-4 text-center lead text-primary">CRUD PHP POO MYSQL AJAX</h1>
            </div> 
        </div>
        <div class="dropdown-divider border-warning"></div>
         <div class="row">

         <div class="col-md-6">
    
         <h1 class="fw-bold mb-8">Liste des factures</h1>
        </div>
<div class="col-md-6">
<div class="d-flex justify-content-end ">
    <button class="btn btn-primary btn-sm me-3 "data-bs-toggle="modal" data-bs-target="#createModal">
        <i class="fas fa-folder-plus"></i> Nouveau
    </button>
    <a href="#" class="btn btn-success btn-sm " id="export"><i class="fas fa-table"> Exporter</i></a>
</div>

</div>
         </div>
           <div class="dropdown-divider border-warning"></div>
          <div class="row">
              <div class="table-responsive" id="orderTable">
                  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Client</th>
      <th scope="col">Caissier</th>
      <th scope="col">Montant</th>
       <th scope="col">Perçu</th>
        <th scope="col">Retourné</th>
         <th scope="col">Etat</th>
            <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php for($i=0;$i<100;$i++): ?>
    <tr>
      <th scope="row"><?=$i?></th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      
      <td>Otto</td>
      <td>@mdo</td>
        <td>Mark</td>
      
      <td>
          <a href="#" class="text-info me-2 infoBtn" title="voir detail"><i class="fas fa-info-circle"></i></a>
     
             <a href="#" class="text-warning me-2 modifBtn" title="modifier"><i class="fas fa-edit"></i></a>
                    <a href="#" class="text-danger me-2 deleteBtn" title="suprimer"><i class="fas fa-trash"></i></a>   </td>

    </tr>
  <?php endfor; ?>
  </tbody>
</table>
              </div>
          </div>
    </section>


<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nouvelle facture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="formOrder">
            <div class="form-floating mb-2">
         
            <input type="text" class="form-control" id="customer" name="customer">
            <label for="customer">Nom de client</label>
            </div>
          <div class="form-floating mb-2"> 
<input type="text" class="form-control" id="cashier" name="cashier">
    <label for="cashier">Nom de caissier</label>
          </div>
          <div class="row g-2">
              <div class="col-md"> <div class="form-floating mb-2"> 
                <input type="number" class="form-control" id="amount" name="amount">
                    <label for="amount">Montant</label>
          </div></div>
           <div class="col-md"> <div class="form-floating mb-2"> 
                <input type="number" class="form-control" id="recieved" name="recieved" name="recieved">
                    <label for="recieved">Montant perçu</label>
          </div></div>
           <!-- <div class="col-md"> <div class="form-floating mb-2"> 
                <input type="number" class="form-control" id="returned" name="returned" name="returned">
                    <label for="returned">Returned</label>
          </div></div>
           -->
              <div class="col-md"> 
                  <div class="form-floating mb-2"> 
                  <select name="state" aria-label="state" class="form-select" id='state' >
<option value="factureé">Facturée</option>
<option value="payée">Payée</option>
<option value="annulée">Annulée</option> 

                  </select>
                   <label for="state">Etat</label>
               
          </div></div>
            
       
           
           
          
          
          </div>
        

        
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-primary" name="create" id="create">Ajouter <i class="fas fa-plus"></i></button>
      </div>
    </div>
  </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="process.js"></script>
</body>

</html>