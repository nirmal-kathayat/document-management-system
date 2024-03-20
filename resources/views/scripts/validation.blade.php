<script>
	this.fomvalidationInitial=function(){
	let _this=this,validate=false;
	let formWrapper=$('.form-data'),
		validationControl=$('.validation-control')
	this.removeErrorEventListener=function(){
		validationControl.on('input',function(){
			$(this).removeAttr('style')
			$(this).parent().find('.validation-error').remove()
		})
		validationControl.on('change',function(){
			$(this).removeAttr('style')
			$(this).parent().find('.validation-error').remove()
		})
	}
	this.submitEventListener=function(wrapper){
		let validationGroup=wrapper.find('.validation-control[data-validation]')
		let count =0
		$('.validation-error').remove()
		validationGroup.each(function(){
			let validationAttrArr=$(this).attr('data-validation').split('|')
			let value=$(this).val()
			if(validationAttrArr.includes('required') && value==''){
				$(this).css('border','1px solid red')
				//$(this).parent().append('<p class="validation-error">This field is required</p>')
				count ++
			}
			if(validationAttrArr.includes('confirm') && value){
				let confirmInput=$('input[name="confirm_password"]')
				let password=$('input[name="password"]')

				if(confirmInput){
					if(confirmInput.val()){
						if(password.val() != confirmInput.val()){
							$(this).css('border','1px solid red')
							$(this).parent().append('<p class="validation-error">Password did not match</p>')
							count ++
						}
					}
				}
			}
		})
		return count;
		
	}
	this.init=function(){
		formWrapper.on('submit',function(e){
			 if(_this.submitEventListener($(this)) > 0){
			 	e.preventDefault()
			 }
			_this.submitEventListener($(this));
		})
		_this.removeErrorEventListener()
	}
}
let formvalidaionObj=new fomvalidationInitial()
	formvalidaionObj.init()
</script>