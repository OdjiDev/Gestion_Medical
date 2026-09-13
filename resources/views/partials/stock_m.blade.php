@include('include.header')


<div class="container-fluid">
<div class="row align-items-center mb-3">

 <!-- <div class="col-md-6">
        <h1 class="mb-0">Stock des medicaments</h1>
</div> -->

<!-- <div class="col-md-6 d-flex justify-content-end">
    <form class="d-none d-sm-inline-block form-inline my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-white border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
</div> -->

<div class=" card shadow mb-4">
    <div class=" row card-header ">

     <div class="col-md-6">
        <h1 class="mb-0">Stock des medicaments</h1>
</div>

        <div class="col-md-6 d-flex justify-content-end">
    <form class="d-none d-sm-inline-block form-inline my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-white border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
</div>

    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="bg-primary text-white">
                <tr>
                    <th>#</th>
                    <th>Produit</th>
                    <th class="text-end">Stock</th>
                   
                    <th class="text-center">Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medicaments as $stock)
                <tr>
                    <td>1</td>
                    <td>{{$stock->nom}}</td>
                    <td class="text-end">{{$stock->quantite}}</td>
                    
                    <td class="text-center">
                        <span class="badge bg-success">Disponible</span>
                    </td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
</div>



</div>
</div>
  
@include('include.footer')