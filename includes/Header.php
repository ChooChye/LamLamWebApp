<?php

    class Header{
        public function __construct($root, $pageTitle)
        {
            $this->app_name = null;
            $this->root = $root;
            $this->pageTitle = $pageTitle;
        }

        public function initHeader(){
            include_once($this->root.'config.php');
            include($this->root.'includes/Firebase.php');
            require $this->root.'vendor/autoload.php';

            $this->app_name = $APP_NAME;
            echo '
            <!DOCTYPE html>
                <html lang="en">
                
                <head>
                
                  <meta charset="utf-8">
                  <meta http-equiv="X-UA-Compatible" content="IE=edge">
                  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                  <meta name="description" content="">
                  <meta name="author" content="">
                
                  <title>'.$APP_NAME.' - '.$this->pageTitle.'</title>
                
                  <!-- Custom fonts for this template-->
                  <link href="'.$this->root.'vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
                  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
                
                  <!-- Custom styles for this template-->
                  <link href="'.$this->root.'core/css/sb-admin-2.min.css" rel="stylesheet">
                
                </head>
                
                <body id="page-top">
            ';
        }
    }


