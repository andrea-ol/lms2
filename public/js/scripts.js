/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled'); 
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }
    
    document.getElementById('back-button').addEventListener('click', function() {
       
        window.history.back(); // Regresa a la página anterior
    });
    // Datatable vista resultadoap
    new DataTable('#example', {
       
            colReorder: true,
            responsive: true,
        initComplete: function () {
            this.api()
                .columns()
                .every(function () {
                    let column = this;
     
                    // Create select element
                    let select = document.createElement('select');
                    select.add(new Option(''));
                    column.footer().replaceChildren(select);
     
                    // Apply listener for user change in value
                    select.addEventListener('change', function () {
                        column
                            .search(select.value, {exact: true})
                            .draw();
                    });
     
                    // Add list of options
                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function (d, j) {
                            select.add(new Option(d));
                        });
                });
        }
    });
    /*cambiará el color del texto a verde cuando el cursor esté sobre los enlaces y 
        volverá al color predeterminado cuando se retire el cursor. 
        ubicacion en header de navbar-brand ps-4.*/
        const links = document.querySelectorAll('.navbar-brand a');


        links.forEach(link => {
            link.addEventListener('mouseenter', () => {
                link.style.color = '#39a900';
            });


            link.addEventListener('mouseleave', () => {
                link.style.color = ''; // Revertir al color predeterminado
            });
        });
        /*cambiará el color del texto a verde cuando el cursor esté sobre los enlaces y 
        volverá al color predeterminado cuando se retire el cursor. 
        ubicacion en id="zajuna-link" class="navbar-brand ps-5"*/
        const zajunaLink = document.getElementById('zajuna-link');


        zajunaLink.addEventListener('mouseenter', () => {
            zajunaLink.style.color = '#39a900';
        });


        zajunaLink.addEventListener('mouseleave', () => {
            zajunaLink.style.color = ''; // Revertir al color predeterminado
        });
});
