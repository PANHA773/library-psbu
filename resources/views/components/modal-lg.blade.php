<script src="{{asset('plugins/barcode_qrcode.min.js')}}"></script>

<div class="modal fade print-area" id="modal-lg">
  <!-- WATERMARK -->
    <div class="watermark">
        LIBRARY SYSTEM<br>
        CHOU CHAMNAN
    </div>

    <div class="print-stamp">
    OFFICIAL LIBRARY<br>
    2025
</div>

    <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="row">
          <div class="col-md-6 p-2" ><span class="modal-title" style="padding-left: 10px;"></span></div>
          <div class="col-md-6">
            <button type="button" class="close no-print float-end p-2" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        </button>
      <div class="modal-body" id="modalContent"></div>
      
      <div class="no-print row p-1">
        <div class="col-md-3">
          <button type="button" id="print_lable_url" class="btn btn-success btn-sm w-100">{{__('admin.print_barcode')}} <i class="fas fa-print"></i></button>
        </div>
        <div class="col-md-3">
          <button type="button" id="downloadPdf" class="btn btn-danger btn-sm w-100">{{__('admin.downloads')}} <i class="fas fa-download"></i></button>
        </div>
        <div class="col-md-3">
          <a href="#" class="btn btn-primary btn-sm w-100">{{__('admin.edit')}} <i class="fas fa-edit"></i></a>
        </div>
        <div class="col-md-3">
          <button type="button" class="btn btn-secondary btn-sm w-100" onclick="window.print()">{{__('admin.print')}} <i class="fas fa-print"></i></button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
  document.getElementById("downloadPdf").addEventListener("click", function () {
    const modal = document.getElementById("modalContent");

    html2canvas(modal).then(canvas => {
        const imgData = canvas.toDataURL("image/png");
        const pdf = new jspdf.jsPDF("p", "mm", "a4");

        const width = pdf.internal.pageSize.getWidth();
        const height = canvas.height * width / canvas.width;
        const file_name = new Date();
      

        pdf.addImage(imgData, "PNG", 0, 0, width, height);
        pdf.save(file_name + ".pdf");
    });
});
</script>