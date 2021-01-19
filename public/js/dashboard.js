
function toggleModal()
{
	const modal = $('.modal');

	modal.toggleClass('opacity-0');
	modal.toggleClass('pointer-events-none');
	$('body').toggleClass('modal-active');

	$('#task').focus();
}

function addEventListeners()
{
	// Show List form
	$('#add_list').click(function(){
		$('form[data-form="list_form"]').toggleClass('hidden');
		$('#list').focus();
	});

	// Toggle modal by click
	$('.modal-open, .modal-overlay, .modal-close').click(function(e){
		$('#list_id').val(e.target.getAttribute('data-list-id'));
		toggleModal();
	});

	// Toggle modal by key
	$(document).keydown(function(e){
		if (e.key == 'Escape' && $('body').hasClass('modal-active'))
			toggleModal();
	});

	// Submit task
	$('#add_task').click(function(){
		$('#task_form').submit();
	});
}


$(document).ready(function(){

	addEventListeners();
});
