function getProducts(quantProd, el) {
	prodReq = (quantProd == "all") ? {"count": "all", "number": 0 }	: { "count": "part", "number": quantProd };
	$.ajax({
		url: "getProducts.php",
		dataType: "json",
		type: "POST",
		data: JSON.stringify(prodReq),
		contentType: "application/json; charset=utf-8;",
		success: function(data) {
			console.log(data);
			console.log(el);

			if(Array.isArray(data.response)) {
				var innerString = '';
				for(var obj in data.response) {
					innerString += '<tr>';
					innerString += '<td>'+data.response[obj].id+'</td>';
					innerString += '<td>'+data.response[obj].name+'</td>';
					innerString += '<td>'+data.response[obj].description+'</td>';
					innerString += '<td>'+data.response[obj].category+'</td>';
					innerString += '<td>'+data.response[obj].price+'</td>';
					innerString += '</tr>';
				}
				el.innerHTML = innerString;
			}else {
				alert(data.response);
			}
		}
	});

}