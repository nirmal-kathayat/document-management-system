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
})