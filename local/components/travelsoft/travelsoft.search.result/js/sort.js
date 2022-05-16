/**
* Custom sorting plugin
*/

window.TSSorter = function (sortData) {

	this.cSort = function (by, order) {

		var sd = sortData;

		if (order === "asc"){

			sd.sort(function (a, b) {

							if (a[by] > b[by]) {
							    return 1;
						  	}

						  	if (a[by] < b[by]) {
						   		return -1;
						  	}
							  
						  	return 0;

						});
		}
			
		if (order === "desc") {

			sd.sort(function (a, b) {

							if (a[by] < b[by]) {
							    return 1;
						  	}

						  	if (a[by] > b[by]) {
						   		return -1;
						  	}
							  
						  	return 0;

						});
		}

		return sd;

	}

}