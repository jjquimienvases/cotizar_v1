const app = new Vue({
  el: "#app",
  data: {
    info_cotizacion: [],
    info_cliente: [],
    cotizacion: null,
  },
  methods: {
    async consultar() {
      if (this.cotizacion) {
        this.info_cotizacion = [];
        this.info_cliente = [];
        await this.GetConsultaItems();
        await this.GetCreditoCliente();
      }
    },
    async GetConsultaItems() {
      const url = `../ajax/ajax_print_data.php?cotizacion=${this.cotizacion}`;
      const { data } = await axios.get(url);
      this.info_cotizacion = data;
      // console.log(this.info_cotizacion);
    },
    async GetCreditoCliente(){
        console.log("entre")
        const url = `../ajax/ajax_credito_cliente.php?cotizacion=${this.cotizacion}`;
        const { data } = await axios.get(url);
        this.info_cliente = data;
        //  console.log(this.info_cliente);
      },
    EjecutarDevolucion(item) {
    console.log("entre a la funcion");
        Swal.fire({
            icon: "question",
            title: "¿Desea ejecutar esta devolucion?",
            text: "¿Seguro que desea hacer La devolucion de este producto?",
            confirmButtonText: "Si quiero",
            showCancelButton: true,
            cancelButtonText: "No, No quiero",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let data = await $.post("../ajax/ajax_update_devolucion.php", item);
                data = JSON.parse(data);
                Swal.fire(data);
                await this.GetConsultaItems();
                await this.GetCreditoCliente();
            }
        }).catch(error => {
            console.log(error);
        })
    },
    
  },
});

Vue.use(VueCurrencyFilter, {
  symbol: "$",
  thousandsSeparator: ".",
  fractionCount: 2,
  fractionSeparator: ",",
  symbolPosition: "front",
  symbolSpacing: true,
  avoidEmptyDecimals: undefined,
});
