
function search_item(){
    let data_ = $("#buscador_productos").val();
    axios({
        method: 'post',
        url: 'ajax/ajax_get_info_item.php',
        data: {
            id: data_,
            
        }
    }).then(function (response) {
        let datos = response;
        var jsonData = JSON.parse(response);
        console.log(jsonData);
    



    })
        .catch(function (error) {
            console.log(error);
        });
}