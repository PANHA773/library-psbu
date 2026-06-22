@extends(admin_layout('layouts.app'))
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.add_book_borrowing')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.add_book_borrowing')}}</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Please fill in the information below. The field labels marked with * are required input fields.</h3>
              </div>
              <form id="quickForm" action="{{ admin_url('borrowers') }}" method="POST">
                @csrf
                @method('POST')
                <div class="card-body">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="reference_no">{{__('admin.date')}}</label>
                            <input type="date" name="date" class="form-control" value="{{ date('Y-m-d')}}" id="date">
                        </div>
                      </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="reference_no">{{__('admin.reference_no')}}</label>
                                <input type="text" name="reference_no" class="form-control" id="reference_no"  placeholder="{{__('admin.enter_reference_no')}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                              <label for="bstudent">{{__('admin.students')}}</label>
                              <input type="hidden" name="student_id" id="sselected">
                              <select class="form-control select2" id="bstudent" style="width: 100%;">
                                <option value="" disabled selected>{{__('admin.select_student')}}</option>
                                @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->first_name.' '. $student->last_name; }}</option>
                                @endforeach
                              </select>
                          </div>
                        </div>
                        <div class="col-md-12 mb-4 mt-4">
                          <div class="card">
                            <div class="form-group  m-2">
                              <div class="input-group">
                              <span class="input-group-text" id="books"><i class="fas fa-barcode" style="font-size: 30px;"></i></span>
                              <input type="text" name="books" id="add_item" class="form-control form-control-lg border-none" placeholder="{{__('admin.search_book_here')}}" aria-describedby="books" autofocus>
                            </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <h4>{{__('admin.books')}}</h4>
                          <div class="">
                            <table class="table table-striped table-bordered no-print text-center">
                              <thead class="bg-primary">
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">{{__('admin.code')}}</th>
                                  <th scope="col">{{__('admin.title')}}</th>
                                  <th scope="col">{{__('admin.quantity')}}</th>
                                  <th scope="col"><i class="fas fa-trash"></i></th>
                                </tr>
                              </thead>
                              <tbody>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="card card-outline card-info">
                              <div class="card-header">
                                <h3 class="card-title">
                                  {{__('admin.description')}}
                                </h3>
                              </div>
                               <textarea id="summernote" name="description"></textarea>
                            </div>
                          </div>
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{__('admin.submit')}}</button>
                </div>
              </form>
            </div>
            </div>
        </div>
      </div>
    </section>
  </div>
</div>
<script>
   var count = 1;
  var britems = JSON.parse(localStorage.getItem("britems")) || {};
  var bstudent = JSON.parse(localStorage.getItem("bstudent")) || {}; 
$(document).ready(function () {
   
    if (localStorage.getItem("britems")) {
        loadItems();
    }

    $("#bstudent").change(function() {
      let student_id = $(this).val();
      $("#sselected").val(student_id);
       localStorage.setItem('bstudent', JSON.stringify(student_id));
    });

    function loadItems() {
        if (localStorage.getItem("britems")) {
            // britems = JSON.parse(localStorage.getItem("britems"));
            
            var tr_html = "";
            let i = 1;

            console.log(JSON.stringify(britems));

            $.each(britems, function (index, data) {
              tr_html += `<tr id="row_${index}" class="row_${index}" data-item-id="${index}">
                        <th scope="row">${i}</th>
                        <input type="hidden" value="${data.row.id}" name="book_id[]" id="book_id">
                        <input type="hidden" value="${data.row.code}" name="book_code[]" id="book_code[]">
                        <td>${data.row.code}</td>
                        <td>${data.row.title} <input type="hidden" value="${data.row.title}" name="book_name[]" id></td>
                        <td><input type="text" name="quantity[]" class="form-control text-center rquantity" value="${data.row.qty}" data-id="${index}" data-item="${index}" id="quantity_${index}" onclick="this.select()">
                          </td>
                        <td><span class="brdel" style="cursor:pointer;"><i class="fas fa-times text-danger"></i></span></td>
                      </tr>`;
              $("tbody").empty().append(tr_html);
              i++;
            });
        }
    }


    /* --------------------------
     * Edit Row Quantity Method
    --------------------------- */
    var old_row_qty;
    $(document).on('focus', '.rquantity', function () {
            old_row_qty = $(this).val();
        })
        .on('change', '.rquantity', function () {
            var row = $(this).closest('tr');
            var item_id = row.attr('data-item-id');
            // if (!is_numeric($(this).val())) {
            //     // $(this).val(old_row_qty);
            //     alert('unexpected_value');
            //     // bootbox.alert(lang.unexpected_value);
            //     return;
            // }
            var new_qty = parseFloat($(this).val()),
                item_id = row.attr('data-item-id');
            britems[item_id].row.qty = new_qty;
            localStorage.setItem('britems', JSON.stringify(britems));
            loadItems();
        });

    /* ----------------------
     * Delete Row Method
     * ---------------------- */

    $(document).on("click", ".brdel", function () {
        var row = $(this).closest("tr");
        var item_id = row.attr("data-item-id");
        delete britems[item_id];
        localStorage.setItem("britems", JSON.stringify(britems));
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
            if (!$('#bstudent').val()) {
                $('#add_item').val('').removeClass('ui-autocomplete-loading');
                alert('select_above');
                $('#add_item').focus();
                return false;
            }
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
        },

        minLength: 1,
        autoFocus: false,
        delay: 250,
        response: function (event, ui) {
            if ($(this).val().length >= 16 && ui.content[0].id == 0) {
                // $("#add_item").focus();
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
            if ($('#bstudent').val()) {
              $("#bstudent").prop("disabled", true);
            } else {

              alert('select_student_above');
                item = null;
                return;
            }
        }
        if (item == null) return;
        var site = {"settings" : 0};
        var item_id = site.settings == 1 ? item.item_id : item.id;
        if (britems[item_id]) {
            var new_qty = parseFloat(britems[item_id].row.qty) + 1;
            // britems[item_id].row.base_quantity = new_qty;
            britems[item_id].row.qty = new_qty;
        } else {
            britems[item_id] = item;
            // alert(item_id);
            // alert(JSON.stringify(item));
            // alert(britems);
        }
        britems[item_id].order = new Date().getTime();
        // alert(JSON.stringify(britems));
        localStorage.setItem('britems', JSON.stringify(britems));
        loadItems();
        return true;
    } 
});
</script>
@endsection