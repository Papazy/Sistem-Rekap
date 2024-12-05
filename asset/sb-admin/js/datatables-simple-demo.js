window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        const table = new simpleDatatables.DataTable(datatablesSimple,{
            order : [1, 'asc'],
        });
    }
    
});
