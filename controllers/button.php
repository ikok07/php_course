<?php

function PrimaryButton($text) {
    view("partials/button.view.php", ["text" => $text]);
}