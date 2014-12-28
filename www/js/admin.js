var ProductsListObject = {};
function showProducts(el, quantity, prodListObj) {
    var href = '<a class="btn btn-link" href="#" data-toggle="modal" data-target="#productInfo">';
	var q = ( (quantity+prodListObj.showed) < prodListObj.list.length) ? (quantity+prodListObj.showed) : prodListObj.list.length;
	for(var i=prodListObj.showed; i<q; ++i) {
		var innerString  = '<tr>';
		innerString += '<td>'+href+prodListObj.list[i].id+'</a></td>';
		innerString += '<td>'+href+prodListObj.list[i].name+'</a></td>';
		innerString += '<td>'+href+prodListObj.list[i].description+'</a></td>';
		innerString += '<td>'+href+prodListObj.list[i].category+'</a></td>';
		innerString += '<td>'+href+prodListObj.list[i].price+'</a></td>';
		innerString += '</tr>';
		$(el).append(innerString);
	}
    $("#productsList a").on("click", function() {
        var id =$(this).parents('tr').children("td:first-child").find("a").text();
        var product = getProductInfo(ProductsListObject, id);

        productInfoId.innerHTML = product.id;
        productInfoIdHID.innerHTML = product.id;
        productInfoName.value = product.name;
        productInfoPrice.value = product.price;
    });

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

function getProductInfo(PLO, id) {
    for(var i in PLO['list']) {
        if(PLO['list'][i].id == id)
            return PLO['list'][i];
    }
    return false;
}
