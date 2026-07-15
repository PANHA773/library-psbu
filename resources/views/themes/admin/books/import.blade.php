@extends(admin_layout('layouts.app'))
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.import_book')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.import_book')}}</li>
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
              <div class="card-header no-print">
                <h3 class="card-title">{{__('admin.add_update_by_csv')}}</h3>
              </div>
              <div class="container-fluid border bg-slate-200">
                <p class="m-2">
                  The first line in downloaded csv file should remain as it is. Please do not change the order of columns.
                  <a href="{{ asset('files/books.csv') }}" class="btn btn-primary float-end"><i class="fas fa-download pr-2"></i>{{__('admin.download')}}</a>
                  <p class="text-sky-400 m-2">The correct column order is (code, title, slug, image, author, author_date, created_by) & you must follow this.</p>
                  <span class="m-2">
                    Please make sure the csv file is UTF-8 encoded and not saved with byte order mark (BOM).
                  </span>
                  <span class="m-2">
                    The images should be uploaded in assets/uploads/ folder and thumbnails with same name as csv to assets/uploads/thumbs/
                  </span>
                </p>
                <p class="m-2">
                  System will check if the code belong to any product then will update that product otherwise will add new product.
                </p>
                
              </div>
              <form id="quickForm" action="{{ admin_url('group_book/import_by_csv') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card-body no-print">
                    <div class="container-fluid">
                      <div class="form-group">
                        <label for="slug">{{__('admin.upload_file')}}</label>
                        <input type="file" name="import_file" class="form-control" id="import_file" placeholder="{{__('admin.import_file')}}" accept=".csv,.xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/csv">
                      </div>
                
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary no-print"><i class="fas fa-upload pr-2"></i>{{__('admin.import')}}</button>
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
  var count=1,bitems=JSON.parse(localStorage.getItem("bitems"))||{};$(document).ready((function(){function t(){if(localStorage.getItem("bitems")){var t="";let e=1;$.each(bitems,(function(o,i){t+=`<tr id="row_${o}" class="row_${o}" data-item-id="${o}">\n                        <input type="hidden" value="${i.row.id}" name="book_id[]" id="book_id">\n                        <input type="hidden" value="${i.row.code}" name="book_code[]" id="book_code[]">\n                        <td>${i.row.title} (${i.row.code})</td>\n                        <td><input type="text" name="quantity[]" class="form-control text-center rquantity" value="${i.row.qty}" data-id="${o}" data-item="${o}" id="quantity_${o}" onclick="this.select()">\n                          </td>\n                        <td><span class="brdel" style="cursor:pointer;"><i class="fas fa-times text-danger"></i></span></td>\n                      </tr>`,$("tbody").empty().append(t),e++}))}}localStorage.getItem("bitems")&&t(),$(document).on("focus",".rquantity",(function(){$(this).val()})).on("change",".rquantity",(function(){var e=$(this).closest("tr"),o=e.attr("data-item-id"),i=parseFloat($(this).val());o=e.attr("data-item-id");bitems[o].row.qty=i,localStorage.setItem("bitems",JSON.stringify(bitems)),t()})),$(document).on("click",".brdel",(function(){var e=$(this).closest("tr"),o=e.attr("data-item-id");if(delete bitems[o],localStorage.setItem("bitems",JSON.stringify(bitems)),e.remove(),!britems.hasOwnProperty(o))return localStorage.setItem("bitems",JSON.stringify(bitems)),void t()})),$(document).on("click","#reset_item",(function(){alert("Do you delete clear item?"),localStorage.getItem("bitems")&&(localStorage.removeItem("bitems"),t(),window.location.reload(!0))})),$("#add_book").autocomplete({source:function(t,e){let o=t.term;$.ajax({type:"GET",url:`<?= admin_url('group_book/get_book_data/${o}'); ?>`,dataType:"json",success:function(t){$(this).removeClass("ui-autocomplete-loading"),e(t)}})},minLength:1,autoFocus:!1,delay:250,response:function(t,e){$(this).val().length>=16&&0==e.content[0].id?($(this).removeClass("ui-autocomplete-loading"),$(this).removeClass("ui-autocomplete-loading"),$(this).val("")):1==e.content.length&&0!=e.content[0].id?(e.item=e.content[0],$(this).data("ui-autocomplete")._trigger("select","autocompleteselect",e),$(this).autocomplete("close"),$(this).removeClass("ui-autocomplete-loading")):1==e.content.length&&0==e.content[0].id&&($(this).removeClass("ui-autocomplete-loading"),$(this).val(""))},select:function(e,o){(e.preventDefault(),0!==o.item.id)?function(e){if(null==e)return;var o=e.id;if(bitems[o]){var i=parseFloat(bitems[o].row.qty)+1;bitems[o].row.qty=i}else bitems[o]=e;return bitems[o].order=(new Date).getTime(),localStorage.setItem("bitems",JSON.stringify(bitems)),t(),!0}(o.item)&&$(this).val(""):alert("no_data")}})}));
</script>
@endsection