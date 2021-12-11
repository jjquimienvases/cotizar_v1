<?php 

{
    "invoices": [
       {
          "invoiceType": "FACTURA",
          "invoiceTypeExport": false,
          "operationCode": "10",
          "pointOfSale": "PROD2",
          "currency": "COP",
          "currencyRate": 0,
          "taxes": [
             {
                "type": "IVA",
                "amount": 332500,
                "taxableAmount": 1750000,
                "percentage": 19
             }
          ],
          "retes": [
             {
                "type": "RETE_RENTA",
                "amount": 70000,
                "taxableAmount": 1750000,
                "percentage": 0
             },
             {
                "type": "RETE_IVA",
                "amount": 49875,
                "taxableAmount": 332500,
                "percentage": 0
             },
             {
                "type": "RETE_ICA",
                "amount": 16905,
                "taxableAmount": 1750000,
                "percentage": 0
             }
          ],
          "items": [
             {
                "itemType": "GRAVADO",
                "quantity": 150,
                "amount": 8600,
                "name": "",
                "description": "PRUEBA ÍTEM 1",
                "taxableAmount": 1290000,
                "totalTax": 245100,
                "total": 1535100,
                "clasificationId": "",
                "clasificationName": "",
                "discountPercentage": 0,
                "discountAmount": 0,
                "taxes": [
                   {
                      "type": "IVA",
                      "amount": 245100,
                      "taxableAmount": 1290000,
                      "percentage": 19
                   }
                ],
                "itemCode": "PRUE0101",
                "observation": "Prueba de Factura Electrónica 1",
                "isGift": false
             },
             {
                "itemType": "GRAVADO",
                "quantity": 460,
                "amount": 1000,
                "name": "PRUEBA ÍTEM 2",
                "description": "PRUEBA ÍTEM 2",
                "taxableAmount": 460000,
                "totalTax": 87400,
                "total": 547400,
                "clasificationId": "",
                "clasificationName": "",
                "discountPercentage": 0,
                "discountAmount": 0,
                "taxes": [
                   {
                      "type": "IVA",
                      "amount": 87400,
                      "taxableAmount": 460000,
                      "percentage": 19
                   }
                ],
                "itemCode": "PRUE0102",
                "observation": "Prueba de Factura Electrónica 2",
                "isGift": false
             }
          ],
          "customer": {
             "type": "PERSONA_JURIDICA",
             "id": "860071562",
             "idExport": "",
             "idType": "NIT",
             "name": "CLIENTE DE PRUEBA & CIA",
             "department": "Bogotá, D.C.",
             "postalCode": "111311",
             "address": "Calle 63 c 28 92",
             "cityName": "BOGOTÁ, D.C.",
             "countryCode": "CO",
             "firstName": "CLIENTE DE PRUEBA & CIA",
             "lastName": "",
             "email": "pruebas@pruebas.com",
             "telephone": 2222222,
             "regimen": "ZZ"
          },
          "otherTaxesTotal": 0,
          "total": 2082500,
          "paid": 2082800,
          "vatAmount": 332500,
          "exemptAmount": 0,
          "taxableAmount": 1750000,
          "issuedDate": "2021-03-04 10:17:11",
          "expirationDate": "2021-03-04 10:17:11",
          "saleCondition": "CONTADO",
          "customerInvoiceId": 1210,
          "seller": "PRUEBAS",
                  "representation": "",
          "observation": "",
          "purchaseOrder": "",
          "area": "",
          "order": "",
          "referral": "",
          "warehouse": "",
          "note": ""
       }
    ]
 }