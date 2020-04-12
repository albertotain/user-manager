<?php

namespace UserManager\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController {
  
  protected function showErrors($arrayErrors) {
    $error_msg = [];
    foreach ($arrayErrors as $errors) {
      if (is_array($errors)) {
        foreach ($errors as $error) {
          $error_msg[] = '<li>' . $error . '</li>';
        }
      } else {
        $error_msg[] = '<li>' . $errors . '</li>';
      }
    }
    if (!empty($error_msg)) {
     return '<br>' . __("Por favor corrige los seguintes errore/s:<ul> " . implode("\n \r", $error_msg) . '</ul>');
    }
  }

}
