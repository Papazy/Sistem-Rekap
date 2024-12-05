const table = new DataTable("#example", {
  title: "Capaian Evaluasi Polres",
  layout: {
    topStart: {
      buttons: [
        {
          extend: "copy",
          customize: function (doc) {
            doc.title = "Capaian Evaluasi Polres";
          },
        },
        {
          extend: "csv",
          customize: function (csv) {
            csv.header = "Capaian Evaluasi Polres\n"; // Judul untuk CSV
          },
        },
        {
          extend: "excel",
          title: "Capaian Evaluasi Polres", // Judul untuk Excel
        },
        {
          extend: "pdf",
          title: "Capaian Evaluasi Polres", // Judul untuk PDF
        },
        {
          extend: "print",
          title: "Capaian Evaluasi Polres", // Judul untuk print
          messageTop: function () {
            return "Capaian Evaluasi Polres";
          }
        },
      ],
    },
  },
  columnDefs: [
    {
      searchable: false,
      orderable: false,
      targets: 0,
    },
  ],
  order: [[1, "asc"]],
});

table
  .on("order.dt search.dt", function () {
    let i = 1;

    table
      .cells(null, 0, { search: "applied", order: "applied" })
      .every(function (cell) {
        this.data(i++);
      });
  })
  .draw();


  const tableWithNoSetting = new DataTable("#exampleNoSetting", {
    title: "Capaian Evaluasi Polres",
    layout: {
      topStart: {
        buttons: [
          {
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
            title: "Capaian Evaluasi Polres", // Judul untuk ekspor print
            messageTop: function () {
              return "Capaian Evaluasi Polres";
            },
            exportOptions: {
              columns: ":not(:last-child)", // Exclude the last column (Setting)
            },
          },
        ],
      },
    },
    columnDefs: [
      {
        searchable: false,
        orderable: false,
        targets: 0,
      },
    ],
    order: [[1, "asc"]],
  });
  