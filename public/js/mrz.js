
const nepalDistricts = [
"Taplejung",
"Panchthar",
"Ilam",
"Jhapa",
"Morang",
"Sunsari",
"Dhankuta",
"Terhathum",
"Sankhuwasabha",
"Bhojpur",
"Solukhumbu",
"Okhaldhunga",
"Khotang",
"Udayapur",
"Saptari",
"Siraha",
"Dhanusa",
"Mahottari",
"Sarlahi",
"Sindhuli",
"Ramechhap",
"Dolakha",
"Sindhupalchok",
"Kavrepalanchok",
"Lalitpur",
"Bhaktapur",
"Kathmandu",
"Nuwakot",
"Rasuwa",
"Dhading",
"Makwanpur",
"Rautahat",
"Bara",
"Parsa",
"Chitwan",
"Gorkha",
"Lamjung",
"Tanahun",
"Syangja",
"Kaski",
"Manang",
"Mustang",
"Myagdi",
"Parbat",
"Baglung",
"Gulmi",
"Palpa",
"Nawalparasi",
"Rupandehi",
"Kapilvastu",
"Arghakhanchi",
"Pyuthan",
"Rolpa",
"Rukum",
'Eastern Rukum',
'Western Rukum',
"Salyan",
"Dang",
"Banke",
"Bardiya",
"Surkhet",
"Dailekh",
"Jajarkot",
"Dolpa",
"Jumla",
"Kalikot",
"Mugu",
"Humla",
"Bajura",
"Bajhang",
"Achham",
"Doti",
"Kailali",
"Kanchanpur",
"Dadeldhura",
"Baitadi",
"Darchula"
];
const districts = nepalDistricts.map(district => district.toUpperCase());
class MRZ{
	constructor(content){
		this.result = this._result(content)
		this.others = []
		this.mrz = []
	}

	_process(content){
		return this._format(content.split('\n'))
	}

	_filter(arr){
		return arr.filter(item => !!item)
	}

	_format(arr){
		const _mrz = []
		const _others = []
		let fields =  {
			type: '',
			district: '',
			dob:'',
			surname:'',
			name:'',
			gender:'',
			expiry_date:'',
			issued_date:'',
			country_code:'NPL',
			passport_no:'',
			nationality:'Nepalese',
			citizen_no:''
		}
		arr.filter(item => !!item)?.forEach(item =>{
			if(item.includes('NPL')){
				_mrz.push(item.replace(/\s+|\||~/g, ''));
			}else{
				_others.push(item)

			}
			districts.forEach(district =>{
				if(item.includes(district)){
					fields = { ...fields,district:district}
				}
			})
		})
		this.others = _others
		this.mrz = _mrz
		
		let _mrzLine1 = length === 3 ? _mrz[1] : length === 2 ? _mrz[0] : '' 
		let _mrzLine2 = length === 3 ? _mrz[2] : length === 2 ? _mrz[1] : ''
		if(!_mrzLine1 || !_mrzLine2){
			_mrz?.forEach(item =>{
				if(!_mrzLine2 && !!this._containsNumber(item) && this._containsNumber(this._replaceLettertoNumber(item))?.length > 10 ){
					_mrzLine2 = item
				}
				if(!_mrzLine1 && !!this._containsLetter(item) && this._containsLetter(item)?.length > 12){
					_mrzLine1 = item
				}

			})
		}
		if(_mrzLine1?.startsWith('PB')){
			fields = { ...fields,type:'PB'}
		}else if(_mrzLine1?.startsWith('P')){
			fields = { ...fields,type:'P'}
		}
		fields = { ...fields,surname:this._surname(_mrzLine1)}
		fields = { ...fields,name: this._name(_mrzLine1)}
		if(!!_mrzLine2){ 
			const matchExpDate = this._expiryDate(_mrzLine2)
			fields = {
					 	...fields,
						passport_no:this._passportNo(_mrzLine2),
						dob:this._dob(_mrzLine2),
						gender:this._gender(_mrzLine2)
					}
			if(!!matchExpDate){
				fields = {...fields,expiry_date:matchExpDate}
				const matchIssueDate = new Date(matchExpDate)
				const tenYrsAgo = `${matchIssueDate.getFullYear() - 10}${matchExpDate.slice(4,matchExpDate.length)}`
				const getOneDayAgo = new Date(new Date(tenYrsAgo).getTime() + (24 * 60 * 60 * 1000))
				if(!!getOneDayAgo){
					fields = {...fields,issued_date:getOneDayAgo.toISOString().slice(0, 10)}
				}
			}
		}
		return fields;

	}

