

new Vue({
    el: "#app",
    data: () => ({
        proveedores: [],
        tarjetas: []
    }),
    async mounted() {
        await this.getProveedores();
        await this.getTarjetas();
    },
    methods: {
        async getProveedores() {
            try {
                const data = await $.get("./ajax/ajax_get_proveedores.php");
                this.proveedores = JSON.parse(data);
            } catch (error) {
                console.log(error);
            }
        },
        async getTarjetas() {
            const data = await $.get("./ajax/ajax_get_proveedores_tarjetas.php");
            const { tarjetas } = JSON.parse(data);
            this.tarjetas = tarjetas;
        },
        editarProveedor(item) {

            Swal.fire({
                icon: "question",
                title: "¿Desea Editar Proveedor?",
                text: "¿Seguro que desea Editar el proveedor?",
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