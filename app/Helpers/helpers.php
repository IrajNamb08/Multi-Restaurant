<?php

if (!function_exists('getBadgeClass')) {
    function getBadgeClass($etat) {
        switch ($etat) {
            case 'reçu':
                return 'warning';
            case 'en_preparation':
                return 'info';
            case 'pret_a_livrer':
                return 'success';
            case 'annule':
                return 'danger';
            default:
                return 'secondary';
        }
    }
}