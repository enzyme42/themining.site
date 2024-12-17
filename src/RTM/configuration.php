<?php

$frontend_configuration = [
  'page_title' => 'The Mining Site: Raptoreum',
  'page_subfolder' => '/RTM/',
  'page_theme_path' => 'themes/tms/',
  'page_stylesheet' => 'styles.css',
  'page_debugmode' => True,

  'math_precision' => 2,

  'pool_color' => '#B64225',
  'pool_donation_currency' => 'Raptoreum',

  'pool_donation_wallet' => 'RQRm1eaSEXs2c5panSf2ziSoVHbThbweTs',
  'pool_donation_explorer_link' => 'https://explorer.rtm-1.zelcore.io/address/RQRm1eaSEXs2c5panSf2ziSoVHbThbweTs',

  'pool_hashrate_unit' => 'H/s',
  'pool_ip' => '127.0.0.1',

  'pool_name' => 'raptoreum',

  'pool_suggested_software' => 'WildRig Multi',
  'pool_suggested_software_linux' => 'wildrig-multi',
  'pool_suggested_software_windows' => 'wildrig.exe',
  'pool_suggested_command_algo' => '-a',
  'pool_suggested_command_open' => '-o',
  'pool_suggested_command_wallet' => '-u',
  'pool_suggested_command_worker' => '-w',
  'pool_suggested_software_link' => 'https://github.com/andru-kun/wildrig-multi/releases'
];

$server_configuration = getData('http://'.$frontend_configuration['pool_ip'].':3001/api/v2/'.$frontend_configuration['pool_name'].'/current/configuration')[0];

?>
