<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Регистрация | Sendmail</title>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-theme.css"/>
    <script type="text/javascript" src="/js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="/js/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <style type="text/css">
        body,div,label,h1,h2,h3,h4,input{
            color:#fff;
        }
    </style>
</head>

<body style="background: url('/img/bg-site.jpg')">
<div class="container">
    <div class="row" style="height:20px;"></div>
    <div class="row">            
        <div class="col-md-4 col-md-offset-4">                        
            <h3 >Регистрация пользователя</h3>            
            <form name="test" method="post" action="" role="form">            
                <div class="form-group">        
                    <?=$this->Session->flash('flash',array('element' => 'failure'));?>
                </div>
                <div class="form-group">
                  <label class="control-label" for="agency">Agency ID:</label>
                  <input class="form-control" placeholder="Например C428" name="data[User][agency]" type="text" value="" />
               </div>
               <div class="form-group">
                  <label class="control-label" for="staff">Staff ID:</label>
                  <input  class="form-control" placeholder="Например S12417" name="data[User][staff]" type="text" value="" />
               </div>
               <div class="form-group">
                  <label class="control-label" for="pass_agency">Пароль от админки</label>
                  <input class="form-control" name="data[User][agpass]" placeholder="Пароль с вашей админ зоны" type="password" value="" />
               </div>
                <div class="form-group">
                    <label class="form-group" for="id">ID клиентики</label>
                    <input class="form-control" name="data[User][lady]" placeholder="Например C12774" type="text" value="" />
                </div>
                <div class="form-group">
                    <label class="form-group" for="email">Ваш Email</label>
                    <input class="form-control"  name="data[User][email]" type="text" value="" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Регистрация</button>
                </div>            
            </form>   
        </div>
    </div>
</div>
</body>

</html>
