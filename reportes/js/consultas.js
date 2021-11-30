// import { Paginate, PaginateLinks } from "./lib/vue-paginate.min.js";

const app = new Vue({
  el: "#app",
  // components: {
  //     Paginate,
  //     PaginateLinks
  // },
  data: {
    info_total: [],
    info_call_m: [],
    info_comerciales: [],
    info_metodos: [],
    info_multiples: [],
    info_bancos: [],
    info_call_i: [],
    info_call_i2: [],
 
  },
  mounted() {
    this.getConsultaMostrador();
    this.getConsultaCallMostrador();
    this.getConsultaCallIbague();
    this.getConsultaCallIbague2();
    this.getConsultaComerciales();
    this.getConsultaAbonos();
    // this.getConsultaNovedades();
    this.getConsultaMetodosMultiples();
    this.getConsultaAbonosRecibido();
    this.getConsultaBancos();
    // this.getConsultaNewAbono();
    
  },
  methods: {
    async getConsultaMostrador() {
      const { data } = await axios.get("../ajax/ajax_consulta_total.php");
      data.map((i) => {
        // Puntos
        //    console.log(i)
        i.pagos = [];
        i.pago.map((e) => {
          // Metodos
          const items = {};
          items.total_ventas = 0;
          items.total_dinero = 0;
          items.promedio_ventas = 0;
          items.metodo = e.metodo.toUpperCase();

          e.ventas.map((v) => {
            // Ventas

            items.total_dinero += this.getMontoX(v);
            items.total_ventas++;

            items.promedio_ventas = Math.floor(
              items.total_dinero / items.total_ventas
            );
          });
          i.pagos.push(items);
        }); //este es el map del los pagos

        reemplazarCaracteresEspeciales(i.finish, ["usuario"]);
        delete i.canales;
        delete i.pago;
        return i;
      }); //Este es el map del los puntos
      this.info_total = data;
      // console.log(output)
    },
    async getConsultaCallMostrador() {
      const { data } = await axios.get("../ajax/ajax_metodo_p_callm.php");
      data.map((i) => {
        // Puntos
        // console.log(i);
        i.pagos = [];
        i.pago.map((e) => {
          // Metodos
          const items = {};
          items.total_ventas = 0;
          items.total_dinero = 0;
          items.promedio_ventas = 0;
          items.metodo = e.metodo.toUpperCase();
          e.ventas.map((v) => {
            //   console.log(this.getMontoY(v));
            // Ventas
            items.total_dinero += this.getMontoY(v);
            items.total_ventas++;

            items.promedio_ventas = Math.floor(
              items.total_dinero / items.total_ventas
            );
          });
          i.pagos.push(items);
        }); //este es el map del los pagos
        // reemplazarCaracteresEspeciales(i.finish, ["usuario"]);
        delete i.pago;
        return i;
      });
      this.info_call_m = data;
    }, 
    async getConsultaCallIbague() {
      const { data } = await axios.get("../ajax/ajax_metodo_p_calli.php");
      data.map((i) => {
        // Puntos
        // console.log(i);
        i.pagos = [];
        i.pago.map((e) => {
          // Metodos
          const items = {};
          items.total_ventas = 0;
          items.total_dinero = 0;
          items.promedio_ventas = 0;
          items.metodo = e.metodo.toUpperCase();
          e.ventas.map((v) => {
            //   console.log(this.getMontoY(v));
            // Ventas
            items.total_dinero += this.getMontoY(v);
            items.total_ventas++;

            items.promedio_ventas = Math.floor(
              items.total_dinero / items.total_ventas
            );
          });
          i.pagos.push(items);
        }); //este es el map del los pagos
        // reemplazarCaracteresEspeciales(i.finish, ["usuario"]);
        delete i.pago;
        return i;
      });
      this.info_call_i = data;
    },
    async getConsultaCallIbague2() {
      const { data } = await axios.get("../ajax/ajax_metodo_p_calli2.php");
      data.map((i) => {
        // Puntos
        // console.log(i);
        i.pagos = [];
        i.pago.map((e) => {
          // Metodos
          const items = {};
          items.total_ventas = 0;
          items.total_dinero = 0;
          items.promedio_ventas = 0;
          items.metodo = e.metodo.toUpperCase();
          e.ventas.map((v) => {
            //   console.log(this.getMontoY(v));
            // Ventas
            items.total_dinero += this.getMontoY(v);
            items.total_ventas++;

            items.promedio_ventas = Math.floor(
              items.total_dinero / items.total_ventas
            );
          });
          i.pagos.push(items);
        }); //este es el map del los pagos
        // reemplazarCaracteresEspeciales(i.finish, ["usuario"]);
        delete i.pago;
        return i;
      });
      this.info_call_i2 = data;
    },
    async getConsultaBancos() {
      const { data } = await axios.get("../ajax/ajax_bancos.php");
      const output = [];
      data.map((i) => {
        const item = {};
        item.total_ventas = 0;
        item.total_dinero = 0;
        item.promedio_ventas = 0;

        item.metodo = i.metodo.toUpperCase();
        i.ventas.map((v) => {
          item.total_dinero += this.getMontoX(v);
          item.total_ventas++;
        });
        item.promedio_ventas = Math.floor(
          item.total_dinero / item.total_ventas
        );
        output.push(item);
      });
      this.info_bancos = output;
      console.log(output);
      console.log("hola");
    },
    async getConsultaComerciales() {
      const { data } = await axios.get("../ajax/ajax_comerciales.php");
      const output = [];
      data.map((i) => {
        const item = {};
        item.total_ventas = 0;
        item.total_dinero = 0;
        item.promedio_ventas = 0;

        item.comercial = i.comercial.toUpperCase();
        i.ventas.map((v) => {
          item.total_dinero += this.getMontoX(v);
          item.total_ventas++;
        });
        item.promedio_ventas = Math.floor(
          item.total_dinero / item.total_ventas
        );
        output.push(item);
      });
      this.info_comerciales = output;
      // console.log(output)
    },
    // async getConsultaAbonos() {
    //   const { data } = await axios.get("../ajax/ajax_abonos.php");
    //   this.info_abonos = data;
    // },
    // async getConsultaAbonosRecibido() {
    //   const { data } = await axios.get("../ajax/ajax_abonos_recibido.php");
    //   this.info_abonos_recibido = data;
    // },
    // async getConsultaNovedades() {
    //     const { data } = await axios.get("../ajax/ajax_novedades.php")
    //     const chars = ["&nbsp;"];
    //     data.map(i => {
    //         for (const c of chars) {
    //             if (i.usuario.includes(c)) {
    //                 i.usuario = i.usuario.replace(c, " ").toUpperCase()
    //                 continue;
    //             }
    //         }
    //     });
    //     this.info_novedades = data;
    // }
    async getConsultaMetodosMultiples() {
      const { data } = await axios.get("../ajax/ajax_multiple_pagos.php");
      this.info_multiples = data;
    },
    getMontoX(item) {
      let totalTax = parseFloat(item.order_total_after_tax);
      const totalDesc = parseFloat(item.order_total_amount_due);
      const NewAbono = parseFloat(item.nuevo_abono);
      const order_id = parseInt(item.order_id);

      let montox = 0;
      if (NewAbono) {
        montox = NewAbono;
        totalTax = NewAbono;
      } else if (totalDesc) {
        montox = totalDesc;
      } else {
        montox = totalTax;
      }

      return Math.floor(montox);
    },

    getMontoY(item){
        let montoy = parseFloat(item.monto);
        return Math.floor(montoy);
    },
    getTotalMonto(cotizaciones) {
      const item = {};
      item.total_ventas = 0;
      item.total_dinero = 0;
      cotizaciones.map((i) => {
        // i.efectivas.map(v => {
        item.total_dinero += this.getMontoX(i);
        item.total_ventas++;
      });
      // console.log(item);
      return item;
    },
    getTotalMontoCall(cot) {
        const item = {};
        item.total_ventas = 0;
        item.total_dinero = 0;
        cot.map((i) => {
          
          item.total_dinero += this.getMontoY(i);
          item.total_ventas++;
       
        });
        // console.log(item);
        return item;
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
