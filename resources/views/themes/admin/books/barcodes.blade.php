@extends(admin_layout('layouts.app'))
@section('content')

<style>
  

  .barcode .item {
    display: block;
    overflow: hidden;
    text-align: center;
    border: 1px dotted #CCC;
    font-size: 12px;
    text-transform: uppercase;
}

.barcode .style30 {
    width: 2.625in;
    height: 1in;
    margin: 0 0.07in;
    padding-top: 0.05in;
}

</style>
<div class="content-wrapper">
    <section class="content-header no-print">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.print_barcode')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.print_barcode')}}</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content no-print">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header no-print">
                <h3 class="card-title">{{__('admin.in_required')}}</h3>
              </div>
              <form id="quickForm" class="no-print" action="{{ admin_url('group_book/print_barcodes') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <input type="hidden" name="form_type" value="1">
                <div class="card-body no-print">
                    <div class="container">
                      <div class="form-group">
                        <label for="slug">{{__('admin.title')}}</label>
                        <input type="text" name="book_name" class="form-control" id="add_book" placeholder="{{__('admin.enter_title')}}" aria-describedby="books" autofocus>
                      </div>
                        <table class="table table-bordered no-print text-center">
                            <thead class="bg-primary">
                              <th>{{__('admin.book_name')}} ({{__('admin.book_barcode')}})</th>
                              <th>{{__('admin.quantity')}}</th>
                              <th width="20px"><i class="fas fa-trash"></i></th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="container mx-5">
                  <span>{{__('admin.print')}} : </span>
                  <div class="row">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="site_name" name="site_name" <?= $site_name ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="site_name">
                      {{__('admin.site_name')}}
                    </label>
                    </div>
                    
                    <div class="form-check mx-2">
                    <input class="form-check-input" type="checkbox" value="1" id="product_name" name="product_name"  <?= $product_name ? 'checked' : ''; ?>>
                    <label class="form-check-label px-2" for="product_name" >
                      {{__('admin.product_name')}} 
                    </label>
                    </div>

                    <div class="form-check mx-2">
                    <input class="form-check-input" type="checkbox" value="1" id="product_price" name="product_price" <?= $product_price ? 'checked' : ''; ?> >
                    <label class="form-check-label px-2" for="product_price">
                     {{__('admin.product_price')}}
                    </label>
                    </div>

                  </div>
                  <button type="button" class="btn btn-primary btn-block mb-2" onclick="window.print(); return false;">{{__('admin.print')}}</button>
                </div>
                <div class="card-footer  no-print">
                  <button type="submit" class="btn btn-primary">{{__('admin.update')}}</button>
                  <button type="button" class="btn btn-danger" id="reset_item">{{__('admin.reset')}}</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="container barcode">
        @if($barcodes)
            <div class="row">
                @foreach($barcodes as $barcode)
                    @for($i = 0; $i < $barcode['quantity']; $i++)
                        <div class="col-3 p-2">
                            <div class="text-center p-1 rounded barcode-container item style30 " style="height: 160px; border-style:dotted; border-color: gray">
                               @if($site_name)
                               <span style="display:block; font-size: 14px; margin-bottom: 0px;">{{ $settings->site_name }}</span>
                               @endif
                               @if($product_name)
                                <span style="display:block; font-size: 14px; margin-bottom: 0px;">{{ $barcode['book_name'] }}</span>
                                @endif
                                <img style="width: 130px; height: 50px; object-fit: contain;" 
                                    src="data:image/png;base64,{!! DNS1D::getBarcodePNG($barcode["barcode"], $barcode["barcode_symbol"],1) !!}" 
                                    alt="barcode" />
                                <span style="display:block; font-size: 12px; margin-top: 0px;">{{ $barcode['barcode'] }}</span>
                                @if($product_price)
                                <span style="display:block; font-size: 12px; margin-top: 0px;">{{ $barcode['price'] }}</span>
                                @endif
                            </div>
                        </div>
                    @endfor
                @endforeach
            </div>
        @endif
    </div>
  </div>
</div>

<script>
  var count=1,bitems=JSON.parse(localStorage.getItem("bitems"))||{};$(document).ready((function(){function t(){if(localStorage.getItem("bitems")){var t="";let e=1;$.each(bitems,(function(o,i){t+=`<tr id="row_${o}" class="row_${o}" data-item-id="${o}">\n                        <input type="hidden" value="${i.row.id}" name="book_id[]" id="book_id">\n                        <input type="hidden" value="${i.row.code}" name="book_code[]" id="book_code[]">\n                        <td>${i.row.title} (${i.row.code})</td>\n                        <td><input type="text" name="quantity[]" class="form-control text-center rquantity" value="${i.row.qty}" data-id="${o}" data-item="${o}" id="quantity_${o}" onclick="this.select()">\n                          </td>\n                        <td><span class="brdel" style="cursor:pointer;"><i class="fas fa-times text-danger"></i></span></td>\n                      </tr>`,$("tbody").empty().append(t),e++}))}}localStorage.getItem("bitems")&&t(),$(document).on("focus",".rquantity",(function(){$(this).val()})).on("change",".rquantity",(function(){var e=$(this).closest("tr"),o=e.attr("data-item-id"),i=parseFloat($(this).val());o=e.attr("data-item-id");bitems[o].row.qty=i,localStorage.setItem("bitems",JSON.stringify(bitems)),t()})),$(document).on("click",".brdel",(function(){var e=$(this).closest("tr"),o=e.attr("data-item-id");if(delete bitems[o],localStorage.setItem("bitems",JSON.stringify(bitems)),e.remove(),!britems.hasOwnProperty(o))return localStorage.setItem("bitems",JSON.stringify(bitems)),void t()})),$(document).on("click","#reset_item",(function(){alert("Do you delete clear item?"),localStorage.getItem("bitems")&&(localStorage.removeItem("bitems"),t(),window.location.reload(!0))})),$("#add_book").autocomplete({source:function(t,e){let o=t.term;$.ajax({type:"GET",url:`<?= admin_url('group_book/get_book_data/${o}'); ?>`,dataType:"json",success:function(t){$(this).removeClass("ui-autocomplete-loading"),e(t)}})},minLength:1,autoFocus:!1,delay:250,response:function(t,e){$(this).val().length>=16&&0==e.content[0].id?($(this).removeClass("ui-autocomplete-loading"),$(this).removeClass("ui-autocomplete-loading"),$(this).val("")):1==e.content.length&&0!=e.content[0].id?(e.item=e.content[0],$(this).data("ui-autocomplete")._trigger("select","autocompleteselect",e),$(this).autocomplete("close"),$(this).removeClass("ui-autocomplete-loading")):1==e.content.length&&0==e.content[0].id&&($(this).removeClass("ui-autocomplete-loading"),$(this).val(""))},select:function(e,o){(e.preventDefault(),0!==o.item.id)?function(e){if(null==e)return;var o=e.id;if(bitems[o]){var i=parseFloat(bitems[o].row.qty)+1;bitems[o].row.qty=i}else bitems[o]=e;return bitems[o].order=(new Date).getTime(),localStorage.setItem("bitems",JSON.stringify(bitems)),t(),!0}(o.item)&&$(this).val(""):alert("no_data")}})}));
</script>
@endsection