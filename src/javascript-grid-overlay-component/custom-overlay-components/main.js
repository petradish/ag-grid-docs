var columnDefs = [
    {headerName: "Athlete", field: "athlete", width: 150},
    {headerName: "Age", field: "age", width: 90},
    {headerName: "Country", field: "country", width: 120},
    {headerName: "Year", field: "year", width: 90},
    {headerName: "Date", field: "date", width: 110},
    {headerName: "Sport", field: "sport", width: 110},
    {headerName: "Gold", field: "gold", width: 100},
    {headerName: "Silver", field: "silver", width: 100},
    {headerName: "Bronze", field: "bronze", width: 100},
    {headerName: "Total", field: "total", width: 100}
];

var gridOptions = {
    // set rowData to null or undefined to show loading panel by default
    rowData: null,
    columnDefs: columnDefs,
    enableColResize: true,
    enableSorting: true,
    enableFilter: true,

    components: {
        customLoadingOverlay: CustomLoadingOverlay,
        customNoRowsOverlay: CustomNoRowsOverlay
    },

    loadingOverlayComponent: 'customLoadingOverlay',
    loadingOverlayComponentParams: {
      loadingMessage: 'One moment please...'
    },
    noRowsOverlayComponent: 'customNoRowsOverlay',
    noRowsOverlayComponentParams: {
      noRowsMessageFunc: function() {
          return 'Sorry - no rows! at: ' + new Date();
      }
    }
};

function onBtShowLoading() {
    gridOptions.api.showLoadingOverlay();
}

function onBtShowNoRows() {
    gridOptions.api.showNoRowsOverlay();
}

function onBtHide() {
    gridOptions.api.hideOverlay();
}

// setup the grid after the page has finished loading
document.addEventListener('DOMContentLoaded', function() {
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);

    // do http request to get our sample data - not using any framework to keep the example self contained.
    // you will probably use a framework like JQuery, Angular or something else to do your HTTP calls.
    var httpRequest = new XMLHttpRequest();
    httpRequest.open('GET', 'https://raw.githubusercontent.com/ag-grid/ag-grid-docs/master/src/olympicWinnersSmall.json');
    httpRequest.send();
    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState === 4 && httpRequest.status === 200) {
            var httpResult = JSON.parse(httpRequest.responseText);
            gridOptions.api.setRowData(httpResult);
        }
    };
});