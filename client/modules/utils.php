<?php

function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 1) . ' GB';
    } elseif ($bytes >= 10485760) {
        $bytes = number_format($bytes / 1048576) . ' MB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 1) . ' MB';
    } elseif ($bytes >= 10240) {
        $bytes = number_format($bytes / 1024) . ' KB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 1) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
}

function getIcon($type)
{
    switch ($type) {
        case '':
        case 'zip':
        case 'rar':
            return 'folder.svg';
            break;
        case 'doc':
        case 'odt':
        case 'pdf':
            return 'doc.svg';
            break;
        case 'exe':
        case 'dmg':
            return 'grid.svg';
            break;
        case 'mp3':
            return 'music-tone.svg';
            break;
        case 'mp4':
            return 'film.svg';
            break;
        case 'jpg':
        case 'png':
        case 'svg':
            return 'picture.svg';
            break;
        case 'ppt':
            return 'pie-chart.svg';
            break;
        case 'txt':
            return 'note.svg';
        default:
            return 'question.svg';
    }
}

function getBaseUrl()
{
    $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
    return $protocol . $_SERVER['HTTP_HOST'];
}

function getFolderPath($folderName)
{
    if ($folderName !== 'files') {
        return $folderPath = './files/' . $folderName;
    } else {
        return $folderPath = './files';
    }
}
