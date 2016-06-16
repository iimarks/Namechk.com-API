<?php
/**
 * @author Saleh | Github (Saleh7)
 * @version 1.0
 */
class NamechkAPI
{
  // Use Namechk to search for an available username ,
  // or domain and secure your brand across the internet.
  // https://namechk.com

  /*function __construct($Method=null, $Name=null, $Par=null){
    if($Method or $Par)
      return $this->Request($Method,$Name,$Par);
  }*/

  /**
  * @return Cookies and csrf-token
  */
  public function getNewCookies(){
      $options = array(
          CURLOPT_RETURNTRANSFER => true,     // return web page
          CURLOPT_HEADER         => true,     //return headers in addition to content
          CURLOPT_FOLLOWLOCATION => true,     // follow redirects
          CURLOPT_ENCODING       => "",       // handle all encodings
          CURLOPT_AUTOREFERER    => true,     // set referer on redirect
          CURLINFO_HEADER_OUT    => true,
          CURLOPT_SSL_VERIFYPEER => false,     // Disabled SSL Cert checks
          CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1
      );
      $ch     = curl_init( "https://namechk.com/" );
      curl_setopt_array( $ch, $options );
      $result = curl_exec( $ch );
      $Data['cookies'] = $this->MatchOne("/Set-Cookie:(.*?);/", $result, 1);
      $Data['token'] = $this->MatchOne('/<meta content="(.*?)" name="csrf-token" \/>/', $result, 1);
      curl_close( $ch );
    return $Data;
  }

  /**
   * @param String    Method
   * @param string    Name
   * @return json data
  */
  public function Request($Method, $Name, $Par=null){
      $getNewCookies = $this->getNewCookies();
      $Token = $getNewCookies['token']; // Or Enter the token ..
      $Cookies = $getNewCookies['cookies']; // Or Enter the cookies .
      $options = array(
          CURLOPT_RETURNTRANSFER => true,     // return web page
          CURLOPT_SSL_VERIFYPEER => false,     // Disabled SSL Cert checks
          CURLOPT_COOKIE         => $Cookies
      );
      if($Par){
        $Url = "https://namechk.com/$Par&ru=$Token";
      }else{
        $Url = "https://namechk.com/availability/$Method?q=$Name&ru=$Token";
      }
      $ch    = curl_init( $Url );
      curl_setopt_array( $ch, $options );
      $result= curl_exec( $ch );
      curl_close( $ch );
    return json_decode($result);
  }

  /**
   * @param String | $User
   */
  public function searchYoutube($User){
     return $this->Request('youtube',$User);
  }

  /**
   * @param String | $User
   */
  public function searchFacebook($User){
     return $this->Request('facebook',$User);
  }

  /**
   * @param String | $User
   */
  public function searchTwitter($User){
     return $this->Request('twitter',$User);
  }

  /**
   * @param String | $User
   */
  public function searchGithub($User){
     return $this->Request('github',$User);
  }

  /**
   * @param String | $User
   */
  public function searchDomains($User){
    $domains = "domains/$User?tlds=com,net,org,me,us,co,io,co.uk,place,auto,xyz,tv,ninja,ink,bar,work,cars,nz,eu,be,am,it,li,info,guru,pro,ms,ca";
    return $this->Request(null,null,$domains);
  }

  /**
   * @param String | $name
   * allows you to search for trademarks without character restriction like the normal search.
   */
  public function searchTrademarks($name){
     return $this->Request(null,null,"trademarks?q=$name");
  }

  /**
    * @param String | $Regex
    * @param String | $Html
    * @param integer | $KeyIndex | Default 0
   */
  private function MatchOne($Regex, $Html, $KeyIndex = 0){
     if(preg_match($Regex, $Html, $Match) == 1)
        return $Match[$KeyIndex];
     else
        return false;
  }
}
?>
