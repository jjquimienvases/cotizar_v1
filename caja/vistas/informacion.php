<?
include_once "../globals/head.php";
?>

<body>

    <div id="app">


        <div class="container text-center">
            <button class="btn btn-primary" id="myboton"> <a href="../try_caja/index.php">Volver Al Panel De Caja </a> </button>
        </div>
        <header class="text-center mb-4 py-4">
            <h1 class="btn btn-success">CIERRE DE CAJA - GASTOS Y NOVEDADES</h1>
        </header>

        <div class="container pt-2 cierre-caja-container">

            <div class="card">
                <div class="card-body">
                    <!-- <h5 class="card-title">Cierre de caja</h5> -->
                    <b class="card-text">
                    <form @submit.prevent>
                        <div class="form-group">
                            <label for="input_monto" class="text-center mb-2"><b>Monto de cierre:</b></label>
                            <br>
                            <input id="input_monto" type="number" class="form-control" v-model="monto">
                        </div>
                        <hr>
                        <div class="btn-wrapper">
                            <button class="btn btn-warning" :disabled="monto <= 0" @click="cerrarCaja">Cerrar caja</button>
                        </div>
                    </form>
                    </b>
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-body">
                    <!-- <h5 class="card-title">Cierre de caja</h5> -->
                    <b class="card-text">
                    <form @submit.prevent>
                        <div class="form-group">
                            <label for="input_monto" class="text-center mb-2"> <b>Gasto Y Novedades</b></label>
                            <br>
                            <input id="input_novedad" type="text" class="form-control mt-2" placeholder="Escribir gasto o novedad" v-model="novedad.novedad">
                            <input id="input_montos" type="number" class="form-control mt-4" v-model="novedad.monto">
                        </div>
                        <hr>
                        <div class="btn-wrapper">
                            <button class="btn btn-primary" @click="subirNovedad">Adjuntar Monto</button>
                        </div>
                    </form>
                    </b>
                </div>
            </div>

        </div>

    </div>
</body>

<?
include_once "../globals/scripts.php";
?>

<!-- Scripts no globales -->
<script src="./scripts.js"></script>
<?
include_once "../globals/foot.php";
?>