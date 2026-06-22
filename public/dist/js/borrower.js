var count = 1;

$(document).ready(function () {
    // If there is any item in localStorage
    if (localStorage.getItem("britems")) {
        loadItems();
    }

    function loadItems() {
        if (localStorage.getItem("britems")) {
            var britems = JSON.parse(localStorage.getItem("britems"));

            var tr_html = "";
            let i = 1;
            $.each(britems, function (index, outerObject) {
                $.each(outerObject, function (key, data) {
                    tr_html += `<tr id="row_${key}" class="row_${key}" data-item-id="${key}">
                              <th scope="row">${i}</th>
                              <td>${data.row.code}</td>
                              <td>${data.row.title}</td>
                              <td><input type="number" class="form-control text-center" value="${data.row.qty}"></td>
                              <td><span class="brdel" style="cursor:pointer;"><i class="fas fa-times text-danger"></i></span></td>
                            </tr>`;
                    $("tbody").empty().append(tr_html);
                    i++;
                });
            });
        }
    }

    /* ----------------------
     * Delete Row Method
     * ---------------------- */
    $(document).on("click", ".brdel", function () {
        var row = $(this).closest("tr");
        var item_id = row.attr("data-item-id");

        alert(item_id);
        var data = JSON.parse(localStorage.getItem("britems"));

        alert(JSON.stringify(data));

        data.splice(item_id, item_id);
        localStorage.setItem("britems", JSON.stringify(data));
        delete britems[item_id];

        row.remove();
        if (britems.hasOwnProperty(item_id)) {
        } else {
            localStorage.setItem('britems', JSON.stringify(britems));
            loadItems();
            return;
        }
    });

    $("#add_item").autocomplete({
        source: function (request, response) {
            let term = request.term;
            $.ajax({
                type: "GET",
                url: `<?= admin_url('borrowers/get_data/${term}'); ?>`,
                dataType: "json",
                success: function (data) {
                    $(this).removeClass("ui-autocomplete-loading");
                    response(data);
                },
            });
            // var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
            // response( $.grep( tags, function( item ){
            //     return matcher.test( item );
            // }) );
        },

        minLength: 1,
        autoFocus: false,
        delay: 250,
        response: function (event, ui) {
            if ($(this).val().length >= 16 && ui.content[0].id == 0) {
                $("#add_item").focus();
                $(this).removeClass("ui-autocomplete-loading");
                $(this).removeClass("ui-autocomplete-loading");
                $(this).val("");
            } else if (ui.content.length == 1 && ui.content[0].id != 0) {
                ui.item = ui.content[0];
                $(this)
                    .data("ui-autocomplete")
                    ._trigger("select", "autocompleteselect", ui);
                $(this).autocomplete("close");
                $(this).removeClass("ui-autocomplete-loading");
            } else if (ui.content.length == 1 && ui.content[0].id == 0) {
                $(this).removeClass("ui-autocomplete-loading");
                $(this).val("");
            }
        },
        select: function (event, ui) {
            event.preventDefault();
            if (ui.item.id !== 0) {
                // alert(ui.item.id);
                var row = add_item(ui.item);
                if (row) {
                    $(this).val("");
                }
            } else {
                alert("no_data");
            }
        },
    });

    // add item to local storage
    function add_item(item) {
        if (count == 1) {
            britems = {};
            // if ($('#bstudent').val()) {
            //     $('#bstudent').select2('readonly', true);
            // } else {

            //   alert('select_student_above');
            //     // bootbox.alert(lang.select_above);
            //     // item = null;
            //     return;
            // }
        }

        if (item == null) return;

        // var item_id = site.settings.item_addition == 1 ? item.item_id : item.id;
        var item_id = item.id;

        if (britems[item_id]) {
            var new_qty = parseFloat(britems[item_id].row.qty) + 1;
            britems[item_id].row.base_quantity = new_qty;
            britems[item_id].row.qty = new_qty;
        } else {
            britems[item_id] = item;
        }
        britems[item_id].order = new Date().getTime();

        // var britem = localStorage.getItem('britems');
        // britem = britem ? JSON.parse(britem) : [];
        // britem.push(britems);
        // localStorage.setItem('britems', JSON.stringify(britem));
        additemToStorage(britems);
        loadItems();
        return true;
    }

    //Add items to local storgae
    const additemToStorage = (item) => {
        const itemsFromStorage = getItemfromStorage();

        //Add new item to array
        itemsFromStorage.push(item);

        //Convert To JSON String and set to local storgae
        localStorage.setItem("britems", JSON.stringify(itemsFromStorage));
    };

    //Get Items from local storage
    const getItemfromStorage = () => {
        let itemsFromStorage;
        if (localStorage.getItem("britems") === null) {
            //"items" is set as key name
            itemsFromStorage = [];
        } else {
            itemsFromStorage = JSON.parse(localStorage.getItem("britems"));
        }
        return itemsFromStorage;
    };
});
