<?php 
if(!function_exists('getPermissionUrl')){
	function getPermissionUrl($accessUri){
		$html = '<div class="table-permission-list-wrapper">';
        $html.='<ul>';
        foreach($accessUri as $url){
            if($url == '/*') {
                $html.= '<li>Full Control</li>';
            }else{
                $urlArr = explode('/',$url);
                $action = count($urlArr) > 2 ? ucFirst($urlArr[2]) : 'View';
                $html.= '<li>'.$action.' '.ucFirst($urlArr[1]).'</li>';
            }
        }
        $html .= '</ul>';
        $html .='</div>';
        return $html;
    }
}


if(!function_exists('getDistricts')){
    function getDistricts(){
        $nepalDistricts = [
            "Achham",
            "Arghakhanchi",
            "Baglung",
            "Baitadi",
            "Bajhang",
            "Bajura",
            "Banke",
            "Bara",
            "Bardiya",
            "Bhaktapur",
            "Bhojpur",
            "Chitwan",
            "Dadeldhura",
            "Dailekh",
            "Dang",
            "Darchula",
            "Dhading",
            "Dhankuta",
            "Dhanusa",
            "Dolakha",
            "Dolpa",
            "Doti",
            "Gorkha",
            "Gulmi",
            "Humla",
            "Ilam",
            "Jajarkot",
            "Jhapa",
            "Jumla",
            "Kailali",
            "Kalikot",
            "Kanchanpur",
            "Kapilvastu",
            "Kaski",
            "Kathmandu",
            "Kavrepalanchok",
            "Khotang",
            "Lalitpur",
            "Lamjung",
            "Mahottari",
            "Makwanpur",
            "Manang",
            "Morang",
            "Mugu",
            "Mustang",
            "Myagdi",
            "Nawalparasi",
            "Nuwakot",
            "Okhaldhunga",
            "Palpa",
            "Panchthar",
            "Parbat",
            "Parsa",
            "Pyuthan",
            "Ramechhap",
            "Rasuwa",
            "Rautahat",
            "Rolpa",
            "Rukum",
            "Rupandehi",
            "Salyan",
            "Sankhuwasabha",
            "Saptari",
            "Sarlahi",
            "Sindhuli",
            "Sindhupalchok",
            "Siraha",
            "Solukhumbu",
            "Sunsari",
            "Surkhet",
            "Syangja",
            "Tanahun",
            "Taplejung",
            "Terhathum",
            "Udayapur"
        ];
        return $nepalDistricts;
    }
}


if(!function_exists('getMaritalStatus')){
    function getMaritalStatus(){
        return [
            'Married',
            'Single'
        ];
    }
}

if(!function_exists('getGender')){
    function getGender(){
        return [
            'Male',
            'Female'
        ];
    }
}