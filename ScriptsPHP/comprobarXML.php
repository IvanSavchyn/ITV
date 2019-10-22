<?php

  $target_file = "../ArchivosXML/" . basename($_FILES["file"]["name"]);
  move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

  $xml = new XMLvalidator();

  if($xml->comprobarXML(simplexml_load_file("../ArchivosXML/" . $_FILES["file"]["name"]))) {
    echo "true";
  }
  else {
    echo "false";
  }



  class XMLvalidator {
    public function comprobarXML($file) {
        return $this->isXMLContentValid($file, '1.0', 'utf-8');
    }
    public function isXMLContentValid($xmlContent, $version, $encoding)
    {
        if (trim($xmlContent) == '') {
            return true;
        }

        libxml_use_internal_errors(true);

        $doc = new DOMDocument($version, $encoding);
        $doc->loadXML($xmlContent);

        return libxml_get_errors();
        libxml_clear_errors();

        if(sizeof($errors) == 0) {
          return true;
        }
        else {
          return false;
        }

    }
  }
?>
