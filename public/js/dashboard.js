
function toggleModal(n, e=null)
{
	const modal = $('.modal-'+n);

	modal.toggleClass('opacity-0');
	modal.toggleClass('pointer-events-none');
	$('body').toggleClass('modal-active-'+n);

	if(e){
		// Customization for modal 0 ( Add task )
		if(n == 0)
			$('#list_id').val(e.currentTarget.getAttribute('data-list-id'));

		// Customization for modal 2 ( Edit task )
		if(n == 2){
			$('#edittask').val($(e.target.parentNode).find('span').text());
			$('#task_id').val(e.currentTarget.getAttribute('data-task-id'));
		}

		// Customization for modal 3 ( Edit list ) 
		if(n == 3){
			$('#editlist').val($(e.currentTarget.parentNode).find('strong').text());
			$('#editlist_id').val(e.currentTarget.getAttribute('data-list-id'));
		}

		// Customization for modal 4 ( Delete task )
		if(n == 4)
			$('#deletetask_id').val(e.currentTarget.getAttribute('data-task-id'));

		// Customization for modal 5 ( Delete list )
		if(n == 5)
			$('#deletelist_id').val(e.currentTarget.getAttribute('data-list-id'));
	}

	modal.find('form').find('input[autofocus]').focus();
}

function addEventListeners()
{
	const modalAmount = 6; // Amount of modals used in this page.

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

	$('#status').click(function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			method: 'POST',
			url: 	'/tasks/status',
			data: {
				'task_id': $(this).attr('data-task-id'),
				'status': ($(this).text().includes('actief')) ? 'voltooid' : 'actief'
			},
			success: function(result){
				window.location.reload();
			},
			error: function(e){
				console.error(e);
			}
		})
	});
}


$(document).ready(function(){

	addEventListeners();
});
