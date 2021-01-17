$(document).ready(function () {
	// Autocomplete values
	foods = [
		"French fries",
		"Tomato",
		"Apple",
		"Vinegar",
		"Soy sauce",
		"Ketchup",
		"Chocolate",
		"Carrot",
		"Lemon",
		"Ginger",
		"Grapes",
		"Watermelon",
		"Salmon",
		"Avocado",
		"Chips",
		"Olives",
		"Bamba",
		"Donuts",
		"Erdinger beer",
		"Hummus",
		"Ice cream",
		"Jalapeño",
		"Milk",
		"Noodles",
		"Pizza",
	];

	let autocompleteList = [];
	function callback(response) {
		autocompleteList = response;
		return autocompleteList;
	}
	$.ajax({
		dataType: "json",
		type: "post",
		url: "./utils/autocomplete.php",
		data: { Email: $("p#Email").text() },
		success: function (data) {
			if (data.length < 1) {
				autocompleteList = foods;
			} else {
				autocompleteList = callback(data);
			}
			$("#itemName").autocomplete({
				source: autocompleteList,
				autoFocus: true,
				appendTo: ".input-container",
			});
		},
		error: function (data) {
			console.log(data.responseText);
		},
	});

	sortAlphabetically();

	// Marks item as "bought"
	$(document).on("click", ".btnBuy", function () {
		$(this).parents("tr").toggleClass("buy");

		let bought = 0;
		if ($(this).parents("tr").attr("class") === "buy") {
			bought = 1;
		}
		let currentRow = $(this).closest("tr");
		$.ajax({
			url: "utils/itemToggleBuy.php",
			type: "POST",
			data: { id: currentRow.data("id"), bought: bought },
			success: function (response) {},
			error: function (xhr, status, error) {
				console.log(xhr.responseText);
			},
		});
		sortAlphabetically();
	});

	$(".remove.modal").modal({
		backdrop: "static",
		show: false,
	});
	let rowToRemove = "";
	$(document).on("click", ".btnRemove", function () {
		$(".remove.modal").modal("show");
		rowToRemove = $(this).parents("tr");
		const itemName = $(this).parents("tr").find(".itemName").text();
		const itemAmount = $(this).parents("tr").find(".itemAmount").text();
		$(".remove.modal .modal-body p").html(
			`You are about to delete <b style="color:red">${itemAmount} ${itemName}</b>`
		);
	});
	$(".btnRemoveConfirm").click(function () {
		$(".remove.modal").modal("hide");
		$.ajax({
			url: "utils/deleteItem.php",
			type: "POST",
			data: { id: rowToRemove.data("id") },
			success: function (response) {
				rowToRemove.fadeOut();
			},
			error: function (xhr, status, error) {
				console.log(error);
			},
		});
	});

	// Reduces amount of item by 1, removes if 0.
	$(document).on("click", ".btnMinus", function () {
		let currentRow = $(this).closest("tr");
		let current_amount = Number(currentRow.find("td:eq(1)").text());
		if (current_amount > 1) {
			currentRow.find("td:eq(1)").text(current_amount - 1);
			$.ajax({
				url: "utils/itemMinus.php",
				type: "POST",
				data: { id: currentRow.data("id"), amount: current_amount },
				success: function (response) {},
				error: function (xhr, status, error) {
					console.log(error);
				},
			});
		} else if (current_amount == 1) {
			$(".remove.modal").modal("show");
			rowToRemove = $(this).parents("tr");
			const itemName = $(this).parents("tr").find(".itemName").text();
			const itemAmount = $(this).parents("tr").find(".itemAmount").text();
			$(".remove.modal .modal-body p").html(
				`You are about to delete <b style="color:red">${itemAmount} ${itemName}</b>`
			);
		}
	});

	// Increases amount of item by 1
	$(document).on("click", ".btnPlus", function () {
		let currentRow = $(this).closest("tr");
		let current_amount = Number(currentRow.find("td:eq(1)").text());
		currentRow
			.find("td:eq(1)")
			.text(Number(currentRow.find("td:eq(1)").text()) + 1);
		$.ajax({
			url: "utils/itemPlus.php",
			type: "POST",
			data: { id: currentRow.data("id"), amount: current_amount },
			success: function (response) {},
			error: function (xhr, status, error) {
				console.log(error);
			},
		});
	});

	$(".btnAddItem").click(function () {
		$("form#addItem .btnSubmit").click();
		sortAlphabetically();
	});

	$(document).on("click", ".btnMark", function () {
		$(this).parents("tr").toggleClass("mark");
	});

	$("form#addItem").submit(function (e) {
		e.preventDefault();
		let itemName = $("#itemName").val();
		let amount = $("#itemAmount").val();
		let email = $("p#Email").text();
		let bought = 0;
		if ($(this).parents("tr").attr("class") === "buy") {
			bought = 1;
		}
		$.ajax({
			url: "utils/addItem.php",
			type: "POST",
			data: {
				itemName: itemName,
				amount: amount,
				bought: bought,
				email: email,
			},
			success: function (response) {
				let id = response;
				if (amount == "") {
					amount = 1;
				} else if (amount <= 0) {
					amount = 1;
				}
				addItem(id, itemName, amount, bought, email);
			},
			error: function (xhr, status, error) {
				console.log(xhr.responseText);
			},
		});
		resetAddItemForm();
		$("#itemName").focus();
	});
	$(".resetAddItemForm").click(function () {
		resetAddItemForm();
	});
	function resetAddItemForm() {
		$("#itemName").val("");
		$("#itemAmount").val("");
	}
	function addItem(id, itemName, amount, bought, email) {
		const item = { id, itemName, amount, bought, email };
		addItemToTable(item);
	}
	function addItemToTable(item) {
		let tr = "";
		if (item.bought) {
			tr = `<tr data-id=${item.id} class="buy">
			<td class="itemName">${item.itemName}</td>
			<td class="itemAmount">${item.amount}</td>
			<td>
				Refresh to complete
			</td>
			</tr>`;
		} else {
			tr = `<tr data-id=${item.id}>
			<td class="itemName">${item.itemName}</td>
			<td class="itemAmount">${item.amount}</td>
			<td>
				Refresh to complete
			</td>
			</tr>`;
		}

		$("table#items tbody").append(tr);
		sortAlphabetically();
	}

	function prevBoughtList() {
		let email = $("p#Email").text();
		let table = document.getElementById("items");
		let i = 1;
		while (table.rows.length != 1) {
			table.deleteRow(i);
		}
		$.ajax({
			url: "utils/prevBoughtList.php",
			type: "POST",
			data: { Email: email },
			success: function (response) {
				// console.log(response);
				response.forEach((item) => {
					addItem(response, item, 1, 0, email);
				});
			},
			error: function (xhr, status, error) {
				console.log(xhr.responseText);
			},
		});
		// sortAlphabetically();
	}

	// Ajax and JSON
	$("#btnRefresh").click(function () {
		$.ajax({
			url: "utils/getItems.php",
			type: "GET",
			success: function (data) {
				console.log(data);
				$("table#items tbody").html("");
				$(data).each(function (i, item) {
					addItem(item.id, item["item name"], item["amount"], item["Email"]);
				});
			},
		});
	});

	$(document).on("click", "#tableObject", function () {
		tbl = tableObject();
		console.log(tbl);
	});

	$(document).on("click", "#checkout", function () {
		checkout();
	});

	$(document).on("click", "#prevBought", function () {
		prevBoughtList();
		setTimeout(function () {
			$("a#refresh")[0].click();
		}, 50);
		// $("a#refresh")[0].click();
	});

	$(document).on("click", "#newList", function () {
		newList();
	});

	$(document).on("click", "#cancel", function () {
		$("a#refresh")[0].click();
	});

	$(document).on("click", "#closeModal", function () {
		$("a#refresh")[0].click();
	});

	$(document).on("keyup", function (evt) {
		if (evt.keyCode == 27) {
			$("a#refresh")[0].click();
		}
	});
});

