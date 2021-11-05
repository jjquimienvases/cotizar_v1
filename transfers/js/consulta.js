
new Vue({
    el: "#app",
    data: () => ({
        proveedores: [],
        tarjetas: [],
        traspaso:null,
    }),
    async mounted() {
      
        await this.getTarjetas();
    },
    methods: {
        async getTarjetas() {

            const url = `../ajax/ajax_filtro_consulta_total.php?id=${this.traspaso}`;
            const { data } = await axios.get(url);
            const { tarjetas } = JSON.parse(data);
            this.tarjetas = tarjetas;
        },
        editarProveedor(item) {

            Swal.fire({
                icon: "question",
                title: "¿Desea Editar Este item?",
                text: "¿Seguro que desea Editar el item?",
                confirmButtonText: "Si quiero",
                showCancelButton: true,
                cancelButtonText: "No, No quiero",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let data = await $.post("./ajax/ajax_actualizar.php", item);
                    data = JSON.parse(data);
                    Swal.fire(data);
                    await this.getTarjetas();
                }
            }).catch(error => {
                console.log(error);
            })


        },
        eliminarProveedor(id) {



            Swal.fire({
                icon: "question",
                title: "¿Desea Eliminar Proveedor?",
                text: "¿Seguro que desea eliminar el proveedor?",
                confirmButtonText: "Si quiero",
                showCancelButton: true,
                cancelButtonText: "No, No quiero",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let data = await $.post("./ajax/ajax_delete.php", { codigo: id });
                    data = JSON.parse(data);
                    Swal.fire(data);
                    await this.getTarjetas();

                }
            }).catch(error => {
                console.log(error);
            })


        },

    },


})