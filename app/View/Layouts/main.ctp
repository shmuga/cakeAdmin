<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> | Панель управления</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.css" rel="stylesheet">    

    <!-- Add custom CSS here -->
    <link href="/css/sb-admin.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css"> -->      
    <style type="text/css">
      .nav.navbar-nav.side-nav li.dropdown.open>a,.nav.navbar-nav.side-nav li.active{
        background:red;
      }
    </style>
    <script src="/js/jquery-1.10.2.js"></script>
    <script src="/js/bootstrap.js"></script>    
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/admin/home"><?=$settings['nazvanie-sayta']?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">                  
          <ul class="nav navbar-nav side-nav">
              <li <?=($this->action === "home") ? "class='active'" : "";?>><a href="/admin/home">Домашняя</a></li>                  
              <?foreach ($modules as $key => $value):?>                           
                      <li class="dropdown <?=($value['modules']['id']==$currentModule[0]) ? "open" : "";?>">
                          <a href="#"  data-toggle="dropdown" class="dropdown-toggle <?if ($value['modules']['id'] == $currentModule[0]) echo "active";?>"><?php echo($value['modules']['title']);?></a>    
                          <ul class="dropdown-menu">                                    
                              <?php foreach($funcsMenu as $k=>$v):?>                          
                                  <? if (key($v) == $value['modules']['id']):?>
                                  <li><a href="<?echo($k);?>"<?php if("/admin/" .$this->action==$k){echo(" class=\"active\"");}?>><?php echo(current($v));$currentAction="/admin/" .$this->action;?></a>
                                  </li>
                                  <?endif;?>
                              <?php endforeach;?>
                          </ul>                           
                      </li>
              <?endforeach;?>
            </ul> 
        
          <ul class="nav navbar-nav navbar-right navbar-user">
            <!-- <li class="dropdown messages-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge">7</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">7 New Messages</li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name"><?=$userData['User']['login'];?></span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name"><?=$userData['User']['login'];?></span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name"></span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li><a href="#">View Inbox <span class="badge">7</span></a></li>
              </ul>
            </li>
            <li class="dropdown alerts-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Default <span class="label label-default">Default</span></a></li>
                <li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>
                <li><a href="#">Success <span class="label label-success">Success</span></a></li>
                <li><a href="#">Info <span class="label label-info">Info</span></a></li>
                <li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>
                <li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>
                <li class="divider"></li>
                <li><a href="#">View All</a></li>
              </ul>
            </li> -->            
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?=$userData['User']['login'];?><b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="/admin/settings"><i class="fa fa-gear"></i> Настройки</a></li>
                <li class="divider"></li>
                <li><a href="/admin/logout"><i class="fa fa-power-off"></i> Выход</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">
        <div class="row">
              <div class="col-lg-12">
                <h1><small><?$arr = array_values($funcsAll[$currentAction]);echo $arr[0]?></small></h1>
                <ol class="breadcrumb">
                  <li><a href="javascript:void;"><i class="icon-dashboard"></i> <?=$modules[$currentModule[0]-1]['modules']['title']?></a></li>
                  <li class="active"><i class="icon-file-alt"></i> <?$arr = array_values($funcsAll[$currentAction]);echo $arr[0]?></li>
                </ol>
              </div>
        </div><!-- /.row -->  
        <?php echo $this->fetch('content'); ?>
        <?php echo $this->element('sql_dump'); ?>
      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->    
    <script type="text/javascript" src="/plugins/multiselect/js/jquery.multi-select.js"></script>
  </body>
</html>