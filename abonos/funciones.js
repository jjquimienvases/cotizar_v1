var options2 = {
  style: "currency",
  currency: "USD",
};
var numberFormat2 = new Intl.NumberFormat("en-US", options2);


$(document).ready(function () {
 let table = $("#myTable").DataTable({
    orderCellsTop: true,
    fixedHeader: true,
    drawCallback: function () {
      var api = this.api();
      var datas = api.column(5, { page: "current" }).data().sum();
      var total = numberFormat2.format(datas);
      var datas_abono = api.column(4, { page: "current" }).data().sum();
      var total_abono = numberFormat2.format(datas_abono);
      // let diferencia = numberFormat2.format(total - total_abono); 
      $("#total_deuda").val(total);
      $("#total_abono").val(total_abono);
      // $("#diferencia").val(diferencia);

    },
  });
  $("#myTable thead tr").clone(true).appendTo("#myTable thead");
  $("#myTable thead tr:eq(1) th").each(function (i) {
    var title = $(this).text(); //es el nombre de la columna
    $(this).html('<input type="text" placeholder="Buscar...' + title + '" />');

    $("input", this).on("keyup change", function () {
      if (table.column(i).search() !== this.value) {
        table.column(i).search(this.value).draw();
      }
    });
  });
});

function ver_datos(id, e) {
  var dato = document.getElementById("cliente" + id);
  e.preventDefault();
}

$("#buscarcliente").on("keyup", function () {
  $.ajax({
    url: "scripts/consulta.php",
    type: "POST",
    dataType: "json",
    data: {
      key: "Q1",
      cliente: $(this).val(),
    },
  })
    .done(function (d) {
      let padre = $("#buscarcliente").parent().parent().parent();
      padre.find("[name^=cliente]").val(d.resultado.order_receiver_name);
      padre.find("[name^=comercial]").val(d.resultado.order_receiver_address);
      padre.find("[name^=fecha]").val(d.resultado.order_date);
      padre.find("[name^=monto]").val( d.resultado.order_total_after_tax);
      padre.find("[name^=order]").val(d.resultado.order_id);
    })
    .fail(function (e) {});
});


$("#nuevo_a").on("keyup", function sumar() {
  var inicial = $("#restantes").val();
  var pago = $("#nuevo_a").val();
  resta = Math.abs(pago - inicial);

  console.log(resta);
  console.log(inicial);
  console.log(pago);
  let inputNombre = document.getElementById("restante_n");
  if (pago < inicial) {
    inputNombre.value = resta;
    // document.getElementById('restante_n').value(numberFormat2.format(resta));
  } else {
    inputNombre.value = resta;
    // document.getElementById('restante_n').value(numberFormat2.format(resta));
  }
});

function onSubmitForm2() {
  Swal.fire({
    title: "Estas seguro de subir este abono?",
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: `Si, Estoy seguro`,
    denyButtonText: `No, cancelar.`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      var frm = document.getElementById("form2");
      var data = new FormData(frm);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
          var msg = xhttp.responseText;
          if (msg != 0) {
            // alert(msg);
            Swal.fire({
              title: "Perfecto!",
              text: "Abono agregado correctamente.",
              icon: "success.png",
             
            });
            $("#exampleModal").modal("hide");
          } else {
            // alert(msg);
            Swal.fire({
              title: "No funciona :( !",
              text: "Contactar al desarrolaldor.",
              icon: "error",
            
            });
          }
        }
      };
      xhttp.open("POST", "ajax_new_abono.php", true);
      xhttp.send(data);
      $("#form1").trigger("reset");
    } else if (result.isDenied) {
      Swal.fire("Cancelaste la subida al mostrador", "", "info");
    }
  });
}

function onSubmitForm() {
  Swal.fire({
    title: "Estas seguro de subir este abono?",
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: `Si, Estoy seguro`,
    denyButtonText: `No, cancelar.`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      var frm = document.getElementById("form1");
      var data = new FormData(frm);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
          var msg = xhttp.responseText;
          if (msg != 0) {
            // alert(msg);
            Swal.fire({
              title: "Perfecto!",
              text: "Agregado correctamente.",
              icon: "success",
            });
            $("#exampleModal").modal("hide");
          } else {
            // alert(msg);
            Swal.fire({
              title: "No funciona :( !",
              text: "Contactar al desarrollador.",
           
            });
          }
        }
      };
      xhttp.open("POST", "ajax_informacion.php", true);
      xhttp.send(data);
      $("#form1").trigger("reset");
    } else if (result.isDenied) {
      Swal.fire("Cancelaste la subida de este abono", "", "info");
    }
  });
}
//muestreo datos modal
function ver_datos(id, e) {
  var dato = document.getElementById("cliente" + id);
  e.preventDefault();
}

