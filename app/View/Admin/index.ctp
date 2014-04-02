<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вход | Admin</title>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-theme.css"/>
    <script type="text/javascript" src="/js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="/js/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <style type="text/css">
        h3,label{
            color:#fff;
        }
    </style>
</head>

<body style="background: url('/img/bg-site.png')">
<div class="container">
    <div class="row" style="height:100px;"></div>
    <div class="row">            
        <div class="col-md-4 col-md-offset-4">                        
            <h3 >Вход</h3>            
            <form name="test" method="post" action="" role="form">            
                <div class="form-group">        
                    <?=$this->Session->flash('flash',array('element' => 'failure'));?>
                </div>              
                <div class="form-group">
                    <label class="form-group" for="id">Логин</label>
                    <input class="form-control" name="data[User][login]" placeholder="" type="text" value="" />
                </div>
                <div class="form-group">
                    <label class="form-group" for="email">Пароль</label>
                    <input class="form-control"  name="data[User][password]" type="password" value="" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block">Вход</button>
                </div>
            </form>   
        </div>
    </div>
</div>
</body>

</html>
