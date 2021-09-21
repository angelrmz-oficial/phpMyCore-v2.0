'use strict';


app.config({

  autoload: true,

  provide: [],

  googleApiKey: '',

  googleAnalyticsId: '',

  smoothScroll: true,

  saveState: false,

  cacheBust: '',


});

function getVisitorsData(){
  var value = $.ajax({ 
      url: 'json.visitorsdata.php', 
      async: false
  }).responseText;
  return value;
}


// Codes to be execute when all JS files are loaded and ready to use
//
app.ready(function() {

  // Page: index.html
  // Earnings chart
  //
  if ( window['Chart'] != undefined ) {
    
    $.getJSON("json.visitorsdata.php", function( datapoints ) {
      new Chart($("#chartjs-earnings"), {
        type: 'line',
        data: {
          labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
          datasets: [
            {
              label: "Visitantes",
              backgroundColor: "rgba(51,202,185,0.5)",
              borderColor: "rgba(51,202,185,0.5)",
              pointRadius: 0,
              data: datapoints
            }
          ]
        },
        options: {
          legend: {
            display: false
          },
        }
      });
    });
  
  }

/*,
            {
              label: "Payments",
              backgroundColor: "rgba(243,245,246,0.8)",
              borderColor: "rgba(243,245,246,0.8)",
              pointRadius: 0,
              data: [0,1,0,0,0,0,0,0,0,0,0,0]
            }*/

  // Page: invoices.html
  // Add a new item row in "create new invoice"
  //
  $(document).on('click', '#btn-new-item', function() {
    var html = '' +
        '<div class="form-group input-group flex-items-middle">' +
          '<select title="Item" data-provide="selectpicker" data-width="100%">' +
            '<option>Website design</option>' +
            '<option>PSD to HTML</option>' +
            '<option>Website re-design</option>' +
            '<option>UI Kit</option>' +
            '<option>Full Package</option>' +
          '</select>' +
          '<div class="input-group-input">' +
            '<input type="text" class="form-control">' +
            '<label>Quantity</label>' +
          '</div>' +
          '<a class="text-danger pl-12" id="btn-remove-item" href="#" title="Remove" data-provide="tooltip"><i class="ti-close"></i></a>' +
        '</div>';

    $(this).before(html);
  });


  // Page: invoices.html
  // Remove an item row in "create new invoice"
  //
  $(document).on('click', '#btn-remove-item', function() {
    $(this).closest('.form-group').fadeOut(function(){
      $(this).remove();
    });
  });



});
