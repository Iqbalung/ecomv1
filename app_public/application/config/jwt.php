<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['jwt_key']	= 'OAJsi1iSHAsha81728173ls1hlyeg';


/* http://www.csfieldguide.org.nz/en/interactives/rsa-key-generator/index.html | pakai yg 256*/

/*$config['private_key'] ="MIGoAgEAAiBOYLAw9S764i29lz8z/fpDTJm4affNQLCcqKFVS9jI1QIDAQABAiAC
3dxz3fPa7zzXC1ofb7GgjCBMQAxTaHGbNfy3tc7bAQIRAJgjlhlH5KsKr0fZGSIl
KsECEQCD4khMkTVKrEPt+sin4QcVAhAYO7rh5gC3eek3kY4eUTtBAhAztaVjYAvl
G2YHCS1jpXeBAhA4ligP/5VNn4hM+359LuQ+";

$config['public_key'] ="MDswDQYJKoZIhvcNAQEBBQADKgAwJwIgTmCwMPUu+uItvZc/M/36Q0yZuGn3zUCw
nKihVUvYyNUCAwEAAQ==";*/

/*
$path = APPPATH."config\\key\\";
$key = array(
        'path' => $path,
        'private_key' => file_get_contents($path.'private_key.pem'),
        'public_key' => file_get_contents($path.'public_key.pub')
    );
$config['private_key'] = $key['private_key'];
$config['public_key'] = $key['public_key'];*/


$config['private_key'] = <<<EOD
-----BEGIN RSA PRIVATE KEY-----
MIGrAgEAAiEAs2Mpqdspk/dPJKM3Y0xzg+/HlO5++7wKmTz7g3aJseMCAwEAAQIg
OhKAClzIuP32wQWViK/XNPQDyJnzfirLnvjiJQwv/QECEQDkT4zumyw5wIXW0H/u
Xh0lAhEAySSrW3LFfYmrF2Kj/IaYZwIRAIXo3slofCUXdajMO+zsiH0CEQCqm7PM
6Vih1reMKlq1wuRZAhBW60QeWSMq8bKHpk4U8yiu
-----END RSA PRIVATE KEY-----
EOD;

$config['public_key'] = <<<EOD
-----BEGIN PUBLIC KEY-----
MDwwDQYJKoZIhvcNAQEBBQADKwAwKAIhALNjKanbKZP3TySjN2NMc4Pvx5Tufvu8
Cpk8+4N2ibHjAgMBAAE=
-----END PUBLIC KEY-----
EOD;



/* End of file jwt.php */
/* Location: ./application/config/jwt.php */