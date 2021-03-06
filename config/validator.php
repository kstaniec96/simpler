<?php
/**
 * Settings for validator..
 *
 * @package Simpler
 * @subpackage Config
 * @version 2.0
 */

return [
    /*
     * Default and custom rules for validator.
     */
    'rules' => [
        /*
         * Default rules
         */
        'domain' => '/^(?!:\/\/)(?=.{1,255}$)((.{1,63}\.){1,127}(?![0-9]*$)[a-z0-9-]+\.?)$/i',
        'url' => '/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i',
        'password' => '#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#',
        'email' => 'email',
        'time' => '/^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$/',
        'date' => '/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/',
        'dateTime' => '/^([0-9]{4})-([0-9]{2})-([0-9]{2})\s([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$/',

        /**
         * Custom rules.
         */
    ],
];
