$(document).ready(function()
{

	$("#btn-plus").click(function()
	{

		$("#cover-more-product").append("<div class=\"events-rows\"><div class=\"event-product\"><label>Product:</label><input type=\"text\" name=\"product1[]\" placeholder=\"Product Name\"></div><div class=\"event-product\"><label>Price:</label><input   type=\"text\" name=\"price1[]\" placeholder=\"Prices\"></div><div class=\"event-product\"><label>N<sup><u>0</u></sup>'s seats:</label><input   type=\"text\" name=\"seats1[]\" placeholder=\"Number of seats\"><div  class=\"event-error\"><i class=\"glyphicon glyphicon-remove\"></i></div></div></div>");
	});


});
