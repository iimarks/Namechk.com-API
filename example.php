<?php
/**
 * @author Saleh | Github (Saleh7)
 * @version 1.0
 */

 // Use Namechk to search for an available username ,
 // or domain and secure your brand across the internet.
 // https://namechk.com

  require 'Namechk.php';
  $Namechk = new NamechkAPI();

  // Example Search ..

  //Search Youtube
  $Youtube = $Namechk->searchYoutube('Saleh7');
  print_r($Youtube);

  //Search Twitter
  # $Twitter = $Namechk->searchTwitter('Saleh7');
  # print_r($Twitter);

  //Search Github
  # $Github = $Namechk->searchGithub('Saleh7');
  # print_r($Github);

  //Search Domains
  # $Domains = $Namechk->searchDomains('Saleh7');
  # print_r($Domains);

  //search for trademarks without character restriction like the normal search.
  # $Trademarks = $Namechk->searchTrademarks('Saleh7');
  # print_r($Trademarks);
?>
