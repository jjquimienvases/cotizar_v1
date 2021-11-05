// $(document).ready(function () {
//     $('#datatable').DataTable({
//         "processing": true,
//         "serverSide": true,
//         "ajax": "../js/datos.php",
//         "columns": [
//             { "data": "id" },
//             { "data": "userId" },
//             { "data": "title" },
//             { "data": "body" }
//         ]

//     });
// });

const app = new Vue({
    el: "#app",
    data: {
        info_total: [],
        info_call_m: [],
        info_call_i: [],
        info_call_i2: [],
        info_comerciales: [],
        info_metodos: [],
        info_abonos: [],
        info_novedades: [],
        info_multiples: [],
        fecha_inicio: null,
        fecha_final: null
    },

    methods:
    {
        async consultar() {
            if (this.fecha_inicio && this.fecha_final) {

                this.info_total1 = []
                this.info_call_m = []
                this.info_call_i = []
                this.info_call_i2 = []
                this.info_comerciales = []
                this.info_metodos = []
                this.info_abonos = []
                this.info_novedades = []
                this.info_multiples = []

                await this.getConsultaMostrador();
                await this.getConsultaCallMostrador();
                await this.getConsultaCallIbague();
                await this.getConsultaCallIbague2();
                await this.getConsultaComerciales();
                await this.getConsultaAbonos();
                await this.getConsultaNovedades();
                await this.getConsultaMetodosMultiples();
            }
        },
         async getConsultaMostrador() {
            const url = `../ajax/ajax_filtro_consulta_total.php?fecha_inicio=${this.fecha_inicio}&fecha_final=${this.fecha_final}`;
            const { data } = await axios.get(url);


            data.map(i => { // Puntos
                i.pagos = [];
                i.pago.map(e => { // Metodos
                    const items = {};
                    items.total_ventas = 0;
                    items.total_dinero = 0;
                    items.promedio_ventas = 0;
                    items.metodo = e.metodo.toUpperCase();

                    e.ventas.map(v => { // Ventas

                        items.total_dinero += this.getMontoX(v);
                        items.total_ventas++;

                        items.promedio_ventas = Math.floor(items.total_dinero / items.total_ventas);
                    })
                    i.pagos.push(items)
                }) //este es el map del los pagos
                reemplazarCaracteresEspeciales(i.finish, ["usuario"])
                delete i.pago;
                return i.pago;
            })
            this.info_total = data;
            //Este es el map del los puntos
            // console.log(output)
        },
        async getConsultaCallMostrador() {
            const url = `../ajax/ajax_filtro_call_mostrador.php?fecha_inicio=${this.fecha_inicio}&fecha_final=${this.fecha_final}`;
            const { data } = await axios.get(url);
            // this.info_call_m = data;
            // console.log(this.info_call_m);
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
            const url = `../ajax/ajax_filtro_call_ibague.php?fecha_inicio=${this.fecha_inicio}&fecha_final=${this.fecha_final}`;
            const { data } = await axios.get(url);
            // this.info_call_m = data;
            // console.log(this.info_call_m);
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
            const url = `../ajax/ajax_filtro_call_ibague2.php?fecha_inicio=${this.fecha_inicio}&fecha_final=${this.fecha_final}`;
            const { data } = await axios.get(url);
            // this.info_call_m = data;
            // console.log(this.info_call_m);
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
        async getConsultaComerciales() {
            const url = `../ajax/ajax_filtro_comerciales.php?fecha_inicio=${this.fecha_inicio}&fecha_final=${this.fecha_final}`;
            const { data } = await axios.get(url);
            const output = [];
            data.map(i => {
                const item = {};
                item.total_ventas = 0;
                item.total_dinero = 0;
                item.promedio_ventas = 0;

                item.comercial = i.comercial.toUpperCase();
                i.ventas.map(v => {
                    item.total_dinero += this.getMontoX(v);
                    item.total_ventas++;
                })
                item.promedio_ventas = Math.floor(item.total_dinero / item.total_ventas);
                output.push(item)
            })
            this.info_comerciales = output;
            // console.log(output)
        },
        async getConsultaAbonos() {

            const url = `../ajax/ajax_filtro_abonos.php?fecha_inicio=${this.fecha_inicio}&fecha_final=${this.fecha_final}`;
            const { data } = await axios.get(url);
            this.info_abonos = data;
        }, async getConsultaNovedades() {

            const url = `../ajax/ajax_filtro_novedades.php?fecha_inicio=${this.fecha_inicio}&fecha_final=${this.fecha_final}`;
            const { data } = await axios.get(url);
            // const chars = ["&nbsp;"];
            // data.map(i => {
            //     for (c of chars) {
            //         if (i.usuario.includes(c)) {
            //             i.usuario = i.usuario.replace(c, " ").toUpperCase()
            //             continue;
            //         }
            //     }
            // });
            this.info_novedades = data;
        }, async getConsultaMetodosMultiples() {
            const url = `../ajax/ajax_filtro_multiple_pagos.php?fecha_inicio=${this.fecha_inicio}&fecha_final=${this.fecha_final}`;
            const { data } = await axios.get(url);
            this.info_multiples = data;
            console.log(data);
               
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
            cotizaciones.map(i => {
                // i.efectivas.map(v => {
                item.total_dinero += this.getMontoX(i);
                item.total_ventas++;
            })
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
    symbol: '$',
    thousandsSeparator: '.',
    fractionCount: 2,
    fractionSeparator: ',',
    symbolPosition: 'front',
    symbolSpacing: true,
    avoidEmptyDecimals: undefined,
});