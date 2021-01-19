
function toggleModal(n, e=null)
{
	const modal = $('.modal-'+n);

	modal.toggleClass('opacity-0');
	modal.toggleClass('pointer-events-none');
	$('body').toggleClass('modal-active-'+n);

	// Customization for modal 0
	if(n == 0)
		$('#list_id').val(e.target.getAttribute('data-list-id'));

	modal.find('form').find('input[autofocus]').focus();
}

function addEventListeners()
{
	const modalAmount = 2;

	// Toggle modal by click
	for(let i = 0; i < modalAmount; i++){
		$('.modal-open-'+i+', .modal-overlay-'+i+', .modal-close-'+i).click(function(e){
			toggleModal(i, e);
		});
	}

	// Toggle modal by key
	$(document).keydown(function(e){
		if (e.key == 'Escape' && $('body[class*="modal-active"]')[0]){
			let modalId = $('body').attr('class');
			modalId = modalId.slice(modalId.indexOf('modal-active-')+13,modalId.indexOf('modal-active-')+14); // 0-9 ( 10 modals max)
			toggleModal(modalId);
		}
	});

	// Submit form
	$('button[data-type="submit"]').click(function(){
		$(this).parent().parent().find('form').submit();
	});
}


$(document).ready(function(){

	addEventListeners();
});
