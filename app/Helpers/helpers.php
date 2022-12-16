<?php


function getCloudFrontPath($resource, $file)
{
    $path = '';
    switch ($resource) {
        case 'project_students':
            $path = 'https://d3des6gui7vs6w.cloudfront.net/maquetacion/galeria/proyectos-alumnos/postgrados/';
            break;

        default:
            $path = '';
            break;
    }

    return $path . $file;
}
