const app = new Vue ({
    el: "#app",

    data:{
        info_total: [],

    },

    mounted() {
        this.getConsultaInventarios();
    },
    methods: {
        async getConsultaInventarios() {
            const {data} = await axios.get("../ajax/ajax_consulta_total.php")
            this.info_total = data;
        },
        getMontoX(item) {
            const Total_Items = parseFloat(item.gramo);
            const Categoria = parseFloat(item.id_categoria);
            const stock = parseInt(item.stock);
            
            const data_accesorio = parseInt(13);
            const galon = 282;
            const tapa = 62;
            let val = 0;
            let val_2 = 0;
            let val_3 = 0;
            let val_4 = 0;
            let val_5 = 0;
            let val_6 = 0;
            let val_7 = 0;
            let val_8 = 0;
            let montox = 0;
            if(Categoria === 4){
                montox = Total_Items / 1000;
            }else if (Categoria === 13){
                montox = Total_Items / 1000;
            }else if(Categoria == 21){
                val = parseFloat(Total_Items / 1000);
                val_2 = parseFloat(stock * 0.25);
                val_3 = parseFloat(stock * 0.75);
                val_4 = parseFloat(val_2 * val);
                val_5 = parseFloat(val_3 * data_accesorio);
                val_6 = parseFloat(stock / 125);
                val_7 = parseFloat(galon * val_6);
                val_8 = parseFloat(tapa * val_6);
                montox = val_7 + val_8 + val_5 + val_4;
            }else if(Categoria != 4){
                montox = Total_Items;
            }
            if(Categoria === 21){
                return Math.floor(montox);
            }else{
                return Math.floor(montox * stock);
            }

        },
        getTotalMonto(cotizaciones) {

            const item = {};
            item.total_dinero = 0;
            cotizaciones.map(i => {
                item.total_dinero += this.getMontoX(i);
            })
            return item;
        },

    }
})

Vue.use(VueCurrencyFilter, {
    symbol: '$',
    thousandsSeparator: '.',
    fractionCount: 2,
    fractionSeparator: ',',
    symbolPosition: 'front',
    symbolSpacing: true,
    avoidEmptyDecimals: undefined,
});
