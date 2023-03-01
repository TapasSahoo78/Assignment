<?php

if (!function_exists('getState')) {
    function getState($state_id)
    {
        $data = array(
            "1" => "West Bengal"
        );
        foreach ($data as $key => $value) {
            if ($state_id == $key)
                echo "<option value='" . $key . "' selected>" . $value . "</option>";
            else
                echo "<option value='" . $key . "'>" . $value . "</option>";
        }
    }
}

if (!function_exists('getCity')) {
    function getCity($city_id)
    {
        $data = array(
            "1" => "Newtown",
            "2" => "Rajarhat",
            "3" => "Howrah",
            "4" => "Sealdah",
            "5" => "Tollygunge",
        );
        foreach ($data as $key => $val) {
            if ($city_id == $key)
                echo "<option value='" . $key . "' selected>" . $val . "</option>";
            else
                echo "<option value='" . $key . "'>" . $val . "</option>";
        }
    }
}
