#CakePHP RecordTrac Port

This is a port of [RecordTrac] (https://github.com/postcode/recordtrac) using [CakePHP](http://www.cakephp.org) as the framework. 
Although this project is called a "port," it does not follow the same conventions for JSON files and DB as the original RecordTrac.


##Installation 
In your /Config/routes.php add this line (replacing the default) if you want RecordTrac, to install it as a module, you'll need to adjust the setup.
//make sure this is before pages route
>Router::connect('/', array('controller' => 'recordtrac', 'action' => 'index')); //sets recordtrac as default index for whole CakePHP install

>Router::connect('/about', array('controller' => 'pages', 'action' => 'display', 'about'));  //just a prettier for /about

>Router::connect('/track', array('controller' => 'requests', 'action' => 'track', 'track')); // track is really part of requests, not a seperate controller

>Router::connect('/track/:id', array('controller' => 'requests', 'action' => 'view'),array('pass' => array('id'))); //This routes /track/REQUESTID

###Technologies Used
http://www.ekoim.com/blog/bootstrap-cakephp-bootstrapcake/ - CakePHP Bootstrap Layout Addition

http://getbootstrap.com - Twitter Bootstrap (as included in the above Layout)

http://www.cakephp.org - CakePHP

https://github.com/destinydriven/cakephp-high-charts-plugin

https://github.com/josegonzalez/cakephp-upload