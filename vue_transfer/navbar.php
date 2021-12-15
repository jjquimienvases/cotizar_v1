<nav class="uk-navbar-container uk-margin" uk-navbar>
    <div class="uk-navbar-left">



        <ul class="uk-navbar-nav">
            <li>
                <a href="#" class="text-danger" id="t_list" onclick="show_list()">
                    <span class="uk-icon uk-margin-small-right text-success" uk-icon="icon: list"></span>
                    Lista de Traspasos
                </a>
            </li>
            <li>
                <a href="#" class="text-primary" id="create_t" onclick="show_create()">
                    <span class="uk-icon uk-margin-small-right text-primary" uk-icon="icon: plus"></span>
                    Generar Un Nuevo Traspaso
                </a>
            </li>
        </ul>



        <div class="uk-navbar-item">

            <input class="uk-input uk-form-width-large rounded-pill" type="text" placeholder="Busca un numero de traspaso">
            <button class="uk-button uk-button-default rounded-pill" uk-icon="icon:  search">Buscar</button>

        </div>

        <div class="uk-navbar-item">

            <button class="uk-button uk-button-default rounded-pill text-success border-black" uk-icon="icon:  home"></button>

        </div>
    </div>
</nav>