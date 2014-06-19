#CakePHP RecordTrac Port

This is a port of [RecordTrac] (https://github.com/postcode/recordtrac) using [CakePHP](http://www.cakephp.org) as the framework. 
Although this project is called a "port," it does not follow the same conventions for JSON files and DB as the original RecordTrac.


##Installation 
In your /Config/routes.php add this line (replacing the default) if you want RecordTrac as your default view, otherwise, you can ignore this
>Router::connect('/', array('controller' => 'users', 'action' => 'signup'));


###Technologies Used
http://www.ekoim.com/blog/bootstrap-cakephp-bootstrapcake/ - CakePHP Bootstrap Layout Addition

http://getbootstrap.com - Twitter Bootstrap (as included in the above Layout)

http://www.cakephp.org - CakePHP
