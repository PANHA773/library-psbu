@extends(admin_layout('layouts.app'))
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.add_attendance')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.add_attendance')}}</li>
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
              <form id="quickForm" action="{{ admin_url('attendances') }}" method="POST">
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
                                <input type="text" name="reference_no" class="form-control" id="reference_no"  placeholder="Enter reference_no">
                            </div>
                        </div>
                        
                        <div class="col-md-12 mb-4 mt-4">
                          <div class="card">
                            <div class="form-group  m-2">
                              <div class="input-group">
                              <span class="input-group-text" id="books"><i class="fas fa-qrcode" style="font-size: 30px;"></i></span>
                              <input type="text" name="attendance_data" id="add_attendance" class="form-control form-control-lg border-none" placeholder="Enter ID Student" aria-describedby="attendance" autofocus>
                            </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <h4>{{__('admin.students')}}</h4>
                          <div class="">
                            <table class="table table-striped table-bordered no-print text-center">
                              <thead class="bg-primary">
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">{{__('admin.code')}}</th>
                                  <th scope="col">{{__('admin.name')}}</th>
                                  <th scope="col">{{__('admin.gender')}}</th>
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
var student = JSON.parse(localStorage.getItem("student_attendances")) || {};
$(document).ready(function () {
    if (localStorage.getItem("student_attendances")) {
        loadItems();
    }

    function loadItems() {
        if (localStorage.getItem("student_attendances")) {
            // britems = JSON.parse(localStorage.getItem("britems"));
            var tr_html = "";
            let i = 1;
            $.each(student, function (index, data) {

              // alert(data);
              tr_html += `<tr id="row_${index}" class="row_${index}" data-item-id="${index}">
                        <th scope="row">${i}</th>
                        <input type="hidden" value="${data.row.id}" name="student_id[]" id="student_id">
                        <input type="hidden" value="${data.row.code}" name="student_code[]" id="student_code[]">
                        <td>${data.row.code}</td>
                        <td>${data.row.first_name + ' ' + data.row.last_name} <input type="hidden" value="${data.row.first_name}" name="student_name[]" id></td>
                        <td>${data.row.gender}</td>
                        <td><span class="brdel" style="cursor:pointer;"><i class="fas fa-times text-danger"></i></span></td>
                      </tr>`;
              $("tbody").empty().append(tr_html);
              i++;
            });
        }
    }


    
    /* ----------------------
     * Delete Row Method
     * ---------------------- */

    $(document).on("click", ".brdel", function () {
        var row = $(this).closest("tr");
        var item_id = row.attr("data-item-id");
        delete student[item_id];
        localStorage.setItem("student_attendances", JSON.stringify(student));
        row.remove();
        if (student.hasOwnProperty(item_id)) {
        } else {
            localStorage.setItem('student_attendances', JSON.stringify(student));
            loadItems();
            return;
        }
    });

    $("#add_attendance").autocomplete({
        source: function (request, response) {
            let code = request.term;
            $.ajax({
                type: "GET",
                url: `<?= admin_url('attendances/get_students/${code}'); ?>`,
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
                var row = add_attendance(ui.item);
                if (row) {
                    $(this).val("");
                }
            } else {
                alert("no_data");
            }
        },
    });

    // add item to local storage
    function add_attendance(item) {

      $.each(student,function(index, data) {

        if(item.student_id == data.student_id) {

          alert('Student has added already');
          item = null;
          return;
        }
      });

        if (item == null) return;

        var site = {"settings" : 0};

        var item_id = site.settings == 1 ? item.item_id : item.id;
  
        if (student[item_id]) {
            // var new_qty = parseFloat(britems[item_id].row.qty) + 1;
            // britems[item_id].row.base_quantity = new_qty;
            // student[item_id].row.qty = new_qty;
        } else {
            student[item_id] = item;
        }

        student[item_id].order = new Date().getTime();

        localStorage.setItem('student_attendances', JSON.stringify(student));
        loadItems();
        return true;
    }

});

</script>
@endsection