	_surname(_mrzLine1){
		let result = ''
		const match =  _mrzLine1.match(/(?<=NPL)[A-Z]+/)
		if(!!match){
			result = match[0];
		}else{
			this.others?.forEach((other,index )=>{
				if(other.includes('GIVEN NAMES')){
					const item = this.others[index - 1]
					result = this._removeSymbol(item)
				}
			})
		}
		return result
	}

	_name(_mrzLine1){
		let result = ''
		const match = _mrzLine1.match(/(?<=<<)[A-Z]+(?=<)/)
		if(!!match){
			result = match[0]
			let index = _mrzLine1.indexOf(match[0])
			if (index !== -1) {
			    let matchMiddleName = _mrzLine1.substring(index + match[0].length).match(/<([A-Z]+)<<+/);
			    if(!!matchMiddleName){
			    	result = `${result} ${matchMiddleName[1]}`
			    }
			}

		}else{
			this.others?.forEach((other,index )=>{
				if(other.includes('GIVEN NAMES')){
					const item =  this.others[index + 1]
					if(!item.includes('NATIONALITY') && !item.includes('NEPALT')){
						result = this._removeSymbol(item)
					}

				}
			})
		}

		return result
	}
	_passportNo(_mrzLine2){
		let result = ''
		let match =  _mrzLine2.match(/^(.*?)(?=NPL)/)

		if(!!match){
			result  = `${match[0].slice(0,2)}${this._replaceLettertoNumber(match[0].slice(2,match[0]?.length - 1))}`
		}
		return result
	}

	_gender(_mrzLine2){
		let indexMale = _mrzLine2.indexOf("M")
		let indexFemale =  _mrzLine2.indexOf("F")
		let gender = ''
		if(indexMale !==-1){
			gender = 'Male'
		}
		if(indexFemale!==-1){
			gender = 'Female'
		}
		return gender

	}

	_dob(_mrzLine2){
		let indexNPL = _mrzLine2.indexOf("NPL")
		let dob= ''
		if (indexNPL !== -1 && _mrzLine2?.length > (indexNPL + 6)) {
			dob = _mrzLine2.substring(indexNPL + 3, indexNPL + 9);
			let year = parseInt(this._replaceLettertoNumber(dob.substring(0, 2)));
			let month = dob.substring(2, 4);
			let day = dob.substring(4, 6);
			dob = `${year + ((year < 99 && year > 40) ? 1900 : 2000 )}-${month}-${day}`
		}
		return dob
	}

	_expiryDate(_mrzLine2){
		let findIndex = _mrzLine2.indexOf("M")  !== -1 ? _mrzLine2.indexOf("M") :  _mrzLine2.indexOf("F")
		let expDate = ''
		if(findIndex!==-1 && _mrzLine2?.length > (findIndex + 6)){
			expDate = _mrzLine2.substring(findIndex + 1, findIndex + 7);
			let year = parseInt(this._replaceLettertoNumber(expDate.substring(0, 2)));
			let month = expDate.substring(2, 4);
			let day = expDate.substring(4, 6);
			expDate = `${year + 2000}-${month}-${day}`
		}
		return expDate
	}
	
	_replaceLettertoNumber(str){
		const filterSymbol = this._removeSymbol(str)
		return filterSymbol.replace(/[OD]/g, '0').replace(/[BE]/g, '8').replace(/[I]/g, '9')
	}


	_removeSymbol(str){
		return str.replace(/[^A-Z0-9]/g, '')
	}

	_containsNumber(str) {
		let result=''
		const match = str.match(/\d+/g)
		return !!match ? match.join('') : null;
	}

	_containsLetter(str){
		let result=''
		const match = str.match(/[A-Z]+/g)

		return !!match ? match.join('') : null;

	}

	_result(content){
		return this._process(content)
	}


}