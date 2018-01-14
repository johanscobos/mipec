var url = "http://localhost:8000/producto";

// muestra el formulario modal para la edición del producto
$(document).on('click', '.open_modal', function () {
    var producto_id = $(this).val();

    $.get(url + '/' + producto_id, function (data) {
        //success data
        console.log(data);
        $('#producto_id').val(data.id);
        $('#nombre').val(data.nombre);
        $('#descripcion').val(data.descripcion);
        $('#btn-save').val("update");
        $('#myModal').modal('show');
    })
});
// muestra el formulario modal para crear un nuevo producto
$('#btn_add').click(function () {
    $('#btn-save').val("add");
    $('#frmproductos').trigger("reset");
    $('#myModal').modal('show');
});
// eliminar el producto y eliminarlo de la lista
$(document).on('click', '.delete-producto', function () {
    var producto_id = $(this).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    })
    $.ajax({
        type: "DELETE",
        url: url + '/' + producto_id,
        success: function (data) {
            console.log(data);
            $("#producto" + producto_id).remove();
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});
// crear nuevo producto / actualizar producto existente
$("#btn-save").click(function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    })
    e.preventDefault();
    var formData = {
        nombre: $('#nombre').val(),
        descripcion: $('#descripcion').val(),
    }
    // utilizado para determinar el metodo http que se va a utilizar [add = POST], [update = PUT]
    var state = $('#btn-save').val();
    var type = "POST"; // para crear un nuevo recurso
    var producto_id = $('#producto_id').val();;
    var my_url = url;
    if (state == "update") {
        type = "PUT"; // para actualizar recursos existentes
        my_url += '/' + producto_id;
    }
    console.log(formData);
    $.ajax({
        type: type,
        url: my_url,
        data: formData,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            var producto = '<tr id="producto' + data.id + '"><td>' + data.id + '</td><td>' + data.nombre + '</td><td>' + data.descripcion + '</td>';
            producto += '<td><button class="btn btn-warning btn-detail open_modal" value="' + data.id + '">Editar</button>';
            producto += ' <button class="btn btn-danger btn-delete delete-producto" value="' + data.id + '">Eliminar</button></td></tr>';
            if (state == "add") { // para actualizar recursos existentes...
                $('#productos-list').append(producto);
            } else { // si el usuario actualiza un registro existente
                $("#producto" + producto_id).replaceWith(producto);
            }
            $('#frmproductos').trigger("reset");
            $('#myModal').modal('hide')
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});