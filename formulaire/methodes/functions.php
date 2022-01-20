<?php

function isValidCountry(array $pays) : bool{

    if (array_key_exists('is_enable', $pays)){
        $isEnable = $pays['is_enable'];
    }else {
        $isEnable = false;
    }
    return $isEnable;
}

function displayAuthor(string $authorPseudo, array $users) : string {
    for ($i =0; $i < count($users); $i++){
        $author = $users[$i];
        if ($authorPseudo === $author['pseudo']){
            return $author['name'].'-'.$author['first_name'].'('.$author['age'].' ans)';
        }
    }

}

function getCountries(array $geo) : array {
    $validGeo = [];

    foreach ($geo as $country){
        if (isValidCountry($country)){
            $validGeo[] = $country;
        }
    }
    return $validGeo;
}
