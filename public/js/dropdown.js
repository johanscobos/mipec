$("#ser").change(function (event) {
    $.get("/admin/clientes/valor/"+event.target.value+"",function(response, ser) {
        //console.log(response);
       // $("#val").empty();
           $("#valor").val(response.valor);
    });
});