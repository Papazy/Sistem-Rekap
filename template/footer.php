

<footer class="bg-light mt-auto border" style="padding-top: 12px; padding-bottom: 12px;">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; BIDTIK POLDA ACEH <?= date('Y') ?></div>
        </div>
    </div>
</footer>
</div>
</div>



<!-- DataTables -->
<!-- <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script> -->

<!-- DataTables Buttons -->
<!-- <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script> -->

<!-- JSZip -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script> -->

<!-- PDFMake -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script> -->

<!-- DataTables Buttons HTML5 Export -->
<!-- <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script> -->

<!-- DataTables Buttons Print -->
<!-- <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">


</script>
<script src="<?= $main_url ?>asset/sb-admin/js/scripts.js"></script>
<script src="<?= $main_url ?>asset/sb-admin/js/datatables-simple-demo.js"></script>
<!-- <script src="<?= $main_url ?>asset/sb-admin/js/datatables-net.js"></script> -->


<!-- <!SCRIPTT TABELL --> -->
<script>
const tableWithSetting = new DataTable("#example", {
    title: "Capaian Evaluasi Polres",
    layout: {
        topStart: {
            buttons: [{
                    extend: "copy",
                    customize: function(doc) {
                        doc.title = "Capaian Evaluasi Polres";
                    },
                },
                {
                    extend: "csv",
                    customize: function(csv) {
                        csv.header = "Capaian Evaluasi Polres\n"; // Judul untuk CSV
                    },
                },
                {
                    extend: "excel",
                    title: "Capaian Evaluasi Polres", // Judul untuk Excel
                },
                {
                    extend: "pdfHtml5",
                    title: "Capaian Evaluasi Polres", // Judul untuk ekspor PDF
                    exportOptions: {
                        columns: ":not(:last-child)", // Exclude the last column (Setting)
                    },
                },
                {
                    extend: "print",
                    title: "", // Judul untuk ekspor print
                    messageTop: function() {
                        <?php if(isset($headerTable)){?>
                        return "<h4><center><?=$headerTable?></center></h4>";
                        <?php }else{?>
                        return "Capaian Evaluasi Polres";
                        <?php }?>
                    },
                    exportOptions: {
                        columns: ":not(:last-child)", // Exclude the last column (Setting)
                    },
                    
                }
            ],
        },
    },
    columnDefs: [{
        searchable: false,
        orderable: false,
        targets: 0,
    }, ],
    order: [
        [1, "asc"]
    ],
});

tableWithSetting
    .on("order.dt search.dt", function() {
        let i = 1;

        tableWithSetting
            .cells(null, 0, {
                search: "applied",
                order: "applied"
            })
            .every(function(cell) {
                this.data(i++);
            });
    })
    .draw();

// Tabel
const tableWithNoSetting = new DataTable("#exampleNoSetting", {
    title: "Capaian Evaluasi Polres",
    layout: {
        topStart: {
            buttons: [{
                    extend: "copy",
                    title: "Capaian Evaluasi Polres", // Judul untuk ekspor Copy
                },
                {
                    extend: "csv",
                    title: "Capaian Evaluasi Polres", // Judul untuk ekspor CSV
                },
                {
                    extend: "excel",
                    title: "Capaian Evaluasi Polres", // Judul untuk ekspor Excel
                },
                {
                    extend: "pdfHtml5",
                    title: "Capaian Evaluasi Polres", // Judul untuk ekspor PDF
                    exportOptions: {
                        columns: ":not(:last-child)", // Exclude the last column (Setting)
                    },
                },
                {
                    extend: "print",
                    title: "", // Judul untuk ekspor print
                    messageTop: function() {
                        <?php if(isset($headerTable)){?>
                        return "<h4><center><?=$headerTable?></center></h4>";
                        <?php }else{?>
                        return "Capaian Evaluasi Polres";
                        <?php }?>
                    },
                    exportOptions: {
                        columns: ":not(:last-child)", // Exclude the last column (Setting)
                    },
                    
                }
            ]
        },
    },
    columnDefs: [{
        searchable: false,
        orderable: false,
        targets: 0,
    }, ],
    order: [
        [1, "asc"]
    ],
});

tableWithNoSetting
    .on("order.dt search.dt", function() {
        let i = 1;

        tableWithNoSetting
            .cells(null, 0, {
                search: "applied",
                order: "applied"
            })
            .every(function(cell) {
                this.data(i++);
            });
    })
    .draw();
</script>

</body>

</html>