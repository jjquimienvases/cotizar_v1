    function desplejarmodal(url, Titulo) {
        var u = ""
        $(".modal-body").load(url);
        $(".modal-title").html(Titulo);
        $(".modal-footer").html(u);
        $("#Modal").modal();

    }