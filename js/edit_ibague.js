$(document).ready(function () {



  function elem(element, args) {

    let edens = new Object;

    if (undefined === args) { args = new Object; }

    if (undefined === element) { edens.elem = document.createElement('div'); }

    else if (undefined !== element.innerHTML) { edens.elem = element; }

    else if (['.', '#'].includes(element.charAt(0))) { edens.elem = document.querySelector(element); }

    else {

      let acrear = 'div'

      if (['btngroup', 'uk-card', 'dropdown_presentacion', 'select_', 'table_', 'btngroup', 'navbar', 'MainRight', 'Epanel', 'columns', 'column', 'form-stacked', 'alert'].includes(element)) { acrear = 'div'; }

      else if (element == 'label') { acrear = 'label'; }

      else if (['ul', 'subnav', 'list', 'accordion'].includes(element)) { acrear = 'ul'; }

      else if (['faicon'].includes(element)) { acrear = 'i'; }

      else if (['checkbox'].includes(element)) { acrear = 'input'; }

      else { acrear = element; }

      edens.elem = document.createElement(acrear);

    }



    Object.entries(args).forEach(function (v, k) {

      if (['type', 'name', 'title', 'href', 'id', 'src', 'value', 'className', 'placeholder'].includes(v[0])) {

        edens.elem[v[0]] = v[1];

        return;

      }

      if (v[0] == 'style') {

        Object.entries(v[1]).forEach((style) => {

          edens.elem.style[style[0]] = style[1];

        });



      }

      if (['html', 'innerHTML', 'content'].includes(v[0])) {

        switch (typeof v[1]) {

          case 'string': edens.elem.innerHTML = v[1]; break;

          case 'number': edens.elem.innerHTML = v[1]; break;

          case 'object':

            if (undefined !== v[1].innerHTML) {

              edens.elem.appendChild(v[1]);

            }

            break;

        }

        return;

      }

      if (v[0] == 'attr') { Object.entries(v[1]).forEach(function (attr) { edens.elem.setAttribute(attr[0], attr[1]); }); return; }

      if (v[0] == 'appendTo') { v[1].appendChild(edens.elem); return; }

      if (v[0] == 'prependTo') { v[1].prepend(edens.elem); return; }

      if (v[0] == 'afterTo') {

        v[1].parentElement.insertBefore(edens.elem, v[1].nextElementSibling)

        return;
      }

      if (v[0] == 'on') {

        Object.entries(v[1]).forEach(function (evento) {

          edens.elem[evento[0]] = function (evt) {

            evento[1](evt)

            evt.preventDefault()

          }

        });

        return;

      }

      if (['onclick', 'onkeyup'].includes(v[0])) {

        edens.elem[v[0]] = function (evt) {

          v[1](evt)

          evt.preventDefault()

        }

        return;

      }

      if (v[0] == 'elements') {

        Object.values(v[1]).forEach(function (v2) {

          let el = elem(v2.element, v2.args);

          edens.elem.appendChild(el);

        });

        return;

      }

    });

    switch (element) {

      case 'btngroup':

        edens.elem.classList.add('field');

        edens.elem.classList.add('has-addons');

        if (undefined !== args.buttons) {

          args.buttons.forEach((button) => {

            let control = elem('p', { appendTo: edens.elem, className: 'control' });

            let btn = elem('button', button)

            control.appendChild(btn);

          });



        }

        break;

      case 'uk-card':

        edens.elem.classList.add("uk-card");

        edens.elem.classList.add("uk-card-default");

        edens.elem.classList.add("uk-width-1-1");

        if (undefined !== args.header) {

          let header_ = elem('div', args.header);

          header_.classList.add("uk-card-header");

          header_.classList.add("uk-padding-small");

          edens.elem.appendChild(header_);

          if (undefined !== args.header.title) {

            let title_ = elem('h3', args.header.title);

            title_.classList.add('uk-card-title')

            title_.classList.add('is-size-5')

            header_.appendChild(title_);

          }

        }

        if (undefined !== args.body) {

          let body_ = elem('div', args.body);

          body_.classList.add("uk-card-body");

          edens.elem.appendChild(body_);

        }

        if (undefined !== args.footer) {

          let footer_ = elem('div', args.footer);

          body_.classList.add("uk-card-footer");

          edens.elem.appendChild(footer_);

        }

        break;

      case 'accordion':

        if (undefined == args.attr) {

          edens.elem.setAttribute("uk-accordion", "");

        }

        if (undefined !== args.items) {

          args.items.forEach((item, i) => {

            let args_li = {};

            if (undefined !== item.li) { args_li = item.li }

            let li = elem('li', args_li);

            edens.elem.appendChild(li);

            if (undefined !== item.title) {

              let title = elem('a', item.title)

              title.classList.add("uk-accordion-title");

              title.href = "#";

              li.appendChild(title);

            }

            if (undefined !== item.body) {

              let body = elem('div', item.body)

              body.classList.add("uk-accordion-content");

              li.appendChild(body);

            }

          });



        }

        break;

      case 'dropdown_presentacion':

        edens.elem.classList.add('uk-inline');

        edens.elem.classList.add('uk-margin-remove');

        if (undefined !== args.icon) {

          elem('a', {

            appendTo: edens.elem,

            className: 'is-small is-info uk-invisible-hover uk-align-right uk-margin-remove',

            attr: { "uk-icon": "icon: " + args.icon },

          })

        }

        if (undefined !== args.dropdown) {

          let drop = elem('div', args.dropdown);

          drop.classList.add("uk-padding-small");

          edens.elem.appendChild(drop);

        }

        break;

      case 'td':

        edens.elem.classList.add("uk-visible-toggle")

        break;

      case 'select':

        if (undefined !== args.options) {

          args.options.forEach((item, i) => {

            let opt = elem('option', item);

            edens.elem.appendChild(opt);

          });



        }

        break;

      case 'select_':

        edens.elem.classList.add("field");

        let control = elem('div', { appendTo: edens.elem, className: 'control has-icons-left', })

        let div_select_args = { appendTo: control }

        if (undefined !== args.div_select) {

          if (undefined == args.div_select.appendTo) { args.div_select.appendTo = control; }

        }

        let div_select = elem('div', div_select_args)

        if (undefined !== args.select) {

          let sel = elem('select', args.select);

          div_select.appendChild(sel)

        }

        div_select.classList.add("select")

        div_select.classList.add("is-fullwidth")

        break;

      case 'btngroup':

        edens.elem.classList.add("field");

        edens.elem.classList.add("has-addons");

        if (undefined !== args.buttons) {

          args.buttons.forEach((button) => {

            let control_ = elem('p', {

              appendTo: edens.elem,

              className: 'control'

            })

            let button_ = elem('button', button)

            control_.appendChild(button_);

          });



        }

        break;

      case 'tr':

        if (undefined !== args.th) {

          args.th.forEach((td) => {

            let td_ = elem('th', td)

            edens.elem.appendChild(td_)

          });

        }

        if (undefined !== args.td) {

          args.td.forEach((td) => {

            let td_ = elem('td', td)

            edens.elem.appendChild(td_)

          });

        }

        break;

      case 'table_':

        edens.elem.classList.add("uk-overflow-auto");

        if (undefined !== args.table) {

          let tbl = elem('table', args.table);

          edens.elem.appendChild(tbl)

        }

        break;

      case 'table':

        edens.elem.classList.add("uk-table")

        edens.elem.classList.add("uk-table-small")

        edens.elem.classList.add("uk-table-divider")

        edens.elem.classList.add("uk-table-middle")

        // edens.elem.classList.add("uk-visible-toggle")

        if (undefined !== args.thead) {

          thead = elem('thead', {

            appendTo: edens.elem,

            elements: [

              {

                element: 'tr',

                args: {

                  td: args.thead

                }

              }

            ]

          })

          edens.elem.appendChild(thead)

        }

        let tbody_ = elem('tbody', { appendTo: edens.elem })

        if (undefined !== args.tbody) {

          args.tbody.forEach((tr) => {

            let tr_ = elem('tr', tr);

            tbody_.appendChild(tr_);

          });





        }

        break;

      case 'button':

        edens.elem.classList.add("button");

        if (undefined !== args.icon) {

          elem('span', {

            appendTo: edens.elem,

            className: 'icon is-small',

            elements: [

              {

                element: 'faicon',

                args: args.icon

              }

            ]

          })

        }

        break;

      case 'alert':

        edens.elem.setAttribute("uk-alert", "");

        msg = "";

        if (undefined !== args.type) {

          mclass = "";

          switch (args.type) {

            case 'error': mclass = "uk-alert-danger"; msg = "ERROR"; break;

            case 'warn': mclass = "uk-alert-warning"; msg = "WARNING"; break;

            case 'success': mclass = "uk-alert-success"; msg = "SUCCESS"; break;

            case 'ok': mclass = "uk-alert-success"; msg = "SUCCESS"; break;

            default:

              mclass = "uk-alert-primary"; msg = "INFORMATION";

          }

        }

        edens.elem.classList.add(mclass)

        if (undefined !== args.content) { msg = args.content; }

        elem('a', {

          appendTo: edens.elem,

          className: 'uk-alert-close',

          attr: { "uk-close": "" }

        })

        break;

      case 'form-stacked':

        edens.elem.classList.add('uk-margin');

        let idfor = makeid();

        if (undefined !== args.label) {

          elem('label', {

            appendTo: edens.elem,

            className: 'uk-form-label is-size-6',

            attr: {

              for: idfor

            },

            innerHTML: args.label

          })

        }

        let fcontrol = elem('div', {

          appendTo: edens.elem,

          className: 'uk-form-controls'

        });

        if (undefined !== args.select_) {

          let select_ = elem('select_', args.select_)

          select_.id = idfor;

          edens.elem.appendChild(select_);

        }

        if (undefined !== args.input) {

          let input = elem('input', args.input)

          input.id = idfor;

          edens.elem.appendChild(input);

        }

        if (undefined !== args.textarea) {

          let textarea = elem('textarea', args.textarea)

          textarea.id = idfor;

          edens.elem.appendChild(textarea);

        }

        if (undefined !== args.control) { args.control(fcontrol) }

        break;

      case 'input':

        if (undefined !== args.type) {

          if (args.type == 'number') {

            edens.elem.setAttribute("step", "any");

          }

          if (['date', 'number'].includes(args.type)) {

            edens.elem.classList.add("uk-input")

            edens.elem.classList.add("uk-form-small")

            if (undefined !== args.valueAsNumber) {

              edens.elem.valueAsNumber = args.valueAsNumber;

            }

          }

          switch (args.type) {

            case 'radio':

              break;

            case 'checkbox':

              edens.elem.classList.add("itemRow")

              break;

            default:

              edens.elem.classList.add("uk-input")

              edens.elem.classList.add("uk-form-small")

          }

        } else {

          edens.elem.className = "uk-input uk-form-small"

        }

        break;

      case 'checkbox':

        edens.elem.classList.add("itemRow")

        edens.elem.type = "checkbox"



        break;

      case 'textarea':

        edens.elem.classList.add("uk-textarea")





        break;

      case 'list':

        edens.elem.classList.add('uk-list');

        edens.elem.classList.add('uk-list-divider');

        if (undefined !== args.items) {

          args.items.forEach((item) => {

            li = elem('li', item)

            edens.elem.appendChild(li)

          });



        }

        break;

      case 'column':

        edens.elem.classList.add('column');

        break;

      case 'columns':

        edens.elem.classList.add('columns');

        break;

      case 'subnav':

        edens.elem.className = "uk-subnav uk-subnav-pill subnav uk-margin-remove has-background-white-ter"

        if (undefined !== args.items) {

          args.items.forEach(function (item) {

            if (undefined !== item.link) {
              item.content = elem('a', item.link)

              delete item.link;

            }

            let li = elem('li', item);

            li.classList.add("uk-padding-remove")

            edens.elem.appendChild(li);

          });

        }



        break;

    }

    if (undefined !== args.DOM || undefined !== args.dom) {

      args.dom(edens.elem);

    }

    return edens.elem;

  }





  $(document).on('click', '#checkAll', function () {

    $(".itemRow").prop("checked", this.checked);

  });

  $(document).on('click', '.itemRow', function () {

    if ($('.itemRow:checked').length == $('.itemRow').length) {

      $('#checkAll').prop('checked', true);

    } else {

      $('#checkAll').prop('checked', false);

    }

  });



  function new_calculatelocal() {

    $("[id^=quantity_]").on('keyup', function () {

      let this_ = $(this);

      let idd = this_.attr('id').split("_")[1];
      calculateTotal(idd);
      var sumatotal = [];
      $("[id^=result]").each(function () {
        sumatotal.push(parseFloat($(this).val()))
      })
      var totall = sumatotal.reduce(function (a, b) { return a + b }).toFixed(2);



      console.log(totall);











      console.log(idd);

    });



  }

  new_calculatelocal();



  var count = $(".itemRow").length;

  $(document).on('click', '#addRows', function () {

    console.log('inicion agregar')

    count++;





    let tr = elem('tr', {

      appendTo: document.querySelector("#invoiceItem tbody"),

      td: [

        {

          innerHTML: elem('input', {

            type: "checkbox",

            class: "itemRow"

          })

        },
        {
          innerHTML: (select = elem("select", {
            style: { width: "300px" },
            attr: {
              name: "search[]",
            },
            id: "search1_" + count,
            options: [{ innerHTML: "selecione sus productos" }],
            on: {
              onchange: function (evt) {
                var tabla = $("#tabla").val();
                $.ajax({
                  url: "methods/conexion_callcenter.php",
                  type: "POST",
                  dataType: "json",
                  data: {
                    key: "Q1",
                    tabla: tabla,
                    producto: evt.target.selectedOptions[0].value,
                  },
                })
                  .done(function (d) {
                    // console.log(d);

                    console.log($(evt.target).parent().parent());
                    let padre = $("#mibuscador").parent().parent().parent();
                    $(evt.target)
                      .parent()
                      .parent()
                      .find("[name^=idCategoria]").attr("readonly", "readonly")
                      .val(d.resultado.id_categoria);
                    $(evt.target)
                      .parent()
                      .parent()
                      .find("[name^=productCode]").attr("readonly", "readonly")
                      .val(d.resultado.id);
                    $(evt.target)
                      .parent()
                      .parent()
                      .find("[name^=Envase]")
                      .val(0);
                    $(evt.target)
                      .parent()
                      .parent()
                      .find("[name^=gramos]")
                      .val(0);
                    $(evt.target)
                      .parent()
                      .parent()
                      .find("[name^=Tapa]")
                      .val(0);
                    $(evt.target)
                      .parent()
                      .parent()
                      .find("[name^=productName]").attr("readonly", "readonly")
                      .val(d.resultado.contratipo);
                    $(evt.target)
                      .parent()
                      .parent()
                      .find("[name^=productStock]").attr("readonly", "readonly").val(d.resultado.stock);

                    $(evt.target)
                      .parent()
                      .parent()
                      .find("[name^=productUnidad]").attr("readonly", "readonly")
                      .val(d.resultado.unidad);
                    $(evt.target)
                      .parent()
                      .parent()
                      .find("[name^=price]")
                      .val(d.resultado.gramo);
                  })
                  .fail(function (e) {
                    console.log("ERROR:", e);
                  });
                evt.preventDefault;
              },
            },

            dom: function (select) {
              setTimeout(function () {
                var tabla = $("#tabla").val();
                $(select).select2({
                  ajax: {
                    url: "methods/conexion_callcenter.php",

                    dataType: "json",

                    type: "post",

                    data: function (param) {
                      return {
                        key: "buscarproducto",
                        tabla: tabla,
                        val: param.term,
                      };
                    },

                    processResults: function (data, params) {
                      return {
                        results: data.results,
                      };
                    },
                  },
                });
              }, 500);
            },
          })),
        },

        {

          innerHTML: elem('input', {

            attr: { placeholder: "ia", size: 2, name: 'idCategoria[]' },

            style: { width: '100%' },

            id: 'idCategoria_' + count,

          })

        },

        {

          innerHTML: elem('input', {

            attr: { placeholder: "ID producto", size: 2, name: 'productCode[]' },

            style: { width: '100%' },

            id: 'productCode_' + count,

          })

        },

        {

          innerHTML: elem('input', {

            attr: { placeholder: "Contratipo", size: 2, name: 'productName[]' },

            style: { width: '100%' },

            id: 'productName_' + count,

          })

        }, {

          innerHTML: elem('input', {

            attr: { placeholder: "Stock", size: 2, name: 'productStock[]' },

            style: { width: '100%' },

            id: 'productStock_' + count,

          })

        }, {

          innerHTML: elem('input', {

            attr: { placeholder: "U. Empaque", size: 2, name: 'productUnidad[]' },

            style: { width: '100%' },

            id: 'productUnidad_' + count,

          })

        },

        {

          innerHTML: elem('input', {

            attr: { placeholder: "Cantidad", size: 2, name: 'quantity[]', accesskey: 'c' },

            style: { width: '100%' },

            id: 'quantity_' + count,

            on: {

              onkeyup: function (evt) {

                // calculateTotal(count);



              }

            },



          })

        },

        {

          innerHTML: elem('input', {

            attr: { placeholder: "Valor unitario", size: 2, name: 'unitario[]' },

            style: { width: '100%' },

            id: 'unitario_' + count,

          })

        },

        {

          innerHTML: elem('input', {

            attr: { placeholder: "Total", size: 2, name: 'result[]' },

            style: { width: '100%' },

            id: 'result_' + count,

            on: {

              onchange: function (evt) {

                console.log(evt);

              }

            }

          })

        }, {

          innerHTML: elem('input', {

            attr: { placeholder: "precio", size: 2, name: 'price[]', type: 'hidden' },

            style: { width: '1%' },

            id: 'price_' + count,

          })

        }



      ]

    });



    new_calculatelocal();





  });



  $(document).on('click', '#removeRows', function () {

    $(".itemRow:checked").each(function () {

      $(this).closest('tr').remove();



      // var id1 = 1;

      // if(undefined==id1) {return;}

      // calculateTotal(id1);

    });



    calculateTotal();

    $('#checkAll').prop('checked', false);

    calculateTotal();

  });

  $(document).on('blur', "[id^=quantity_]", function () {

    calculateTotal();

  });

  $(document).on('blur', "[id^=price_]", function () {

    calculateTotal();

  });

  $(document).on('blur', "#taxRate", function () {

    calculateTotal();

  });

  $(document).on('blur', "#amountPaid", function () {

    var amountPaid = $(this).val();

    var totalAftertax = $('#totalAftertax').val();

    if (amountPaid && totalAftertax) {

      totalAftertax = totalAftertax - amountPaid;

      $('#amountDue').val(totalAftertax);

    } else {

      $('#amountDue').val(totalAftertax);

    }

  });

  $(document).on('click', '.deleteInvoice', function () {

    var id = $(this).attr("id");

    if (confirm("Are you sure you want to remove this?")) {

      $.ajax({

        url: "action.php",

        method: "POST",

        dataType: "json",

        data: { id: id, action: 'delete_invoice' },

        success: function (response) {

          if (response.status == 1) {

            $('#' + id).closest("tr").remove();

          }

        }

      });

    } else {

      return false;

    }

  });

});



