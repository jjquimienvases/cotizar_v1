new Vue({
  el: "#app",
  data: () => ({
    facturas: [],
    tarjetas: [],
    target: [],
    data_modal: [],
    persona: "",
    document: "",
    personas: "",
    documents: "",
    cotizacion: "",
    order_id:"",
  }),
  async mounted() {
    await this.getFacturas();
    await this.getTarjetas();
    await this.getTarjetas_call();
    // await this.consultar_data();
  },
  methods: {
    async getFacturas() {
      try {
        const data = await $.get("./ajax/ajax_get_facturas.php");
        this.facturas = JSON.parse(data);
      } catch (error) {
        console.log(error);
      }
    },
    async getTarjetas() {
      const data = await $.get("./ajax/ajax_get_tarjetas.php");
      const { tarjetas } = JSON.parse(data);
      this.tarjetas = tarjetas;
    },
    async getTarjetas_call() {
      const data = await $.get("./ajax/ajax_consultar_call.php");
      const { target } = JSON.parse(data);
      this.target = target;
    },
    consultar_data(id) {
      Swal.fire({
        icon: "question",
        title: "¿Desea Adjuntar Factura?",
        confirmButtonText: "Si quiero",
        showCancelButton: true,
        cancelButtonText: "No, No quiero",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
      })
        .then(async (result) => {
          if (result.isConfirmed) {
            // console.log(id);
            const data = await $.post("./ajax/ajax_consultar_modal.php", {
              codigo: id,
            });
            const data_modal = data;

            let info = (this.data_modal = data_modal);
            
         
            //  console.log(info);
            Swal.fire(info);
            // await this.getTarjetas();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    GenerarFactura(item) {
      Swal.fire({
        icon: "question",
        title: "¿Desea Generar Factura?",
        text: "¿Seguro que desea generar factura?",
        confirmButtonText: "Si quiero",
        showCancelButton: true,
        cancelButtonText: "No, No quiero",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
      })
        .then(async (result) => {
          if (result.isConfirmed) {
            let data = await $.post("./ajax/ajax_consultar_datos.php", item);
            data = JSON.parse(data);
            console.log(data);
            // let valores = data[0].map(function(a){return a.total}).reduce(function(a,b){ return a+b;})
               let subttl = data[0].map(function(a){return a.taxableAmount}).reduce(function(a,b){ return a+b;});

            let fecha_actual = data[3];

            let newinvoice = {};
            newinvoice.invoices = [];
            let items = data[0];
            let customer = { customer: data[2] };

             let iva = subttl * 0.19;
            let cuentas = subttl + iva;
            // let cuentas = parseFloat(data[1].order_total_before_tax);
            // let subttoal = cuentas / 1.19;
            let customerInvoiceId = data[8];
            let seller = data[1].order_receiver_address;
            let order = data[1].order_id;
            let saleCondition = "CONTADO";
            let representation = "";
            // let observation = "";
            let purchaseOrder = "";
            let area = "";
            let referral = "";
            let warehouse = "";
            let note = "";
            let otherTaxesTotal = 0;

            //variables de valores fijos
            let invoiceType = "FACTURA";
            let invoiceTypeExport = false;
            let operationCode = 10;
            let pointOfSale = "JJSA";
            let currency = "COP";
            let currencyRate = 0;
            //variable de los items
            let itemType = "GRAVADO";
            let quantity = parseInt(data[0].order_item_quantity);
            let amoun = data[0].order_item_unitario / 1.19;
            let amount1 = amoun.toFixed(2);
            let amount = parseFloat(amount1);
            let con_iva_unitario = data[0].order_item_unitario;
            let name = "";
            let subTotal = amount * quantity;
            let description = data[0].item_name;
            // let tota = con_iva_unitario * quantity ;
            // let total = parseFloat(tota.toFixed());
            let taxableAmoun = subTotal;
            let taxableAmount = parseFloat(taxableAmoun.toFixed(2));
            let totalTa = taxableAmount * 0.19;
            let totalTax1 = totalTa.toFixed();
            let totalTax = parseFloat(totalTax1);
            let total = parseFloat(taxableAmount + totalTax).toFixed(2);
            let clasificationId = "";
            let clasificationName = "";
            let discountPercentage = 0;
            let discountAmount = 0;
            let tax_type_p = "IVA"; // taxes de productos
            let tax_amount_p = totalTax;
            let tax_taxableAmount_p = taxableAmount;
            let percentage = 19;
            let itemCode = data[0].item_code;
            let observation = "Factura Electronica";
            let ifGift = false;
            //Variables de cliente
            let type = data[6];
            let demo_cedula = data[7];
            let idExport = 0;
            let idType = data[5];
            let names = data[2].nombres;
            let departament = data[4].municipio;
            let postalCode = data[4].postal;
            let address = data[2].direccion;
            let cityName = data[4].ciudad;
            let countryCode = "CO";
            let firstName = "";
            let lastName = "";
            let email = data[2].email;
            let telephone = parseInt(data[2].telefono);
            let regimen = "ZZ";
            // OK OK  aqui vamos a hacer el input para el post
            //    let input = document.createElement("INPUT");
            //    input.type = 'number';
            //    input.value=order;
            //    input.name="info_post";

            //primera parte
            newinvoice.invoices.push({
              invoiceType: invoiceType,
              invoiceTypeExport: invoiceTypeExport,
              operationCode: operationCode,
              pointOfSale: pointOfSale,
              currency: currency,
              currencyRate: currencyRate,
              taxes: [
                {
                  type: "IVA",
                  amount: iva.toFixed(2),
                  taxableAmount: subttl.toFixed(2),
                  percentage: 19,
                },
              ],
              retes: [],
              items,
              customer: {
                type: type,
                id: demo_cedula,
                idExport: idExport,
                idType: idType,
                name: names,
                department: departament,
                postalCode: postalCode,
                address: address,
                cityName: cityName,
                countryCode: countryCode,
                firstName: firstName,
                lastName: lastName,
                email: email,
                telephone: telephone,
                regimen: regimen,
              },

              otherTaxesTotal: otherTaxesTotal,
              total: cuentas,
              paid: "",
              vatAmount: iva,
              exemptAmount: 0,
              taxableAmount: subttl,
              issuedDate: fecha_actual,
              expirationDate: fecha_actual,
              saleCondition: saleCondition,
              customerInvoiceId: customerInvoiceId,
              seller: seller,
              representation: representation,
              observation: observation,
              purchaseOrder: purchaseOrder,
              area: area,
              order: order,
              referral: referral,
              warehouse: warehouse,
              note: note,
            });

            invoice = JSON.stringify(newinvoice);

            console.log(JSON.stringify(newinvoice));
            let user = "facturacionelectronica@jjquimienvases.com";
            let pass = "JJQu1m13nv4s3s2020**";

            usuario = btoa(user);
            contrasena = btoa(pass);

            var settings = {
              url:
                "https://app.sifactura.co/api/v1/invoice/process/new/batch/json/PROD",
              method: "POST",
              timeout: 0,
              headers: {
                Authorization:
                  "Basic ZmFjdHVyYWNpb25lbGVjdHJvbmljYUBqanF1aW1pZW52YXNlcy5jb206SkpRdTFtMTNudjRzM3MyMDIwKio=",
                "Content-Type": "application/json",
                Cookie:
                  "SIFACTURA_SESSION=30fa8c83-7d3f-4577-8775-fab536e9f28c; CSRF-TOKEN=c11ba6e6-025d-4493-8b29-d81c75cd5b7b",
              },
              data: invoice,
            };

            $.ajax(settings).done(async (response) => {
              console.log(response);
              if (response.errors == null) {

const data_actualizar_status = await $.post("./ajax/ajax_actualizar_data.php", {codigo: order, id_factura:customerInvoiceId});

console.log(data_actualizar_status);


                Swal.fire({
                  icon: "success",
                  title: "Proceso Exitoso",
                  text: "Esta factura fue generada exitosamente!",
                  footer: "<a href>Deseas ver el pdf?</a>",
                });
                
                var pdf = {
                  url:
                    "https://app.sifactura.co/api/v1/invoice/getPdf/sales/PROD/JJSA/FACTURA/" +
                    customerInvoiceId,
                  method: "GET",
                  timeout: 0,
                  headers: {
                    Authorization:
                      "Basic ZmFjdHVyYWNpb25lbGVjdHJvbmljYUBqanF1aW1pZW52YXNlcy5jb206SkpRdTFtMTNudjRzM3MyMDIwKio=",
                    Cookie:
                      "SIFACTURA_SESSION=30fa8c83-7d3f-4577-8775-fab536e9f28c; CSRF-TOKEN=c11ba6e6-025d-4493-8b29-d81c75cd5b7b",
                  },
                };

                $.ajax(pdf).done(function (base64) {
                //   console.log(base64);
                  // The Base64 string of a simple PDF file
                  var b64 = base64;

                  // Decode Base64 to binary and show some information about the PDF file (note that I skipped all checks)
                  var bin = atob(b64);
                  console.log(
                    "File Size:",
                    Math.round(bin.length / 1024),
                    "KB"
                  );
                  console.log("PDF Version:", bin.match(/^.PDF-([0-9.]+)/)[1]);
                  var link = document.createElement("a");
                  link.innerHTML = "VER O DESCARGAR PDF";
                  link.download = "Factura"+customerInvoiceId+".pdf";
                  link.href = "data:application/octet-stream;base64," + b64;

                  Swal.fire({
                    icon: "success",
                    text: "Click en el banner para ver la factura!",
                    showCancelButton: true,
                    showConfirmButton: false,
                    footer: link,
                  });
                });
              } else {
                Swal.fire({
                  icon: "warning",
                  title: "Ups..",
                  text: "Esta factura no fue creada!",
                  footer:
                    "<a href='https://api.whatsapp.com/send?phone=573045393941' target='_blank'>Contactar al desarrollador</a>",
                });
              }
            });
            await this.getTarjetas();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },GenerarFacturaCall(item) {
      Swal.fire({
        icon: "question",
        title: "¿Desea Generar Factura?",
        text: "¿Seguro que desea generar factura?",
        confirmButtonText: "Si quiero",
        showCancelButton: true,
        cancelButtonText: "No, No quiero",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
      })
        .then(async (result) => {
          if (result.isConfirmed) {
            let data = await $.post("./ajax/ajax_consultar_data_call.php", item);
            data = JSON.parse(data);
            console.log(data);
            // let valores = data[0].map(function(a){return a.total}).reduce(function(a,b){ return a+b;})
             let subttl = data[0].map(function(a){return a.taxableAmount}).reduce(function(a,b){ return a+b;});

            let fecha_actual = data[3];
            let newinvoice = {};
            newinvoice.invoices = [];
            let items = data[0];
            let customer = { customer: data[2] };
            let iva = subttl * 0.19;
            let cuentas = subttl + iva;
            // let cuentas = parseFloat(data[1].order_total_before_tax);
            // let subttoal = cuentas / 1.19;
            let customerInvoiceId = data[8];
            let seller = data[1].order_receiver_address;
            let order = data[1].order_id;
            let saleCondition = "CONTADO";
            let representation = "";
            // let observation = "";
            let purchaseOrder = "";
            let area = "";
            let referral = "";
            let warehouse = "";
            let note = "";
            let otherTaxesTotal = 0;

            //variables de valores fijos
            let invoiceType = "FACTURA";
            let invoiceTypeExport = false;
            let operationCode = 10;
            let pointOfSale = "JJSA";
            let currency = "COP";
            let currencyRate = 0;
            //variable de los items
            let itemType = "GRAVADO";
            let quantity = parseInt(data[0].order_item_quantity);
            let amoun = data[0].order_item_unitario / 1.19;
            let amount1 = amoun.toFixed(2);
            let amount = parseFloat(amount1);
            let con_iva_unitario = data[0].order_item_unitario;
            let name = "";
            let subTotal = amount * quantity;
            let description = data[0].item_name;
            // let tota = con_iva_unitario * quantity ;
            // let total = parseFloat(tota.toFixed());
            let taxableAmoun = subTotal;
            let taxableAmount = parseFloat(taxableAmoun.toFixed(2));
            let totalTa = taxableAmount * 0.19;
            let totalTax1 = totalTa.toFixed();
            let totalTax = parseFloat(totalTax1);
            let total = parseFloat(taxableAmount + totalTax).toFixed(2);
            let clasificationId = "";
            let clasificationName = "";
            let discountPercentage = 0;
            let discountAmount = 0;
            let tax_type_p = "IVA"; // taxes de productos
            let tax_amount_p = totalTax;
            let tax_taxableAmount_p = taxableAmount;
            let percentage = 19;
            let itemCode = data[0].item_code;
            let observation = "Factura Electronica";
            let ifGift = false;
            //Variables de cliente
            let type = data[6];
            let demo_cedula = data[7];
            let idExport = 0;
            let idType = data[5];
            let names = data[2].nombres;
            let departament = data[4].municipio;
            let postalCode = data[4].postal;
            let address = data[2].direccion;
            let cityName = data[4].ciudad;
            let countryCode = "CO";
            let firstName = "";
            let lastName = "";
            let email = data[2].email;
            let telephone = parseInt(data[2].telefono);
            let regimen = "ZZ";
            // OK OK  aqui vamos a hacer el input para el post
            //    let input = document.createElement("INPUT");
            //    input.type = 'number';
            //    input.value=order;
            //    input.name="info_post";

            //primera parte
            newinvoice.invoices.push({
              invoiceType: invoiceType,
              invoiceTypeExport: invoiceTypeExport,
              operationCode: operationCode,
              pointOfSale: pointOfSale,
              currency: currency,
              currencyRate: currencyRate,
              taxes: [
                {
                  type: "IVA",
                  amount: iva.toFixed(2),
                  taxableAmount: subttl.toFixed(2),
                  percentage: 19,
                },
              ],
              retes: [],
              items,
              customer: {
                type: type,
                id: demo_cedula,
                idExport: idExport,
                idType: idType,
                name: names,
                department: departament,
                postalCode: postalCode,
                address: address,
                cityName: cityName,
                countryCode: countryCode,
                firstName: firstName,
                lastName: lastName,
                email: email,
                telephone: telephone,
                regimen: regimen,
              },

              otherTaxesTotal: otherTaxesTotal,
              total: cuentas,
              paid: "",
              vatAmount: iva,
              exemptAmount: 0,
              taxableAmount: subttl,
              issuedDate: fecha_actual,
              expirationDate: fecha_actual,
              saleCondition: saleCondition,
              customerInvoiceId: customerInvoiceId,
              seller: seller,
              representation: representation,
              observation: observation,
              purchaseOrder: purchaseOrder,
              area: area,
              order: order,
              referral: referral,
              warehouse: warehouse,
              note: note,
            });

            invoice = JSON.stringify(newinvoice);

            console.log(JSON.stringify(newinvoice));
            let user = "facturacionelectronica@jjquimienvases.com";
            let pass = "JJQu1m13nv4s3s2020**";

            usuario = btoa(user);
            contrasena = btoa(pass);

            var settings = {
              url:
                "https://app.sifactura.co/api/v1/invoice/process/new/batch/json/PROD",
              method: "POST",
              timeout: 0,
              headers: {
                Authorization:
                  "Basic ZmFjdHVyYWNpb25lbGVjdHJvbmljYUBqanF1aW1pZW52YXNlcy5jb206SkpRdTFtMTNudjRzM3MyMDIwKio=",
                "Content-Type": "application/json",
                Cookie:
                  "SIFACTURA_SESSION=30fa8c83-7d3f-4577-8775-fab536e9f28c; CSRF-TOKEN=c11ba6e6-025d-4493-8b29-d81c75cd5b7b",
              },
              data: invoice,
            };

            $.ajax(settings).done(async (response) => {
              const data_actualizar_status_call = await $.post("./ajax/ajax_actualizar_data_call.php", {codigo: order, id_factura:customerInvoiceId});
              console.log(response);
              if (response.errors == null) {
//actualizando la data 
             
                Swal.fire({
                  icon: "success",
                  title: "Proceso Exitoso",
                  text: "Esta factura fue generada exitosamente!",
                  footer: "<a href>Deseas ver el pdf?</a>",
                });

                //ajax para actualizar la data
                
                var pdf = {
                  url:
                    "https://app.sifactura.co/api/v1/invoice/getPdf/sales/PROD/JJSA/FACTURA/" +
                    customerInvoiceId,
                  method: "GET",
                  timeout: 0,
                  headers: {
                    Authorization:
                      "Basic ZmFjdHVyYWNpb25lbGVjdHJvbmljYUBqanF1aW1pZW52YXNlcy5jb206SkpRdTFtMTNudjRzM3MyMDIwKio=",
                    Cookie:
                      "SIFACTURA_SESSION=30fa8c83-7d3f-4577-8775-fab536e9f28c; CSRF-TOKEN=c11ba6e6-025d-4493-8b29-d81c75cd5b7b",
                  },
                };

                $.ajax(pdf).done(function (base64) {
                  console.log(base64);
                  // The Base64 string of a simple PDF file
                  var b64 = base64;

                  // Decode Base64 to binary and show some information about the PDF file (note that I skipped all checks)
                  var bin = atob(b64);
                  console.log(
                    "File Size:",
                    Math.round(bin.length / 1024),
                    "KB"
                  );
                  console.log("PDF Version:", bin.match(/^.PDF-([0-9.]+)/)[1]);
                  var link = document.createElement("a");
                  link.innerHTML = "VER O DESCARGAR PDF";
                  link.download = "Factura"+customerInvoiceId+".pdf";
                  link.href = "data:application/octet-stream;base64," + b64;

                  Swal.fire({
                    icon: "success",
                    text: "Click en el banner para ver la factura!",
                    showCancelButton: true,
                    showConfirmButton: false,
                    footer: link,
                  });
                });
              } else {
                Swal.fire({
                  icon: "warning",
                  title: "Ups..",
                  text: "Esta factura no fue creada!",
                  footer:
                    "<a href='https://api.whatsapp.com/send?phone=573045393941' target='_blank'>Contactar al desarrollador</a>",
                });
              }
            });

            await this.getTarjetas_call();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
});