function sortAlphabetically() {
	let tbl = $("table");
	$("#iName").each(function () {
		let th = $(this),
			thIndex = th.index(),
			inverse = false;
		tbl
			.find("td")
			.filter(function () {
				return $(this).index() === thIndex;
			})
			.sortElements(
				function (a, b) {
					if ($.text([a]).toUpperCase() == $.text([b]).toUpperCase()) return 0;

					return $.text([a]).toUpperCase() > $.text([b]).toUpperCase()
						? inverse
							? -1
							: 1
						: inverse
						? 1
						: -1;
				},
				function () {
					// parentNode is the element we want to move
					return this.parentNode;
				}
			);

		inverse = !inverse;
	});
	sortByBought();
}

// self-explanatory
function sortByBought() {
	let tbl = $("table");
	$("tr").each(function () {
		let th = $(this),
			thIndex = th.index(),
			inverse = false;
		tbl
			.find("td")
			.filter(function () {
				return $(this).index() === thIndex;
			})
			.sortElements(
				function (a, b) {
					if (
						$(a).closest("tr").attr("class") == $(b).closest("tr").attr("class")
					)
						return 0;
					return $(a).closest("tr").attr("class") == "buy"
						? inverse
							? -1
							: 1
						: inverse
						? 1
						: -1;
				},
				function () {
					// parentNode is the element we want to move
					return this.parentNode;
				}
			);

		inverse = !inverse;
	});
}

// Creates an object from the table
function tableObject() {
	tbl = $("table#items tr:has(td)")
		.map(function (i, v) {
			let $td = $("td", this);
			isBuy = false;
			if ($td.closest("tr").attr("class") == "buy") {
				isBuy = true;
			}
			return {
				id: $td.closest("tr").attr("data-id"),
				name: $td.eq(0).text(),
				amount: $td.eq(1).text(),
				buy: isBuy,
			};
		})
		.get();
	return tbl;
}

function checkout() {
	boughtItems = [];
	tableObject().forEach((item) => {
		if (item.buy == 1) {
			boughtItems.push(item);
		}
	});

	if (boughtItems.length > 0) {
		$.ajax({
			url: "utils/checkout.php",
			type: "POST",
			data: { boughtItems: boughtItems },
		});
	}

	let table = document.getElementById("items");
	for (let i = table.rows.length - 1; i > 0; i--) {
		let row = table.rows[i];
		if (row.getAttribute("class") === "buy") {
			$("table tr:nth-child(" + i + ")").fadeOut();
		}
	}
}

function newList() {
	let email = $("p#Email").text();
	let table = document.getElementById("items");
	let i = 1;
	while (table.rows.length != 1) {
		table.deleteRow(i);
	}
	$.ajax({
		url: "utils/emptyList.php",
		type: "POST",
		data: { Email: email },
		success: function (response) {},
		error: function (xhr, status, error) {
			console.log(xhr.responseText);
		},
	});
}
