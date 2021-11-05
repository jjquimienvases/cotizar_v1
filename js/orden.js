let precioDB = 0;
let precioPerfumeria = 0;
// const totalles = 0;
$(document).ready(function(){

  function elem(element,args){
    let edens = new Object;
    if(undefined===args){args=new Object;}
    if(undefined===element){edens.elem = document.createElement('div');}
    else if(undefined!==element.innerHTML){edens.elem=element;}
    else if(['.','#'].includes(element.charAt(0))){edens.elem=document.querySelector(element);}
    else{
      let acrear='div'
      if(['btngroup','uk-card','dropdown_presentacion','select_','table_','btngroup','navbar','MainRight','Epanel','columns','column','form-stacked','alert'].includes(element)) {acrear='div';}
      else if(element=='label'){acrear='label';}
      else if(['ul','subnav','list','accordion'].includes(element)){acrear='ul';}
      else if(['faicon'].includes(element)){acrear='i';}
      else if(['checkbox'].includes(element)){acrear='input';}
      else{acrear=element;}
      edens.elem=document.createElement(acrear);
    }

    Object.entries(args).forEach(function(v,k){
      if (['type','name','title','href','id','src','value','className','placeholder'].includes(v[0])) {
        edens.elem[v[0]] = v[1];
        return;
      }
      if (v[0]=='style') {
        Object.entries(v[1]).forEach((style) => {
          edens.elem.style[style[0]] = style[1];
        });

      }
      if (['html','innerHTML','content'].includes(v[0])) {
        switch (typeof v[1]) {
          case 'string':edens.elem.innerHTML = v[1];break;
          case 'number':edens.elem.innerHTML = v[1];break;
          case 'object':
          if (undefined!==v[1].innerHTML) {
            edens.elem.appendChild(v[1]);
          }
          break;
        }
        return;
      }
      if (v[0]=='attr'){Object.entries(v[1]).forEach(function(attr){edens.elem.setAttribute(attr[0],attr[1]);});return;}
      if (v[0]=='appendTo'){v[1].appendChild(edens.elem);return;}
      if (v[0]=='prependTo'){v[1].prepend(edens.elem);return;}
      if (v[0]=='afterTo'){
        v[1].parentElement.insertBefore(edens.elem,v[1].nextElementSibling)
        return;}
        if (v[0]=='on') {
          Object.entries(v[1]).forEach(function(evento){
            edens.elem[evento[0]] = function(evt){
              evento[1](evt)
              evt.preventDefault()
            }
          });
          return;
        }
        if (['onclick','onkeyup'].includes(v[0])) {
          edens.elem[v[0]] = function(evt){
            v[1](evt)
            evt.preventDefault()
          }
          return;
        }
        if (v[0]=='elements') {
          Object.values(v[1]).forEach(function(v2){
            let el = elem(v2.element,v2.args);
            edens.elem.appendChild(el);
          });
          return;
        }
      });
      switch (element) {
        case 'btngroup':
        edens.elem.classList.add('field');
        edens.elem.classList.add('has-addons');
        if (undefined!==args.buttons) {
          args.buttons.forEach((button) => {
            let control = elem('p',{appendTo:edens.elem,className:'control'});
            let btn = elem('button',button)
            control.appendChild(btn);
          });

        }
        break;
        case 'uk-card':
        edens.elem.classList.add("uk-card");
        edens.elem.classList.add("uk-card-default");
        edens.elem.classList.add("uk-width-1-1");
        if (undefined!==args.header) {
          let header_ = elem('div',args.header);
          header_.classList.add("uk-card-header");
          header_.classList.add("uk-padding-small");
          edens.elem.appendChild(header_);
          if (undefined!==args.header.title) {
            let title_ = elem('h3',args.header.title);
            title_.classList.add('uk-card-title')
            title_.classList.add('is-size-5')
            header_.appendChild(title_);
          }
        }
        if (undefined!==args.body) {
          let body_ = elem('div',args.body);
          body_.classList.add("uk-card-body");
          edens.elem.appendChild(body_);
        }
        if (undefined!==args.footer) {
          let footer_ = elem('div',args.footer);
          body_.classList.add("uk-card-footer");
          edens.elem.appendChild(footer_);
        }
        break;
        case 'accordion':
        if (undefined==args.attr) {
          edens.elem.setAttribute("uk-accordion","");
        }
        if (undefined!==args.items) {
          args.items.forEach((item, i) => {
            let args_li = {};
            if (undefined!==item.li) {args_li=item.li}
            let li = elem('li',args_li);
            edens.elem.appendChild(li);
            if (undefined!==item.title) {
              let title = elem('a',item.title)
              title.classList.add("uk-accordion-title");
              title.href="#";
              li.appendChild(title);
            }
            if (undefined!==item.body) {
              let body = elem('div',item.body)
              body.classList.add("uk-accordion-content");
              li.appendChild(body);
            }
          });

        }
        break;
        case 'dropdown_presentacion':
        edens.elem.classList.add('uk-inline');
        edens.elem.classList.add('uk-margin-remove');
        if (undefined!==args.icon) {
          elem('a',{
            appendTo:edens.elem,
            className:'is-small is-info uk-invisible-hover uk-align-right uk-margin-remove',
            attr:{"uk-icon":"icon: "+args.icon},
          })
        }
        if (undefined!==args.dropdown) {
          let drop = elem('div',args.dropdown);
          drop.classList.add("uk-padding-small");
          edens.elem.appendChild(drop);
        }
        break;
        case 'td':
        edens.elem.classList.add("uk-visible-toggle")
        break;
        case 'select':
        if (undefined!==args.options) {
          args.options.forEach((item, i) => {
            let opt = elem('option',item);
            edens.elem.appendChild(opt);
          });

        }
        break;
        case 'select_':
        edens.elem.classList.add("field");
        let control = elem('div',{appendTo:edens.elem,className:'control has-icons-left',})
        let div_select_args = {appendTo:control}
        if (undefined!==args.div_select) {
          if (undefined==args.div_select.appendTo) {args.div_select.appendTo = control;}
        }
        let div_select = elem('div',div_select_args)
        if (undefined!==args.select) {
          let sel = elem('select',args.select);
          div_select.appendChild(sel)
        }
        div_select.classList.add("select")
        div_select.classList.add("is-fullwidth")
        break;
        case 'btngroup':
        edens.elem.classList.add("field");
        edens.elem.classList.add("has-addons");
        if (undefined!==args.buttons) {
          args.buttons.forEach((button) => {
            let control_ = elem('p',{
              appendTo:edens.elem,
              className:'control'
            })
            let button_ = elem('button',button)
            control_.appendChild(button_);
          });

        }
        break;
        case 'tr':
        if (undefined!==args.th) {
          args.th.forEach((td) => {
            let td_ = elem('th',td)
            edens.elem.appendChild(td_)
          });
        }
        if (undefined!==args.td) {
          args.td.forEach((td) => {
            let td_ = elem('td',td)
            edens.elem.appendChild(td_)
          });
        }
        break;
        case 'table_':
        edens.elem.classList.add("uk-overflow-auto");
        if (undefined!==args.table) {
          let tbl = elem('table',args.table);
          edens.elem.appendChild(tbl)
        }
        break;
        case 'table':
        edens.elem.classList.add("uk-table")
        edens.elem.classList.add("uk-table-small")
        edens.elem.classList.add("uk-table-divider")
        edens.elem.classList.add("uk-table-middle")
        // edens.elem.classList.add("uk-visible-toggle")
        if (undefined!==args.thead) {
          thead = elem('thead',{
            appendTo:edens.elem,
            elements:[
              {
                element:'tr',
                args:{
                  td:args.thead
                }
              }
            ]
          })
          edens.elem.appendChild(thead)
        }
        let tbody_ = elem('tbody',{appendTo:edens.elem})
        if (undefined!==args.tbody) {
          args.tbody.forEach((tr) => {
            let tr_ = elem('tr',tr);
            tbody_.appendChild(tr_);
          });


        }
        break;
        case 'button':
        edens.elem.classList.add("button");
        if (undefined!==args.icon) {
          elem('span',{
            appendTo:edens.elem,
            className:'icon is-small',
            elements:[
              {
                element:'faicon',
                args:args.icon
              }
            ]
          })
        }
        break;
        case 'alert':
        edens.elem.setAttribute("uk-alert","");
        msg="";
        if (undefined!==args.type) {
          mclass = "";
          switch (args.type) {
            case 'error':mclass = "uk-alert-danger";msg="ERROR";break;
            case 'warn':mclass = "uk-alert-warning";msg="WARNING";break;
            case 'success':mclass = "uk-alert-success";msg="SUCCESS";break;
            case 'ok':mclass = "uk-alert-success";msg="SUCCESS";break;
            default:
            mclass = "uk-alert-primary";msg="INFORMATION";
          }
        }
        edens.elem.classList.add(mclass)
        if (undefined!==args.content) {msg=args.content;}
        elem('a',{
          appendTo:edens.elem,
          className:'uk-alert-close',
          attr:{"uk-close":""}
        })
        break;
        case 'form-stacked':
        edens.elem.classList.add('uk-margin');
        let idfor = makeid();
        if (undefined!==args.label) {
          elem('label',{
            appendTo:edens.elem,
            className:'uk-form-label is-size-6',
            attr:{
              for:idfor
            },
            innerHTML:args.label
          })
        }
        let fcontrol = elem('div',{
          appendTo:edens.elem,
          className:'uk-form-controls'
        });
        if (undefined!==args.select_) {
          let select_ = elem('select_',args.select_)
          select_.id=idfor;
          edens.elem.appendChild(select_);
        }
        if (undefined!==args.input) {
          let input = elem('input',args.input)
          input.id=idfor;
          edens.elem.appendChild(input);
        }
        if (undefined!==args.textarea) {
          let textarea = elem('textarea',args.textarea)
          textarea.id=idfor;
          edens.elem.appendChild(textarea);
        }
        if (undefined!==args.control) {args.control(fcontrol)}
        break;
        case 'input':
        if (undefined!==args.type) {
          if (args.type=='number') {
            edens.elem.setAttribute("step","any");
          }
          if (['date','number'].includes(args.type)) {
            edens.elem.classList.add("uk-input")
            edens.elem.classList.add("uk-form-small")
            if (undefined!==args.valueAsNumber) {
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
        }else{
          edens.elem.className = "uk-input uk-form-small"
        }
        break;
        case 'checkbox':
        edens.elem.classList.add("itemRow")
        edens.elem.type="checkbox"

        break;
        case 'textarea':
        edens.elem.classList.add("uk-textarea")


        break;
        case 'list':
        edens.elem.classList.add('uk-list');
        edens.elem.classList.add('uk-list-divider');
        if (undefined!==args.items) {
          args.items.forEach((item) => {
            li = elem('li',item)
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
        if (undefined!==args.items) {
          args.items.forEach(function(item){
            if (undefined!==item.link) {item.content = elem('a',item.link)
            delete item.link;
          }
          let li = elem('li',item);
          li.classList.add("uk-padding-remove")
          edens.elem.appendChild(li);
        });
      }

      break;
    }
    if (undefined!==args.DOM || undefined!==args.dom) {
      args.dom(edens.elem);
    }
    return edens.elem;
  }


  $(document).on('click', '#checkAll', function() {
    $(".itemRow").prop("checked", this.checked);
  });
  $(document).on('click', '.itemRow', function() {
    if ($('.itemRow:checked').length == $('.itemRow').length) {
      $('#checkAll').prop('checked', true);
    } else {
      $('#checkAll').prop('checked', false);
    }
  });

  function new_calculatelocal(){
    $("[id^=quantity_]").on('keyup',function(){
      let this_ = $(this);
      let idd = this_.attr('id').split("_")[1];


      calculateTotal(idd);

      var sumatotal = [];
      $("[id^=result]").each(function(){
        sumatotal.push(parseFloat($(this).val()))
      })
      var totalles = sumatotal.reduce(function(a,b){return a+b}).toFixed(2);

      console.log(totalles+"real");





      console.log( idd   );
    });

  }
  new_calculatelocal();

  var count = $(".itemRow").length;
  $(document).on('click', '#addRows', function() {
    console.log('inicion agregar')
    count++;


    let tr = elem('tr',{
      appendTo:document.querySelector("#invoiceItem tbody"),
      td:[
        {
          innerHTML:elem('input',{
            type:"checkbox",
            class:"itemRow"
          })
        },
        {
          innerHTML:select = elem('select',{
            style:{width:'310px'},
            options:[
              {innerHTML:'selecion'},
            ],
            on:{
              onchange:function(evt){
                $.ajax({
                  url:'methods/conexion_orden.php',
                  type:'POST',
                  dataType:'json',
                  data:{key:'Q1',producto:select.value}
                }).done(function(d){
                  console.log(d);
                  precioDB = [d.resultado.gramo];
                  precioDB = precioDB.toString();

                   	let padre = $("#mibuscador").parent().parent().parent();
                  $(tr).find("[name^=idCategoria]").val(d.resultado.id_categoria)
                  $(tr).find("[name^=productCode]").val(d.resultado.id)
                  $(tr).find("[name^=productName]").val(d.resultado.contratipo)
                  $(tr).find("[name^=productStock]").val(d.resultado.stock)
                  $(tr).find("[name^=productUnidad]").val(d.resultado.unidad)
                  $(tr).find("[name^=price]").val(d.resultado.price_orden)
                }).fail(function(e){console.log("ERROR:",e);});



              },
            },
            dom:function(select){
              setTimeout(function(){

                $(select).select2({
                  ajax: {
                    url: 'methods/conexion_orden.php',
                    dataType: 'json',
                    type:'post',
                    data:function(param){
                      return {
                        key:'buscarproducto',
                        val:param.term
                      };
                    },
                    processResults: function (data, params) {
                      return {
                        results: data.results,
                      };
                    },

                  }
                });


              },500);
            }
          })
        },
        {
          innerHTML:elem('input',{
            attr:{placeholder:"ia",size:2,name:'idCategoria[]'},
            style:{width:'100%'},
            id:'idCategoria_'+count,
          })
        },
        {
          innerHTML:elem('input',{
            attr:{placeholder:"ID producto",size:2,name:'productCode[]'},
            style:{width:'100%'},
            id:'productCode_'+count,
          })
        },
        {
          innerHTML:elem('input',{
            attr:{placeholder:"Contratipo",size:2,name:'productName[]'},
            style:{width:'100%'},
            id:'productName_'+count,
          })
        },{
          innerHTML:elem('input',{
            attr:{placeholder:"Stock",size:2,name:'productStock[]'},
            style:{width:'100%'},
            id:'productStock_'+count,
          })
        },
        {
          innerHTML:elem('input',{
            attr:{placeholder:"U. Empaque",size:2,name:'productUnidad[]'},
            style:{width:'100%'},
            id:'productUnidad_'+count,
          })
        },
        {
          innerHTML:elem('input',{
            attr:{placeholder:"Q Cajas",size:2,name:'cantidad[]'},
            style:{width:'100%'},
            id:'cantidad_'+count,
          })
        },
        {
          innerHTML:elem('input',{
            attr:{placeholder:"Cantidad",size:2,name:'quantity[]',accesskey:'c'},
            style:{width:'100%'},
            id:'quantity_'+count,
            on:{
              onkeyup:function(evt){
                // calculateTotal(count);

              }
            },

          })
        },
        {
          innerHTML:elem('input',{
            attr:{placeholder:"precio",size:2,name:'price[]'},
            style:{width:'100%'},
            id:'price_'+count,
          })
        },
        {
          innerHTML:elem('input',{
            attr:{placeholder:"Total",size:2,name:'result[]'},
            style:{width:'100%'},
            id:'result_'+count,
            on:{
              onchange:function(evt){
                console.log(evt);
              }
            }
          })
        }
      ]
    });

    new_calculatelocal();


  });

  $(document).on('click', '#removeRows', function(){
    $(".itemRow:checked").each(function() {
      $(this).closest('tr').remove();
       new_calculatelocal();
    });

    calculateTotal();
    $('#checkAll').prop('checked', false);
    calculateTotal();
  });
  $(document).on('blur', "[id^=quantity_]", function(){
    calculateTotal();
  });
  $(document).on('blur', "[id^=price_]", function(){
    calculateTotal();
  });
  $(document).on('blur', "#taxRate", function(){
    calculateTotal();
  });
  $(document).on('blur', "#amountPaid", function(){
    var amountPaid = $(this).val();
    var totalAftertax = $('#totalAftertax').val();
    if(amountPaid && totalAftertax) {
      totalAftertax = totalAftertax-amountPaid;
      $('#amountDue').val(totalAftertax);
    } else {
      $('#amountDue').val(totalAftertax);
    }
  });

});

function roundToTwo(num) {
  return +(Math.round(num + "e+2")  + "e-2");
}

function calculateTotal(id1){
  if (undefined==id1) {return;}

  $("[id^='result_"+id1+"']").each(function() {
    var id = $(this).attr('id');

    var categoria = $('#idCategoria_'+id1).val();
    var priceunit = 0;
    var price = $('#price_'+id1).val();


    var valu = 0;
    var quantity  = $('#quantity_'+id1).val();

    if(!quantity) {
      quantity = 1;
    }else if(quantity != 0){
    var totales = quantity * price;

    }

       var totalAmount = 0;
       var total = totales;
       if (undefined==total) {total = 0;}
       totalAmount += total.toFixed(2);

      var totall = 0;

      var sumatotal = [];
     $("[id^=result]").each(function(){
    sumatotal.push(parseFloat($(this).val()))
     })
     totall = sumatotal.reduce(function(a,b){return a+b})

  console.log(totall);


          var sumasubT = totall;
          var sumaAT = totall;
          



    document.getElementById(id).value = roundToTwo(total).toFixed();

    document.getElementById("subTotal").value= sumasubT;
    document.getElementById("totalAftertax").value=sumaAT;




  });
}
