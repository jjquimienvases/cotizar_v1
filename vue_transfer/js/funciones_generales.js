$(document).ready(function () {
 
        $("#create_transfer").hide();
    $("#preview").hide();
});

function show_create() {
    $("#create_transfer").show();
    $("#transfer_list").hide();
    console.log("click en mostrar creacion")
}

function show_list() {
    $("#create_transfer").hide();
    $("#transfer_list").show();
    console.log("click en mostrar lista")
}

function show_form_create(){
    $("#preview").hide();
    $("#form_create").show();
}

function show_preview() {
    $("#form_create").hide();
    $("#preview").show();
}