
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
		console.log(arr)
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
		const length = _mrz?.length;
		const _mrzLine1 = length === 3 ? _mrz[1] : length === 2 ? _mrz[0] : ""
		const _mrzLine2 = length === 3 ? _mrz[2] : length === 2 ? _mrz[1] : ""
		if(_mrzLine1?.startsWith('PB')){
			fields = { ...fields,type:'PB'}
		}else if(_mrzLine1?.startsWith('P')){
			fields = { ...fields,type:'P'}
		}

		if(!!_mrzLine1){
			var matchForSurname =this._surname(_mrzLine1);
			var matchForName = this._name(_mrzLine1,matchForSurname);
			if(matchForSurname && matchForSurname?.length){
				fields = { ...fields,surname:matchForSurname[0]}
			}
			if(matchForName && matchForName?.length){
				fields = { ...fields,name:matchForName[0]}
			}
		}


		if(!!_mrzLine2){
			const matchForPassportNo =this._passportNo(_mrzLine2)
			const matchDob = this._dob(_mrzLine2)
			const matchGender = this._gender(_mrzLine2)
			const matchExpDate = this._expiryDate(_mrzLine2)
			if(matchForPassportNo && matchForPassportNo?.length){
				fields = { ...fields,passport_no:this._replaceLettertoNumber(matchForPassportNo[0]).slice(0, -1)}
			}

			if(!!matchDob){
				fields = {...fields,dob:matchDob}
			}

			if(!!matchGender){
				fields = {...fields,gender:matchGender}
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

		console.log(fields);

		return fields;

	}

	_surname(_mrzLine1){
		return _mrzLine1.match(/(?<=NPL)[A-Z]+/)
	}

	_name(_mrzLine1){
		return  _mrzLine1.match(/(?<=<<)[A-Z]+(?=<)/)
	}
	_passportNo(_mrzLine2){
		return _mrzLine2.match(/^(.*?)(?=NPL)/)
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
		return this._removeSymbol(str.replace(/[OD]/g, '0').replace(/[B]/g, '8').replace(/[I]/g, '9'))
	}


	_removeSymbol(str){
		return str.replace(/[^a-zA-Z0-9]/g, '')
	}



	_result(content){
		return this._process(content)
	}
}