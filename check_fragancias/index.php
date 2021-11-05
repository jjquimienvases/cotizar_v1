<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fragancias</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="../Lib/bootstrap/css/bootstrap.min.css"> -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="../Lib/sweetalert2/sweetalert2.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Crimson+Pro">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container mt-4 text-center">
     <h4 class="text-danger">BIENVENIDO A LA LISTA DE ESENCIAS</h4>
                <button id="generate_consulta" onclick="getInformation()"></button>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>CONTRATIPO</th>
                      <th>GENERO</th>
                    <th>STOCK</th>
                </tr>
            </thead>
            <tbody id="info_fragancias">

            </tbody>
        </table>
    </div>
    <script src="js/funciones.js"></script>
</body>

</html>