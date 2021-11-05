new Vue({
    el: "#app",
    data: () => ({
        productos: [],

        
    }),
    async mounted() {
        await this.getProductos();
  
       
    },
    methods: {
        async getProductos() {
            try {
                const data = await $.get("./ajax/ajax_get_productos.php");
                this.productos = JSON.parse(data);
            } catch (error) {
                console.log(error);
            }
        },


        },
       
    

    });