function roundToTwo(num) {

  return +(Math.round(num + "e+2") + "e-2");

}



function calculateTotal(id1) {
 var tipo_cliente = document.getElementById("especificos").value;
 var cc = document.getElementById("cedula").value;
console.log(tipo_cliente);    
   var sub_total = 0;
  var iva = 0;
  var total = 0;
  var valor = 0;
  var totalAmount = 0;
  var porcentaje = 0;
  var coniva = 0;
  var totales = 0;

  if(undefined==id1) {return;}
    console.log("estoy calculando en ibague",id1);

    $("[id^='result_"+id1+"']").each(function() {
      var id = $(this).attr('id');
      var categoria = $('#idCategoria_'+id1).val();
    //   var price = $('#price_'+id1).val();
      var price = $('#price_'+id1).val();
      var codigo = $("#productCode_" + id1).val();
      if(cc == 809012325 && codigo == 596726){var price = 3400;}
      
      if(categoria == 4 && price < 125000){
        price = 123500;
        var price = price;
      }
      var quantity = $('#quantity_'+id1).val();

      if(!quantity){
        quantity = 1;
      }else if(categoria == 8 && quantity < 12 ){
            total = 150;
  }else if(categoria == 8 && quantity >= 12 ){
            total = 125;
  }else if(categoria == 21 && quantity == 28){
      var galon = 2000;
      var total = galon;
    }else if(categoria == 21 && quantity ==125){
      var galon = 7000;
      var total = galon;
    }else if(categoria == 21 && quantity ==250){
      var galon = 12000;
      var total = galon;
    }else if(categoria == 21 && quantity == 500){
      var galon = 22000;
      var total = galon;
    }else if(categoria == 21 && quantity == 1000){
      var galon = 40000;
      var total = galon;
    }else if(categoria == 13 && quantity == 28){
        valor = 5000;
       total = valor;
    }else if(categoria == 13 && quantity == 250){
     valor = price /1000;
     iva = valor * 0.19;
     coniva = valor + iva;
     porcentaje = coniva * 0.50;
     sub_total = porcentaje + coniva;
     total = sub_total;
      
    }else if (codigo == 9051 && quantity > 0) {
    //   valor = price;
    //  iva = valor * 0.19;
    //  coniva = valor + iva;
    //  porcentaje = coniva * 0.05;
    //  sub_total = porcentaje + coniva;
     total = 450; 
        }else if (codigo == 491253 && quantity > 0) {
    //  valor = price ;
    //  iva = valor * 0.19;
    //  coniva = valor + iva;
    //  sub_total =coniva;
     total = 351; 
    }else if (codigo == 911 || codigo == 371412 || codigo == 371411 && quantity > 0) {
    //  valor = price;
    //  iva = valor * 0.19;
    //  coniva = valor + iva;
    //  porcentaje = coniva * 0.05;
    //  sub_total = porcentaje + coniva;
     total = 280; 
      }else if(categoria == 13 && quantity == 500){
     valor = price /1000;
     iva = valor * 0.19;
     coniva = valor + iva;
     porcentaje = coniva * 0.50;
     sub_total = porcentaje + coniva;
     total = sub_total;    
        
    }else if(categoria == 13 && quantity == 1000){
     valor = price /1000;
     iva = valor * 0.19;
     coniva = valor + iva;
     porcentaje = coniva * 0.30;
     sub_total = porcentaje + coniva;
     total = sub_total;    
    
    }else if(categoria == 72){
// potes actualizado
 
    valor = parseInt(price);
  var  posibleiva = valor * 0.19;
  iva = parseInt(posibleiva);
  iva = parseInt(iva);
  coniva = (valor + iva);   
  porcentaje = coniva * 0.15;
  sub_total = (porcentaje + coniva);
  total = sub_total + 50;
    }else if(categoria == 90 && quantity > 0){
// productos puntoquimico 
    valor = parseInt(price);
  var  posibleiva = valor * 0.19;
  iva = parseInt(posibleiva);
  iva = parseInt(iva);
  coniva = (valor + iva);   
  porcentaje = coniva * 0.30;
  sub_total = (porcentaje + coniva);
  total = sub_total;
    }else if(categoria == 71 && quantity > 11){
  valor = parseInt(price);
  var  posibleiva = valor * 0.19;
  iva = parseInt(posibleiva);
  iva = parseInt(iva);
  coniva = (valor + iva);   
  porcentaje = coniva * 0.20;
  sub_total = (porcentaje + coniva);
  total = sub_total + 50;
}else if(categoria == 100){
    valor = parseInt(price);
    var total = valor;
}else if(quantity > 0 && quantity < 12 && categoria == 9 ){ //envases de perfumeria ibague 
  valor = parseInt(price);
  var  posibleiva = valor * 0.19;
  iva = parseInt(posibleiva);
  iva = parseInt(iva);
  coniva = (valor + iva);   
  porcentaje = coniva * 0.28;
  sub_total = (porcentaje + coniva);
  total = sub_total;
    }else if(categoria == 60 && quantity >=11 && quantity < 12){
        valor = parseInt(price);
  var  posibleiva = valor * 0.19;
  iva = parseInt(posibleiva);
  iva = parseInt(iva);
  coniva = (valor + iva);   
  porcentaje = coniva * 0.50;
  sub_total = (porcentaje + coniva);
  total = sub_total;
    }else if(categoria == 60 && quantity >=12 && quantity < 100){
        valor = parseInt(price);
  var  posibleiva = valor * 0.19;
  iva = parseInt(posibleiva);
  iva = parseInt(iva);
  coniva = (valor + iva);   
  porcentaje = coniva * 0.25;
  sub_total = (porcentaje + coniva);
  total = sub_total;
    }else if(categoria == 60 && quantity >= 100 && quantity < 1000 ){
         valor = parseInt(price);
  var  posibleiva = valor * 0.19;
  iva = parseInt(posibleiva);
  iva = parseInt(iva);
  coniva = (valor + iva);   
  porcentaje = coniva * 0.18;
  sub_total = (porcentaje + coniva);
  total = sub_total;
    }else if(categoria == 60 && quantity >= 1000){
          valor = parseInt(price);
  var  posibleiva = valor * 0.19;
  iva = parseInt(posibleiva);
  iva = parseInt(iva);
  coniva = (valor + iva);   
  porcentaje = coniva * 0.12;
  sub_total = (porcentaje + coniva);
  total = sub_total;
    }
 else if(quantity >= 12 && quantity <= 100 && categoria == 9 ){
  valor = parseInt(price);
  var  posibleiva = valor * 0.19;
  iva = parseInt(posibleiva);
  iva = parseInt(iva);
  coniva = (valor + iva);   
  porcentaje = coniva * 0.20;
  sub_total = (porcentaje + coniva);
  total = sub_total;
 }else if(quantity >= 101 && quantity < 1000 && categoria == 9 ){
  valor = parseInt(price);
  var  posibleiva = valor * 0.19;
  iva = parseInt(posibleiva);
  iva = parseInt(iva);
  coniva = (valor + iva);   
  porcentaje = coniva * 0.18;
  sub_total = (porcentaje + coniva);
  total = sub_total;
 }else if($(".p_especial").prop("checked") && quantity > 0){
       valor = parseInt(price);
  var  posibleiva = valor * 0.19;
  iva = parseInt(posibleiva);
  iva = parseInt(iva);
  coniva = (valor + iva);   
  porcentaje = coniva * 0.05;
  sub_total = (porcentaje + coniva);
  total = sub_total;
 
 }else if($(".pp_item_p").prop("checked") && quantity > 0){
//       valor = parseInt(price);
//   var  posibleiva = valor * 0.19;
//   iva = parseInt(posibleiva);
//   iva = parseInt(iva);
//   coniva = (valor + iva);   
//   porcentaje = coniva * 0.05;
//   sub_total = (porcentaje + coniva);
  total = 0;
 }
 else if(quantity > 1000 && categoria == 9 ){
  valor = parseInt(price);
  var  posibleiva = valor * 0.19;
  iva = parseInt(posibleiva);
  iva = parseInt(iva);
  coniva = (valor + iva);   
  porcentaje = coniva * 0.18;
  sub_total = (porcentaje + coniva);
  total = sub_total;
 }else if(categoria == 4 && quantity <499){  // AQUI COMENZAMOS CON LA PERFUMERIA
  valor = price /1000;
  iva = valor * 0.19;
 coniva = valor + iva;
 porcentaje = coniva * 0.50;
 sub_total = porcentaje + coniva;
 total = sub_total;
 console.log("total gramos"+ total);
}else if(categoria == 4 && quantity > 499 && quantity <999){
  valor = price /1000;
    iva = valor * 0.19;
 coniva = valor + iva;
 porcentaje = coniva * 0.30;
 sub_total = porcentaje + coniva;
 total = sub_total;
  console.log("total gramos"+ total);
}else if(categoria == 4 && quantity > 999 && quantity <24999){
  valor = price /1000;
    iva = valor * 0.19;
 coniva = valor + iva;
 porcentaje = coniva * 0.20;
 sub_total = porcentaje + coniva;
 total = sub_total;
  console.log("total gramos"+ total);
}else if(categoria == 4 && quantity > 24999){
  valor = price /1000;
    iva = valor * 0.19;
 coniva = valor + iva;
 porcentaje = coniva * 0.13;
 sub_total = porcentaje + coniva;
 total = sub_total;
  console.log("total gramos"+ total);
}else if(categoria == 40 && quantity >=1 && quantity <250){
      var feromonas = 13000;
      var total = feromonas;
    }else if(categoria == 40 && quantity >=250 && quantity <500){
      var feromonas = 35000;
      var total = feromonas;
    }else if(categoria == 40 && quantity >=500){
      var feromonas = 70000;
      var total = feromonas;
    }// AQUI VAMOS A GENERAR LA FUNCION PARA LOS PRODUCTOS QUE NO SON DE PERFUMERIA
else if(categoria != 4 && categoria != 75 && quantity <=11){
  valor = parseInt(price);
  var  posibleiva = valor * 0.19;
  iva = parseInt(posibleiva);
  iva = parseInt(iva);
  coniva = (valor + iva);   
  porcentaje = coniva * 0.50;
  sub_total = (porcentaje + coniva);
  total = sub_total + 50;
}else if(categoria != 4 && categoria != 75 && quantity >= 12 && quantity <=99){
  valor = parseInt(price);
  posibleiva = valor * 0.19;
  iva = parseInt(posibleiva);
  iva = parseInt(iva);
  coniva = (valor + iva);
  porcentaje = coniva * 0.30;
  sub_total = (porcentaje + coniva);
  total = sub_total + 50;
}else if(categoria != 4 && categoria != 75 && quantity >= 100  && quantity < 999){
  valor = parseInt(price);
  posibleiva = valor * 0.19;
  iva = parseInt(posibleiva);
  iva = parseInt(iva);
  coniva = (valor + iva);
  porcentaje = coniva * 0.20;
  sub_total = (porcentaje + coniva);
  total = sub_total + 50;
}else if(categoria != 4 && categoria != 75 && quantity > 999){
  valor = parseInt(price);
  posibleiva = valor * 0.19;
  iva = parseInt(posibleiva);
  iva = parseInt(iva);
  coniva = (valor + iva);
  porcentaje = coniva * 0.15;
  sub_total = (porcentaje + coniva);
  total = sub_total + 50;
}//AQUI VAMOS A IMPRMIR LAS TAPAS
else if(categoria == 75 && quantity <=11){
  valor = parseInt(price);
  var  posibleiva = valor * 0.19;
  iva = parseInt(posibleiva);
  iva = parseInt(iva);
  coniva = (valor + iva);
  porcentaje = coniva * 0.50;
  sub_total = (porcentaje + coniva);
  total = sub_total + 20;
}else if(categoria == 75 && quantity >= 12 && quantity <=99){
  valor = parseInt(price);
  posibleiva = valor * 0.19;
  iva = parseInt(posibleiva);
  iva = parseInt(iva);
  coniva = (valor + iva);
  porcentaje = coniva * 0.30;
  sub_total = (porcentaje + coniva);
  total = sub_total + 20;
}else if(categoria == 75 && quantity >= 100  && quantity < 999){
  valor = parseInt(price);
  posibleiva = valor * 0.19;
  iva = parseInt(posibleiva);
  iva = parseInt(iva);
  coniva = (valor + iva);
  porcentaje = coniva * 0.20;
  sub_total = (porcentaje + coniva);
  total = sub_total + 20;
}else if(categoria == 75 && quantity > 999){
  valor = parseInt(price);
  posibleiva = valor * 0.19;
  iva = parseInt(posibleiva);
  iva = parseInt(iva);
  coniva = (valor + iva);
  porcentaje = coniva * 0.15;
  sub_total = (porcentaje + coniva);
  total = sub_total + 20;
}

 var totall = 0;
 var mytotalperfumeria = 0;


      if (undefined==total) {total = 0;}

       if(categoria == 21){
         totales = total;
       }else if(categoria != 4){
          totales = total * quantity; 
       }else if(categoria == 4){
     totales = total * quantity;
       }
      var vunit = total;
      if(categoria != 4){
        console.log(total);
      }else{
        console.log("no funciona");
      }
      console.log(totales);

      if(categoria == 4){
        document.getElementById(id).value = roundToTwo(totales).toFixed(2);
      }else{
        document.getElementById(id).value = roundToTwo(totales).toFixed(2);
      };

      var sumatotal = [];
      $("[id^=result]").each(function(){
        sumatotal.push(parseFloat($(this).val()))
      })

      var totall = sumatotal.reduce(function(a,b){return a+b})
      
      
    var sumaperfumeria = [];
     $("[id^=monto]").each(function(){
    sumaperfumeria.push(parseFloat($(this).val()))
  })
  
   if(sumaperfumeria !=0){mytotalperfumeria = sumaperfumeria.reduce(function(a,b){return a+b})}else{
     mytotalperfumeria = 0;
   }

          var sumasubT = totall;
          var sumaAT = totall;
          console.log("cuando esta en 0"+totall);
          console.log("precio DB"+price);
  
            var sumasubT = totall + mytotalperfumeria;
            var sumaAT = totall + mytotalperfumeria;
           console.log("cuando no esta en 0"+ mytotalperfumeria + parseInt(totall));
      
      
      
      

    //   var sumasubT = totall;
      var sumaTT = 0;
    //   var sumaAT = totall;
      var amountP = 0;

     if(categoria == 4){
      document.getElementById("unitario_"+id1).value= (vunit).toFixed(2);
    }else if (categoria != 4){
        document.getElementById("unitario_"+id1).value= vunit;
    }

      document.getElementById("subTotal").value= (sumasubT).toFixed(2);
      document.getElementById("totalAftertax").value=(sumaAT).toFixed(2);
      document.getElementById("amountPaid").value= (amountP).toFixed(2);

      onkeydescuento(); 
 
      var deuda = sumaAT - amountP;


    });
}





function getdescuento(arg) {

  if (undefined == arg) { return 0; }

  if (undefined == arg.porcentaje || undefined == arg.subtotal) { return 0; }

  let total = 0;

  let porcentajeparsed = parseFloat(arg.porcentaje) / 100;

  let descuento = parseFloat(arg.subtotal) * porcentajeparsed;

  return descuento;

}



function onkeydescuento() {

  $("#taxRate").on('keyup', function (evt) {

    let subtotal = parseFloat($("#subTotal").val());

    let descuento = getdescuento({ porcentaje: parseFloat($(this).val()), subtotal: subtotal })

    $("#taxAmount").val(descuento);

    $("#amountDue").val(subtotal - descuento);

    evt.preventDefault();

  });

}



function formatear($num) {

  setlocale(LC_MONETARY, 'en_US');

  return "$".number_format($num, 2);

}

function showInfo() {
  document.getElementById('buttons').style.display = 'none';
  document.getElementById('buttonh').style.display = 'block';
  document.getElementById('ocult').style.display = 'block';
}

function hiddenInfo() {
  document.getElementById('ocult').style.display = 'none';
  document.getElementById('buttons').style.display = 'block';
  document.getElementById('buttonh').style.display = 'none';
}