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
        return $nepalDistricts = [
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
    }
}