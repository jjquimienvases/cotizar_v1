


new Vue({
    el: "#app",
    // vuetify: new Vuetify(),
    data: () => ({
        monto: 0,
        novedad: {}

    }),
    mounted() {
    },
    methods: {
        async cerrarCaja() {
            try {
                const { data } = await axios.post("./ajax/ajax_cerrar_caja.php", {
                    monto: this.monto
                }, {
                    headers: { "Content-Type": "application/json" }

                });
                if (data) {
                    Swal.fire({
                        title: "Caja Cerrada Correctamente",
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Continuar!'

                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "https://www.cotizar.jjquimienvases.com/try_caja/index.php";
                        }
                    })
                }


            } catch (error) {
                const { msg, err, redirect, url } = error.response.data
                console.log(err)

                if (redirect) {
                    Swal.fire({
                        title: "No Cerraste Caja",
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Continuar!'

                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    })
                } else {
                    Swal.fire({
                        title: "Error",
                        icon: "error",
                        text: `${err} - ${msg}`,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Continuar!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                           window.location.href = "https://www.cotizar.jjquimienvases.com/try_caja/index.php";
                        }
                    })

                }


            } finally { this.monto = 0; }

        },
        async subirNovedad() {

            try {
                const { data } = await axios.post("./ajax/ajax_novedades.php", this.novedad, {
                    headers: { "Content-Type": "application/json" }
                });
                if (data) {
                    Swal.fire({
                        title: "GASTO REGISTRADO",
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Continuar!'

                    }).then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = "https://www.cotizar.jjquimienvases.com/try_caja/index.php";

                        }
                    })
                }
                this.monto = 0;

            } catch (error) {
                const { msg, err, redirect, url } = error.response.data

                Swal.fire({
                    title: "Error",
                    icon: "error",
                    text: `${err} - ${msg}`
                })
                if (redirect) {
                    window.location.href = url;
                }


            }


        }
    }
})