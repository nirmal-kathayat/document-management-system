$(document).ready(function(){
	const profileBtn = $('.profile-wrapper')
	const profileDropdown = $('.profile-dropdown')
	profileBtn.on('click',function(){
		if($(this).hasClass('active')){
			$(this).removeClass('active')
			profileDropdown.slideUp()
		}else{
			$(this).addClass('active')
			profileDropdown.slideDown()
		}
	})

	const modalCloseBtn = $('.modal-cancel')
	const modalOk = $('.confrim-ok')
	const target = $('.confirmation-modal')
	modalCloseBtn.on('click',function(){
		target.fadeOut()
		modalOk.removeAttr('href',href)
	})

	$(document).on('click','.confirm-modal-open',function(e){
		e.preventDefault()
		const href=$(this).attr('href')
		modalOk.attr('href',href)
		target.fadeIn()
	})
})