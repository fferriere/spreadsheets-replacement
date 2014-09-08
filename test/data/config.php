<?php

return array(
    'columns' => array(
        array(
            'source' => 'B',
            'destination' => 'A',
            'actions' => array(
                array(
                    'type' => 'Concat',
                    'start' => '\'',
                ),
            ),
        ),
        array(
            'source' => 'C',
            'destination' => 'B',
            'actions' => array(
                array(
                    'type' => 'FullReplace',
                    'search' => 'VE',
                    'replace' => 'VTE'
                ),
            ),
        ),
        array(
            'source' => 'D',
            'destination' => 'C',
            'actions' => array(
                array(
                    'type' => 'StrReplace',
                    'search' => '447510001',
                    'replace' => '4457101'
                ),
                array(
                    'type' => 'Regexp',
                    'pattern' => '#^411(.)*$#',
                    'replacement' => '4110000'
                ),
                array(
                    'type' => 'Regexp',
                    'pattern' => '#^7(.{4}).*(.{2})$#',
                    'replacement' => '7$1$2'
                ),
            ),
        ),
        array(
            'source' => 'D',
            'destination' => 'D',
            'name' => 'D1',
            'actions' => array(
                array(
                    'type' => 'Regexp',
                    'pattern' => '#^(?!411)(.)*$#',
                    'replacement' => ''
                ),
                array(
                    'type' => 'Regexp',
                    'pattern' => '#^411(.*)$#',
                    'replacement' => 'CL$1'
                ),
            ),
        ),
        array(
            'source' => 'I',
            'destination' => 'E',
        ),
        array(
            'source' => 'H',
            'destination' => 'F',
            'actions' => array(
                array(
                    'type' => 'StrReplace',
                    'search' => '.',
                    'replace' => ','
                )
            )
        ),
        array(
            'source' => 'F',
            'destination' => 'G',
        ),
        array(
            'source' => 'G',
            'destination' => 'H',
        ),
    ),
);
