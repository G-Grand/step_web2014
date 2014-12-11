var ProductsListObject = {};
function showProducts(el, quantity, prodListObj) {
	var q = ( (quantity+prodListObj.showed) < prodListObj.list.length) ? (quantity+prodListObj.showed) : prodListObj.list.length;
	for(var i=prodListObj.showed; i<q; ++i) {
		innerString  = '<tr>';
		innerString += '<td>'+prodListObj.list[i].id+'</td>';
		innerString += '<td>'+prodListObj.list[i].name+'</td>';
		innerString += '<td>'+prodListObj.list[i].description+'</td>';
		innerString += '<td>'+prodListObj.list[i].category+'</td>';
		innerString += '<td>'+prodListObj.list[i].price+'</td>';
		innerString += '</tr>';
		$(el).append(innerString);
	}
	return q;
}


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
				ProductsListObject['list'] = data.response;
				ProductsListObject['showed'] = 0;
				ProductsListObject.showed = showProducts(el, 5, ProductsListObject);
				if(ProductsListObject.showed != ProductsListObject.list.length) {
					moreProductsBtn.style.display = '';
				}
			}else {
				alert(data.response);
			}
		}
	});
}