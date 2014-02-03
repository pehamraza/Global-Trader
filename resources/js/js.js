$(document).ready(function($) {

	var btn = $('.btn-buy');
	var btnId = $('.btn-buy').attr('id');
	$('#bankdiv').hide();
	$('#loandiv').hide();
checks();

// CHECKS
function checks(id)
{
// 1. if balance is 0 you can't buy

// else $('.btn-buy').removeClass('disabled'); // opposite 1

//2. if bought items are zero then sell button is disabled
// var cquantity = Number($('.quantity').html());
// if(cquantity==0) $('.btn-sell').addClass('disabled');
// else $('.btn-sell').removeClass('disabled');// opposite 2

var cblnc = Number($('.acc-blnc').html());

	// var qntity = Number($('#q'+id).html());
	var a=1; var b = 10
	for(a=1; a<b; a++)
		{
			var price = $('#price'+a).html();
			var quantity = Number($('#q'+a).html());
			// console.log('#price'+a);
			var name = $('#buy'+a).val();
			if(price>cblnc) {
				//console.log(price+'>'+cblnc+' = '+' #buy'+a+' ('+name+') is disabled');
				$('#buy'+a).addClass('disabled');
			}
			else{$('#buy'+a).removeClass('disabled');}

			if(quantity==0) $('#sell'+a).addClass('disabled');
		}
	
	if(cblnc<=0) $('#buy'+id).addClass('disabled');
	


	// var cblnc = Number($('.acc-blnc').html());
	// if(cblnc<=0) $('.btn-buy').addClass('disabled');
//checks end here

	
}

function update_session(id, quantity,type)
{
	$.ajax({
		url: '../../console/update_session',
		type: 'post',
		data: {post: '1', 'goodId': id, 'quantity': quantity, 'type': type},
	})
	.done(function() {
		console.log("goods owned session updated");
	})
	.fail(function() {
		console.log("error: goods owned session was not updated");
	})
	// .always(function() {
	// 	console.log("complete: goods owned session updation request complete");
	// });
	
}

function buychecks(id)
{
	var cblnc = Number($('.acc-blnc').html());
	// var qntity = Number($('#q'+id).html());
	var price = Number($('#price'+id).html());
	
	if(cblnc<=0) $('#buy'+id).addClass('disabled');
	if(price>cblnc) $('#buy'+id).addClass('disabled');
	// checks(id);
}

function sellchecks(id)
{
	var cblnc = Number($('.acc-blnc').html());
	var qntity = Number($('#q'+id).html());
	// var price = Number($('price'+id).html());
	
	if(qntity==0) $('#sell'+id).addClass('disabled');
	// if(price>cblnc) $('#buy'+id).addClass('disabled');
	// checks(id);
}

/// buy
	$('.btn-buy').click(function() {
		// buychecks(id);sellchecks(id);
		
		$('.btn-buy').preventDefault;
		var id = $(this).attr('dbid');
		// var btnid = $(this).attr('id');
		var name = $(this).val();
		var rate = $(this).attr('price');
		// buychecks(id);sellchecks(id);
		generate('div#notycontainer','Buy','success', 'You are Buying '+name+' at <h2 class="reduce_padding">$'+rate+'</h2>', 'topRight', name, rate, id);
		// checks(id);
		// buychecks(id);sellchecks(id);	
	});


/// sell
$('.btn-sell').click(function() {
		// sellchecks(id);buychecks(id);
		$('.btn-sell').preventDefault;
		var id = $(this).attr('dbid');
		var name = $(this).val();
		var rate = $(this).attr('price');
		// alert(id);
		// sellchecks(id);buychecks(id);
		generate('div#notycontainer','Sell','warning', 'You are Selling '+name+' at <h2 class="reduce_padding">$'+rate+'</h2>', 'topRight', name, rate, id);
		// sellchecks(id);buychecks(id);
		// checks(id);
	});


$('#btn-bank').click(function(){
	$('#btn-bank').preventDefault;
	$('#bankdiv').toggle(400);
	checks();
});


$('#btn-loan').click(function(){
	$('#btn-loan').preventDefault;
	$('#loandiv').toggle(400);
	checks();
});


function update_acc_blnc(blnc)
{
	$.ajax({
		url: '../../console/update_acc_blnc/'+blnc,
		type: 'POST',
	})
	.done(function() {
		console.log("blnc update success");
	})
	.fail(function() {
		console.log("blnc update error");
	})
	// .always(function() {
	// 	console.log("blnc update complete");
	// });
	
}



function generate(container, transaction_type, type, message, layout, name, rate, id) {
var tt2 = null;
var previous = $('#bought_items').html();
var previous = $('#bought_items').html();
previous = Number(previous);
var blnc = $('.acc-blnc').html();
blnc = Number(blnc);	

var quantity = $('#q'+id).html();
quantity = Number(quantity);

if(transaction_type=='Sell')tt2='Sold'; else tt2 = 'Bought';
	
        var n = $(container).noty({
            text        : message,
            type        : 'alert',
            dismissQueue: true,
            layout      : layout,
            theme       : 'defaultTheme',
			killer: true,
             animation: {
                open: {height: 'toggle'},
                close: {height: 'toggle'},
                // easing: 'swing',
                speed: 250 // opening & closing animation speed
            },

            buttons     : [
                {addClass: 'btn btn-primary', text: 'Go Ahead', onClick: function ($noty) {
                    $noty.close();
                    $('#notylog').noty({dismissQueue: true,
                     force: false, layout: 'topCenter', 
                     theme: 'defaultTheme', 
                     timeout: 2200,
				    force: false, 
				    maxVisible: 10,
				    // closeWith: ['hover'],
                     text: '1 '+name+' '+tt2+' for $'+rate,
                      type: type,
                       callback: {
							       afterShow: function() {checks(id);}
							    },
                     animation: {
	                       open: {height: 'toggle'},
					        close: {height: 'toggle'},
					        easing: 'swing',
					        speed: 500 // opening & closing animation speed
					    }}
                     );
//START SELLING
if(transaction_type=='Sell')
{
                    //wagon
                    $('#bought_items').html(previous-1);

                    //reducing balance
                    blnc = blnc + Number(rate);
                    $('.acc-blnc').html(blnc);
                    update_acc_blnc(blnc);
                    quantity = Number(quantity) - 1;
                    // console.log('quantity before session:'+quantity)
                     $('#q'+id).html(quantity);

                     update_session(id, quantity,'1');

			        // $('#sell'+id).removeClass('disabled');

}
//ENDS SELLING 

//START BUYING
else{
                    //wagon
                    $('#bought_items').html(previous+1);

                    //reducing balance
                    blnc = blnc - rate;
                    $('.acc-blnc').html(blnc);
                    update_acc_blnc(blnc);
			        quantity = Number(quantity) + 1;

                     $('#q'+id).html(quantity);

                     update_session(id, quantity,'0');
			        $('#sell'+id).removeClass('disabled');

}
//ENDS BUYING 
                   
                }
                },
                 {addClass: 'btn btn-info', text: transaction_type+' 10', onClick: function ($noty) {
                    $noty.close();
                    var total = rate*10;
                    $('#notylog').noty({dismissQueue: true,
                     force: false, layout: 'topCenter', 
                     theme: 'defaultTheme', 
                     timeout: 2200,
				    force: false, 
				    maxVisible: 10,
				    // closeWith: ['hover'],
                     text: '10 '+name+' '+tt2+' for $'+total+' @ $'+rate, 
                     type: type,
                     animation: {
	                       open: {height: 'toggle'},
					        close: {height: 'toggle'},
					        easing: 'swing',
					        speed: 500 // opening & closing animation speed
					    }}
                     );
                }
                },
                {addClass: 'btn btn-warning', text: transaction_type+' All', onClick: function ($noty) {
                    $noty.close();
                    var total = rate*10;
                    $('#notylog').noty({dismissQueue: true,
                     force: false, layout: 'topCenter', 
                     theme: 'defaultTheme',
                     timeout: 2200,
				    force: false, 
				    maxVisible: 10,
				    // closeWith: ['hover'], 
                     text: '10 '+name+' '+tt2+' for $'+total+' @ $'+rate, 
                      type: type,
                     animation: {
	                       open: {height: 'toggle'},
					        close: {height: 'toggle'},
					        easing: 'swing',
					        speed: 500 // opening & closing animation speed
					    }}
                     );
                }
                },
                {addClass: 'btn btn-danger', text: 'Cancel', onClick: function ($noty) {
                    $noty.close();
                    // noty({dismissQueue: true, force: false, layout: 'topCenter', theme: 'defaultTheme', text: 'You clicked "Cancel" button', type: 'error'});
                }
                }
            ]
        });
        // console.log('html: ' + n.options.id);
    }


    ////// document.ready ends here
});