function abrir_data(data) {
  console.log(data);
  $.ajax({
    url: "scripts/consulta3.php",
    type: "POST",
    dataType: "json",
    data: {
      key: "Q1",
      cliente: data,
    },
  })
    .done(function (d) {
      console.log(d.retornolosdatos);
      let padre = $("#buscarcliente").parent().parent().parent();
      d.retornolosdatos.forEach((item) => {
        console.log(item.order_id);
//inicio elem 
//funcion elem 
$(document).ready(function() {
    function elem(element, args) {
        let edens = new Object();

        if (undefined === args) {
            args = new Object();
        }

        if (undefined === element) {
            edens.elem = document.createElement("div");
        } else if (undefined !== element.innerHTML) {
            edens.elem = element;
        } else if ([".", "#"].includes(element.charAt(0))) {
            edens.elem = document.querySelector(element);
        } else {
            let acrear = "div";

            if (
                [
                    "btngroup",
                    "uk-card",
                    "dropdown_presentacion",
                    "select_",
                    "table_",
                    "btngroup",
                    "navbar",
                    "MainRight",
                    "Epanel",
                    "columns",
                    "column",
                    "form-stacked",
                    "alert",
                ].includes(element)
            ) {
                acrear = "div";
            } else if (element == "label") {
                acrear = "label";
            } else if (["ul", "subnav", "list", "accordion"].includes(element)) {
                acrear = "ul";
            } else if (["faicon"].includes(element)) {
                acrear = "i";
            } else if (["checkbox"].includes(element)) {
                acrear = "input";
            } else {
                acrear = element;
            }

            edens.elem = document.createElement(acrear);
        }

        Object.entries(args).forEach(function(v, k) {
            if (
                [
                    "type",
                    "name",
                    "title",
                    "href",
                    "id",
                    "src",
                    "value",
                    "className",
                    "placeholder",
                ].includes(v[0])
            ) {
                edens.elem[v[0]] = v[1];

                return;
            }

            if (v[0] == "style") {
                Object.entries(v[1]).forEach((style) => {
                    edens.elem.style[style[0]] = style[1];
                });
            }

            if (["html", "innerHTML", "content"].includes(v[0])) {
                switch (typeof v[1]) {
                    case "string":
                        edens.elem.innerHTML = v[1];
                        break;

                    case "number":
                        edens.elem.innerHTML = v[1];
                        break;

                    case "object":
                        if (undefined !== v[1].innerHTML) {
                            edens.elem.appendChild(v[1]);
                        }

                        break;
                }

                return;
            }

            if (v[0] == "attr") {
                Object.entries(v[1]).forEach(function(attr) {
                    edens.elem.setAttribute(attr[0], attr[1]);
                });
                return;
            }

            if (v[0] == "appendTo") {
                v[1].appendChild(edens.elem);
                return;
            }

            if (v[0] == "prependTo") {
                v[1].prepend(edens.elem);
                return;
            }

            if (v[0] == "afterTo") {
                v[1].parentElement.insertBefore(edens.elem, v[1].nextElementSibling);

                return;
            }

            if (v[0] == "on") {
                Object.entries(v[1]).forEach(function(evento) {
                    edens.elem[evento[0]] = function(evt) {
                        evento[1](evt);

                        evt.preventDefault();
                    };
                });

                return;
            }

            if (["onclick", "onkeyup"].includes(v[0])) {
                edens.elem[v[0]] = function(evt) {
                    v[1](evt);

                    evt.preventDefault();
                };

                return;
            }

            if (v[0] == "elements") {
                Object.values(v[1]).forEach(function(v2) {
                    let el = elem(v2.element, v2.args);

                    edens.elem.appendChild(el);
                });

                return;
            }
        });

        switch (element) {
            case "btngroup":
                edens.elem.classList.add("field");

                edens.elem.classList.add("has-addons");

                if (undefined !== args.buttons) {
                    args.buttons.forEach((button) => {
                        let control = elem("p", {
                            appendTo: edens.elem,
                            className: "control",
                        });

                        let btn = elem("button", button);

                        control.appendChild(btn);
                    });
                }

                break;

            case "uk-card":
                edens.elem.classList.add("uk-card");

                edens.elem.classList.add("uk-card-default");

                edens.elem.classList.add("uk-width-1-1");

                if (undefined !== args.header) {
                    let header_ = elem("div", args.header);

                    header_.classList.add("uk-card-header");

                    header_.classList.add("uk-padding-small");

                    edens.elem.appendChild(header_);

                    if (undefined !== args.header.title) {
                        let title_ = elem("h3", args.header.title);

                        title_.classList.add("uk-card-title");

                        title_.classList.add("is-size-5");

                        header_.appendChild(title_);
                    }
                }

                if (undefined !== args.body) {
                    let body_ = elem("div", args.body);

                    body_.classList.add("uk-card-body");

                    edens.elem.appendChild(body_);
                }

                if (undefined !== args.footer) {
                    let footer_ = elem("div", args.footer);

                    body_.classList.add("uk-card-footer");

                    edens.elem.appendChild(footer_);
                }

                break;

            case "accordion":
                if (undefined == args.attr) {
                    edens.elem.setAttribute("uk-accordion", "");
                }

                if (undefined !== args.items) {
                    args.items.forEach((item, i) => {
                        let args_li = {};

                        if (undefined !== item.li) {
                            args_li = item.li;
                        }

                        let li = elem("li", args_li);

                        edens.elem.appendChild(li);

                        if (undefined !== item.title) {
                            let title = elem("a", item.title);

                            title.classList.add("uk-accordion-title");

                            title.href = "#";

                            li.appendChild(title);
                        }

                        if (undefined !== item.body) {
                            let body = elem("div", item.body);

                            body.classList.add("uk-accordion-content");

                            li.appendChild(body);
                        }
                    });
                }

                break;

            case "dropdown_presentacion":
                edens.elem.classList.add("uk-inline");

                edens.elem.classList.add("uk-margin-remove");

                if (undefined !== args.icon) {
                    elem("a", {
                        appendTo: edens.elem,

                        className: "is-small is-info uk-invisible-hover uk-align-right uk-margin-remove",

                        attr: { "uk-icon": "icon: " + args.icon },
                    });
                }

                if (undefined !== args.dropdown) {
                    let drop = elem("div", args.dropdown);

                    drop.classList.add("uk-padding-small");

                    edens.elem.appendChild(drop);
                }

                break;

            case "td":
                edens.elem.classList.add("uk-visible-toggle");

                break;

            case "select":
                if (undefined !== args.options) {
                    args.options.forEach((item, i) => {
                        let opt = elem("option", item);

                        edens.elem.appendChild(opt);
                    });
                }

                break;

            case "select_":
                edens.elem.classList.add("field");

                let control = elem("div", {
                    appendTo: edens.elem,
                    className: "control has-icons-left",
                });

                let div_select_args = { appendTo: control };

                if (undefined !== args.div_select) {
                    if (undefined == args.div_select.appendTo) {
                        args.div_select.appendTo = control;
                    }
                }

                let div_select = elem("div", div_select_args);

                if (undefined !== args.select) {
                    let sel = elem("select", args.select);

                    div_select.appendChild(sel);
                }

                div_select.classList.add("select");

                div_select.classList.add("is-fullwidth");

                break;

            case "btngroup":
                edens.elem.classList.add("field");

                edens.elem.classList.add("has-addons");

                if (undefined !== args.buttons) {
                    args.buttons.forEach((button) => {
                        let control_ = elem("p", {
                            appendTo: edens.elem,

                            className: "control",
                        });

                        let button_ = elem("button", button);

                        control_.appendChild(button_);
                    });
                }

                break;

            case "tr":
                if (undefined !== args.th) {
                    args.th.forEach((td) => {
                        let td_ = elem("th", td);

                        edens.elem.appendChild(td_);
                    });
                }

                if (undefined !== args.td) {
                    args.td.forEach((td) => {
                        let td_ = elem("td", td);

                        edens.elem.appendChild(td_);
                    });
                }

                break;

            case "table_":
                edens.elem.classList.add("uk-overflow-auto");

                if (undefined !== args.table) {
                    let tbl = elem("table", args.table);

                    edens.elem.appendChild(tbl);
                }

                break;

            case "table":
                edens.elem.classList.add("uk-table");

                edens.elem.classList.add("uk-table-small");

                edens.elem.classList.add("uk-table-divider");

                edens.elem.classList.add("uk-table-middle");

                // edens.elem.classList.add("uk-visible-toggle")

                if (undefined !== args.thead) {
                    thead = elem("thead", {
                        appendTo: edens.elem,

                        elements: [{
                            element: "tr",

                            args: {
                                td: args.thead,
                            },
                        }, ],
                    });

                    edens.elem.appendChild(thead);
                }

                let tbody_ = elem("tbody", { appendTo: edens.elem });

                if (undefined !== args.tbody) {
                    args.tbody.forEach((tr) => {
                        let tr_ = elem("tr", tr);

                        tbody_.appendChild(tr_);
                    });
                }

                break;

            case "button":
                edens.elem.classList.add("button");

                if (undefined !== args.icon) {
                    elem("span", {
                        appendTo: edens.elem,

                        className: "icon is-small",

                        elements: [{
                            element: "faicon",

                            args: args.icon,
                        }, ],
                    });
                }

                break;

            case "alert":
                edens.elem.setAttribute("uk-alert", "");

                msg = "";

                if (undefined !== args.type) {
                    mclass = "";

                    switch (args.type) {
                        case "error":
                            mclass = "uk-alert-danger";
                            msg = "ERROR";
                            break;

                        case "warn":
                            mclass = "uk-alert-warning";
                            msg = "WARNING";
                            break;

                        case "success":
                            mclass = "uk-alert-success";
                            msg = "SUCCESS";
                            break;

                        case "ok":
                            mclass = "uk-alert-success";
                            msg = "SUCCESS";
                            break;

                        default:
                            mclass = "uk-alert-primary";
                            msg = "INFORMATION";
                    }
                }

                edens.elem.classList.add(mclass);

                if (undefined !== args.content) {
                    msg = args.content;
                }

                elem("a", {
                    appendTo: edens.elem,

                    className: "uk-alert-close",

                    attr: { "uk-close": "" },
                });

                break;

            case "form-stacked":
                edens.elem.classList.add("uk-margin");

                let idfor = makeid();

                if (undefined !== args.label) {
                    elem("label", {
                        appendTo: edens.elem,

                        className: "uk-form-label is-size-6",

                        attr: {
                            for: idfor,
                        },

                        innerHTML: args.label,
                    });
                }

                let fcontrol = elem("div", {
                    appendTo: edens.elem,

                    className: "uk-form-controls",
                });

                if (undefined !== args.select_) {
                    let select_ = elem("select_", args.select_);

                    select_.id = idfor;

                    edens.elem.appendChild(select_);
                }

                if (undefined !== args.input) {
                    let input = elem("input", args.input);

                    input.id = idfor;

                    edens.elem.appendChild(input);
                }

                if (undefined !== args.textarea) {
                    let textarea = elem("textarea", args.textarea);

                    textarea.id = idfor;

                    edens.elem.appendChild(textarea);
                }

                if (undefined !== args.control) {
                    args.control(fcontrol);
                }

                break;

            case "input":
                if (undefined !== args.type) {
                    if (args.type == "number") {
                        edens.elem.setAttribute("step", "any");
                    }

                    if (["date", "number"].includes(args.type)) {
                        edens.elem.classList.add("uk-input");

                        edens.elem.classList.add("uk-form-small");

                        if (undefined !== args.valueAsNumber) {
                            edens.elem.valueAsNumber = args.valueAsNumber;
                        }
                    }

                    switch (args.type) {
                        case "radio":
                            break;

                        case "checkbox":
                            edens.elem.classList.add("itemRow");

                            break;

                        default:
                            edens.elem.classList.add("uk-input");

                            edens.elem.classList.add("uk-form-small");
                    }
                } else {
                    edens.elem.className = "uk-input uk-form-small";
                }

                break;

            case "checkbox":
                edens.elem.classList.add("itemRow");

                edens.elem.type = "checkbox";

                break;

            case "textarea":
                edens.elem.classList.add("uk-textarea");

                break;

            case "list":
                edens.elem.classList.add("uk-list");

                edens.elem.classList.add("uk-list-divider");

                if (undefined !== args.items) {
                    args.items.forEach((item) => {
                        li = elem("li", item);

                        edens.elem.appendChild(li);
                    });
                }

                break;

            case "column":
                edens.elem.classList.add("column");

                break;

            case "columns":
                edens.elem.classList.add("columns");

                break;

            case "subnav":
                edens.elem.className =
                    "uk-subnav uk-subnav-pill subnav uk-margin-remove has-background-white-ter";

                if (undefined !== args.items) {
                    args.items.forEach(function(item) {
                        if (undefined !== item.link) {
                            item.content = elem("a", item.link);

                            delete item.link;
                        }

                        let li = elem("li", item);

                        li.classList.add("uk-padding-remove");

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
    let tr = elem("tr", {
        appendTo: document.querySelector("#invoiceItem tbody"),
        td: [
          {
            innerHTML: elem("input", {
              attr: { placeholder: "fecha", size: 15, name: "fechas",value:item.order_date, },

              style: { width: "100%" },

              // id: 'idCategoria_' + count,
            }),
          },
          {
            innerHTML: elem("input", {
              attr: { placeholder: "mpago", size: 15, name: "mpago",value:item.metodo_de_pago, },

              style: { width: "100%" },

              // id: 'idCategoria_' + count,
            }),
          },
          {
            innerHTML: elem("input", {
              attr: {
                placeholder: "abonos_late",
                size: 15,
                name: "abonos_late",
                value:item.nuevo_abono,
                class:"form-control",
              },

              style: { width: "100%" },

              // id: 'idCategoria_' + count,
            }),
          },
          {
            innerHTML: elem("img", {
              attr: {
                src: ruta,
                name: "imgs",
                size: 20,
                class:"img",
                id:"imageness",
              
              },

              style: { width: "100%" },

              // id: 'idCategoria_' + count,
            }),
          }
          
        ],
      });


});
//fin funcion elem
        //fin elem
       
        padre.find("[name^=fechas]").val(item.order_date);
        padre.find("[name^=mpago]").val(item.metodo_de_pago);
        padre.find("[name^=abonos_late]").val(item.order_date);
        padre.find("[name^=cliente]").val(item.order_receiver_name);
        padre.find("[name^=abono]").val(item.abono);
        padre.find("[name^=cotizacion]").val(item.order_id);
        padre.find("[name^=restante_modal]").val(item.restante);
        padre.find("[name^=order_ids]").val(item.order_id);
        padre.find("[name^=deuda]").val(item.deuda);
        let imagens = item.archivo;
        let ruta = "./imagenes/" + imagens;
        // document.getElementById("imgs").src = ruta;
        
        // padre.find("[name^=fechas]").val(item.order_date);
      });

      // no te va a funionar para todos. solo para el ultimo
      // padre.find("[name^=fechas]").val(d.resultado.order_date);
    //   padre.find("[name^=order_ids]").val(d.resultado.order_id);
    //   padre.find("[name^=cliente]").val(d.resultado.order_receiver_name);
    //   padre.find("[name^=abono]").val(d.resultado.abono);
    //   padre.find("[name^=cotizacion]").val(d.resultado.order_id);
    //   padre.find("[name^=mpago]").val(d.resultado.metodo_de_pago);
    //   padre.find("[name^=restante_modal]").val(d.resultado.restante);
    //   let imagens = d.resultado.archivo;
    //   console.log(imagens);
    //   var img = new Image();
    //   img.src = "./imagenes/" + imagens;
    //   let ruta = "./imagenes/" + imagens;
    //   document.getElementById("imgs").src = ruta;

    //   let newabono = d.resultado.nuevo_abono;
    //   let new_metodo_pago = d.resultado.metodo_de_pago;
    //   let img_for_ruta = d.resultado.archivo;

    //   newabono.forEach(function (item) {
    //     console.log(item);
    //   });
    })
    .fail(function (e) {});
}

function showNewAbono() {
  document.getElementById("info_1").style.display = "none";
  document.getElementById("agregar_na").style.display = "none";
  document.getElementById("new_abono").style.display = "block";
  document.getElementById("close_na").style.display = "block";
}

function closeNewAbono() {
  document.getElementById("info_1").style.display = "block";
  document.getElementById("agregar_na").style.display = "block";
  document.getElementById("new_abono").style.display = "none";
  document.getElementById("close_na").style.display = "none";
}


